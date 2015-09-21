<?php

namespace Ecograph\Http\Controllers;

use Ecograph\Http\Requests;
use Ecograph\Http\Controllers\Controller;
use Ecograph\Libs\Bcash;
use Ecograph\Perfil;
use Ecograph\Product;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Ecograph\Libs\Layout;
use Ecograph\Libs\Fichas;
use Ecograph\Customer;
use Ecograph\Basket;
use Ecograph\AddressBook;
use Ecograph\Gateway;
use Validator;
use Session;
use Cart;
use Auth;

class StoreController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Store Controller
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
    }

    /**
     * Retorna uma página com o resumo de uma compra.
     *
     * @return View
     */
    public function Resumo(Request $request) {
        Session::forget('error');
        $post_inputs = $request->all();

        $parent = \Fichas::parentCategoria($post_inputs['orc_categoria_id']);
        $layout = $this->layout->classes($parent);
        $title = 'Resumo do Pedido';
        $cart_total = Cart::total();
        //levanta o endereço do cliente
        $customers_default_address_id = Customer::find(Auth::user()->id);
        $default_address = AddressBook::find($customers_default_address_id->customers_default_address_id);
        //levanta o tipo de pagamento
        $gateway = Gateway::ativos('1')->get();
        //$gateway = Gateway::find('1');
        return view('loja.index')
            ->with('title', STORE_NAME . 'Resumo')
            ->with('page', 'resumo')
            ->with('ativo', 'Resumo')
            ->with('rota', 'loja/resumo.html')
            ->with('contents', Cart::content())
            ->with('default_address', $default_address)
            ->with('gateways', $gateway)
            ->with('post_inputs', $post_inputs)
            ->with('cart_total', $cart_total)
            ->with('layout', $layout);
    }



    /**
     * Prepara ambiente para processamento do pagamento.
     *
     * @return json
     */
    public function ValidaCaixa(Request $request) {
        $erros = array();
        $post_inputs = $request->all();
//dd($post_inputs);
        //regras a serem validadas
        $rules['payment'] = 'required|numeric';
        //$rules['discount_avista'] = 'required|numeric';
        //$rules['discount_avista_id'] = 'required|numeric';
        $rules['discount_cupom'] = 'numeric';
        $rules['total_compra'] = 'required|numeric';
        $rules['orc_vl_frete'] = 'required|numeric';
        $rules['orc_tipo_frete'] = 'required';
        $validation = Validator::make($post_inputs, $rules);
        if ($validation->fails()) {
            foreach ($validation->getMessageBag()->toArray() as $atributo => $erro) {
                foreach ($erro as $key => $value) {
                    $erros[] = $value;
                }
            }
            $data = array('status' => 'fail',
                'info' => 'Erro de dados',
                'erro' => $erros,
                'loadurl' => ''
            );
            return json_encode($data);
        }
        //$class = Gateway::find($post_inputs['payment'])->class;
        //puxa as configurações necessárias para o processo de pagamento retorna um array

        $submit = route('loja.process');
        $data = array('status' => 'pass',
            'info' => 'Dados verificados. Aguarde redirecionamento ...',
            'metodo' => 'post',
            'forma_pagamento' => $post_inputs['forma_pagamento'],
            'id_pagamento' => $post_inputs['payment'],
            'orc_desconto_valor' => $post_inputs['orc_desconto_valor'],
            'url_externa' => 'https://www.bcash.com.br/checkout/pay/',
            'loadurl' => $submit
        );

       // echo '<pre>';print_r($data);exit;
        return json_encode($data);
    }


    public function Busca(Product $product) {
        $keyword = \Request::get('keyword');
        //$filtro = '';
        $filtro = Fichas::trataKeyword($keyword);

        if (is_array($filtro)) {
            $chave = Fichas::Proibidas($filtro);
            $resultado = Fichas::buscas($chave);

            if ($resultado) {
                //$buscaperfil = $perfil->where('nome_perfil', 'LIKE', $chave)->get()->first();
                //dd($buscaperfil);
                $products = $resultado->getCollection()->all();
                $path = $resultado->setPath('loja/busca');
                $links = $path->appends(['keyword' => $keyword])->render();
                $layout = $this->layout->classes('0');
                foreach($products as $prod){
                    $produto = $product->find($prod->id);
                    $produto_id = $produto->CategoryProduct()->first()->product_id;
                    $category[$produto_id] = $produto->CategoryProduct()->first()->category_id;

                }
                //dd($category);
                return view('produtos.index')
                    ->with('products', $products)
                    ->with('category',$category)
                    ->with('keyword', $keyword)
                    ->with('title', STORE_NAME . ' Busca por: ' . $keyword)
                    ->with('page', 'busca')
                    ->with('links', $links)
                    ->with('ativo', $keyword)
                    ->with('total', $resultado->total())
                    ->with('rota', 'loja/busca')
                    ->with('layout', $layout);
            }
        }

        $layout = $this->layout->classes('0');
        return view('produtos.index')
            ->with('products', '')
            ->with('keyword', $keyword)
            ->with('title', STORE_NAME . ' Busca por: ' . $keyword)
            ->with('page', 'naocadastrado')->with('ativo', 'busca')
            ->with('total', '0')->with('rota', 'busca/')
            ->with('layout', $layout)
            ->with('message', 'A busca por ' . $keyword . ' não obteve resultado.');
    }
    public function Finalizacao() {

        return view('loja.index')
            ->with('title', STORE_NAME . ' Ckeckout Bcash')
            ->with('page', 'sucesso')
            ->with('ativo', 'Bcash')
            ->with('parametros', '')
            ->with('rota', 'loja/sucesso');

    }
}
