<?php

namespace Ecograph\Http\Controllers;

use Ecograph\Http\Controllers\Controller;
use Ecograph\Gateway;
use Ecograph\Libs\Layout;
use Ecograph\Libs\Checkout;
use Cart;
use Session;


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
        $this->middleware('auth');
        $this->layout = $layout;
    }

    public function Process() {
        $inputs = \Request::except('_token');
        //identifica a classe a ser utilizada
        $class = Gateway::find($inputs['payment'])->class;
        //puxa as configurações necessárias para o processo de pagamento
        $start = $class::start();

        //prepara o ambiente espedífico da classe
        $before = $class::before($start, $inputs['orc_tipo_frete'], $inputs['orc_vl_frete']);

        $before["id_pedido"] = $inputs['order_id'];
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
            ->with('rota', 'loja.checkout')
            ->with('submeter', $submeter)
            ->with('total_compra', $inputs['total_compra'])
            ->with('discount_cupom', $inputs['discount_cupom'])
            ->with('vl_frete', $inputs['orc_vl_frete'])
            ->with('tipo_frete', $inputs['orc_tipo_frete'])
            ->with('html', $html)
            ->with('class', $class_id)
            ->with('layout', $layout);
    }

   /* public function Checkout() {
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
    }*/

    public function Pedido() {
        $inputs = \Request::except('_token');

        //identifica a classe a ser utilizada
        $class = Gateway::find($inputs['id_payment'])->class;
        //gera o pedido
        $order_id = Checkout::order($inputs['payment'], $class);

        //gera os valores totais, descontos e acrescimos
        $value = [
            Cart::total(),
            $inputs['vl_frete'],
            0,
            $inputs['discount_cupom'],
            0,
            $inputs['total_compra']
        ];

        Checkout::OrderTotal($order_id,$value);
        //prossegue na criacação dos itens do pedido

        Checkout::Item($order_id);

        if ($order_id) {
            //caso true - criou o item de pedido;

                $data['status'] = 'success';
                $data['url_interna'] = '';
                $data['url_externa'] = 'https://www.bcash.com.br/checkout/pay/';
                $data['metodo'] = 'post';
                $data['submeter'] = true;
                $data['neworder_Id'] = $order_id;
            return json_encode($data);
        } else{
           return false;
        }

    }

}
