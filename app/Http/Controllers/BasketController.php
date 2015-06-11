<?php

namespace Ecograph\Http\Controllers;

use Ecograph\Http\Requests;
use Ecograph\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Ecograph\Libs\Layout;
use Ecograph\Libs\Fichas;
use Ecograph\Libs\Utilidades;
use Ecograph\Gateway;
use Ecograph\Customer;
use Ecograph\Category;
use Ecograph\CategoryProduct;
use Ecograph\Descontoacrescimo;
use Ecograph\Basket;
use Ecograph\Formato;
use Ecograph\Pacote;
use Ecograph\BasketIten;
use Cart;
use Auth;

class BasketController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Basket Controller
      |--------------------------------------------------------------------------
      |
      | This controller renders your application's "dashboard" for users that
      | are authenticated. Of course, you are free to change or remove the
      | controller as you wish. It is just here to get your app started!
      |
     */

    private $layout;
    private $basket;
    private $basket_item;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Layout $layout, Basket $basket, BasketIten $basket_item) {
        $this->layout = $layout;
        $this->basket = $basket;
        $this->basket_item = $basket_item;
    }

    /**
     * Verifica se existe produtos do carrinho antigo.
     *
     * @return View
     */
    public function Verifica() {
        $userId = \Auth::user()->id;
        $carrinho = Customer::with('basketes')->find($userId);
        if (count($carrinho->basketes->toarray()) > 0) {
            return redirect(url('/carrinho/lista.html'));
        } else {
            return redirect(url('/home.html'));
        }
    }

    /* somente quando loga */

    public function Lista() {
        $title = 'Itens no carrinho';
        //Auth::login($customer);
        //$customers_default_address_id = Customer::find(Auth::user()->id);
        //$default_address = Addressbook::find($customers_default_address_id->customers_default_address_id);
        $cart = Cart::content();
        //dd($cart);
        $carrinho = $this->basket
                ->where('customer_id', Auth::user()->id)
                ->get();
        $lista = $carrinho->toarray();
        if (count($lista) > 0) {
            foreach ($lista as $key => $valor) {
                $basket_option = $this->basket_item->where('basket_id', $valor['id'])->get();
                $option_itens = $basket_option->toarray();
                //dd( $lista);
                $item = array('id' => $valor['products_id'],
                    'name' => Fichas::nomeProduto($valor['products_id']),
                    'price' => str_replace('R$ ', '', $valor['final_price']),
                    'quantity' => $valor['quantity'],
                    'image' => Fichas::ImgProduto($valor['products_id'])
                );
                $cat = CategoryProduct::Categoria($valor['products_id']);
                $categoria = $cat->toarray();
                $option = array('categoria_id' => $categoria[0]['category_id'],
                    'categoria' => $categoria[0]['products_name'],
                    'formato_id' => $option_itens[0]['formato_id'],
                    'formato' => 'descobrir categ',
                    'papel_id' => $option_itens[0]['papel_id'],
                    'papel' => 'descobrir categ',
                    'acabamento_id' => $option_itens[0]['acabamento_id'],
                    'acabamento' => 'descobrir categ',
                    'unidade' => '120',
                    'perfil' => $categoria[0]['products_name'],
                    'perfil_id' => '22'
                );
                Cart::add($item['id'], $item['name'], $item['quantity'], $item['price'], $option);
            }
             $contents = Cart::content();
            $gateways = Gateway::ativos('1')->get();
            $classes = Utilidades::Descontos();
            $desc_acrescimo = Descontoacrescimo::where('class', 'discount_avista')->get();
            $desc_acrescimo_id = $desc_acrescimo->toarray();
            $layout = $this->layout->classes(Fichas::parentCategoria('12'));
            return view('clientes.index')
                            ->with('title', STORE_NAME . ' Itens no carrinho')
                            ->with('page', 'carrinho')
                            ->with('ativo', 'carrinho')
                            ->with('contents', $contents->toarray())
                            ->with('post_inputs','')
                            ->with('gateways', $gateways)
                            ->with('classes', $classes)
                            ->with('desc_acrescimo_id', $desc_acrescimo_id)
                            ->with('cart_total', Cart::total())
                            ->with('rota', 'carrinho.html')
                            ->with('layout', $layout);
        }
    }

    public function Adicionar(Request $request) {
        $post_inputs = $request->all();
        //dd($post_inputs);
        $image = Fichas::ImgProduto($post_inputs['produto_id']);
        $item = (array('id' => $post_inputs['produto_id'],
            'name' => Fichas::nomeProduto($post_inputs['produto_id']),
            'price' => str_replace('R$ ', '', $post_inputs['orc_pacote_valor']),
            'quantity' => 1,
            'image' => $image
        ));
        $option = array('categoria_id' => $post_inputs['orc_subcategoria_id'],
            'categoria' => $post_inputs['orc_subcategoria_nome'],
            'formato_id' => $post_inputs['orc_formato_id'],
            'formato' => $post_inputs['orc_formato_nome'],
            'papel_id' => $post_inputs['orc_papel_id'],
            'papel' => $post_inputs['orc_papel_nome'],
            'acabamento_id' => $post_inputs['orc_acabamento_id'],
            'acabamento' => $post_inputs['orc_acabamento_nome'],
            'unidade' => $post_inputs['orc_pacote_qtd'],
            'perfil' => $post_inputs['orc_nome_perfil'],
            'perfil_id' => $post_inputs['orc_id_perfil']
        );
        Cart::add($item['id'], $item['name'], $item['quantity'], $item['price'], $option);
        $carrinho = $this->basket->where('customer_id', Auth::user()->id)->get();
        if (count($carrinho->toarray()) > 0) {
            $lista = $carrinho->toarray();
            foreach ($lista as $key => $valor) {
                if ($valor['products_id'] == $item['id']) {
                    $this->basket->quantity++;
                } else {
                    $this->basket->customer_id = Auth::user()->id;
                    $this->basket->products_id = $item['id'];
                    $this->basket->quantity = $item['quantity'];
                    $this->basket->products_model = Fichas::modelProduto($item['id']);
                    $this->basket->final_price = $item['quantity'] * $item['price'];
                    $this->basket->save();
                    //itens da cesta
                    $this->basket_item->basket_id = $this->basket->id;
                    $this->basket_item->formato_id = $option['formato_id'];
                    $this->basket_item->papel_id = $option['papel_id'];
                    $this->basket_item->acabamento_id = $option['acabamento_id'];
                    $this->basket_item->pacote_id = '23';
                    $this->basket_item->save();
                }
            }
        } else {
            $this->basket->customer_id = Auth::user()->id;
            $this->basket->products_id = $item['id'];
            $this->basket->quantity = $item['quantity'];
            $this->basket->products_model = Fichas::nomeProduto($item['id']);
            $this->basket->final_price = $item['quantity'] * $item['price'];
            $this->basket->save();
            //itens da cesta
            $this->basket_item->basket_id = $this->basket->id;
            $this->basket_item->formato_id = $option['formato_id'];
            $this->basket_item->papel_id = $option['papel_id'];
            $this->basket_item->acabamento_id = $option['acabamento_id'];
            $this->basket_item->pacote_id = '23';
            $this->basket_item->save();
        }
        return json_encode(array('action' => true,
            'info' => 'Item adicionado no carrinho com sucesso'));
    }

    public function Listar(Request $request) {
        //dd($request);
        $cart = Cart::content();
        //$userId = \Auth::user()->id;
        //$carrinho = Customer::with('basketes')->find($userId);
        //dd($contents->toarray());
        /* if (count($carrinho->basketes->toarray()) > 0) {
          $lista = $carrinho->basketes->toarray();
          foreach ($lista as $key => $valor) {
          ///os itens para esse carrinho
          $basket_item = Basket::with('BasketIten')->find($valor['id']);
          $itens = $basket_item->BasketIten->toarray();
          $categoria = CategoryProduct::where('product_id', $valor['products_id'])->get();
          $item_categoria = $categoria->toArray();
          $formato = Formato::find($itens[0]['formato_id'])->valor;
          $quantidade = Pacote::find($itens[0]['pacote_id'])->quantity;
          $options = array("categoria" => $item_categoria[0]['products_name'],
          "formato" => $formato,
          "formato_id" => $itens[0]['formato_id'],
          "papel" => $formato,
          "papel_id" => $itens[0]['papel_id'],
          "acabamento" => $formato,
          "acabamento_id" => $itens[0]['acabamento_id'],
          "unidade" => $quantidade,
          "perfil" => $post_inputs['orc_nome_perfil'],
          "pacote_id" => $itens[0]['pacote_id']);
          }
          } */
        foreach ($cart->toarray() as $row) {
            foreach ($row as $item) {
                $contents[] = $row;
            }
        }
        //dd($contents);
        $gateways = Gateway::ativos('1')->get();
        $classes = Utilidades::Descontos();
        $desc_acrescimo = Descontoacrescimo::where('class', 'discount_avista')->get();
        $desc_acrescimo_id = $desc_acrescimo->toarray();
        $layout = $this->layout->classes(Fichas::parentCategoria(0));
        return view('clientes.index')
                        ->with('title', STORE_NAME . ' Itens no carrinho')
                        ->with('page', 'carrinho')
                        ->with('ativo', 'carrinho')
                        ->with('contents', $contents)
                        ->with('post_inputs', '')
                        ->with('gateways', $gateways)
                        ->with('classes', $classes)
                        ->with('parent', '0')
                        ->with('perfil', '')
                        ->with('desc_acrescimo_id', $desc_acrescimo_id)
                        ->with('cart_total', Cart::total())
                        ->with('rota', 'carrinho/lista.html')
                        ->with('layout', $layout);
        /* $post_inputs = $request->except('_token');
          $parent = Category::find($post_inputs['orc_subcategoria_id'])->parent_id;




          if (count($carrinho->basketes->toarray()) > 0) {
          $lista = $carrinho->basketes->toarray();
          //dd($lista);
          foreach ($lista as $key => $valor) {
          ///os itens para esse carrinho
          $basket_item = Basket::with('BasketIten')->find($valor['id']);
          $itens = $basket_item->BasketIten->toarray();
          //dd($itens[0]);
          $categoria = CategoryProduct::where('product_id', $valor['products_id'])->get();
          $item_categoria = $categoria->toArray();
          $formato = Formato::find($itens[0]['formato_id'])->valor;
          $quantidade = Pacote::find($itens[0]['pacote_id'])->quantity;

          $options = array("categoria" => $item_categoria[0]['products_name'],
          "formato" => $formato,
          "formato_id" => $itens[0]['formato_id'],
          "papel" => $formato,
          "papel_id" => $itens[0]['papel_id'],
          "acabamento" => $formato,
          "acabamento_id" => $itens[0]['acabamento_id'],
          "unidade" => $quantidade,
          "perfil" => $post_inputs['orc_nome_perfil'],
          "pacote_id" => $itens[0]['pacote_id']);
          //
          // Returns an array of rowid(s) of found item(s) or false on failure
          $rowid = Cart::search(array('products_id' => $valor['products_id']));
          if ($rowid) {
          Cart::update($rowid, array('qty', $valor['quantity']));
          } else {
          // Batch method
          Cart::add(
          array('id' => $valor['products_id'], 'name' => $valor['products_model'], 'qty' => $valor['quantity'], 'price' => $valor['final_price'], 'options' => $options)
          );
          }
          }
          }

          $gateways = Gateway::ativos('1')->get();
          $classes = Utilidades::Descontos();
          $desc_acrescimo = Descontoacrescimo::where('class', 'discount_avista')->get();
          $desc_acrescimo_id = $desc_acrescimo->toarray();
          $layout = $this->layout->classes(Fichas::parentCategoria($post_inputs['orc_subcategoria_id']));
          return view('clientes.index')
          ->with('title', STORE_NAME . ' Itens no carrinho')
          ->with('page', 'carrinho')
          ->with('ativo', 'carrinho')
          ->with('contents', $contents->toarray())
          ->with('post_inputs', $post_inputs)
          ->with('gateways', $gateways)
          ->with('classes', $classes)
          ->with('parent', $parent)
          ->with('perfil', $post_inputs['orc_nome_perfil'])
          ->with('desc_acrescimo_id', $desc_acrescimo_id)
          ->with('cart_total', Cart::total())
          ->with('rota', 'basket')
          ->with('layout', $layout); */
    }

    public function Carrinho(Request $request) {
        $post_inputs = $request->all();
        $carrinho = $this->basket
                ->where('customer_id', Auth::user()->id)
                ->get();
        //dd($post_inputs);
        /*
         *  "nome_empresa" => ""
          "atividade" => ""
          "nome" => "Leandro "
          "cargo" => ""
          "cel1" => "(51) 9976-7179"
          "cel2" => ""
          "fone1" => "(51) 3396-4816"
          "fone2" => "(51) 3231-1664"
          "end" => ""
          "cep" => ""
          "email" => "leanbez@gmail.com"
          "site" => ""
          "obs" => ""
          "orc_peso" => "0"
          "orc_vl_frete" => "PAC"
          "orc_tipo_frete" => "37.00"
          "orc_categoria_id" => "11"
          "orc_categoria_nome" => "Pasta"
          "orc_subcategoria_id" => "11"
          "orc_subcategoria_nome" => "Pasta"
          "orc_formato_id" => "26"
          "orc_formato_nome" => "Bolsa"
          "orc_cor_id" => ""
          "orc_cor_nome" => ""
          "orc_papel_id" => "10"
          "orc_papel_nome" => "couche 300g"
          "orc_acabamento_id" => "14"
          "orc_acabamento_nome" => "Sem Acabamento"
          "orc_enoblecimento_id" => ""
          "orc_enoblecimento_nome" => ""
          "orc_pacote_qtd" => "250 un"
          "orc_pacote_valor" => "R$ 25"
          "orc_id_perfil" => "62"
          "orc_nome_perfil" => "Psicologia"
          "_token" => "hyUnfxKSaImabSqq5jqhTPDZfYck4CO6LcYeFUKb"
          "user" => "1"
          "produto_id" => "3063"
         */
        $lista = $carrinho->toarray();
        if (count($lista) > 0) {
            //$options= $this->basket->BasketIten(1);
            //dd($options);
            //dd($lista);
            foreach ($lista as $key => $valor) {
                $basket_option = $this->basket_item->where('basket_id', $valor['id'])->get();
                $option_itens = $basket_option->toarray();
                //dd( $option_itens);
                $item = array('id' => $valor['products_id'],
                    'name' => Fichas::nomeProduto($valor['products_id']),
                    'price' => str_replace('R$ ', '', $valor['final_price']),
                    'quantity' => $valor['quantity'],
                    'image' => Fichas::ImgProduto($valor['products_id'])
                );
                $option = array('categoria_id' => '1',
                    'categoria' => 'descobrir categ',
                    'formato_id' => $option_itens[0]['formato_id'],
                    'formato' => 'descobrir categ',
                    'papel_id' => $option_itens[0]['papel_id'],
                    'papel' => 'descobrir categ',
                    'acabamento_id' => $option_itens[0]['acabamento_id'],
                    'acabamento' => 'descobrir categ',
                    'unidade' => '120',
                    'perfil' => 'descobrir perfil',
                    'perfil_id' => '22'
                );
                Cart::add($item['id'], $item['name'], $item['quantity'], $item['price'], $option);
            }
        }

        // if(is_array($update)){
        //   foreach($update as $k=>$vl){
        //     Cart::update($vl[0],$vl[1]);
        //   }
        // }    
        $contents = Cart::content();

        //$parent = Category::find($post_inputs['orc_subcategoria_id'])->parent_id;
        $post_inputs = array();
        $gateways = Gateway::ativos('1')->get();
        $classes = Utilidades::Descontos();
        $desc_acrescimo = Descontoacrescimo::where('class', 'discount_avista')->get();
        $desc_acrescimo_id = $desc_acrescimo->toarray();
        $layout = $this->layout->classes(Fichas::parentCategoria('12'));
        return view('clientes.index')
                        ->with('title', STORE_NAME . ' Itens no carrinho')
                        ->with('page', 'carrinho')
                        ->with('ativo', 'carrinho')
                        ->with('contents', $contents->toarray())
                        ->with('post_inputs', $post_inputs)
                        ->with('gateways', $gateways)
                        ->with('classes', $classes)
                        ->with('desc_acrescimo_id', $desc_acrescimo_id)
                        ->with('cart_total', Cart::total())
                        ->with('rota', 'carrinho.html')
                        ->with('layout', $layout);
    }

    public function Atualizar() {
        $parans = \Request::all();
        $content = Cart::content();
        if ($parans['quantity'] == 0) {
            return json_encode(array('action' => 'false', 'info' => 'Informe uma quantidade acima de zero.'));
        }
        foreach ($content as $item) {
            if ($parans['product_id'] == $item->id) {
                Cart::update($item->rowid, array('quatity' => $parans['quantity']));
                $final_price = $this->basket
                        ->where('customer_id', Auth::user()->id)
                        ->where('products_id', $parans['product_id'])
                        ->get();
                foreach ($final_price as $items) {
                    $price = $items->final_price;
                }

                /* $carrinho = 
                  $lista = $carrinho->toarray();
                  $basket_option = $this->basket_item->where('basket_id', $lista[0]['id'])->get(); */
                $this->basket
                        ->where('customer_id', Auth::user()->id)
                        ->where('products_id', $parans['product_id'])
                        ->update(['quantity' => $parans['quantity'],
                            'final_price' => $price * $parans['quantity']]);
                //$carrinho->delete();

                break;
            }
        }
        //Session::put('success', 'Item atualizado com sucesso!');
        if (Cart::count() > 0) {
            return json_encode(array('action' => 'true', 'info' => 'Produto ' . $parans['product_id'] . ' Atualizado para ' . $parans['quantity']));
        } else {
            return json_encode(array('action' => 'true', 'info' => 'Produto ' . $parans['product_id'] . ' Atualizado para ' . $parans['quantity'] . ' vamos redirecionar para carrinho vazio.'));
        }
    }

    public function Remover() {
        $parans = \Request::all();
        $content = Cart::content();
        foreach ($content as $item) {
            if ($parans['product_id'] == $item->id) {
                //Cart::update($item->rowid, array('quatity' => $parans['quantity']));
                $carrinho = $this->basket
                        ->where('customer_id', Auth::user()->id)
                        ->where('products_id', $parans['product_id'])
                        ->get();
                // dd($carrinho);
                foreach ($carrinho as $items) {
                    $id = $items->id;
                }
                //elimina os item do carrinho
                $this->basket_item->where('basket_id', $id)->delete();
                //elimina a entrada com a linha de produto do carrinho
                $this->basket
                        ->where('customer_id', Auth::user()->id)
                        ->where('products_id', $parans['product_id'])->delete();
                $rowId = $item->rowid;
                break;
            }
        }
        Cart::remove($rowId);
        //Session::put('success', 'Item atualizado com sucesso!');
        //if (Cart::count() > 0) {
        return json_encode(array('action' => 'true', 'info' => 'Produto ' . $parans['product_id'] . ' removido. Aguarde a atualização da página.'));
        //} 
    }

}
