<?php

namespace Ecograph\Http\Controllers;

use Ecograph\Acabamento;
use Ecograph\Category;
use Ecograph\CategoryEnoblecimento;
use Ecograph\Enoblecimento;
use Ecograph\Http\Requests;
use Ecograph\Http\Controllers\Controller;
use Ecograph\Paccor;
use Illuminate\Http\Request;
use Ecograph\Pacote;
use Ecograph\CategoryFormato;
use Ecograph\Pacformato;
use Ecograph\CategoryPapel;
use Ecograph\CategoryCor;
use Ecograph\Pacpapel;
use Ecograph\CategoryAcabamento;
use Ecograph\Pacacabamento;
use Ecograph\Libs\Utilidades;
use Ecograph\Libs\Fretes;

class PricesController extends Controller {
    private $category;
    private $pacFormato;
    private $pacPapel;
    private $pacCor;
    private $pacAcabamento;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Category $category, Pacformato $pacFormato, Pacpapel $pacPapel, Paccor $pacCor, Pacacabamento $pacAcabamento) {
        //$this->middleware('auth');
        $this->category = $category;
        $this->pacFormato = $pacFormato;
        $this->pacPapel = $pacPapel;
        $this->pacCor = $pacCor;
        $this->pacAcabamento = $pacAcabamento;
    }
    /**
     * *levanta um array.
     * de preços e pesos
     * de acordo com a categoria solicitada
     * @return json
     */
    public function Precos(Category $category, Request $request, CategoryFormato $categoryFormato, CategoryPapel $categoryPapel, CategoryCor $categoryCor, CategoryAcabamento $categoryAcabamento) {

        $data = '';
        $post_inputs = $request->all();

        if($post_inputs['categoria'] == 29){
            $cat_id = 5;
        } else {
            $cat_id = $post_inputs['categoria'];
        }
        $cat = $category->find($cat_id);

        $formato_id = $post_inputs['formato'];
        $category_formato_id = $categoryFormato
            ->where('formato_id',$formato_id)
            ->where('category_id',$cat_id)->first()->id;
        $PacFormatos = $cat->CategoryFormato->find($category_formato_id)->PacFormatos()->lists('id');

        $papel_id = $post_inputs['papel'];
        $category_papel_id = $categoryPapel
            ->where('papel_id',$papel_id)
            ->where('category_id',$cat_id)->first()->id;
        $PacPapeis = $cat->CategoryPapel->find($category_papel_id)->PacPapeis()->wherein('pacformato_id',$PacFormatos)->lists('id');
        $PacPapeisWeight = $cat->CategoryPapel->find($category_papel_id)->PacPapeis()->wherein('pacformato_id',$PacFormatos)->lists('weight');

        $cor_id = $post_inputs['cor'];
        $category_cor_id = $categoryCor
            ->where('cor_id',$cor_id)
            ->where('category_id',$cat_id)->first()->id;
        $PacCores = $cat->CategoryCor->find($category_cor_id)->PacCor()->wherein('pacpapel_id',$PacPapeis)->lists('id');

        $acabamento_id = $post_inputs['acabamento'];
        $category_acabamento_id = $categoryAcabamento
            ->where('acabamento_id',$acabamento_id)
            ->where('category_id',$cat_id)->first()->id;

        $PacAcabamentos = $cat->CategoryAcabamento->find($category_acabamento_id)->PacAcabamentos()

            ->wherein('paccor_id',$PacCores)->lists('price');

        if(count($PacAcabamentos)>0){
            $span_preco = array();
            foreach ($PacAcabamentos as $k => $preco) {
                $span_preco[] = Utilidades::RealBusca($preco);
                //$data = array('preco' => $span_preco);
            }
            $data['status'] = 'ok';
            $data['preco'] = $span_preco;
            $data['peso'] = $PacPapeisWeight;
        } else {
            $data['status'] = 'erro';
            $data['info'] = 'Preço ainda não cadastrado';
        }
        //dd($data);
        return ($data);
    }

    /**
     * encontra o frete para o peso e cep encaminhado
     * @return json
     */
    public function Fretes(Request $request) {
        $post_inputs = $request->all();
        //$post_inputs['orc_peso'] = 31;
        //verifica o peso
        if($post_inputs['orc_peso']<= 30){
            $UF = Fretes::UF($post_inputs['orc_cep']);
            //testa para ver se é frete grátis
            if($UF == ESTADO_FRETE_GRATIS && $vl_declarado >= VALOR_LIMITE_TRANSPORTE_GRATIS){
                //permite frete grátis
                $data = array('erro' => false,
                    'mensagem' => 'Frete Grátis para '.$UF,
                    'Transportadora' => 0,
                    'SEDEX' => 0,
                    'Retirada na Loja' => 0);
                //dd(json_encode($data));
                return json_encode($data);
            }
            $vl_declarado = $post_inputs['vl_declarado'];
            $URL_SEDEX = Fretes::makeURL($post_inputs['orc_peso'], $post_inputs['orc_cep'], '40010',$vl_declarado);
            $valor_sedex = Fretes::GetRequestCorreio($URL_SEDEX);
            if ($valor_sedex['erro']) {
                $data = [
                    'erro' => true,
                    'mensagem' => $valor_sedex['erro']
                ];
                return json_encode($data);
            }else{
                $data = [
                    'erro' => false,
                    'mensagem' => '',
                    'Transportadora' => 0,
                    'SEDEX' => $valor_sedex['valor'],
                    'Retirada na Loja' => 0
                ];
                //dd(json_encode($data));
                return json_encode($data);
            }

        }else{
            $data = [
                'erro' => false,
                'mensagem' => 'Peso superior a 30KG',
                'Transportadora' => 0,
                'SEDEX' => 999999,
                'Retirada na Loja' => 0
            ];
            //dd(json_encode($data));
            return json_encode($data);
        }
    }

}
