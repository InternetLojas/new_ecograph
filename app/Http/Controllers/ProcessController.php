<?php

namespace Ecograph\Http\Controllers;

use Ecograph\AddressBook;
use Ecograph\Basket;
use Ecograph\BasketIten;
use Ecograph\Confdesconto;
use Ecograph\Customer;
use Ecograph\Http\Controllers\Controller;
use Ecograph\Gateway;
use Ecograph\Libs\Layout;
use Ecograph\Libs\Checkout;
use Cart;
use Ecograph\Order;
use Ecograph\OrderIten;
use Ecograph\Ordersituacao;
use Ecograph\OrderTotal;
use Ecograph\Product;
use Session;
use Symfony\Component\HttpFoundation\Request;


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

    public function Process(\Illuminate\Http\Request $request) {
        $inputs = $request->except('_token');
        Session::set('orc_desconto_valor',$inputs['orc_desconto_valor']);
        //identifica a classe a ser utilizada
        $class = Gateway::find($inputs['payment'])->class;
        //puxa as configurações necessárias para o processo de pagamento
        $start = $class::start();

        //prepara o ambiente espedífico da classe
        $before = $class::before($start, $inputs['orc_tipo_frete'], $inputs['orc_vl_frete']);
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

    public function Pedido(Gateway $gateway, Checkout $checkout, Customer $customer, Order $order, Ordersituacao $ordersituacao, AddressBook $addressBook, Product $product, OrderIten $orderIten, OrderTotal $orderTotal) {
        $inputs = \Request::except('_token');
        $prossegue = false;
        //identifica a classe a ser utilizada
        $class = $gateway->find($inputs['id_payment'])->class;
        //gera o pedido
        $order_id = $checkout->order($inputs['payment'], $class, $customer,$order,$ordersituacao,$addressBook);

        if (is_numeric($order_id)) {
            //gera os valores totais, descontos e acrescimos
            $value = [
                Cart::total(),
                $inputs['vl_frete'],
                0,
                Session::get('orc_desconto_valor'),
                0,
                $inputs['total_compra']
            ];

            $o_total = $checkout->OrderTotal($order_id,$value, $orderTotal);

            if($o_total){
                //prossegue na criacação dos itens do pedido
                $o_item = $checkout->Item($order_id,$product, $orderIten);
                if($o_item){
                    $prossegue = true;
                }
            }

            if($prossegue){
                $data['status'] = 'success';
                $data['url_interna'] = '';
                $data['url_externa'] = 'https://www.bcash.com.br/checkout/pay/';
                $data['metodo'] = 'post';
                $data['submeter'] = true;
                $data['neworder_Id'] = $order_id;

                //envia o email de confirmação de pedido
                \EnvioEmail::novopedido($order_id);

                //remove o item da tabela
                //procura a linha do carrinho
                $userId = \Auth::user()->id;

                //guarda a informação do uso do cupom
                if (Session::has('conf_descontos_code_id')) {
                   $cliente = $customer->find($userId);
                    $conf_descontos_code_id = Session::get('conf_descontos_code_id');
                    if(!empty($conf_descontos_code_id)){
                       $CustomerDiscount = $cliente->CustomerDiscount()
                    ->where('conf_descontos_code_id',$conf_descontos_code_id)
                    ->where('customer_id',$userId)->first();
                 
                    $CustomerDiscount->update(['discount_order_id',$order_id]);
                    //destproi a sessão
                    Session::set('conf_descontos_code_id','');  
                    Session::set('discount_code',''); 
                    }                                   
                
                }
                $customer = Customer::find($userId);
                $customer_basket = $customer->basket->toArray();
                if ($customer_basket) {
                    foreach ($customer_basket as $item) {
                        //procura a linha do carrinho
                        $basket = Basket::find($item['id']);
                        if ($basket) {
                            //elimina os itens
                            $basket->BasketIten()->delete();
                            //elimina o carrinho
                            $basket->delete();
                        }
                    }
                    Cart::destroy();
                    return json_encode($data);
                }
            }
        }
        $data['status'] = 'fail';
        $data['url_interna'] = '';
        $data['url_externa'] = '';
        $data['metodo'] = '';
        $data['submeter'] = false;
        $data['neworder_Id'] = '';
        return json_encode($data);
    }

}
