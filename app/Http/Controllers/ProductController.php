<?php

namespace Ecograph\Http\Controllers;

use Auth;
use Ecograph\Acesso;
use Ecograph\Customer;
use Ecograph\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Ecograph\Libs\Layout;
use Ecograph\Libs\Fichas;
use Ecograph\CategoryFormato;
use Ecograph\Cor;
use Ecograph\CategoryCor;
use Ecograph\Enoblecimento;
use Ecograph\CategoryEnoblecimento;
use Ecograph\CategoryPapel;
use Ecograph\CategoryAcabamento;
use Ecograph\Formato;
use Ecograph\Papel;
use Ecograph\Acabamento;
use Ecograph\Pacformato;
use Ecograph\Pacote;
use Ecograph\ProdutoPerfil;
use Ecograph\Category;
use Ecograph\CategoryProduct;
use Ecograph\CategoryDescription;
use Utilidades;

class ProductController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Product Controller
      |--------------------------------------------------------------------------
      |
      | This controller renders your application's "dashboard" for users that
      | are authenticated. Of course, you are free to change or remove the
      | controller as you wish. It is just here to get your app started!
      |
     */
    private $enoblecimentoModel;
    private $acabamentoModel;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Enoblecimento $enoblecimentoModel, Acabamento $acabamentoModel) {
        $this->enoblecimentoModel = $enoblecimentoModel;
        $this->acabamentoModel = $acabamentoModel;
    }

    /**
     * *
     * apresenta a página prodtuos
     * @return view
     */
    public function index() {

        $lista = Fichas::CategoriasPais();
        foreach ($lista as $categorias) {
            foreach ($categorias['prole']['filhos'] as $key => $item) {
                $listagem[] = array($item['id'], $item['nome_filho']);
            }
        }
        return view('produtos.index')
            ->with('title', STORE_NAME . ' Impressos em geral por tema ou profissão')
            ->with('page', 'vitrine')
            ->with('ativo', 'Vitrine')
            ->with('listagem', $listagem)
            ->with('rota', 'produtos/portfolio.html');
    }

    /**
     * *
     * apresenta a página detalhes.
     * @return view
     */
    public function Detalhes($pai, $filho, $nome_html) {

        $lista = Fichas::CategoriasPais();
        $listagem = '';
        foreach ($lista as $categorias) {
            foreach ($categorias['prole']['filhos'] as $key => $item) {
                $listagem[] = array($item['id'], $item['nome_filho']);
            }
        }
        $solicitado = array('pai' => $pai, 'filho' => $filho, 'nome_html' => $nome_html);
        //dd($solicitado);
        return view('produtos.index')
            ->with('title', STORE_NAME . ' Calculadora On Line')
            ->with('page', 'detalhes')
            ->with('ativo', 'Detalhes')
            ->with('listagem', $listagem)
            ->with('solicitado', $solicitado)
            ->with('rota', 'produtos/detalhes/'.$pai.'/'.$filho.'/'.$nome_html);
    }

    /**
     * *
     * apresenta a página detalhes.
     * @return view
     */
    public function DetalhesCartaoGratis($pai, $filho, $nome_html, Acesso $acesso) {
        if(!Auth::check()){
            return redirect()->route('clientes.login');
        } else {
            $acesso = $acesso->where('customer_id', Auth::user()->id)->get()->first()->permite_brinde;
            if($acesso == 0){
                return 'proibido';
            }
        }
        $lista = Fichas::CategoriasPais(true);
        $listagem = '';
        foreach ($lista as $categorias) {
            foreach ($categorias['prole']['filhos'] as $key => $item) {
                $listagem[] = array($item['id'], $item['nome_filho']);
            }
        }
        //dd($listagem);
        $solicitado = array('pai' => $pai, 'filho' => $filho, 'nome_html' => $nome_html);

        return view('produtos.index')
            ->with('title', STORE_NAME . ' Calculadora On Line')
            ->with('page', 'detalhescv')
            ->with('ativo', 'Cartão Grátis')
            ->with('listagem', $listagem)
            ->with('solicitado', $solicitado)
            ->with('rota', 'produtos/detalhes/'.$pai.'/'.$filho.'/'.$nome_html);
    }

    /**
     * prepara a configuração de preços e pesos.
     * de acordo com a categoria
     * solicitada
     * @return Json
     */
    public function Orcamento(Request $request) {
        $post_inputs = $request->all();
        //envia o email de com os dados para o orçamento
        \EnvioEmail::EnviarOrcamento();
        return view('produtos.index')
            ->with('title', STORE_NAME)
            ->with('page', 'imprimir')
            ->with('post_inputs', $post_inputs)
            ->with('ativo', 'teste')
            ->with('rota', 'produtos/orcamento');
    }
    /**
     * *
     * apresenta a página prodtuos
     * @return view
     */
    public function EnviarPDF(Request $request, Customer $modelCustomer) {
        $post_inputs = $request->all();
        $img_categoria = Category::find($post_inputs['orc_subcategoria_id'])->categories_image;
        $userId = \Auth::user()->id;
        $customers = $modelCustomer->find($userId);
        $default_address = $customers->customers_default_address_id;
        $address = $customers->AddressBook()->where('id',$default_address)->first();

        //levanta o endereço do cliente
        //$default_address = AddressBook::find($customers->customers_default_address_id);
        $pacote_valor = str_replace('R$ ','',$post_inputs['orc_pacote_valor']);
        $valor = str_replace(',','.',$pacote_valor);
        $vl = $post_inputs['orc_vl_frete']+$valor-$post_inputs['orc_desconto_valor'];

        $total = number_format($vl,2,".","");
        return view('produtos.index',compact('customers'))
            ->with('title', STORE_NAME . ' Envie seu arquivo PDF')
            ->with('page', 'enviarpdf')
            ->with('ativo', 'Enviar PDF')
            ->with('post_inputs', $post_inputs)
            ->with('default_address', $address)
            ->with('img_categoria', $img_categoria)
            ->with('total',$total)
            ->with('rota', 'produtos/enviarpdf.html');
    }

    /* função e chamada pela função carregar() do javascript */

    public function Validar(Request $request) {
        //dd($request->all());
        $file1 = $request->file('logo1');
        $file2 = $request->file('logo1');
        if($file1 || $file2){
            //dd($request->input());
            $inputs = $request->all();
            $data = [
                'status' => 'success',
                'inputs' => $inputs,
                'loadurl'=>route('files.upload')
            ];
        } else {
            $inputs = [];
            $data = [
                'status' => 'fail',
                'erro' => 'Por favor! Escolha pelo menos uma imagem para enviar.',
                'loadurl'=>''
            ];
        }
        return json_encode($data);
    }
    /**
     * mostra a página de modelos dos produtos
     * selecionados
     * @return Json
     */
    public function Portfolio(Request $request) {
        $post_inputs = $request->all();
        if(empty($post_inputs['orc_acabamento_nome'])){
            $orc_acabamento_nome = Acabamento::find($post_inputs['orc_acabamento_id']);
            $post_inputs['orc_acabamento_nome'] = $orc_acabamento_nome->valor;
        }

        //quem é o pai da categoria enviada
        $pai = Category::find($post_inputs['orc_subcategoria_id'])->parent_id;
        $categ_pai = Fichas::nomecategoria($pai);
        $cat = Category::where('parent_id', $pai)->get();
        $categoria = $cat->toarray();

        //verificar se existe o produto para a categoria solicitada
        $check_produtos = CategoryProduct::where('category_id', $post_inputs['orc_subcategoria_id'])->lists('product_id');
//se existir produtos vinculados
        if (count($check_produtos) > 0) {
            $perfis_produtos = ProdutoPerfil::where('perfil_id', $post_inputs['orc_id_perfil'])
                ->wherein('product_id', $check_produtos)
                ->orderby('created_at')
                ->paginate(NR_PRODUTOS_POR_PAGINA);
        }

        $path = $perfis_produtos->setPath('produtos/portfolio.html');

        if ($perfis_produtos->total() > 0) {
            return view('produtos.index')
                ->with('title', STORE_NAME . $post_inputs['orc_categoria_nome'])
                ->with('parent', $pai)
                ->with('page', 'listagem')
                ->with('categorias', $categoria)
                ->with('perfis_produtos', $perfis_produtos)
                ->with('links', $path->render())
                ->with('post_inputs', $post_inputs)
                ->with('ativo', $categ_pai)
                ->with('total', $perfis_produtos->total())
                ->with('rota', 'produtos/portfolio.html');
        } else {
            echo 'sem produtos';
        }
    }

    /**
     * prepara a configuração de preços e pesos.
     * de acordo com a categoria
     * solicitada
     * @return Json
     */
    public function Calculadora(Request $request) {
        $post_inputs = $request->all();
        $layout = [];

        $formato_id = CategoryFormato::where('category_id', $post_inputs['escolhido'])
            ->lists('formato_id');
        //dd($formato_id);
        if (count($formato_id) > 0) {
            foreach ($formato_id as $k => $valor) {
                $formato[] = array('id' => $valor, 'nome' => Formato::find($valor)->valor);
            }
        } else {
            $data = array();
            $data['back_menu'] = array('background' => '');
            $data['active_a'] = array('style_a' => '');
            $data['imagem'] = array('image' => utf8_encode('images/fora-do-ar.jpg'));
            $data['processamento'] = array('erro' => utf8_encode('Erro no processamento.'));
            $data['informacao'] = array('info' => utf8_encode('Essa categoria ainda não foi cadastrada.'));
            //dd($data);
            $json_data = json_encode($data);

            return $json_data;
        }
        $cores = '';
        $cor_id = CategoryCor::where('category_id', $post_inputs['escolhido'])->lists('cor_id');
        foreach ($cor_id as $k => $valor) {
            $cores[] = array('id' => $valor, 'nome' => Cor::find($valor)->valor);
        }
        $papel_id = CategoryPapel::where('category_id', $post_inputs['escolhido'])->lists('papel_id');
        foreach ($papel_id as $k => $valor) {
            $papel[] = array('id' => $valor, 'nome' => Papel::find($valor)->valor);
        }
        $enoblecimento_id = $this->enoblecimentoModel->where('category_id', $post_inputs['escolhido'])->get()->lists('valor','id');
        $acabamento_id = CategoryAcabamento::where('category_id', $post_inputs['escolhido'])->lists('acabamento_id');

        foreach ($enoblecimento_id as $id => $valor) {

            $enoblecimento[] = [
                'id' => $id,
                'nome' => $valor
            ];

        }

        foreach ($acabamento_id as $k => $valor) {
            $enoblec_id = $this->enoblecimentoModel
                ->where('valor', Acabamento::find($valor)->enoblecimento)->get()->first()->id;

            $acabamento[$enoblec_id][] = [
                'valores' => [
                    'id' => $valor,
                    'nome' => Acabamento::find($valor)->valor,
                    'enobrecimento' => Acabamento::find($valor)->enoblecimento
                ]
            ];
        }

        $pacote = Pacote::where('category_id', $post_inputs['escolhido'])->get();
        $pacote_qtd = $pacote->toarray();
        foreach ($pacote_qtd as $key => $itens) {
            $quantidade[] = [
                'id' => $itens['id'],
                'unidade' => $itens['quantity']
            ];
        }
        $tabela = [
            'formato' => $formato,
            'cores' => $cores,
            'papel' => $papel,
            'enoblecimento' => $enoblecimento,
            'acabamento' => $acabamento
        ];
        $category = Category::find($post_inputs['escolhido']);
        $parent_cores = $category->toarray();
        switch ($parent_cores['parent_id']) {
            case 1 :
                //comercial
                $back_menu = "#CC0000";
                break;
            case 2 :
                //editorial
                $back_menu = $back_li = "#FFBF00";
                break;
            case 3 :
                //promocional
                $back_menu = "#009900";
                break;
            case 4 :
                //brindes
                $back_menu = "#663399";
                break;
        }
        //dados da categoria
        $dados_categoria = CategoryDescription::where('id', $post_inputs['escolhido'])->get();
        $categoria = $dados_categoria->toarray();

        if ($categoria[0]['categories_info'] != '') {
            $info = ($categoria[0]['categories_info']);
        } else {
            $info = ('<p>Impressão de alta definição.</p>');
        }
        if ($categoria[0]['categories_descricao'] != '') {
            $desc = utf8_encode($categoria[0]['categories_descricao']);
        } else {
            $desc = utf8_encode('<p>Vários modelos e formatos.</p>');
        }
        $check = Pacformato::where('category_id', $post_inputs['escolhido']);
        if ($check) {
            // dd($tabela);
            $data = array();
            $data['back_menu'] = array('background' => $back_menu);
            $data['active_a'] = array('style_a' => '');
            $data['imagem'] = array('image' => utf8_encode('images/' . $parent_cores['categories_image']));
            $data['parans'] = $tabela;
            $data['qtd'] = $quantidade;
            $data['informacao'] = array('info' => $info);
            $data['processamento'] = array('erro' => '');
            $data['descricao'] = array('desc' => $desc);
            $data['parent'] = array('pai' => $parent_cores['parent_id']);
            //dd($data);
            $json_data = json_encode($data);
            return $json_data;
        }
        $data = array();
        $data['back_menu'] = array('background' => '#324241');
        $data['imagem'] = array('image' => utf8_encode('images/fora-do-ar.jpg'));
        $data['erro'] = array('erro' => utf8_encode('Erro no processamento.'));
        $data['informacao'] = array('info' => utf8_encode('Essa categoria ainda não foi cadastrada.'));
        //, JSON_PRETTY_PRINT
        $json_data = json_encode($data);
        return $json_data;
    }
    /**
     * prepara a configuração de preços e pesos.
     * de acordo com a categoria
     * solicitada
     * @return Json
     */
    public function ListaAcabamento($categoria,$papel,$enobrecimento) {
        if($categoria == 5){
            switch ($papel) {
                case 1 :
                    $autoriza = [2, 3, 4, 5, 6, 7, 8,9];

                    break;
                case 2 :
                    $autoriza = [2, 6];
                    break;
                case 3 :
                    $autoriza = [1, 5];
                    break;
            }
        } else {
            $autoriza = $acabamento_id = $this->acabamentoModel->all()->lists('id');
        }

        $enobrecimento_nome = $this->enoblecimentoModel->find($enobrecimento)->valor;
        $acabamento_id = $this->acabamentoModel->where('enoblecimento', $enobrecimento_nome)->wherein('id',$autoriza)->get()->lists('id');
        $data['acabamento'] = $acabamento_id;
        $json_data = json_encode($data);
        return $json_data;

    }
    /**
     * mostra a página de modelos dos produtos
     * selecionados
     * @return view
     */
    public function Produtos() {
        $categorias = Category::all();
        $categ = $categorias->toArray();
        foreach ($categ as $categoria) {
            //if ($categoria['parent_id'] != 0 && $categoria['id'] <> 19 && $categoria['id'] <> 27 && $categoria['id'] <> 28 && $categoria['id'] <> 31) {
            if ($categoria['parent_id'] != 0 && $categoria['id'] <> 18 && $categoria['id'] <> 29 && $categoria['id'] <> 32 && $categoria['id'] <> 35) {
                $cat[] = $categoria;
            }
            //}
        }
        $array_categ = Utilidades::agrupa($cat, 4, 'busca');

        return view('produtos.index')
            ->with('title', STORE_NAME)
            ->with('page', 'produtos')
            ->with('ativo', 'Produtos')
            ->with('array_categ', $array_categ)
            ->with('rota', 'produtos.html');
    }


}
