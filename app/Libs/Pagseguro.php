<?php

Class Pagseguro extends \Payments {

    public function __construct() {
        parent::__construct();
        $this->beforeFilter('csrf', array('on' => 'post'));
        Config::get('extras');
    }

    static function start() {
        $gateway = Gateway::id('PagSeguro')->whereStatus('1')->get();
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
        $credencials = array('email' => $configuracao['email'],
            'token' => $configuracao['token'],
            'currency' => $configuracao['currency']
        );

        /* $nvp_product = array('PAYMENTREQUEST_0_AMT' => number_format($ot_total,2,'.',''),
          'PAYMENTREQUEST_0_ITEMAMT' => number_format($ot_subtotal,2,'.',''),
          'MAXAMT' => number_format($ot_total_max,2,'.',''),
          );
         */
        $url = array('url_api' => $configuracao['url_api'],
            'charset' => $configuracao['charset'],
            'redirectURL' => $configuracao['redirectURL'],
            'url_pagamento' => $configuracao['url_pagamento']);

        /* $nvp_frete = array('L_SHIPPINGOPTIONNAME0' => utf8_decode(strip_tags($frete)),
          'L_SHIPPINGOPTIONAMOUNT0' => $vl_frete,
          'L_SHIPPINGOPTIONISDEFAULT0' => 'true'
          ); */
        $i = 1;

        foreach (Cart::contents() as $itens) {
            $preco = $itens->price * $itens->quantity;
            $weight = Product::where('id', '=', $itens->id)->first();
            $item_produto['itemId' . $i] = $itens->name;
            $item_produto['itemWeight' . $i] = $weight->products_weight;
            $item_produto['itemDescription' . $i] = $itens->name;
            $item_produto['itemAmount' . $i] = number_format($itens->price, 2, '.', '');
            $item_produto['itemQuantity' . $i] = $itens->quantity;
            $i++;
        }

        //$nvp_preco['PAYMENTREQUEST_0_SHIPPINGAMT'] = $vl_frete;

        $customer = Customer::find(Auth::user()->id);
        $default_address = Addressbook::find($customer->customers_default_address_id);

        $comprador = array('senderName' => $customer->customers_firstname,
            'senderAreaCode' => $customer->customers_ddd,
            'senderPhone' => $customer->customers_telephone,
            'shippingAddressNumber' => $default_address->entry_nr_rua,
            'shippingAddressStreet' => $default_address->entry_street_address,
            'shippingAddressComplement' => $default_address->entry_comp_ref,
            'shippingAddressDistrict' => $default_address->entry_suburb,
            'shippingAddressCity' => $default_address->entry_city,
            'shippingAddressState' => $default_address->entry_state,
            'shippingAddressCountry' => 'BRA',
            'shippingAddressPostalCode' => $default_address->entry_postcode,
            'senderEmail' => $customer->email,
            'shippingType' => '',
        );

        $pagseguro = array_merge($credencials, $item_produto, $comprador);

        return array($pagseguro, $url);
    }

    static function acessos($configuracao, $array = array()) {

        /* print_r($array);exit;
          if($configuracao['sandbox'] != 'Sandbox')
          {
          $endpoint = 'https://api-3t.paypal.com/nvp';
          } else
          {
          $endpoint =  'https://api-3t.sandbox.paypal.com/nvp';
          } */

        return false;
    }

    static function process($configuracao, $data, $order_id, $url = '') {
        $data[0]['reference'] = $order_id;
        // echo "<pre>";print_r($nvp);
        $method = 'POST';
        //informa o identificador do pedido
        //$nvp['PAYMENTREQUEST_0_INVNUM'] = $order_id;
        if (strtoupper($method) === 'POST') {
            $postFields = ($data[0] ? http_build_query($data[0], '', '&') : "");
            $contentLength = "Content-length: " . strlen($postFields);
            $methodOptions = array(
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => $postFields,
            );
        } else {
            $contentLength = null;
            $methodOptions = array(
                CURLOPT_HTTPGET => true
            );
        }


        $options = array(
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/x-www-form-urlencoded; charset=" . $data[1]['charset'],
                $contentLength,
                'lib-description: php:2.2.4',
                'language-engine-description: php:2.2.4'
            ),
            CURLOPT_URL => $configuracao['url_api'],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_CONNECTTIMEOUT => '20',
                //CURLOPT_TIMEOUT => $timeout
        );
        /* $curl = curl_init();

          curl_setopt($curl, CURLOPT_URL, $configuracao['url_api']);
          curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
          curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($curl, CURLOPT_POST, true);
          curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($nvp));

          $response = urldecode(curl_exec($curl));

          curl_close($curl);

          //Tratando a resposta
          $responseNvp = array();

          if (preg_match_all('/(?<name>[^\=]+)\=(?<value>[^&]+)&?/', $response, $matches))
          {
          foreach ($matches['name'] as $offset => $name)
          {
          $responseNvp[$name] = $matches['value'][$offset];
          }
          }

          //Verificando se deu tudo certo e, caso algum erro tenha ocorrido,
          //gravamos um log para depuração.
          if (isset($responseNvp['ACK']) && $responseNvp['ACK'] != 'Success')
          {
          for ($i = 0; isset($responseNvp['L_ERRORCODE' . $i]); ++$i)
          {
          $message = sprintf("PayPal NVP %s[%d]: %s\n", $responseNvp['L_SEVERITYCODE' . $i], $responseNvp['L_ERRORCODE' . $i], $responseNvp['L_LONGMESSAGE' . $i]);

          error_log($message);
          Session::put('messages', $message);
          return false;
          }
          } else
          {
          Session::put('messages', '');
          return $responseNvp;
          } */
        $options = ($options + $methodOptions);

        $curl = curl_init();
        curl_setopt_array($curl, $options);
        $response = urldecode(curl_exec($curl));
        $info = curl_getinfo($curl);
        $error = curl_errno($curl);
        $errorMessage = curl_error($curl);
        echo "<pre>";
        print_r($response);
        curl_close($curl);
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
