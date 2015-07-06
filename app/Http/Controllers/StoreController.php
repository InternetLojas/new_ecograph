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
    private $fileModel;
    private $fileTextoModel;
    private $fileMidiaModel;
    private $orcamentoModel;
    private $orcamentoProdutoModel;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Layout $layout,\Ecograph\File $fileModel,
                                \Ecograph\FileTexto $fileTextoModel,
                                \Ecograph\FileMidia $fileMidiaModel,
                                \Ecograph\Orcamento $orcamentoModel,
                                \Ecograph\OrcamentoProduto $orcamentoProdutoModel) {
        $this->layout = $layout;
        $this->fileModel = $fileModel;
        $this->fileTextoModel = $fileTextoModel;
        $this->fileMidiaModel = $fileMidiaModel;
        $this->orcamentoModel = $orcamentoModel;
        $this->orcamentoProdutoModel = $orcamentoProdutoModel;
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
        //, \Ecograph\Http\Requests\FileMidiaRequest $midia
        $post_inputs = $request->all();
        foreach($post_inputs as $key => $input){
            if($key !=='files'){
                $find_orc   = 'orc_';
                $find_id   = '_id';
                $pos = strpos($key, $find_orc);
                $pos1 = strpos($key, $find_id);
                if ($pos === false) {
                    $inputs[$key] = $input;
                } else if($pos1 === false){
                    $inputs_orc[$key] = $input;
                }
            }
        }
        //dd($inputs_orc);
        /*$rules = [
            'logo1' => 'mimes:jpeg,jpg,gif,png,bmp,pdf',
            'logo2' => 'mimes:jpeg,jpg,gif,png,bmp,pdf',
            'logo3' => 'mimes:jpeg,jpg,gif,png,bmp,pdf',
            'img1' => 'mimes:jpeg,jpg,gif,png,bmp,pdf',
            'img2' => 'mimes:jpeg,jpg,gif,png,bmp,pdf',
            'img2' => 'mimes:jpeg,jpg,gif,png,bmp,pdf'
        ];*/
        $erros = [];
        //local onde se armazena fisicamente os arquivos enviados dos clientes
        $storagePath = storage_path() . '/documentos/' . \Auth::user()->id;
        foreach($post_inputs['files'] as $key => $files){
            if($files){
                $logos[$key] = $files->getClientOriginalName();
                $files->move($storagePath,  $logos[$key]);
                $erros[] =$files->isValid();
            }
        }
        //dd($inputs_orc);
        $user_id = Auth::user()->id;
        $customer_name = Customer::find($user_id)->customers_firstname;
        //preparando os arquivos para upload
        $file = $this->fileModel->fill(['customer_id'=>$user_id]);
        $file->save();
        $inputs['file_id'] = $file->id;
        $filetexto = $this->fileTextoModel->fill($inputs);
        $filetexto->save();
        $logos['file_id'] =  $inputs['file_id'];
        $filemidia = $this->fileMidiaModel->fill($logos);
        $filemidia->save();
        //armazenando os dados para o orçamento
        $orc = ['customer_id'=>$user_id,'file_id' => $inputs['file_id'],'orcamento_status'=>1];
        $orcamento = $this->orcamentoModel->fill($orc);
        $orcamento->save();
        $inputs_orc['orcamento_id'] = $orcamento->id;
        $orcamento_produto = $this->orcamentoProdutoModel->fill($inputs_orc);
        $orcamento_produto->save();

        $parent = \Fichas::parentCategoria($post_inputs['orc_categoria_id']);
        $layout = $this->layout->classes($parent);
        $title = 'Resumo do Orcamento';

        return view('loja.index')
            ->with('title', STORE_NAME . $title)
            ->with('page', 'resumo_orc')
            ->with('ativo', 'Resumo')
            ->with('rota', 'loja/resumo.html')
            ->with('customer_name',$customer_name)
            ->with('inputs', $inputs)
            ->with('storagePath',$storagePath)
            ->with('logos', $logos)
            ->with('orcamento_id', $orcamento->id)
            ->with('inputs_orc', $inputs_orc)
            ->with('erros', $erros)
            ->with('layout', $layout);
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
