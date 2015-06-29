<?php

namespace Ecograph\Libs;

Class Fretes {

    public static function envelopar($peso, $ceporigem, $cepdestino, $srv, $nVlValorDeclarado = '') {
        $nVlPeso = $peso; // Peso em kg
        $nCdFormato = '1'; // Formato, 1-Caixa/pacote, 2-Rolo/prisma, 3-Envelope  
        $nVlComprimento = '20'; // Comprimento em cm
        $nVlAltura = '10'; // Altura em cm
        $nVlLargura = '15'; // Larg ura em cm
        $nVlDiametro = '60'; // Diametro em cm
        $sCdMaoPropria = 'N'; // Servico m?o própria
        /* if (empty($nVlValorDeclarado)) {
          if (Cart::total() * 100 >= 10000) {
          $nVlValorDeclarado = 1000;
          } else {
          $nVlValorDeclarado = Cart::total(); // Declarar valor - 0 - desabilitado
          }
          } */
        $nVlValorDeclarado = 1000;
        $sCdAvisoRecebimento = 'N'; // Aviso de recebimento
        // O xml a ser enviado - S?o os parametros que os Correios precisam para processar a solicitaç?o
        // Este modelo xml de requisiç?o tem no endereço do webserivce
        $envelope = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:tem="http://tempuri.org/">
                       <soapenv:Header/>
                       <soapenv:Body>
                            <tem:CalcPrecoPrazo>
                                  <tem:nCdEmpresa></tem:nCdEmpresa>
                                  <tem:sDsSenha></tem:sDsSenha>
                                  <tem:nCdServico>' . $srv . '</tem:nCdServico>
                                  <tem:sCepOrigem>' . $ceporigem . '</tem:sCepOrigem>
                                  <tem:sCepDestino>' . $cepdestino . '</tem:sCepDestino>
                                  <tem:nVlPeso>' . $nVlPeso . '</tem:nVlPeso>
                                  <tem:nCdFormato>' . $nCdFormato . '</tem:nCdFormato>
                                  <tem:nVlComprimento>' . $nVlComprimento . '</tem:nVlComprimento>
                                  <tem:nVlAltura>' . $nVlAltura . '</tem:nVlAltura>
                                  <tem:nVlLargura>' . $nVlLargura . '</tem:nVlLargura>
                                  <tem:nVlDiametro>' . $nVlDiametro . '</tem:nVlDiametro>
                                  <tem:sCdMaoPropria>' . $sCdMaoPropria . '</tem:sCdMaoPropria>
                                  <tem:nVlValorDeclarado>' . $nVlValorDeclarado . '</tem:nVlValorDeclarado>
                                  <tem:sCdAvisoRecebimento>' . $sCdAvisoRecebimento . '</tem:sCdAvisoRecebimento>
                            </tem:CalcPrecoPrazo>
                       </soapenv:Body>
                    </soapenv:Envelope>';
        return $envelope;
    }

    public static function makeURL($peso, $cepdestino, $srv, $nVlValorDeclarado = '') {
        $nVlValorDeclarado = 1000;
        return '?nCdEmpresa=&sDsSenha=&sCepOrigem=' . STORE_CEP . '&sCepDestino=' . $cepdestino . '&nVlPeso=' . $peso . '&nCdFormato=1&nVlComprimento=20&nVlAltura=10&nVlLargura=15&sCdMaoPropria=n&nVlValorDeclarado=' . $nVlValorDeclarado . '&sCdAvisoRecebimento=n&nCdServico=' . $srv . '&nVlDiametro=60&StrRetorno=xml';
    }

    public static function GetRequestCorreio($URL) {
        $endereco_wsdl = 'http://ws.correios.com.br/calculador/CalcPrecoPrazo.asmx/CalcPreco';
        $xml = simplexml_load_file($endereco_wsdl . $URL);
        $response = array();
        foreach ($xml->Servicos->cServico as $value) {
            if ($value->Valor != '0,00') {
                $response = array('erro' => false,'valor'=> $value->Valor);
                //$valor = $value->Valor;
                break;
            } else {
                $response = array('erro' => true,'erro'=>$value->MsgErro );
                //$valor['Erro'] = $value->MsgErro;
                break;
            }
        }

        return $response;
    }

    public static function CurlRequestCorreio($dados) {
        $endereco_wsdl = 'http://ws.correios.com.br/calculador/CalcPrecoPrazo.asmx';
        $cabecalho = array(
            'POST /calculador/CalcPrecoPrazo.asmx HTTP/1.1',
            'Host: ws.correios.com.br',
            'User-Agent: Curl-PHP/',
            'Content-Type: text/xml; charset=utf-8',
            'Content-Length: ' . strlen($dados),
            'Accept-Encoding: GZIP',
            'SOAPAction: "http://tempuri.org/CalcPrecoPrazo"');

        $ch = curl_init(); // Iniciar o Curl
        curl_setopt($ch, CURLOPT_URL, $endereco_wsdl); // O Endereço que irá acessar
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Para Retornar o resultado
        curl_setopt($ch, CURLOPT_VERBOSE, false); // Modo Verbose, para exibir o processo na tela
        curl_setopt($ch, CURLOPT_HEADER, false); // Se precisar de retorno dos cabeçalhos
        curl_setopt($ch, CURLOPT_TIMEOUT, 30); // Tempo máximo em segundos que deve esperar responder
        curl_setopt($ch, CURLOPT_HTTPHEADER, $cabecalho); // Cabecalho para ser enviado
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false); // Seguir redirecionamentos
        curl_setopt($ch, CURLOPT_POST, true); // Usará metodo post
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dados); // Dados para serem processados
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Caso precise verificar certificado
        curl_setopt($ch, CURLOPT_ENCODING, 'GZIP'); // Usar compressao
        // Executa a requisiç?o
        $resposta = curl_exec($ch);

        // Se der erro, mostra na tela e encerra
        if (curl_errno($ch)) {
            echo "Error: ", curl_error($ch);
            exit();
        }
        //http://www.toolsweb.com.br/webservice/clienteWeb
        //print_r($resposta);exit;
        return $resposta;
    }

    public static function UF($cepdestino) {
        $url = "http://www.toolsweb.com.br/webservice/clienteWebService.php?cep=" . $cepdestino . "&amp;formato=xml";

        $xml = simplexml_load_file($url);
        return $xml->dados->estado;
    }

    public static function TipodeFrete($product_id = '') {
        $Fretes = array();
        //echo $product_id;
        if ($product_id == '') {
            //percorre a lista com os itens do carrinho;
            $carrinho = Cart::contents();
            foreach ($carrinho as $item) {
                $peso = $item->quantity * $item->peso;
                if ($peso > 30) {
                    $Fretes[$item->id] = array('FG' => 'N', 'FT' => 'S', 'FC' => 'N', 'Peso' => $peso);
                } else {
                    $Fretes[$item->id] = array('FG' => 'N', 'FT' => 'N', 'FC' => 'S', 'Peso' => $peso);
                }
                //print_r($Fretes);exit; 
            }
        } else {
            $id = $product_id;
            $peso = Product::find($id)->products_weight;
            if ($peso > 30) {
                $Fretes[$id] = array('FG' => 'N', 'FT' => 'S', 'FC' => 'N', 'Peso' => $peso);
            } else {
                $Fretes[$id] = array('FG' => 'N', 'FT' => 'N', 'FC' => 'S', 'Peso' => $peso);
            }
            //print_r($Fretes);exit;          
        }
        return $Fretes;
    }

    public static function FreteGratis($id, $peso) {
        //verifica a situação do produto quanto a ser frete grátis ou não;
        $sem_frete = ProductSemFrete::Ativos($id)->get();
        $frete = $sem_frete->toarray();
        if (count($frete) > 0) {
            if ($peso <= PESO_LIMITE_TRANSPORTE_GRATIS) {
                return $frete[0]['regiao'];
            }
        }
        return false;
    }

    public static function VerificaEstado($frete_reg, $UF) {
        //verifica o estado a ser enviado permite frete grátis ou não;
        $regioes = explode(',', $frete_reg);
        $regioesfrete = Utilidades::RegioesFrete();
        foreach ($regioes as $regiao) {
            if ($regiao != '' && in_array($UF, $regioesfrete[$regiao])) {
                return true;
            }
        }
        return false;
    }

    public static function servicos() {
        //verifica quais são meios de transporte que estão disponíveis
        $shipping = Shipping::ativos('1')->get();
        $confshipping = Shipping::find($shipping->first()->id)->confshipping;
        foreach ($confshipping as $conf) {
            $srv[$conf['shipping_value']] = $conf['shipping_title'];
            $servicos = $srv;
        }
        if (is_array($servicos)) {
            return $servicos;
        }
        return false;
        /*
          Array
          (
          [41106] => PAC
          [40010] => SEDEX
          [40045] => SEDEX a Cobrar
          [40215] => SEDEX 10
          [GrÃ¡tis] => Envio GrÃ¡tis
          )
         */
    }

    public static function Transportadora($peso, $uf) {
        switch ($peso) {
            case ($peso <= 10) : $valor = 'valor1';
                $tarifa = Transportadora::where('UF', '=', $uf)->get();
                break;
            case ($peso > 10 and $peso <= 20) : $valor = 'valor2';
                $tarifa = Transportadora::where('UF', '=', $uf)->get();
                break;
            case ($peso > 20 and $peso <= 30) : $valor = 'valor3';
                $tarifa = Transportadora::where('UF', '=', $uf)->get();
                break;
            case ($peso > 30 and $peso <= 250) : $valor = 'valor4';
                $tarifa = Transportadora::where('UF', '=', $uf)->get();
                break;
            case ($peso > 250) : $valor = 'valor5';
                $tarifa = Transportadora::where('UF', '=', $uf)->get();
                break;
        }
        $param = $tarifa->toarray();
        //print_r($param);exit;
        if ($valor == 'valor1' || $valor == 'valor2' || $valor == 'valor3') {
            $tarifa = $param[0][$valor];
        } else {
            $tarifa = $peso * $param[0][$valor];
        }
        return $tarifa;
    }

}
