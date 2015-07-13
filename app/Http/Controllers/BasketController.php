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
use Ecograph\AddressBook;
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
            return redirect(route('carrinho.listar'));
        } else {
            return redirect(route('index'));
        }
    }

    /* somente quando loga */

    public function Lista() {
        //$cart = Cart::content();
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
            //levanta o endereço do cliente
            $customers_default_address_id = Customer::find(Auth::user()->id);
            $default_address = AddressBook::find($customers_default_address_id->customers_default_address_id);

            return view('clientes.index')
                ->with('title', STORE_NAME . ' Itens no carrinho')
                ->with('page', 'carrinho')
                ->with('ativo', 'carrinho')
                ->with('contents', $contents->toarray())
                ->with('post_inputs', '')
                ->with('gateways', $gateways)
                ->with('classes', $classes)
                ->with('desc_acrescimo_id', $desc_acrescimo_id)
                ->with('cart_total', Cart::total())
                ->with('default_address', $default_address)
                ->with('rota', 'carrinho.html')
                ->with('layout', $layout);
        } else {
            if(Cart::count()==0)
            {
                $layout = $this->layout->classes(0);
                return view('clientes.index')
                    ->with('title', STORE_NAME . ' Carrinho Vazio')
                    ->with('page', 'carrinhovazio')
                    ->with('ativo', 'Carrinho Vazio')
                    ->with('rota', 'carrinho/lista.html')
                    ->with('layout', $layout);
            }else {
                $cart = Cart::content();

                foreach ($cart->toarray() as $row) {
                    //dd($row);
                    //foreach ($row as $item) {
                    $this->basket->customer_id = Auth::user()->id;
                    $this->basket->products_id = $row['id'];
                    $this->basket->quantity = $row['qty'];
                    $this->basket->products_model = Fichas::modelProduto($row['id']);
                    $this->basket->final_price = $row['qty'] * $row['price'];
                    $this->basket->save();
                    //itens da cesta
                    $this->basket_item->basket_id = $this->basket->id;
                    $this->basket_item->formato_id = $row['options']['formato_id'];
                    $this->basket_item->papel_id = $row['options']['papel_id'];
                    $this->basket_item->acabamento_id = $row['options']['acabamento_id'];
                    $this->basket_item->pacote_id = '23';
                    $this->basket_item->save();

                }
                $contents = Cart::content();
                $gateways = Gateway::ativos('1')->get();
                $classes = Utilidades::Descontos();
                $desc_acrescimo = Descontoacrescimo::where('class', 'discount_avista')->get();
                $desc_acrescimo_id = $desc_acrescimo->toarray();
                $layout = $this->layout->classes(Fichas::parentCategoria('12'));
                //levanta o endereço do cliente
                $customers_default_address_id = Customer::find(Auth::user()->id);
                $default_address = AddressBook::find($customers_default_address_id->customers_default_address_id);

                return view('clientes.index')
                    ->with('title', STORE_NAME . ' Itens no carrinho')
                    ->with('page', 'carrinho')
                    ->with('ativo', 'carrinho')
                    ->with('contents', $contents->toarray())
                    ->with('post_inputs', '')
                    ->with('gateways', $gateways)
                    ->with('classes', $classes)
                    ->with('desc_acrescimo_id', $desc_acrescimo_id)
                    ->with('cart_total', Cart::total())
                    ->with('default_address', $default_address)
                    ->with('rota', 'carrinho.html')
                    ->with('layout', $layout);
            }
        }
    }

    public function Adicionar(Request $request) {
        $post_inputs = $request->all();

        $valor = str_replace('R$ ', '',$post_inputs['orc_pacote_valor']);
        $price = str_replace(',', '.',$valor);
        $image = Fichas::ImgProduto($post_inputs['produto_id']);
        $item = (array('id' => $post_inputs['produto_id'],
            'name' => Fichas::nomeProduto($post_inputs['produto_id']),
            'price' => $price,
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
        //return json_encode(array('action' => true,
        //    'info' => 'Item adicionado no carrinho com sucesso',
        //    'total_itens' => Cart::count()
        //));
        $contents = Cart::content();
        $gateways = Gateway::ativos('1')->get();
        $classes = Utilidades::Descontos();
        $desc_acrescimo = Descontoacrescimo::where('class', 'discount_avista')->get();
        $desc_acrescimo_id = $desc_acrescimo->toarray();
        $layout = $this->layout->classes(Fichas::parentCategoria('12'));
        //levanta o endereço do cliente
        $customers_default_address_id = Customer::find(Auth::user()->id);
        $default_address = AddressBook::find($customers_default_address_id->customers_default_address_id);

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
            ->with('default_address', $default_address)
            ->with('rota', 'carrinho.html')
            ->with('layout', $layout);
    }

    public function Listar() {
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
        }
        $contents = Cart::content();
        $gateways = Gateway::ativos('1')->get();
        $classes = Utilidades::Descontos();
        $desc_acrescimo = Descontoacrescimo::where('class', 'discount_avista')->get();
        $desc_acrescimo_id = $desc_acrescimo->toarray();
        $layout = $this->layout->classes(Fichas::parentCategoria('12'));
        //levanta o endereço do cliente
        $customers_default_address_id = Customer::find(Auth::user()->id);
        $default_address = AddressBook::find($customers_default_address_id->customers_default_address_id);

        return view('clientes.index')
            ->with('title', STORE_NAME . ' Itens no carrinho')
            ->with('page', 'carrinho')
            ->with('ativo', 'carrinho')
            ->with('contents', $contents->toarray())
            ->with('post_inputs', '')
            ->with('gateways', $gateways)
            ->with('classes', $classes)
            ->with('desc_acrescimo_id', $desc_acrescimo_id)
            ->with('cart_total', Cart::total())
            ->with('default_address', $default_address)
            ->with('rota', 'carrinho.listar')
            ->with('layout', $layout);
    }

    public function Resumo(Request $request) {
        $post_inputs = $request->all();
        $contents = Cart::content();
        //
        //dd($post_inputs);
        $layout = $this->layout->classes(Fichas::parentCategoria($post_inputs['orc_subcategoria_id']));
        //levanta o endereço do cliente
        $customers_default_address_id = Customer::find(Auth::user()->id);
        $default_address = AddressBook::find($customers_default_address_id->customers_default_address_id);

        return view('clientes.index')
            ->with('title', STORE_NAME . ' Seu resumo')
            ->with('page', 'resumo')
            ->with('ativo', 'Resumo')
            ->with('contents', $contents->toarray())
            ->with('post_inputs', $post_inputs)
            ->with('cart_total', Cart::total())
            ->with('default_address', $default_address)
            ->with('rota', 'resumo.html')
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
        //dd($content);
        foreach ($content as $item) {
            if ($item->id == $parans['product_id']) {
                //Cart::update($item->rowid, array('quatity' => $parans['quantity']));
                $carrinho = $this->basket
                    ->where('customer_id', Auth::user()->id)
                    ->where('products_id', $parans['product_id'])
                    ->lists('id');
                //dd($carrinho);
                if(count($carrinho)>0)
                {
                    //foreach ($carrinho as $items) {
                    $id = $carrinho[0]['id'];
                    //}
                    //elimina os item do carrinho
                    $this->basket_item->where('basket_id', $id)->delete();
                    //elimina a entrada com a linha de produto do carrinho
                    $this->basket
                        ->where('customer_id', Auth::user()->id)
                        ->where('products_id', $parans['product_id'])->delete();
                    $rowId = $item->rowid;
                    Cart::remove($rowId);

                    return json_encode(array(
                        'reload' => 'true',
                        'info' => 'Produto ' . $parans['product_id'] . ' removido. Aguarde a atualização da página.'));
                } else {
                    Cart::destroy();
                    return json_encode(array(
                        'reload' => 'true',
                        'info' => 'Produto ' . $parans['product_id'] . ' removido. Aguarde a atualização da página.'));

                }
                break;
            }
        }
        return json_encode(array(
            'reload' => 'false',
            'info' => 'Produto ' . $parans['product_id'] . ' removido.'));


    }

}
