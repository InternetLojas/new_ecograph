<?php

namespace Ecograph\Http\Controllers;

use Ecograph\Http\Controllers\Controller;
use Ecograph\Gateway;
use Ecograph\Libs\Layout;
use Cart;

class ProcessController extends Controller {

    private $layout;

    //private $payments;
    // private $classe_pg;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Layout $layout) {
        $this->layout = $layout;
        //$this->payments = $payments;
    }

    public function Process() {
        $inputs = \Request::except('_token');
        //identifica a classe a ser utilizada
        $class = Gateway::find($inputs['payment'])->class;
        //puxa as configurações necessárias para o processo de pagamento
        $start = $class::start();
        //prepara o ambiente espedífico da classe
        $before = $class::before($start, $inputs['tipo_frete'], $inputs['frete']);
        $before["id_pedido"] = 900;
        $before["redirect"] = "true";
        //preparativos para mostrar a página
        $html = $class::html($before);

        $payment = Gateway::find($inputs['payment']);
        //identifica a classe

        $class_payment = Gateway::find($inputs['payment'])->class;
        $title_class = Gateway::find($inputs['payment'])->title;
        $class_id = Gateway::find($inputs['payment'])->id;
        //identifica se é um gateway interno ou externo
        $gateway_externo = Gateway::find($inputs['payment'])->gateway_externo;
        if ($gateway_externo == 0) {
            $submeter = false;
        } else {
            $submeter = true;
        }
        $layout = $this->layout->classes('0');
        return view('loja.index')
                        ->with('title', STORE_NAME . ' Checkout ' . $title_class)
                        ->with('page', 'checkout')
                        ->with('ativo', $title_class)
                        ->with('gateway', $title_class)
                        ->with('payment', $payment)
                        ->with('class_payment', $class_payment)
                        ->with('rota', 'loja/checkout.html')
                        ->with('submeter', $submeter)
                        ->with('total_compra', $inputs['total_compra'])
                        ->with('discount_cupom', $inputs['discount_cupom'])
                        ->with('vl_frete', $inputs['frete'])
                        ->with('tipo_frete', $inputs['tipo_frete'])
                        ->with('html', $html)
                        ->with('class', $class_id)
                        ->with('layout', $layout);
    }

    public function Checkout() {
        $inputs = \Request::all();
        $layout = $this->layout->classes(0);
        //$payment = Gateway::find($inputs['payment']);
        //identifica a classe
        $class_payment = Gateway::find($inputs['payment'])->class;
        $title_class = Gateway::find($inputs['payment'])->title;
        $class_id = Gateway::find($inputs['payment'])->id;
        //identifica se é um gateway interno ou externo
        $gateway_externo = Gateway::find($inputs['payment'])->gateway_externo;
        if ($gateway_externo == 0) {
            $submeter = false;
        } else {
            $submeter = true;
        }
        return view('loja.index')
                        ->with('title', STORE_NAME . ' Checkout ' . $title_class)
                        ->with('page', 'checkout')
                        ->with('ativo', $title_class)
                        ->with('gateway', $title_class)
                        ->with('class_payment', $class_payment)
                        ->with('rota', 'loja/checkout.html')
                        ->with('submeter', $submeter)
                        ->with('class', $class_id)
                        ->with('layout', $layout);
    }

    public function Pedido() {

        $post_inputs = \Request::except('_token');
        dd($post_inputs);
        //gera a pedido especifico
        //$order_id = 1; //$this->order($class);
        // //gera os valores totais, descontos e acrescimos
        //$this->ordemtotal($order_id);
        //
        // 
        //$this->post_inputs = $post_inputs;
        //identifica a classe a ser utilizada
       // $class = Gateway::where('payment',$post_inputs['payment'])->class;
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
