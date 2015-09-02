<?php

namespace Ecograph\Libs;

use Ecograph\Libs\Payments;
use Ecograph\Gateway;
use Ecograph\Customer;
use Ecograph\AddressBook;
use Ecograph\Order;
use Ecograph\OrderIten;
use Ecograph\OrderTotal;
use Ecograph\Product;
use Ecograph\Ordersituacao;
use Auth;
use Cart;


Class Checkout {


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {

    }
    /**
     * Armazena o pedido no banco de dados.
     * Retorna o identificados do novo pedido ou retorna false
     * @return order_id ou false
     */
    static function order($payment_method, $pgmt,$customers, $orders, $ordersituacao, $addressBook) {
        //dd(Cart::content());
        $customer = $customers->find(Auth::user()->id);
        $default_address = $addressBook->find($customer->customers_default_address_id);
        if(empty($default_address->entry_state_code)){
            $cep = str_replace('-','',str_replace('.','',$default_address->entry_postcode));
            $state =  Fretes::UF($cep);
            $default_address->entry_state_code = utf8_decode($state[0]);
            $default_address->entry_state = utf8_decode($state[0]);
        }
        //$cliente_ip = $HTTP_SERVER['HTTP_CLIENT_IP'];
        $cliente_ip = '127.0.0.1';
        //$request = \Request::instance();
        //$cliente_ip = $request->setTrustedProxies(array($ip)); // only trust proxy headers coming from the IP addresses on the array (change this to suit your needs)
        //$ip = $cliente_ip()->getClientIp();
        //dd($cliente_ip);
        $array_customer = [
            'customer_id' => Auth::user()->id,
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
            'customers_ip_address' => $cliente_ip
        ];

        $array_delivery = [
            'delivery_name' => $customer->customers_firstname . ' ' . $customer->customers_lastname,
            'delivery_nr_rua' => $default_address->entry_nr_rua,
            'delivery_street_address' => $default_address->entry_street_address,
            'delivery_comp_ref' => $default_address->entry_comp_ref,
            'delivery_suburb' => $default_address->entry_suburb,
            'delivery_city' => $default_address->entry_city,
            'delivery_postcode' => $default_address->entry_postcode,
            'delivery_state' => $default_address->entry_state,
            'delivery_state_code' => $default_address->entry_state_code,
            'delivery_country' => 'Brasil'
        ];

        $array_billing = [
            'billing_name' => $customer->customers_firstname . ' ' . $customer->customers_lastname,
            'billing_nr_rua' => $default_address->entry_nr_rua,
            'billing_street_address' => $default_address->entry_street_address,
            'billing_comp_ref' => $default_address->entry_comp_ref,
            'billing_suburb' => $default_address->entry_suburb,
            'billing_city' => $default_address->entry_city,
            'billing_postcode' => $default_address->entry_postcode,
            'billing_state' => $default_address->entry_state,
            'billing_state_code' => $default_address->entry_state_code,
            'billing_country' => 'Brasil',
            'payment_method' => $pgmt,
            'currency' => 'BRL'
            //'currency_value' => '1.0000'
        ];

        //controla clientes pessoas jurídicas
        if ($customer->customers_pf_pj == 'j') {
            $array_customer['customers_company'] = $default_address->entry_company;
            $array_delivery['delivery_company'] = $default_address->entry_company;
            $array_billing['billing_company'] = $default_address->entry_company;
        }

        $orders_status = $ordersituacao->status($pgmt)->get();
        $status_id = '';
        foreach ($orders_status as $status) {
            $status_id = $status['id'];
        }

        $array_order_status = [
            'payment_method' => $payment_method,
            'orders_status' => $status_id
        ];
        //dd([$array_customer, $array_delivery, $array_billing, $array_order_status]);
        $array_order = array_merge($array_customer, $array_delivery, $array_billing, $array_order_status);
        $order = null;
        $order = $orders->Create($array_order);
        if (is_object($order)) {
            return $order->id;
        } else {
            return false;
        }
    }
    /**
     * Armazena os valores totais do pedido no banco de dados.
     * Retorna o identificados do novo pedido ou retorna false
     * @return true ou false
     */
    static function OrderTotal($new_order_id, $value, $orderTotal) {
        $order_totais = null;
        $colluns = array(
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
        //dd($colluns);

        foreach ($colluns['title'] as $key => $collun) {
            $array_ordertotais = [
                'order_id' => $new_order_id,
                'title' => $colluns['title'][$key],
                'text' => $colluns['text'][$key],
                'value' => $colluns['value'][$key]
            ];
            $order_totais = $orderTotal->firstOrCreate($array_ordertotais);
        }
        if (is_object($order_totais)) {
            return true;
        } else {
            return false;
        }
    }
    /**
     * Armazena os tens do pedido no banco de dados.
     * Retorna o identificados do novo pedido ou retorna false
     * @return true ou false
     */
    static function item($new_order_id, $product, $orderIten) {
        $order_item = Null;
        foreach (Cart::content() as $itens) {
            //dd($itens);
            //controla o estoque
            $stock = $product->find($itens->id);
            $stock_quantity = $stock->products_quantity - $itens->quantity;
            $stock->update(['products_quantity'=> $stock_quantity]);
            $array_order = [
                'order_id' => $new_order_id,
                'product_id' => $itens->id,
                'quantity' => $itens->qty,
                'product_name' => $itens->name,
                'price' => $itens->price,
                'final_price' => $itens->price*$itens->quantity,
                'tax' => '0.00'
            ];
            $order_item = $orderIten->firstOrCreate($array_order);
        }
        if (is_object($order_item)) {
            return true;
        } else {
            return false;
        }
    }


}
