<?php

namespace Ecograph\Libs;

use Ecograph\Category;
use Ecograph\CategoryDescription;
use Ecograph\CategoryProduct;
use Ecograph\Product;
use Ecograph\Perfil;
use Ecograph\ProductDescription;

Class Fichas {

    public static function CategoriasPais() {
        $categorias = Category::all();
        $array_categ = $categorias->toArray();
        foreach ($array_categ as $categoria) {
            if ($categoria['parent_id'] == 0 && $categoria['id'] <> 28) {
                $sons = Category::where('parent_id', $categoria['id'])->get();
                $prole = $sons->toarray();
                if (count($prole) > 0) {
                    foreach ($prole as $key => $item) {
                        $nome_filho = CategoryDescription::find($item['id'])->categories_name;
                        $prole[$key]['nome_filho'] = $nome_filho;
                        $filhos = array('filhos' => $prole, 'nr_filhos' => count($prole));
                        $pais[$categoria['id']] = array('nome' => CategoryDescription::find($categoria['id'])->categories_name, 'prole' => $filhos);
                    }
                }
            }
        }

        if ($pais) {
            return $pais;
        }
    }

    public static function ProdutosCategoria($id) {
        $produtos = Product::where('id', '=', $id)->get();
        return $produtos;
    }
 
    public static function MegaMenu($k) {
        //se não existe categoria é mostrada página 404
        if (!is_null(Category::find($k))) {
            $produtos = CategoryProduct::Produtos($k);
            $nr_produtos = count($produtos);
            $li = 1;
            if ($nr_produtos > 0) {
                //echo "<div id=\"{$k}_1\" class=\"last\">";
                echo " <ul class=\"thumbnails\">";
                foreach ($produtos as $product) {
                    echo HTML::MegaMenu($product->product_id);
                }
                echo "</ul>";
                //echo "</div>";
            }
        }
    }

    public static function Thumbs($id) {
        $li .= '<a href="' . URL::to('produtos/') . '/' . $id . '">' . HTML::image('images/' . Product::find($id)->products_image, Product::find($id)->cod, array('class' => 'img-ficha', 'width' => '100%')) . '</a>';
    }

    public static function TrataImg($id) {
        if (file_exists('images/' . Product::find($id)->products_image)) {
            return true;
        }
        return false;
    }

    public static function calculapeso() {
        $carrinho = Cart::contents();
        $nr_itens = 0;
        $weight = 0;
        if (Cart::totalitems() > 1) {
            foreach ($carrinho as $item) {
                if (is_null(ProductSemFrete::Ativos($item->id)->first())) {
                    $peso = $item->quantity * $item->peso;
                    $weight += $peso;
                }
            }
        } else {
            foreach ($carrinho as $item) {
                if (is_null(ProductSemFrete::Ativos($item->id)->first())) {
                    return $item->quantity * $item->peso;
                } else {
                    return false;
                }
            }
        }

        return $weight;
    }

    public static function buscaend($cep) {

        echo $cep;
    }

    public static function SetValorParcelas($parcelas, $preco, $echo = true) {
        if ($parcelas != 0) {
            $ValorParcelas = $preco / $parcelas;
            if ($echo) {
                echo Utilidades::toReal($ValorParcelas);
            } else {
                return Utilidades::RealBusca($ValorParcelas);
            }
        } else {
            return false;
        }
    }

    public static function Novidade($id) {
        $product = Product::where('id', $id)->where('products_quantity', '>', '0')->where('products_date_available', '>', date('Y-m-d h:m:s'))->orderBy('products_quantity')->get();
        if ($product->isEmpty()) {
            return false;
        } else {
            return true;
        }
    }

    public static function NomeFabricante($id, $echo = true) {
        $fab = "Não cadastrado";
        $fabricante = Manufacturer::fabricante($id)->get();
        foreach ($fabricante as $name) {
            $fab = $name->manufacturers_name;
        }
        if ($echo) {
            echo $fab;
        } else {
            return $fab;
        }
    }

    public static function Fabricantes() {
        /* $fabricantes = Manufacturer::all();
          $li = '';
          foreach ($fabricantes as $manufacturers) {
          //foreach ($manufacturers as $manufacturer){
          //echo(($manufacturers->id));exit;
          $status = Product::where('manufacturer_id', '=', $manufacturers->id)
          ->where('products_status', '=', '1')->first();
          if ($status) {
          $href = URL::to('fabricantes/') . '/' . $manufacturers->id;
          $li .= '<li>';
          $li .= '<i class=\"icon-chevron-right\"></i>';
          $li .= '<a href="' . $href . '/' . URLAmigaveis::Slug($manufacturers->manufacturers_name, "-", true) . '.html">' . HTML::image('images/' . $manufacturers->manufacturers_image, $manufacturers->manufacturers_image, array('style' => 'display:block; width:100%; max-width:180px', 'title' => $manufacturers->manufacturers_name)) . '</a>';
          //$li .= '</div>';
          $li .= '</li>';
          }
          } */
        $li = '';
        $fabricantes = Product::where('products_status', '=', '1')->where('products_quantity', '>', '0')->orderBy('manufacturer_id', 'DESC')->groupBy('manufacturer_id')->get();
        //echo "<pre>"; print_r($fabricantes);exit;
        foreach ($fabricantes as $manufacturers) {
            //echo "aqui ".$manufacturers->manufacturer_id;exit;
            //$fabricante = Manufacturer::where('id', '=', $manufacturers->id)->first();
            $fabricante = Manufacturer::find($manufacturers->manufacturer_id);
            if (!is_null($fabricante)) {
                $fab_name = $fabricante->manufacturers_name;
                $fab_img = $fabricante->manufacturers_image;
                $href = URL::to('fabricantes/') . '/' . $manufacturers->manufacturer_id;
                $li .= '<li>';
                $li .= '<a href="' . $href . '/' . URLAmigaveis::Slug($fab_name, "-", true) . '.html">' . HTML::image('images/' . $fab_img, $fab_img, array('style' => 'display:block; width:100%; max-width:180px', 'title' => $fab_name)) . '</a>';
                $li .= '</li>';
            }
        }
        return $li;
    }

    public static function PrecoExcepcional($id) {
        $excepcional = Product::find($id);
        if (!is_null($excepcional)) {
            if ($excepcional->products_price_excepcional == 1) {
                return true;
            }
        }
        return false;
    }

    public static function TambemInteressa($id) {
        $info = ProductDescription::find($id);
        $detalhes = Product::find($id);
        if (!is_null($info)) {
            return array($info->products_name, $detalhes->cod, $detalhes->products_image, $detalhes->id);
        } else
            return false;
    }

    public static function checkFreteGratis($id) {
        //$fretes_zero =;
        //$frete = DB::table('product_semfretes')->where('products_id', $id)->first();
        $frete = ProductSemFrete::Ativos($id)->first();
        //var_dump($frete);exit;
        if (!is_null($frete)) {
            return $frete->regiao;
        }
        return false;
    }

    public static function Parcelas($preco) {
        Config::get('extras');

        $nrParcelas = '';
        if ($preco > PARCELA_MINIMA_AUTORIZADA) {
            $vezes = 0;
            for ($i = 0; $i <= PARCELAS_PERMITIDAS; $i++) {
                $vezes = $i + 2;
                $parcelas = $preco / $vezes;
                if ($parcelas >= PARCELA_MINIMA_AUTORIZADA && $vezes <= PARCELAS_PERMITIDAS && $parcelas > 0) {
                    $nrParcelas = $vezes;
                }
            }
            return $nrParcelas;
        }
        return false;
    }

    public static function PrecoAVista($preco, $echo = true) {
        Config::get('extras');
        $desconto = number_format(($preco * DESCONTO_CONCEDIDO), '2', ',', '.');
        if ($echo) {
            echo Utilidades::toReal($preco - $desconto);
        } else {
            return Utilidades::RealBusca($preco - $desconto);
        }
    }

    public static function checkOferta($id) {
        $special = Special::where('product_id', '=', $id)->where('status', '=', '1')->first();

        if (!is_null($special)) {
            return $special;
        }
        return false;
    }

    public static function priceOferta($id) {
        $special = Special::where('product_id', '=', $id)->where('status', '=', '1')->first();

        if (!is_null($special)) {
            return $special;
        }
        return false;
    }

    public static function viewProle($valores) {
        $id_seg = array();
        $ids_cat_seg = array();
        $id_ter = array();
        $ids_cat_ter = array();
        if (count($valores) > 0) {
            foreach ($valores as $ch => $array_categorias) {
                //verifica se a categoria de seugndo nível possui produtos
                $check = CategoryProduct::where('category_id', $ch)->get();
                $id_cat = json_decode($check);
                if (count($id_cat) > 0) {
                    //segundo nível
                    $id_seg[] = $id_cat->category_id;
                    //return array('pai'=> '','neto'=>$cat);
                }
                //produtos do terceiro nivel
                foreach ($array_categorias as $k => $categorias) {
                    $id_ter[] = $categorias;
                }
                $ids_cat_seg = $id_seg;
                $ids_cat_ter[$ch] = $id_ter;
                $id_seg = array();
                $id_ter = array();
            }
        }

        if (count($ids_cat_seg) > 0) {
            //sorteia os ids para a segunda categoria
            $sorteada = array_keys($ids_cat_seg);
            shuffle($sorteada);
            $pai = $sorteada[0];
            $categoria = array_values($valores[$pai]);
            shuffle($categoria);
            $cat = $categoria[0];
            return array('pai' => $pai, 'neto' => $cat);
        } else if (count($ids_cat_ter) > 0) {
            //sorteia os ids para a segunda categoria
            $sorteada = array_keys($ids_cat_ter);
            shuffle($sorteada);
            $pai = $sorteada[0];
            $categoria = array_values($valores[$pai]);
            shuffle($categoria);
            $cat = $categoria[0];

            return array('pai' => $pai, 'neto' => $cat);
        } else {
            return false;
        }
    }

    public static function Aleatorios($valores) {
        $ids_categorias = array();
        if (count($valores) > 0) {
            foreach ($valores as $ch => $array_categorias) {
                foreach ($array_categorias as $k => $categorias) {
                    $ids[] = $categorias;
                }
                $ids_categorias[$ch] = $ids;
                $ids = array();
            }
        }
        if (count($ids_categorias) > 0) {
            //sorteia os ids grupa em quatro e mostra o resultado
            $sorteada = array_keys($ids_categorias);
            shuffle($sorteada);
            $pai = $sorteada[0];
            $categoria = array_values($valores[$pai]);
            shuffle($categoria);
            $cat = $categoria[0];
            return array($pai, $cat);
        }
    }

    public static function OutrasProd($id_categorias) {
        $aleatorios = CategoryProduct::where('category_id', $id_categorias)->get();
        //$aleatorios = Category::find($id_categorias)->products;
        $id_produto = json_decode($aleatorios);
        if (count($id_produto) > 0) {
            foreach ($id_produto as $item) {
                $ids[] = $item->product_id;
            }
        }
        shuffle($ids);
        //echo "<pre>";print_r($ids);exit;
        $limite = 0;
        foreach ($ids as $key => $aleatorio) {
            if ($limite >= 4) {
                break;
            }
            $selecionados[] = $aleatorio;
            $limite++;
        }
        shuffle($selecionados);
        return $selecionados;
    }

    public static function checkComentario($id) {
        $comentarios = Comentario::Texto($id)->take(4)->get();
        if ($comentarios) {
            return $comentarios;
        }
    }

    public static function checkAtributos($id) {
        $lista_atributos = Productatributo::where('product_id', '=', $id)->get();
        $atributos = null;
        if (!is_null($lista_atributos)) {
            foreach ($lista_atributos as $item) {
                $opcao = Atribvalor::find($item->atribvalores_id)->valor;
                $atributo_id = Atribvalor::find($item->atribvalores_id)->atributo_id;
                $atributo_nome = Atributo::find($atributo_id)->atributo_nome;
                $opcoes = array('atribvalores_id' => $item->atribvalores_id, 'especificacao_custo' => $item->especificacao_custo, 'custo_aritmetico_sinal' => $item->custo_aritmetico_sinal);
                $atributos[$atributo_nome][$opcao] = $opcoes;
                $opcoes = array();
            }
            return $atributos;
        }
    }

    public static function trataKeyword($keyword) {
        $array_busca = explode(" ", $keyword);
        $n_palavras = count($array_busca);
        for ($i = 0; $i < $n_palavras; $i++) {
            $param = trim($array_busca[$i]);
            if (strlen($param) >= 2 and $param != "") {
                $relacao[] = $param;
            }
        }
        if (is_array($relacao)) {
            return $relacao;
        } else {
            return false;
        }
    }

    public static function Proibidas($lista = array()) {
        $proibidas = array("para", "de", "pelo", "pela", "por", "com", "em");
        $chave = "";
        if (is_array($lista)) {
            foreach ($lista as $argumento) {
                if (in_array($argumento, $proibidas)) {
                    continue;
                } else {
                    $testadas[] = $argumento;
                }
            }
            if (is_array($testadas) && count($testadas) > 1) {
                //return $testadas;
                //mais de um argumento a ser buscado
                foreach ($testadas as $arg) {
                    $chave .= '%' . $arg;
                }
                return $chave . '%';
                //return Fichas::buscas($chave . '%');
            } else {
                return "%" . $testadas[0] . "%";
                //return Fichas::buscas($chave);
                //return false;
            }
        }
    }

    public static function buscas($chave) {

        $buscanome = ProductDescription::where('products_name', 'LIKE', $chave)->paginate(NR_PRODUTOS_POR_PAGINA);
        $nome = $buscanome->toarray();
        if ($nome['total'] > 0) {
            return $buscanome;
        }

        $buscadesc = ProductDescription::where('products_description', 'LIKE', $chave)->paginate(NR_PRODUTOS_POR_PAGINA);
        $desc = $buscadesc->toarray();
        if ($desc['total'] > 0) {
            return $desc;
        }

        $buscaperfil = Perfil::where('nome_perfil', 'LIKE', $chave)->paginate(NR_PRODUTOS_POR_PAGINA);
        $perfil = $buscaperfil->toarray();
        if ($perfil['total'] > 0) {
            return $perfil;
        }

        return false;
    }

    public static function CheckSons($cat_id) {
        $sons = Category::where('parent_id', '=', $cat_id)->get();
        if (count($sons->toarray()) > 0) {
            return array('filhos' => $sons->toarray(), 'nr_filhos' => count($sons->toarray()));
        }
        return false;
    }
    public static function idCategoria($product) {
        $collection = CategoryProduct::Categoria($product);
        $categories = $collection->toArray();
        foreach($categories as $category){
            $id = $category['category_id'];
        }
        return $id;
    }

    public static function idparentCategoria($product) {
        $collection = CategoryProduct::Categoria($product);
        $categories = $collection->toArray();
        foreach($categories as $category){
          $id = $category['category_id'];
        }
        return Category::find($id)->parent_id;
    }
    public static function nomeCategoria($id) {
        return CategoryDescription::find($id)->categories_name;
    }

    public static function parentCategoria($id) {
         return Category::find($id)->parent_id;
    }

    public static function infoCategoria($id) {
        return CategoryDescription::find($id)->categories_info;
    }

    public static function nomeProduto($id) {
        return ProductDescription::find($id)->products_name;
    }

    public static function ImgProduto($id) {
        $img = Product::find($id)->products_image;
       
        if (!file_exists('images/' . $img)) {
            $img = 'theme/naoencontrado.png';
        }
        return $img; 
    }

    public static function ModelProduto($id) {
        return Product::find($id)->products_model;
    }

    public static function produtosPopulares($max = 4) {
        $products = ProductDescription::where('products_viewed', '>', '0')->take($max)->orderBy('products_viewed', 'DESC')->get();
        return $products->toarray();
    }

}
