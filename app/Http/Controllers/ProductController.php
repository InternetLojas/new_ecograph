<?php

namespace Ecograph\Http\Controllers;

use Ecograph\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Ecograph\Libs\Layout;
use Ecograph\Libs\Fichas;
use Ecograph\CategoryFormato;
use Ecograph\Core;
use Ecograph\CategoryCore;
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

    private $layout;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Layout $layout) {
        $this->layout = $layout;
        //$this->middleware('auth');
    }

    /**
     * *
     * apresenta a página prodtuos
     * @return view
     */
    public function index() {
        //$category = Category::pai();
        $layout = $this->layout->classes('0');
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
            ->with('rota', 'produtos/portfolio.html')
            ->with('layout', $layout);
    }

    /**
     * *
     * apresenta a página detalhes.
     * @return view
     */
    public function Detalhes($pai, $filho, $nome_html) {
        $layout = $this->layout->classes($pai);
        $lista = Fichas::CategoriasPais();
        $listagem = '';
        $solicitado = '';
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
            ->with('rota', 'produtos/detalhes/'.$pai.'/'.$filho.'/'.$nome_html)
            ->with('layout', $layout);
    }

    /**
     * prepara a configuração de preços e pesos.
     * de acordo com a categoria
     * solicitada
     * @return Json
     */
    public function Orcamento(Request $request) {
        $post_inputs = $request->all();
        $pai = Fichas::parentCategoria($post_inputs['orc_categoria_id']);
        $layout = $this->layout->classes($pai);
        return view('produtos.index')
            ->with('title', STORE_NAME)
            ->with('page', 'imprimir')
            ->with('post_inputs', $post_inputs)
            ->with('ativo', 'teste')
            ->with('layout', $layout)
            ->with('rota', 'produtos/orcamento');
    }
    /**
     * *
     * apresenta a página prodtuos
     * @return view
     */
    public function EnviarPDF(Request $request) {
        $post_inputs = $request->all();
        //dd($post_inputs);
        $layout = $this->layout->classes('0');

        return view('produtos.index')
            ->with('title', STORE_NAME . ' Envie seu arquivo PDF')
            ->with('page', 'enviarpdf')
            ->with('ativo', 'Enviar PDF')
            ->with('post_inputs', $post_inputs)
            ->with('rota', 'produtos/enviarpdf.html')
            ->with('layout', $layout);
    }
    /**
     * mostra a página de modelos dos produtos
     * selecionados
     * @return Json
     */
    public function Portfolio(Request $request) {
        $post_inputs = $request->all();

        //quem é o pai da categoria enviada
        $pai = Category::find($post_inputs['orc_subcategoria_id'])->parent_id;
        $categ_pai = Fichas::nomecategoria($pai);
        $cat = Category::where('parent_id', $pai)->get();
        $categoria = $cat->toarray();

        //verificar se existe o produto para a categoria solicitada
        $check_produtos = CategoryProduct::where('category_id', $post_inputs['orc_subcategoria_id'])->lists('product_id');
//se existir produtos vinculados
        if (count($check_produtos) > 0) {
            $perfis_produtos = ProdutoPerfil::where('perfis_id', $post_inputs['orc_id_perfil'])
                ->wherein('templates_id', $check_produtos)
                ->orderby('created_at')
                ->paginate(NR_PRODUTOS_POR_PAGINA);
        }

        $path = $perfis_produtos->setPath('produtos/portfolio.html');

        //$produtos = $perfis_produtos->toarray();
        $layout = $this->layout->classes($pai);
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
                ->with('layout', $layout)
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
        // dd($post_inputs);
        $pai = Fichas::parentCategoria($post_inputs['escolhido']);
        $layout = $this->layout->classes($pai);

        $formato_id = CategoryFormato::where('categories_id', $post_inputs['escolhido'])
            ->lists('formato_id');
        //dd($formato_id);
        if (count($formato_id) > 0) {
            foreach ($formato_id as $k => $valor) {
                $formato[] = array('id' => $valor, 'nome' => Formato::find($valor)->valor);
            }
        } else {
            $data = array();
            $data['back_menu'] = array('background' => $layout['back_menu']);
            $data['active_a'] = array('style_a' => $layout['style_a']);
            $data['imagem'] = array('image' => utf8_encode('images/fora-do-ar.jpg'));
            $data['processamento'] = array('erro' => utf8_encode('Erro no processamento.'));
            $data['informacao'] = array('info' => utf8_encode('Essa categoria ainda não foi cadastrada.'));
            //dd($data);
            $json_data = json_encode($data);

            return $json_data;
        }
        $cores = '';
        $cor_id = CategoryCore::where('categories_id', $post_inputs['escolhido'])->lists('cor_id');
        foreach ($cor_id as $k => $valor) {
            $cores[] = array('id' => $valor, 'nome' => Core::find($valor)->valor);
        }
        $papel_id = CategoryPapel::where('categories_id', $post_inputs['escolhido'])->lists('papel_id');
        foreach ($papel_id as $k => $valor) {
            $papel[] = array('id' => $valor, 'nome' => Papel::find($valor)->valor);
        }
        $acabamento_id = CategoryAcabamento::where('categories_id', $post_inputs['escolhido'])->lists('acabamento_id');
        foreach ($acabamento_id as $k => $valor) {
            $acabamento[] = array('id' => $valor, 'nome' => Acabamento::find($valor)->valor);
        }
        $enoblecimento = '';
        $enoblecimento_id = CategoryEnoblecimento::where('categories_id', $post_inputs['escolhido'])->lists('enoblecimento_id');
        foreach ($enoblecimento_id as $k => $valor) {
            $enoblecimento[] = array('id' => $valor, 'nome' => Enoblecimento::find($valor)->valor);
        }
        /* $cores = array(
          array(
          "id" => "90",
          "nome" => "4x0"),
          array(
          "id" => "91",
          "nome" => "4x4")
          );
          $enoblecimento = array(
          array(
          "id" => "92",
          "nome" => "Sem Enoblecimento"),
          array(
          "id" => "93",
          "nome" => "Laminacao Fosca")
          ); */

        $pacote = Pacote::where('categories_id', $post_inputs['escolhido'])->get();
        $pacote_qtd = $pacote->toarray();
        foreach ($pacote_qtd as $key => $itens) {
            $quantidade[] = array('id' => $itens['id'], 'unidade' => $itens['quantity']);
        }
        $tabela = array('formato' => $formato, 'cores' => $cores, 'papel' => $papel, 'acabamento' => $acabamento, 'enoblecimento' => $enoblecimento);
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
        $check = Pacformato::where('categories_id', $post_inputs['escolhido']);
        if ($check) {
            //dd($tabela);
            $data = array();
            $data['back_menu'] = array('background' => $back_menu);
            $data['active_a'] = array('style_a' => $layout['style_a']);
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
     * mostra a página de modelos dos produtos
     * selecionados
     * @return view
     */
    public function Produtos() {
        $categorias = Category::all();
        $categ = $categorias->toArray();
        foreach ($categ as $categoria) {
            if ($categoria['parent_id'] != 0 && $categoria['id'] <> 28) {

                $cat[] = $categoria;
            }
        }
        $array_categ = Utilidades::agrupa($cat, 4, 'busca');
        //dd($array_categ);
        $layout = $this->layout->classes(0);
        return view('produtos.index')
            ->with('title', STORE_NAME)
            ->with('page', 'produtos')
            ->with('ativo', 'Produtos')
            ->with('layout', $layout)
            ->with('array_categ', $array_categ)
            ->with('rota', 'produtos.html');
    }


}
