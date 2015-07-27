<?php

namespace Ecograph\Http\Controllers;

use Ecograph\Category;
use Ecograph\Http\Requests;
use Ecograph\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Ecograph\Pacote;
use Ecograph\CategoryFormato;
use Ecograph\Pacformato;
use Ecograph\CategoryPapel;
use Ecograph\Pacpapel;
use Ecograph\CategoryAcabamento;
use Ecograph\Pacacabamento;
use Ecograph\Libs\Utilidades;
use Ecograph\Libs\Fretes;

class PricesController extends Controller {
    private $category;
    /**
     * *levanta um array.
     * de preços e pesos
     * de acordo com a categoria solicitada
     * @return json
     */
    public function Precos(Category $category, Request $request) {
        $post_inputs = $request->all();

        //identifica as linhas que atendem a categoria e formato enviados
        //$cat = $category->find($post_inputs['categoria']);
        //$category_formato = $cat->formato->lists('id');
       /* dd($category_formato);*/
        $category_formato = CategoryFormato::where('category_id', $post_inputs['categoria'])
                ->where('formato_id', $post_inputs['formato'])
                ->lists('id');

        //levantando apenas as linhas que atendem a categoria o os id do category_formato
        $pacote_formatos = Pacformato::where('category_id', $post_inputs['categoria'])
                ->wherein('category_formato_id', $category_formato)
                ->lists('id');

        //identificando o id da categoroy_papel
        $category_papel = CategoryPapel::where('category_id', $post_inputs['categoria'])
                ->where('papel_id', $post_inputs['papel'])
                ->lists('id');

        //levantando as linhas que atendem categoria papel e pac_formato
        $pacote_papeis = Pacpapel::where('category_id', $post_inputs['categoria'])
                ->where('category_papel_id', $category_papel[0])
                ->wherein('pacformato_id', $pacote_formatos)
                ->lists('id');
        //identificando o peso para o pacote 
        $category_peso = Pacpapel::wherein('id', $pacote_papeis)->get();
        $peso = $category_peso->toarray();
$pacote_peso=[];
        foreach ($peso as $k => $valores) {
            $pacote_peso[] = utf8_encode($valores['weight']);
        }

        $category_acabamento = CategoryAcabamento::where('category_id', $post_inputs['categoria'])
                ->where('acabamento_id', $post_inputs['acabamento'])
                ->lists('id');
        //dd($category_acabamento);
        //levantando as linhas que atendem categoria acabamento e pac_papel
        $pacote_acabamentos = Pacacabamento::where('category_id', $post_inputs['categoria'])
                ->where('category_acabamento_id', $category_acabamento[0])
                ->wherein('pacpapel_id', $pacote_papeis)
                ->get();

        $acabamento = $pacote_acabamentos->toarray();

        $span_preco = array();
        foreach ($acabamento as $k => $preco) {
            $span_preco[] = Utilidades::RealBusca(Pacacabamento::find($preco['id'])->price);
            $data = array('preco' => $span_preco);
        }
        $data['peso'] = ($pacote_peso);
        if ($post_inputs['categoria'] == 5) {
            $data['preco'][5] = '25,00';
            $data['preco'][6] = '25,00';
            $data['preco'][7] = '25,00';
            $data['preco'][8] = '25,00';
            $data['preco'][9] = '25,00';
        }
        //dd($data);
        if (is_array($data)) {
            return ($data);
        }
    }

    /**
     * encontra o frete para o peso e cep encaminhado
     * @return json
     */
    public function Fretes(Request $request) {
        $post_inputs = $request->all();
        $post_inputs['orc_peso'] = '3.25';
        //$URL_PAC = Fretes::makeURL($post_inputs['orc_peso'], '90810150', $post_inputs['orc_cep'], '41106');
        $URL_SEDEX = Fretes::makeURL($post_inputs['orc_peso'], $post_inputs['orc_cep'], '40010');
        //echo $URL_SEDEX ;exit;
        //$valor_pac = Fretes::GetRequestCorreio($URL_PAC);
        $valor_sedex = Fretes::GetRequestCorreio($URL_SEDEX);
        if ($valor_sedex['erro']) {
            $data = array('erro' => true,
                'mensagem' => $valor_sedex['erro']);
        } else {
            
            $data = array('erro' => false,
                'Transportadora' => 0,
                'SEDEX' => $valor_sedex['valor'],
                'Retirada na Loja' => 0);
        }
        //dd(json_encode($data));
        return json_encode($data);
    }

}
