<?php

Class Gerencianet extends \Payments {

    public function __construct() {
        parent::__construct();
        $this->beforeFilter('csrf', array('on' => 'post'));
        Config::get('extras');
    }

    static function start() {
        $gateway = Gateway::id('Gerencianet')->whereStatus('1')->get();
        $confgateways = Gateway::find($gateway->first()->id)->confgateway;

        foreach ($confgateways as $conf) {
            $credentials[$conf['gateway_key']] = $conf['gateway_value'];
        }
        return $credentials;
    }

    static function before($configuracao, $frete, $vl_frete) {

        foreach ($configuracao as $key => $valor) {
            switch ($key) {
                case 'token':
                    $dados["token"] = $valor;
                    break;
                case 'url_api':
                    $dados["url_api"] = $valor;
                    break;
                case 'formato':
                    $dados["formato"] = $valor;
                    break;
                case 'url_api_teste':
                    $dados["url_api_teste"] = $valor;
                    break;
                case 'ambiente':
                    $dados["ambiente"] = $valor;
                    break;
            }
        }

        $dados["frete"] = $vl_frete;
        $dados["tipo_frete"] = $frete;

        $customer = Customer::find(Auth::user()->id);
        $default_address = Addressbook::find($customer->customers_default_address_id);

        $dados["nome"] = $customer->customers_firstname . " " . $customer->customers_lastname;
        $dados["dob"] = $customer->customers_dob;
        $dados["email"] = $customer->email;
        $dados["telefone"] = $customer->customers_ddd . $customer->customers_telephone;
        $dados["celular"] = $customer->customers_ddd2 . $customer->customers_telephone2;
        $dados["cpf_cnpj"] = $customer->customers_cpf_cnpj;
        $dados["pf_pj"] = $customer->customers_pf_pj;
        $dados["rg_ie"] = $customer->customers_rg_ie;
        $dados["endereco"] = $default_address->entry_street_address;
        $dados["bairro"] = $default_address->entry_suburb;
        $dados["complemento"] = $default_address->entry_comp_ref;
        $dados["estado"] = $default_address->entry_state_code;
        $dados["cidade"] = $default_address->entry_city;
        $dados["cep"] = $default_address->entry_postcode;
        $dados["nr"] = $default_address->entry_nr_rua;

        // print_r($dados);exit;
        return $dados;
    }

    static function acessos($configuracao) {
        if ($configuracao['ambiente'] != 'Teste') {
            $endpoint = $configuracao['url_api'];
        } else {
            $endpoint = $configuracao['url_api_teste'];
        }
        if ($configuracao['formato'] == 'xml') {
            $endpoint .= 'xml';
        } else {
            $endpoint .= 'json';
        }
        return $endpoint;
    }

    static function process($configuracao, $dados, $order_id, $url = '') {
        $itens = '';
        if (count(Cart::totalItems()) > 0) {
            if (count(Cart::totalItems()) > 1) {
                foreach (Cart::contents() as $item) {
                    $preco = $item->price * $item->quantity;
                    $preco = number_format($preco, 2, '.', '');
                    $itens .= "<item>";
                    $itens .= "<itemValor>" . str_replace(".", "", $preco) . "</itemValor>";
                    $itens .= "<itemDescricao>" . $item->name . "</itemDescricao>";
                    $itens .= "<itemQuantidade>" . $item->quantity . "</itemQuantidade>";
                    $itens .= "</item>";
                }
            } else if (count(Cart::totalItems()) == 1)
                ; {
                foreach (Cart::contents() as $item) {
                    $preco = $item->price * $item->quantity;
                    $preco = number_format($preco, 2, '.', '');
                    $itens .= "<item>";
                    $itens .= "<itemValor>" . str_replace(".", "", $preco) . "</itemValor>";
                    $itens .= "<itemDescricao>" . $item->name . "</itemDescricao>";
                    $itens .= "<itemQuantidade>" . $item->quantity . "</itemQuantidade>";
                    $itens .= "</item>";
                }
            }
        }

        $formato = "";
        if ($configuracao['formato'] == 'xml') {
            $formato = "<?xml version=\"1.0\" encoding=\"utf-8\"?>
            <integracao>
            <itens>"
                    . $itens .
                    "</itens>
            <frete>" . str_replace(".", "", $dados["frete"]) . "</frete>
            <desconto>0</desconto>
            <tipo>produto</tipo>
            <descricao>Obrigado por comprar na nossa loja.</descricao>
            <solicitarEndereco>s</solicitarEndereco>
            <retorno>
            <identificador>" . $order_id . "</identificador>
            <url>http://minhaloja.com.br/finalizado</url>
            </retorno>
            <cliente>
            <nome>" . $dados["nome"] . "</nome>";

            if ($dados["pf_pj"] = 'f') {
                $formato .= "<cpf>" . $dados["cpf_cnpj"] . "</cpf>";
            }

            $formato .= "<email>" . $dados["email"] . "</email>
            <nascimento>" . $dados["dob"] . "</nascimento>
            <celular>" . $dados["celular"] . "</celular>
            <logradouro>" . $dados["endereco"] . "</logradouro>
            <numero>" . $dados["nr"] . "</numero>
            <complemento>" . $dados["complemento"] . "</complemento>
            <bairro>" . $dados["bairro"] . "</bairro>
            <cidade>" . $dados["cidade"] . "</cidade>
            <cep>" . $dados["cep"] . "</cep>
            <estado>" . $dados["estado"] . "</estado>
            </cliente>
            </integracao>";

            $formato = str_replace(array("\n", "\r", "\t"), '', $formato);
        } else {
            $formato = json_encode($dados);
        }
        //Executando a operação

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);

        $data = array("token" => $configuracao['token'], "dados" => $formato);

        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 30);

        $response = curl_exec($curl);

        curl_close($curl);

        if ($response) {
            Session::put('messages', '');
            return $response;
        }
        Session::put('messages', 'Erro ao tentar conexão com o servidor. Por favor tente mais tarde.');
        return false;
    }

    static function after($configuracao, $response) {
        if ($response) {
            $xml = simplexml_load_string($response);

            if ($xml->status == '2') {
                return $xml->resposta->link;
            }
        }

        Session::put('messages', $xml->resposta->erro);
        return false;
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
        $atualizacarrinho = Basket::where('customer_id', '=', Auth::user()->id)->delete();

        Session::forget('carrinho');
        Cart::destroy();
        $layout = Layout::classes('6');
        return View::make('loja.index')
                        ->with('title', STORE_NAME . ' Ckeckout Gerencianet')
                        ->with('page', 'caixa')
                        ->with('ativo', 'Gerencianet')
                        ->with('dados', $dados)
                        ->with('gateway', 'Gerencianet')
                        ->with('html', $html)
                        ->with('url_envio', $url_envio)
                        ->with('rota', 'loja/index')
                        ->with('layout', $layout)
                        ->with('message', Session::get('messages'))
                        ->with('class', '');
    }

}
