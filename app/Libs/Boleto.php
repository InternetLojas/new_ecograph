<?php

Class Boleto extends \Payments {

    public function __construct() {
        parent::__construct();
        $this->beforeFilter('csrf', array('on' => 'post'));
        Config::get('extras');
    }

    static function start() {
        $gateway = Gateway::id('Boleto')->whereStatus('1')->get();
        $confgateways = Gateway::find($gateway->first()->id)->confgateway;

        foreach ($confgateways as $conf) {
            $credentials[$conf['gateway_key']] = $conf['gateway_value'];
        }
        return $credentials;
    }

    static function before($configuracao, $frete, $vl_frete) {
        $boleto = array();
        foreach ($configuracao as $key => $valor) {
            $dados[$key] = $valor;
        }

        $dados['dataVencimento'] = date("d-m-Y", strtotime("+{$dados['prazoPagamento']} days", strtotime(date('d-m-Y'))));

        $customer = Customer::find(Auth::user()->id);
        $default_address = Addressbook::find($customer->customers_default_address_id);

        $sacado['sacado'] = $customer->customers_firstname . " " . $customer->customers_lastname;
        $sacado['sacado_documento'] = $customer->customers_cpf_cnpj;
        $sacado['sacado_endereco'] = $default_address->entry_street_address . ' ' . $default_address->entry_nr_rua . ' ' . $default_address->entry_suburb;
        $sacado['sacado_cep'] = $default_address->entry_postcode;
        $sacado['sacado_cidade'] = $default_address->entry_city;
        $sacado['sacado_uf'] = $default_address->entry_state_code;

        $cedente['cedente'] = STORE_NAME;
        $cedente['cedente_documento'] = STORE_CNPJ;
        $cedente['cedente_endereco'][] = STORE_ADDRESS . ' - ' . STORE_BAIRRO . ', ' . STORE_CIDADE . '/' . STORE_ESTADO;
        $cedente['cedente_endereco'][] = STORE_CEP;
        $cedente['cedente_endereco'][] = STORE_FONE;
        $cedente['cedente_endereco'][] = STORE_OWNER_EMAIL_ADDRESS;
        $cedente['cedente_endereco'][] = STORE_SITE;
        $cedente['cedente_cep'] = STORE_CEP;
        $cedente['cedente_cidade'] = STORE_CIDADE;
        $cedente['cedente_uf'] = STORE_ESTADO;

        $envio["frete"] = $vl_frete;
        $envio["tipo_frete"] = $frete;
        $dados['logotipo'] = LOGOTIPO;
        $dados['valor'] = Cart::total() + $vl_frete;

        $desconto = strpos($dados['descontosAbatimentos'], '%') === false ? $dados['valor'] * $dados['descontosAbatimentos'] : ($dados['valor'] * str_replace('%', '', $dados['descontosAbatimentos']) / 100);
        $dados['descontosAbatimentos'] = $desconto;
        $dados['valor_cobrado'] = $dados['valor'] - $dados['descontosAbatimentos'] - $dados['outrasDeducoes'] + $dados['moraMulta'] + $dados['outrosAcrescimos'];

        $boleto = array_merge($dados, $sacado, $cedente, $envio);
//echo "<pre>";print_r($boleto);exit;
        return $boleto;
    }

    static function acessos($configuracao) {
        return true;
    }

    static function process($configuracao, $dados, $order_id, $url = '', $limite = 5) {

        //monta o array com o nome dos produtos com um limite definido de itens
        $max = 1;
        foreach (Cart::contents() as $item) {
            $dados['descricaoDemonstrativo'][] = $item->name;
            $max++;
            if ($max == $limite) {
                break;
            }
        }

        if ($dados['contraApresentacao']) {
            $data = $dados['dataVencimento'];
        } else {
            $data = '0000';
        }

        $gateway = Gateway::id('Boleto')->whereStatus('1')->get();
        $logo_banco = $gateway->first()->image;

        //array com as informações a serem usadas para o layout do boleto
        $boleto = array('cedente' => $dados['cedente'],
            'cedente_cpf_cnpj' => $dados['cedente_documento'],
            'cedente_endereco' => $dados['cedente_endereco'],
            'cedente_endereco2' => $dados['cedente_uf'],
            'cedente_conta' => $dados['conta'],
            'cedente_contadv' => $dados['contaDv'],
            'logo_banco' => $logo_banco,
            'logotipo' => $dados['logotipo'],
            'codigo_banco_com_dv' => $dados['codigoBanco'],
            'especie' => 'Real', //valor
            'quantidade' => '1',
            'data_vencimento' => $data,
            'data_processamento' => date('d-m-Y'),
            'data_documento' => date('d-m-Y'),
            'pagamento_minimo' => $dados['pagamentoMinimo'],
            'valor_documento' => $dados['valor'],
            'desconto_abatimento' => $dados['descontosAbatimentos'],
            'outras_deducoes' => $dados['outrasDeducoes'],
            'mora_multa' => $dados['moraMulta'],
            'outros_acrescimos' => $dados['outrosAcrescimos'],
            'valor_cobrado' => $dados['valor_cobrado'],
            'valor_unitario' => $dados['valor'],
            'sacador_avalista' => '',
            'sacado' => $dados['sacado'],
            'sacado_documento' => $dados['sacado_documento'],
            'sacado_endereco' => $dados['sacado_endereco'],
            'sacado_cidade' => $dados['sacado_cidade'],
            'sacado_cep' => $dados['sacado_cep'],
            'sacado_uf' => $dados['sacado_uf'],
            'demonstrativo' => $dados['descricaoDemonstrativo'], // Max: 5 linhas
            'instrucoes' => $dados['instrucoes'], // Max: 8 linhas
            'local_pagamento' => $dados['localPagamento'],
            'numero_documento' => $order_id,
            'agencia_codigo_cedente' => $dados['agencia'],
            'agencia_codigo_cedenteDv' => $dados['agenciaDv'],
            'cedente_convenio' => $dados['convenio'],
            'nosso_numero' => $order_id,
            'especie_doc' => $dados['especieDoc'],
            'aceite' => $dados['aceite'],
            'carteira' => $dados['carteira'],
            'uso_banco' => ''
        );

        Session::put('boleto', $boleto);
        Session::put('messages', '');
        return URL::to('loja/pagamento/' . $dados['ficha_compensacao']);
    }

    static function after($configuracao, $response) {

        //Session::put('messages', '');
        return $response;
    }

    static function html($dados = array(), $url_envio) {
        //$html = Session::get('boleto');
        $html = "<script>
        function chamar_gateway()
        {
            setTimeout(boleto(), 100*1000);
        }
        function boleto()
        {
            /*location.href = '" . $url_envio . "';*/
            $(\"#div-boleto\").css('display', 'block');
            $(\".acesso\").css('display', 'none');
        }
        </script>";
        return $html;
    }

    static function redireciona($url_envio = '', $boleto, $html) {
        $atualizacarrinho = Basket::where('customer_id', '=', Auth::user()->id)->delete();
        $valor = $boleto['valor_cobrado'] - $boleto['descontosAbatimentos'] - $boleto['outrasDeducoes'] + $boleto['moraMulta'] + $boleto['outrosAcrescimos'];
        Session::forget('carrinho');
        Cart::destroy();

        $documento = (Session::get('boleto'));
        $sequencial = Session::get('boleto')['nosso_numero'];

        $Parametros = array('dataVencimento' => $boleto['dataVencimento'],
            'valor' => $valor,
            'sequencial' => $sequencial, // Para gerar o nosso número
            'sacado' => $boleto['sacado'],
            'cedente' => $boleto['cedente'],
            'agencia' => $boleto['agencia'], // Até 4 dígitos
            'carteira' => $boleto['carteira'],
            'conta' => $boleto['conta'] . $boleto['contaDv'], // Até 8 dígitos
            'convenio' => $boleto['convenio'] // 4, 6 ou 7 dígitos
        );

        $classe = GerarBoleto::Banco($boleto['codigoBanco']);
        $nossonumero = $classe::gerarNossoNumero($Parametros);
        $campolivre = $classe::CampoLivre($Parametros, $nossonumero);
        $dt = Utilidades::FormataData($boleto['dataVencimento']);
        $fatorVencimento = (Utilidades::dateToDays("1997", "10", "07") - Utilidades::dateToDays($dt[0], $dt[1], $dt[2]));
        $valorZerofill = str_pad(number_format($boleto['valor_cobrado'], 2, '', ''), 10, '0', STR_PAD_LEFT);
        $dv_verificador = $classe::DigitoVerificador($boleto['codigoBanco'], strlen($boleto['convenio']), $fatorVencimento, $valorZerofill, $campolivre);
        $blocks = $classe::Blocks($campolivre);
        // Concatenates bankCode + currencyCode + first block of 5 characters and
        // calculates its check digit for part1.
        $check_digit1 = Utilidades::modulo10($boleto['codigoBanco'] . '9' . $blocks['20-24']);

        // Shift in a dot on block 20-24 (5 characters) at its 2nd position.
        $blocks['20-24'] = substr_replace($blocks['20-24'], '.', 1, 0);

        // Concatenates bankCode + currencyCode + first block of 5 characters +
        // checkDigit.
        $part1 = $boleto['codigoBanco'] . '9' . $blocks['20-24'] . $check_digit1;

        // Calculates part2 check digit from 2nd block of 10 characters.
        $check_digit2 = Utilidades::modulo10($blocks['25-34']);

        $part2 = $blocks['25-34'] . $check_digit2;
        // Shift in a dot at its 6th position.
        $part2 = substr_replace($part2, '.', 5, 0);

        // Calculates part3 check digit from 3rd block of 10 characters.
        $check_digit3 = Utilidades::modulo10($blocks['35-44']);

        // As part2, we do the same process again for part3.
        $part3 = $blocks['35-44'] . $check_digit3;
        $part3 = substr_replace($part3, '.', 5, 0);

        $linhadigitavel = $part1 . $part2 . $part3 . $dv_verificador . $fatorVencimento . $valorZerofill;
        Session::put('linhadigitos', $linhadigitavel);
        $banco = $classe::getNomeBanco($boleto['codigoBanco']);
        return View::make('loja.index')
                        ->with('title', STORE_NAME . ' Ckeckout Boleto Bancário')
                        ->with('page', 'caixa')
                        ->with('ativo', 'Boleto')
                        ->with('boleto', $documento)
                        ->with('banco', $banco)
                        ->with('gateway', 'Boleto')
                        ->with('html', $html)
                        ->with('url_envio', $url_envio)
                        ->with('rota', 'loja/index')
                        ->with('message', Session::get('messages'))
                        ->with('class', LAYOUT);
    }

}
