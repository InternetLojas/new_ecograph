<?php

namespace Ecograph\Libs;

use Ecograph\Libs\Payments;
use Ecograph\Gateway;
use Ecograph\Customer;
use Ecograph\Addressbook;
use Auth;
use Cart;

Class Bcash extends Payments {

    public function __construct() {
        parent::__construct();
    }

    static function start() {
        $gateway = Gateway::id('Bcash')->whereStatus('1')->get();
        $confgateways = Gateway::find($gateway->first()->id)->confgateway;

        foreach ($confgateways as $conf) {
            $credentials[$conf['gateway_key']] = $conf['gateway_value'];
        }

        return $credentials;
    }

    static function before($configuracao, $frete, $vl_frete) {
        foreach ($configuracao as $key => $valor) {
            switch ($key) {
                case 'venc_boleto':
                    $dados["vencimento"] = $valor;
                    break;
                case 'url_retorno':
                    $dados["url_retorno"] = $valor;
                    break;
                case 'email':
                    $dados["email_loja"] = $valor;
                    break;
                case 'tipo_integracao':
                    $dados["tipo_integracao"] = $valor;
                    break;
            }
        }

        $dados["frete"] = $vl_frete;
        $dados["tipo_frete"] = $frete;
        $i = 0;
//dd(Cart::content()->toarray());
        foreach (Cart::content()->toarray() as $rows => $itens) {
            //dd($itens);
            $preco = $itens['price'] * $itens['qty'];
            $dados["produto_codigo_" . ($i + 1)] = $itens['name'];
            $dados["produto_descricao_" . ($i + 1)] = $itens['options']['categoria'] . '<br>' .
                    $itens['options']['formato'] . '<br>' .
                    $itens['options']['papel'] . '<br>' .
                    $itens['options']['acabamento'] . '<br>' .
                    $itens['options']['perfil'] . '<br>' .
                    $itens['options']['unidade'];
            $dados["produto_qtde_" . ($i + 1)] = $itens['qty'];
            $dados["produto_valor_" . ($i + 1)] = $preco;
            $i++;
        }

        $customer = Customer::find(Auth::user()->id);
        $default_address = Addressbook::find($customer->customers_default_address_id);

        $dados["email"] = $customer->email;
        $dados["nome"] = $customer->customers_firstname . " " . $customer->customers_lastname;
        $dados["telefone"] = $customer->customers_ddd . $customer->customers_telephone;
        $dados["endereco"] = $default_address->entry_street_address;
        $dados["bairro"] = $default_address->entry_suburb;
        $dados["cidade"] = $default_address->entry_city;
        $dados["estado"] = $default_address->entry_state;
        $dados["cep"] = $default_address->entry_postcode;
        // print_r($dados);exit;
        return $dados;
    }

//prepara o pacote de dados a ser enviado ao gateway de pagamento específico
    static function Pacote($dados, $order_id) {

        $dados["id_pedido"] = $order_id;
        if ($dados['hash'] == 'Sim') {
            ksort($dados);
            $parametros = http_build_query($dados) . $chaveAcesso;
            $md5valid = md5($parametros);
            $hash = "<input type='hidden' name='hash' value='" . $md5valid . "'>";
            $postBcash = $postBcash . $hash;
        }
        $dados["redirect"] = "true";
        return $dados;
    }

    static function acessos($configuracao) {
        return false;
    }

    static function process($configuracao, $dados, $order_id, $url = '') {
        Session::put('messages', '');
        return false;
    }

    static function after($configuracao, $response) {
        return '';
    }

    static function Html($dados) {
        $inputs = null;

        foreach ($dados as $key => $value) {
            if ($key != 'hash' && $key != 'key' && $key != 'light_box') {
                $inputs[$key] = $value;
            }
        }
        return $inputs;
    }

    static function redireciona($url_envio = '', $dados, $html) {
        $atualizacarrinho = Basket::where('customer_id', '=', Auth::user()->id)->delete();

        Session::forget('carrinho');
        Cart::destroy();

        return View::make('loja.index')
                        ->with('title', STORE_NAME . ' Ckeckout Bcash')
                        ->with('page', 'caixa')
                        ->with('ativo', 'checkout')
                        ->with('dados', $dados)
                        ->with('gateway', 'Bcash')
                        ->with('html', $html)
                        ->with('url_envio', '')
                        ->with('rota', 'loja/index')
                        ->with('message', Session::get('messages'))
                        ->with('class', LAYOUT);
        ;
    }

}
