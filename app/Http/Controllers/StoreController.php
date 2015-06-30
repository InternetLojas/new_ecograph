<?php

namespace Ecograph\Http\Controllers;

use Ecograph\Http\Requests;
use Ecograph\Http\Controllers\Controller;
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
        //$this->middleware('auth');
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

    public function UploadResumo(Request $request) {
        $erros = array();
        $post_inputs = $request->all();
        foreach ($post_inputs['files1'] as $upload) {
            echo $upload;
        }
        //exit;
        dd($request->file('files1')->UploadedFile);
        /**
         * Storage related
         */
        //$rules = array('image' => 'required'); //mimes:jpeg,bmp,png and for max size max:10000
        $storagePath = storage_path() . '/documentos/' . \Auth::user()->id;
        if ($request->hasFile('files1')) {
            if ($request->file('files1')->isValid()) {
                $type = $request->file('files1')->getExtension();
                if ($type === 'jpeg' || $type === 'jpg' || $type === 'gif' || $type === 'bmp') {

                    //$rules['files1'] = 'mimes:jpeg,jpg,gif,png,bmp,pdf';
                    //$validator = Validator::make($post_inputs['files1'], $rules);
                    //if ($validator->fails()) {
                    // }else {
                    $fileName1 = $request->file('files1')->getClientOriginalName();
                    $request->file('files1')->move($storagePath, $fileName1);
                }
            }
        }
        if ($request->hasFile('files2')) {
            if ($request->file('files2')->isValid()) {
                $type = $request->file('files2')->getExtension();
                if ($type === 'jpeg' || $type === 'jpg' || $type === 'gif' || $type === 'bmp') {

                    /* $rules['files2'] = 'mimes:jpeg,jpg,gif,png,bmp,pdf';
                      $validator = Validator::make($post_inputs['files2'], $rules);
                      if ($validator->fails()) {

                      } else { */
                    $fileName2 = $request->file('files2')->getClientOriginalName();
                    $request->file('files2')->move($storagePath, $fileName2);
                }
            }
        }
        if ($request->hasFile('files3')) {
            if ($request->file('files3')->isValid()) {
                $type = $request->file('files3')->getExtension();
                if ($type === 'jpeg' || $type === 'jpg' || $type === 'gif' || $type === 'bmp') {

                    /* $rules['files2'] = 'mimes:jpeg,jpg,gif,png,bmp,pdf';
                      $validator = Validator::make($post_inputs['files2'], $rules);
                      if ($validator->fails()) {

                      } else { */
                    $fileName3 = $request->file('files3')->getClientOriginalName();
                    $request->file('files3')->move($storagePath, $fileName3);
                }
            }
        }
        if ($request->hasFile('files4')) {
            if ($request->file('files4')->isValid()) {
                $type = $request->file('files4')->getExtension();
                if ($type === 'jpeg' || $type === 'jpg' || $type === 'gif' || $type === 'bmp') {

                    /* $rules['files2'] = 'mimes:jpeg,jpg,gif,png,bmp,pdf';
                      $validator = Validator::make($post_inputs['files2'], $rules);
                      if ($validator->fails()) {

                      } else { */
                    $fileName4 = $request->file('files4')->getClientOriginalName();
                    $request->file('files4')->move($storagePath, $fileName4);
                }
            }
        }
        if ($request->hasFile('files5')) {
            if ($request->file('files5')->isValid()) {
                $type = $request->file('files5')->getExtension();
                if ($type === 'jpeg' || $type === 'jpg' || $type === 'gif' || $type === 'bmp') {
                    /* $rules['files2'] = 'mimes:jpeg,jpg,gif,png,bmp,pdf';
                      $validator = Validator::make($post_inputs['files2'], $rules);
                      if ($validator->fails()) {

                      } else { */
                    $fileName5 = $request->file('files5')->getClientOriginalName();
                    $request->file('files5')->move($storagePath, $fileName5);
                }
            }
        }
        if ($request->hasFile('files6')) {
            if ($request->file('files6')->isValid()) {
                $type = $request->file('files6')->getExtension();
                if ($type === 'jpeg' || $type === 'jpg' || $type === 'gif' || $type === 'bmp') {
                    /* $rules['files2'] = 'mimes:jpeg,jpg,gif,png,bmp,pdf';
                      $validator = Validator::make($post_inputs['files2'], $rules);
                      if ($validator->fails()) {

                      } else { */
                    $fileName6 = $request->file('files6')->getClientOriginalName();
                    $request->file('files6')->move($storagePath, $fileName6);
                }
            }
        }
        if (count($erros) > 0) {
            $layout = \Layout::classes(0);
            return view('home.index')
                            ->with('title', STORE_NAME . ' Impressos em geral por tema ou profissão')
                            ->with('page', 'home')
                            ->with('ativo', 'Home')
                            ->with('rota', '/')
                            ->with('layout', $layout);
            // send back to the page with the input data and errors
        }
        $parent = \Fichas::parentCategoria($post_inputs['orc_categoria_id']);
        $layout = $this->layout->classes($parent);
        //$title = 'Resumo do Pedido';
        $cart_total = Cart::total();
        //levanta o endereço do cliente
        $address = Customer::with('AddressBook')->find(\Auth::user()->id)->AddressBook;
        $default_address = $address->toarray();
        //levanta o tipo de pagamento
        $gateway = Gateway::ativos('1')->get();
        //$gateway = Gateway::find('1');
        return view('loja.index')
                        ->with('title', STORE_NAME . 'Resumo')
                        ->with('page', 'resumo')
                        ->with('ativo', 'Resumo')
                        ->with('rota', 'loja/resumo.html')
                        ->with('contents', Cart::content())
                        ->with('default_address', $default_address[0])
                        ->with('gateways', $gateway)
                        ->with('post_inputs', $post_inputs)
                        ->with('cart_total', $cart_total)
                        ->with('layout', $layout);
    }

    public function upload() {
        /**
         * Request related
         */
        $file = \Request::file('documento');

        $userId = \Request::get('userId');

        /**
         * Storage related
         */
        $storagePath = storage_path() . '/documentos/' . $userId;

        $fileName = $file->getClientOriginalName();

        /**
         * Database related
         */
        $fileModel = new \App\File();
        $fileModel->name = $fileName;

        $user = \App\User::find($userId);
        $user->files()->save($fileModel);

        return $file->move($storagePath, $fileName);
    }

    /**
     * Prepara ambiente para processamento do pagamento.
     *
     * @return json
     */
    public function ValidaCaixa() {
        $erros = array();
        $post_inputs = \Request::all();
        //regras a serem validadas
        $rules['payment'] = 'required|numeric';
        //$rules['discount_avista'] = 'required|numeric';
        //$rules['discount_avista_id'] = 'required|numeric';
        $rules['discount_cupom'] = 'numeric';
        $rules['total_compra'] = 'required|numeric';
        $rules['frete'] = 'required|numeric';
        $rules['tipo_frete'] = 'required';
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

        $submit = 'loja/process';
        $data = array('status' => 'pass',
            'info' => 'Dados verificados. Aguarde redirecionamento ...',
            'erro' => '',
            'loadurl' => $submit
        );
        return json_encode($data);
    }

    /**
     * Prepara ambiente para processamento do pagamento.
     *
     * @return json
     */
    public function Caixa() {

        $erros = array();
        //check if its our form
        if (Session::token() !== Input::get('_token')) {
            $erros[] = 'Esse formulário ja havia sido postado.';
            $data = array('status' => 'fail',
                'info' => 'Erro de sessão',
                'erro' => $erros,
                'loadurl' => ''
            );
            return json_encode($data);
        }
        //destroy a sessão anterior de pagamento
        //Session::forget('parametros');
        $post_inputs = Input::all(Input::except('_token'));
        //regras a serem validadas
        $rules['payment'] = 'required|numeric';
        $rules['vl_discount_avista'] = 'required|numeric';
        $rules['discount_avista_id'] = 'required|numeric';
        $rules['total_compra'] = 'required|numeric';
        $rules['vl_discount_cupom'] = 'numeric';
        $rules['vl_frete'] = 'required|numeric';
        $rules['tipo_frete'] = 'required';
        $validation = Validator::make($post_inputs, $rules);
        if ($validation->fails()) {
            foreach ($validation->getMessageBag()->toArray() as $atributo => $erro) {
                foreach ($erro as $key => $value) {
                    $erros[] = $value;
                }
            }
        }
        if (count($erros) > 0) {
            $data = array('status' => 'fail',
                'info' => 'Erro de dados',
                'erro' => $erros
            );
            return json_encode($data);
        } else {
            $this->post_inputs = $post_inputs;
            //identifica a classe a ser utilizada
            $class = Gateway::find($post_inputs['payment'])->class;
            $this->class = $class;

            //puxa as configurações necessárias para o processo de pagamento retorna um array
            $start = $class::start();
            $this->start = $start;

            //gera a pedido especifico e recebe o identificador do novo pedido
            //ou recebe false quando não foi possivel gerar o pedido
            $order_id = Checkout::order($class, $post_inputs['payment']);
            if ($order_id) {
                $this->order_id = $order_id;
                //prossegue na criacação dos itens do pedido
                $data = $this->ItemsPedido();
                if ($data['status'] == 'pass') {
                    //cria um sessão do identificador do pedido utilizado
                    Session::put('neworder_id', $order_id);
                    $data['url_action'] = URL::to('loja/finalizacao');
                    //identifica se é um gateway interno ou externo
                    $gateway_externo = Gateway::find($post_inputs['payment'])->gateway_externo;
                    //cria um sessão da classe trabalhada
                    Session::put('newclass', $class);
                    if ($gateway_externo == 0) {
                        //o formulário n necessita ser submetido
                        $submeter = false;
                    } else {
                        //o formulário precisa ser submetido
                        $submeter = true;
                    }
                    $data['submeter'] = $submeter;
                    $data['neworder_Id'] = $order_id;
                    //echo '<pre>';print_r($data);exit;
                    //if($dat)
                    //tudo ok as sessões desse pedido no carrinho são eliminadas
                    //Basket::where('customer_id', '=', Auth::user()->id)->delete();
                    //Session::forget('carrinho');
                    //Cart::destroy();
                    return json_encode($data);
                } else {
                    return json_encode($data);
                }
                //return json_encode($data);
            }
            $erros[] = 'Não foi possivel criar o pedido';
            $data = array('status' => 'fail',
                'info' => 'Erro de dados',
                'erro' => $erros
            );
            return json_encode($data);
        }
    }

    public function Busca() {
        $keyword = \Request::get('keyword');
        //$filtro = '';
        $filtro = Fichas::trataKeyword($keyword);
        if (is_array($filtro)) {
            $chave = Fichas::Proibidas($filtro);
            $resultado = Fichas::buscas($chave);
            if ($resultado) {
                $products = $resultado->getCollection()->all();
                $path = $resultado->setPath('loja/busca');
                $links = $path->appends(['keyword' => $keyword])->render();
                $layout = $this->layout->classes('0');
                return view('produtos.index')
                                ->with('products', $products)
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

}
