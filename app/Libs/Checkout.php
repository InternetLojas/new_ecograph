<?php

namespace Ecograph\Libs;

use Ecograph\Libs\Payments;
use Ecograph\Gateway;
use Ecograph\Customer;
use Ecograph\Addressbook;
use Auth;
use Cart;

Class Checkout {

    /**
     * Armazena o pedido no banco de dados.
     * Retorna o identificados do novo pedido ou retorna false
     * @return order_id ou false
     */
    static function order($payment_method, $gateway_id) {

        $customer = Customer::find(Auth::user()->id);
        $default_address = Addressbook::find($customer->customers_default_address_id);

        //$ip = $HTTP_SERVER['HTTP_CLIENT_IP'];
        //$ip = '127.0.0.1';
        $request = Request::instance();
        $request->setTrustedProxies(array('127.0.0.1')); // only trust proxy headers coming from the IP addresses on the array (change this to suit your needs)
        $ip = $request->getClientIp();
        $array_customer = array('customer_id' => Auth::user()->id,
            'customers_name' => $customer->customers_firstname . ' ' . $customer->customers_lastname,
            'customers_nr_rua' => $default_address->entry_nr_rua,
            'customers_street_address' => $default_address->entry_street_address,
            'customers_comp_ref' => $default_address->entry_comp_ref,
            'customers_suburb' => $default_address->entry_suburb,
            'customers_city' => $default_address->entry_city,
            'customers_postcode' => $default_address->entry_postcode,
            'customers_state' => $default_address->entry_state,
            'customers_state_code' => $default_address->entry_state_code,
            'customers_country' => 'Brasil',
            'customers_ddd' => $customer->customers_ddd,
            'customers_telephone' => $customer->customers_telephone,
            'customers_email_address' => $customer->email,
            'customers_cpf_cnpj' => $customer->customers_cpf_cnpj,
            'customers_pf_pj' => $customer->customers_pf_pj,
            'customers_rg_ie' => $customer->customers_rg_ie,
            'customers_ip_address' => $ip
        );

        $array_delivery = array('delivery_name' => $customer->customers_firstname . ' ' . $customer->customers_lastname,
            'delivery_nr_rua' => $default_address->entry_nr_rua,
            'delivery_street_address' => $default_address->entry_street_address,
            'delivery_comp_ref' => $default_address->entry_comp_ref,
            'delivery_suburb' => $default_address->entry_suburb,
            'delivery_city' => $default_address->entry_city,
            'delivery_postcode' => $default_address->entry_postcode,
            'delivery_state' => $default_address->entry_state,
            'delivery_state_code' => $default_address->entry_state_code,
            'delivery_country' => 'Brasil'
        );

        $array_billing = array('billing_name' => $customer->customers_firstname . ' ' . $customer->customers_lastname,
            'billing_nr_rua' => $default_address->entry_nr_rua,
            'billing_street_address' => $default_address->entry_street_address,
            'billing_comp_ref' => $default_address->entry_comp_ref,
            'billing_suburb' => $default_address->entry_suburb,
            'billing_city' => $default_address->entry_city,
            'billing_postcode' => $default_address->entry_postcode,
            'billing_state' => $default_address->entry_state,
            'billing_state_code' => $default_address->entry_state_code,
            'billing_country' => 'Brasil',
            'payment_method' => Gateway::find($gateway_id)->title,
            'currency' => 'BRL',
            'currency_value' => '1.0000'
        );

        //controla clientes pessoas jurídicas
        if ($customer->customers_pf_pj == 'j') {
            $array_customer['customers_company'] = $default_address->entry_company;
            $array_delivery['delivery_company'] = $default_address->entry_company;
            $array_billing['billing_company'] = $default_address->entry_company;
        }

        $orders_status = Ordersituacao::status($payment_method)->get();
        //print_r($orders_status);exit;
        foreach ($orders_status as $status) {
            $status_id = $status->id;
        }

        $array_order_status = array('payment_method' => $payment_method,
            'orders_status' => $status_id,
            'orders_status_finished_at' => 'now()'
        );

        $array_order = array_merge($array_customer, $array_delivery, $array_billing, $array_order_status);
        $order = new Order();
        foreach ($array_order as $key => $valor) {
            $order->$key = $valor;
        }
        return 1;
//if($order->save()){
        //return $order->id;
//}
        //exit;
        //$order->save();
//return false;
        //return $order->id;
    }

    /**
     * Armazena os tens do pedido no banco de dados.
     * Retorna o identificados do novo pedido ou retorna false
     * @return true ou false
     */
    static function item($new_order_id) {
        $orderitem = Null;
        foreach (Cart::contents() as $itens) {
            //controla o estoque
            $stock = Product::find($itens->id);
            $stock->products_quantity -= $itens->quantity;
            //$stock->save();
            //controla os itens do pedido
            $orderitem = new OrderItem();
            $preco = $itens->price * $itens->quantity;
            $orderitem->order_id = $new_order_id;
            $orderitem->product_id = $itens->id;
            $orderitem->quantity = $itens->quantity;
            $orderitem->product_name = $itens->name;
            $orderitem->price = $itens->price;
            $orderitem->final_price = $preco;
            $orderitem->tax = '0.00';
            //$orderitem->save();
        }
        if (is_object($orderitem)) {
            //return $orderitem->toArray();
            return true;
        } else {
            return false;
        }
        //return false;
        /* return Response::json([
          "status" => "ok",
          "orderitem"  => $orderitem->toArray()
          ]); */
    }

    /**
     * Armazena os valores totais do pedido no banco de dados.
     * Retorna o identificados do novo pedido ou retorna false
     * @return true ou false
     */
    static function ordemtotal($new_order_id, $value) {
        $response = true;
        $totalcolluns = array(
            'title' => array(
                'Sub-total',
                'Frete',
                'Desconto a vista',
                'Desconto do cupom',
                'Acréscimos',
                'Total Geral'
            ),
            'text' => array(
                'Valor dos produtos nos carriho',
                'Valor do frete',
                'Desconto concedido para pagamento a vista',
                'Desconto concedido pelo cupom de desconto',
                'Acréscimos',
                'Total Geral'
            ),
            'value' => $value
        );

        foreach ($totalcolluns['title'] as $key => $collun) {
            $ordertotais = new OrderTotal();
            //foreach ($collun as $k=>$value){
            $ordertotais->orders_id = $new_order_id;
            $ordertotais->title = $totalcolluns['title'][$key];
            $ordertotais->text = $totalcolluns['text'][$key];
            $ordertotais->value = $totalcolluns['value'][$key];
            //if (!$ordertotais->save()) {
            //$response = false;
            //}
            //}
        }
        return $response;
    }

}
