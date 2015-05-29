<?php namespace Ecograph\Libs;
Class Paypal extends \Payments {

    public function __construct() {
        parent::__construct();
        $this->beforeFilter('csrf', array('on' => 'post'));
        Config::get('extras');
    }

    static function start() {
        $gateway = Gateway::id('Paypal')->whereStatus('1')->get();
        $confgateways = Gateway::find($gateway->first()->id)->confgateway;

        foreach ($confgateways as $conf) {
            $credentials[$conf['gateway_key']] = $conf['gateway_value'];
        }
        return $credentials;
    }

    static function before($configuracao, $frete, $vl_frete) {
        $ot_total = Cart::total() + $vl_frete;
        $ot_subtotal = Cart::total();
        $ot_total_max = $ot_total + 100;
        $nvp_credencials = array('USER' => $configuracao['username'],
            'PWD' => $configuracao['password'],
            'SIGNATURE' => $configuracao['signature'],
            'VERSION' => '108.0',
            'METHOD' => 'SetExpressCheckout',
            'PAYMENTREQUEST_0_PAYMENTACTION' => 'SALE',
            'PAYMENTREQUEST_0_CURRENCYCODE' => 'BRL'
        );

        $nvp_product = array('PAYMENTREQUEST_0_AMT' => number_format($ot_total, 2, '.', ''),
            'PAYMENTREQUEST_0_ITEMAMT' => number_format($ot_subtotal, 2, '.', ''),
            'MAXAMT' => number_format($ot_total_max, 2, '.', ''),
        );

        $nvp_url = array('RETURNURL' => $configuracao['url_sucesso'],
            'CANCELURL' => $configuracao['url_cancelamento']);

        $nvp_frete = array('L_SHIPPINGOPTIONNAME0' => utf8_decode(strip_tags($frete)),
            'L_SHIPPINGOPTIONAMOUNT0' => $vl_frete,
            'L_SHIPPINGOPTIONISDEFAULT0' => 'true'
        );
        $i = 0;

        foreach (Cart::contents() as $itens) {
            $preco = $itens->price * $itens->quantity;
            $nvp_preco['L_PAYMENTREQUEST_0_NAME' . $i] = $itens->name;
            $nvp_preco['L_PAYMENTREQUEST_0_NUMBER' . $i] = $i + 1;
            $nvp_preco['L_PAYMENTREQUEST_0_DESC' . $i] = $itens->name;
            $nvp_preco['L_PAYMENTREQUEST_0_AMT' . $i] = number_format($itens->price, 2, '.', '');
            $nvp_preco['L_PAYMENTREQUEST_0_QTY' . $i] = $itens->quantity;
            $i++;
        }

        $nvp_preco['PAYMENTREQUEST_0_SHIPPINGAMT'] = $vl_frete;

        $customer = Customer::find(Auth::user()->id);
        $default_address = Addressbook::find($customer->customers_default_address_id);

        $nvp_order = array('FIRSTNAME' => $customer->customers_firstname,
            'STREET' => $default_address->entry_street_address,
            'CITY' => $default_address->entry_city,
            'STATE' => $default_address->entry_state,
            'COUNTRYCODE' => 'BR',
            'ZIP' => $default_address->entry_postcode,
            'EMAIL' => $customer->email,
            'PHONENUM' => $customer->customers_ddd . $customer->customers_telephone
        );

        $nvp = array_merge($nvp_credencials, $nvp_product, $nvp_url, $nvp_frete, $nvp_preco, $nvp_order);
//print_r($nvp);exit;
        return $nvp;
    }

    static function acessos($configuracao) {

        if ($configuracao['sandbox'] != 'Sandbox') {
            $endpoint = 'https://api-3t.paypal.com/nvp';
        } else {
            $endpoint = 'https://api-3t.sandbox.paypal.com/nvp';
        }

        return $endpoint;
    }

    static function process($configuracao, $nvp, $order_id, $url = '') {
        //informa o identificador do pedido
        $nvp['PAYMENTREQUEST_0_INVNUM'] = $order_id;

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($nvp));

        $response = urldecode(curl_exec($curl));

        curl_close($curl);

        //Tratando a resposta
        $responseNvp = array();

        if (preg_match_all('/(?<name>[^\=]+)\=(?<value>[^&]+)&?/', $response, $matches)) {
            foreach ($matches['name'] as $offset => $name) {
                $responseNvp[$name] = $matches['value'][$offset];
            }
        }

        //Verificando se deu tudo certo e, caso algum erro tenha ocorrido,
        //gravamos um log para depuração.
        if (isset($responseNvp['ACK']) && $responseNvp['ACK'] != 'Success') {
            for ($i = 0; isset($responseNvp['L_ERRORCODE' . $i]); ++$i) {
                $message = sprintf("PayPal NVP %s[%d]: %s\n", $responseNvp['L_SEVERITYCODE' . $i], $responseNvp['L_ERRORCODE' . $i], $responseNvp['L_LONGMESSAGE' . $i]);

                error_log($message);
                Session::put('messages', $message);
                return false;
            }
        } else {
            Session::put('messages', '');
            return $responseNvp;
        }
    }

    static function after($configuracao, $responseNVL) {
        if ($configuracao['sandbox'] != 'Sandbox') {
            $redirect_url = 'https://www.paypal.com/cgi-bin/webscr';
        } else {
            $redirect_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
        }
        if (isset($responseNVL['ACK']) && $responseNVL['ACK'] == 'Success') {
            $query = array(
                'cmd' => '_express-checkout',
                'token' => $responseNVL['TOKEN']
            );

            return sprintf('%s?%s', $redirect_url, http_build_query($query));
        }
    }

    static function html($dados = array(), $url_envio) {
        $html = "<script>
        function chamar_gateway()
        {
            setTimeout(redireciona(), 100*1000);\n
        }
        function redireciona()
        {
            location.href = '" . $url_envio . "';
        }
        </script>";
        return $html;
    }

    static function redireciona($url_envio = '', $dados, $html) {
        if (!empty(Session::get('messages'))) {
            $url_envio = '';
        } else {
            $atualizacarrinho = Basket::where('customer_id', '=', Auth::user()->id)->delete();

            Session::forget('carrinho');
            Cart::destroy();
        }

        return View::make('loja.index')
                        ->with('title', STORE_NAME . ' Ckeckout Paypal')
                        ->with('page', 'caixa')
                        ->with('ativo', 'Paypal')
                        ->with('dados', $dados)
                        ->with('gateway', 'Paypal')
                        ->with('html', $html)
                        ->with('url_envio', $url_envio)
                        ->with('rota', 'loja/index')
                        ->with('message', Session::get('messages'))
                        ->with('class', LAYOUT);
        ;
    }

}
