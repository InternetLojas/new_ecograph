<?php

namespace Ecograph\Http\Controllers;

use Ecograph\Cor;
use Ecograph\Http\Requests;
use Ecograph\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Ecograph\Libs\Layout;
use Ecograph\Libs\Fichas;
use Ecograph\Customer;
use Ecograph\CategoryProduct;
use Ecograph\Basket;
use Ecograph\Formato;
use Ecograph\Papel;
use Ecograph\Acabamento;
use Ecograph\Core;
use Ecograph\Enoblecimento;
use Ecograph\ProdutoPerfil;
use Ecograph\Pacote;
use Ecograph\BasketIten;
use Ecograph\AddressBook;
use Session;
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


    private $basket;
    private $basket_item;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Basket $basket, BasketIten $basket_item) {
        $this->basket = $basket;
        $this->basket_item = $basket_item;
    }

    /**
     * Verifica se existe produtos do carrinho antigo.
     * Situação ocorre quando o cliente faz login
     * @return View
     */
    public function Verifica() {
        $userId = \Auth::user()->id;
        $customer = Customer::find($userId);
        $customer_basket = $customer->basket->toArray();
        //verifica se tem uma sessão com produtos
        if(Cart::count()==0){
            //tem itens Antigo
            // se sim carrega itens antigo
            if (count($customer_basket) > 0) {
                return redirect()->route('basket.sessao.old');
            }else{
                //se não redireciona para index
                return redirect()->route('index');
            }
        } else {
            //tem itens Antigo
            //se sim carrega itens antigo mais a sessão
            if (count($customer_basket) > 0) {
                return redirect()->route('basket.sessao.old',['customer_basket'=>$customer_basket]);
            }else{
                //se não redireciona para index
                return redirect()->route('index');
            }
        }
    }

    /**
     * @param Request $request
     * @return $this
     * Se se loga e tem itens antigo carrega a sessão de carrinho
     */
    public function SessaoOld(){
        $userId = Auth::user()->id;
        $customer = Customer::find($userId);
        $customer_basket = $customer->basket->toArray();
        $this->getCart($customer_basket);
        $contents = Cart::content();
        //levanta o endereço do cliente
        $default_address = AddressBook::find($customer->customers_default_address_id);
        return view('clientes.index')
            ->with('title', STORE_NAME . ' Itens no carrinho')
            ->with('page', 'carrinho')
            ->with('ativo', 'carrinho')
            ->with('post_inputs', '')
            ->with('contents', $contents->toarray())
            ->with('cart_total', Cart::total())
            ->with('default_address', $default_address)
            ->with('rota', 'carrinho.html');
    }

    /**
     * @param Request $request
     * @return view
     * Se se loga e tem itens antigo carrega a sessão de carrinho
     */
    public function SessaoNew($customer_basket){
        $this->getCart($customer_basket);
        $contents = Cart::content();
        //levanta o endereço do cliente
        $default_address = AddressBook::find($customer->customers_default_address_id);
        return view('clientes.index')
            ->with('title', STORE_NAME . ' Itens no carrinho')
            ->with('page', 'carrinho')
            ->with('ativo', 'carrinho')
            ->with('post_inputs', '')
            ->with('contents', $contents->toarray())
            ->with('cart_total', Cart::total())
            ->with('default_address', $default_address)
            ->with('rota', 'carrinho.html');
    }
    /**
     * @param Request $request
     * @return jason
     * incrementa linhas de produtos no carrinho virtual
     */
    public function Adicionar(Request $request) {
        $post_inputs = $request->all();
        //orc_desconto_valor
        $valor = str_replace('R$ ', '',$post_inputs['orc_pacote_valor']);
        $price = str_replace(',', '.',$valor);
        $image = Fichas::ImgProduto($post_inputs['produto_id']);
        $qty = str_replace(' un','',$post_inputs['orc_pacote_qtd']);
        if($post_inputs['orc_subcategoria_id']== 29){
            $pacote_id[0] = 1000;
        } else {
            $pacote_id = Pacote::where('category_id',$post_inputs['orc_subcategoria_id'])
                ->where('quantity',$qty)->lists('id');
        }

        $item = (array('id' => $post_inputs['produto_id'],
            'name' => Fichas::nomeProduto($post_inputs['produto_id']),
            'price' => $price,
            'quantity' => 1,
            'image' => $image
        ));
        $option = array(
            'categoria_id' => $post_inputs['orc_subcategoria_id'],
            'categoria' => $post_inputs['orc_subcategoria_nome'],
            'formato_id' => $post_inputs['orc_formato_id'],
            'formato' => $post_inputs['orc_formato_nome'],
            'papel_id' => $post_inputs['orc_papel_id'],
            'papel' => $post_inputs['orc_papel_nome'],
            'cor_id' => $post_inputs['orc_cor_id'],
            'cor' => $post_inputs['orc_cor_nome'],
            'enoblecimento_id' => $post_inputs['orc_enoblecimento_id'],
            'enoblecimento' => $post_inputs['orc_enoblecimento_nome'],
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
                    $this->basket_item->cor_id = $option['cor_id'];
                    $this->basket_item->enoblecimento_id = $option['enoblecimento_id'];
                    $this->basket_item->acabamento_id = $option['acabamento_id'];
                    $this->basket_item->pacote_id = $pacote_id[0];
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
            $this->basket_item->cor_id = $option['cor_id'];
            $this->basket_item->enoblecimento_id = $option['enoblecimento_id'];
            $this->basket_item->acabamento_id = $option['acabamento_id'];
            $this->basket_item->pacote_id = $pacote_id[0];
            $this->basket_item->save();
        }

        $data = array('status' => 'success',
            'info' => 'Itens adicionado na carrinho'
        );
        //dd($data);
        return json_encode($data);
    }
    /**
     * @param
     * @return view
     * incrementa retorna a lista de produtos do carrinho
     */
    public function Basket(Request $request) {
        $post_inputs = $request->all();
        //echo 'primeiro aqui';
        //dd($post_inputs);
        if(Cart::count()>0){
            $contents = Cart::content();
            //dd($contents);
            $userId = \Auth::user()->id;
            $customer = Customer::find($userId);
            //levanta o endereço do cliente
            $default_address = AddressBook::find($customer->customers_default_address_id);

            return view('clientes.index')
                ->with('title', STORE_NAME . ' Itens no carrinho')
                ->with('page', 'carrinho')
                ->with('ativo', 'carrinho')
                ->with('post_inputs', $post_inputs)
                ->with('contents', $contents->toarray())
                ->with('cart_total', Cart::total())
                ->with('default_address', $default_address)
                ->with('rota', 'carrinho.html');
        }
        else {
            return view('clientes.index')
                ->with('title', STORE_NAME . ' Carrinho Vazio')
                ->with('page', 'carrinhovazio')
                ->with('ativo', 'Carrinho Vazio')
                ->with('rota', 'carrinho.lista');
        }
    }

    public function Listar(Request $request) {
        if(Cart::count()>0){
            $post_inputs = $request->all();
           // echo "aqui";
            //dd($post_inputs);
            $contents = Cart::content();
            $userId = \Auth::user()->id;
            $customer = Customer::find($userId);
            //levanta o endereço do cliente
            $default_address = AddressBook::find($customer->customers_default_address_id);

            return view('clientes.index')
                ->with('title', STORE_NAME . ' Itens no carrinho')
                ->with('page', 'carrinho')
                ->with('ativo', 'carrinho')
                ->with('post_inputs', $post_inputs)
                ->with('contents', $contents->toarray())
                ->with('cart_total', Cart::total())
                ->with('default_address', $default_address)
                ->with('rota', 'basket.listar');
        }
        else {

            return view('clientes.index')
                ->with('title', STORE_NAME . ' Carrinho Vazio')
                ->with('page', 'carrinhovazio')
                ->with('ativo', 'Carrinho Vazio')
                ->with('rota', 'carrinho.lista');
        }
    }
    /**
     * @param
     * @return json
     * incrementa retira o item do carrinho virtual e da tabela
     */
    public function Remover() {
        $parans = \Request::all();
        //procura a linha do carrinho
        $rowId = Cart::search(array('id' => $parans['product_id'] )); // Returns an array of rowid(s) of found item(s) or false on failure
        if($rowId) {
            if (!Auth::check()) {
                Cart::remove($rowId[0]);
            } else {
                /* $userId = \Auth::user()->id;
                 $customer = Customer::find($userId);
                 $customer_basket = $customer->basket->toArray();
                 if($customer_basket){
                     foreach($customer_basket as $item){
                         $row = $this->basket_item->find($item['id']);
                         if($row)
                             $row->delete();
                     }
                     $row = $this->basket->find($customer_basket[0]['id']);
                     if($row)
                         $row->delete();
                 }
                 if($rowId)
                     Cart::remove($rowId[0]);*/

                //Cart::remove($rowId[0]);
                $userId = \Auth::user()->id;
                $customer = Customer::find($userId);
                $customer_basket = $customer->basket->toArray();
                if ($customer_basket) {
                    foreach ($customer_basket as $item) {
                        //$basket_itens = BasketIten::
                        $basket = Basket::find($item['id']);
                        if ($basket) {
                            //elimina os itens
                            $basket->BasketIten()->delete();
                            //elimina o carrinho
                            $basket->delete();
                        }
                    }
                }
                Cart::remove($rowId[0]);
            }
            return json_encode(array(
                'reload' => 'true',
                'info' => 'Produto ' . $parans['product_id'] . ' removido. Aguarde a atualização da página.'));
        }

        return json_encode(array(
            'reload' => 'false',
            'info' => 'Nada a ser removido'));
    }

    /**
     * @param $customer_basket
     */
    public function getCart($customer_basket)
    {
        foreach ($customer_basket as $key => $valor) {
            //procura o produto na sessão do carrinho
            $rowId = Cart::search(['id' => $valor['products_id']]); // Returns an array of rowid(s) of found item(s) or false on failure
            //se achar o produto aumenta a quantidade
            if($rowId){
                $row = Cart::get($rowId);
                $row_qtd = $valor['quantity']+$row['quantity'];
                $row_total = ($valor['price']/$valor['quantity'])*$row_qtd;
                Cart::update($rowId, array('quantity' => $row_qtd, 'price'=>$row_total));
            }
            $item = array('id' => $valor['products_id'],
                'name' => \Ecograph\ProductDescription::find($valor['products_id'])->products_name,
                'price' => str_replace('R$ ', '', $valor['final_price']),
                'quantity' => $valor['quantity'],
                'image' => Fichas::ImgProduto($valor['products_id'])
            );
            $basket_items = $this->basket->find($valor['id']);
            $option_itens = $basket_items->BasketIten->toArray();
            //dd($option_itens);
            $cat = CategoryProduct::Categoria($valor['products_id']);
            $categoria = $cat->toarray();
            $cor_id = $option_itens[0]['cor_id'];
            $enoblecimento_id = $option_itens[0]['enoblecimento_id'];
            if ($cor_id != 0) {
                $cor_nome = Cor::find($option_itens[0]['cor_id'])->valor;
            } else {
                $cor_nome = '';
            }
            if ($enoblecimento_id != 0) {
                $enoblecimento_nome = Enoblecimento::find($option_itens[0]['enoblecimento_id'])->valor;
            } else {
                $enoblecimento_nome = '';
            }
            if($categoria[0]['category_id'] == 29){
                $unidade = 150;
            } else {
                $unidade = Pacote::find($option_itens[0]['pacote_id'])->quantity;
            }
            $option = [
                'categoria_id' => $categoria[0]['category_id'],
                'categoria' => $categoria[0]['products_name'],
                'formato_id' => $option_itens[0]['formato_id'],
                'formato' => Formato::find($option_itens[0]['formato_id'])->valor,
                'papel_id' => $option_itens[0]['papel_id'],
                'papel' => Papel::find($option_itens[0]['papel_id'])->valor,
                'acabamento_id' => $option_itens[0]['acabamento_id'],
                'acabamento' => Acabamento::find($option_itens[0]['acabamento_id'])->valor,
                'cor_id' => $cor_id,
                'cor' => $cor_nome,
                'enoblecimento_id' => $enoblecimento_id,
                'enoblecimento' => $enoblecimento_nome,
                'unidade' => $unidade,
                'perfil' => $categoria[0]['products_name'],
                'perfil_id' => ProdutoPerfil::find($valor['products_id'])->perfis_id
            ];
            Cart::add($item['id'], $item['name'], $item['quantity'], $item['price'], $option);
        }
    }
}
