<?php
namespace Ecograph\Libs;
use Illuminate\Support\Facades\Config;
use Mail;
class EnvioEmail {

    /**
     * Controla o email para lembrar cliente que produto está disponível
     *
     * @return json
     */
    public static function LembrarProduto() {
        $input = Input::all();
        if (Mail::send('emails.lembrar', $input, function($message) {
                    $info = Input::all();
                    $message->from($info['email'], $info['nome']);
                    $message->to(STORE_EMAIL_TESTE, STORE_NAME)->subject('Lembrar de produto!');
                })) {
            $html = array('status' => 'pass',
                'info' => 'Recebemos sua solicitação de lembrança do produto, em breve entraremos em contato informando a disponibilidade do produto.',
                'erro' => '',
                'loadurl' => ''
            );
        } else {
            $erro[] = 'Problemas no envio do email';
            $html = array('status' => 'fail',
                'info' => 'Tivemos dificuldade no envio de seu email. Por favor tente novamente.',
                'erro' => $erro,
                'loadurl' => ''
            );
        }
        return $html;
    }

    /**
     * Controla o email para responder ao cliente sobre produto que tem preço excepcional
     *
     * @return json
     */
    public static function ConsultarProduto() {
        $input = Input::all();
        //$nome = Productdescription::find($input['product_consulte'])->products_name;
        //$input['product'] = $nome;
        if (Mail::send('emails.consultar', $input, function($message) {
                    $info = Input::all();
                    $message->from($info['email'], $info['nome']);
                    $message->to(STORE_EMAIL_TESTE, STORE_NAME)->subject("Informações sobre preço excepcional de produto.");
                })) {
            $html = array('status' => 'pass',
                'info' => 'Recebemos sua solicitação de consulta de preço de produto, em breve entraremos em contato informando o valor.',
                'erro' => '',
                'loadurl' => ''
            );
        } else {
            $erro[] = 'Problemas no envio do email';
            $html = array('status' => 'fail',
                'info' => 'Tivemos dificuldade no envio de seu email. Por favor tente novamente.',
                'erro' => $erro,
                'loadurl' => ''
            );
        }
        return $html;
    }

    /**
     * Controla o email para receber email de cliente que faz contato
     *
     * @return json
     */
    public static function EnviarContato() {
        $input = \Request::all();
        if (Mail::send('emails.contato', $input, function($message) {
                    $info = \Request::all();
                    $message->from($info['email'], $info['nome']);
                    $message->to(STORE_EMAIL_TESTE, STORE_NAME)->subject("Contato de Cliente.");
                    //enviando o feedback para o cliente;
                    //$message->from(STORE_EMAIL_TESTE, STORE_NAME);
                    //$message->to($info['email'], $info['nome'])->subject("Recebemo sua mensagem.");
                })) {
            $html = array('status' => 'pass',
                'info' => 'Caro Sr(a)' . $input['nome'] . '! Recebemos seu contato, em breve entraremos em contato.',
                'erro' => '',
                'loadurl' => ''
            );
        } else {
            $erro[] = 'Problemas no envio do email';
            $html = array('status' => 'fail',
                'info' => 'Caro Sr(a)' . $input['nome'] . '! Tivemos dificuldade no envio de seu email. Por favor tente novamente.',
                'erro' => $erro,
                'loadurl' => ''
            );
        }
        return $html; 
    }

    /**
     * Controla o email para de cliente que assina newsletter
     *
     * @return json
     */
    public static function InscreverNews() {
        $input = Input::all();
        if (Mail::send('emails.news', $input, function($message) {
                    $info = Input::all();
                    //$nome = ProductDescription::find($info['product_consulte'])->products_name; 
                    $message->from(STORE_EMAIL_TESTE, STORE_NAME);
                    $message->to($info['newsEmail'], $info['nomecompleto'])->subject("Inscrição em newsletter.");
                })) {
            $html = array('status' => 'pass',
                'info' => 'Caro Sr(a)' . $input['nomecompleto'] . '! Recebemos sua solicitação para inscrição na nossa newletter. Obrigado pelo interesse.',
                'erro' => '',
                'loadurl' => ''
            );
        } else {
            $erro[] = 'Problemas no envio do email';
            $html = array('status' => 'fail',
                'info' => 'Caro Sr(a)' . $input['nomecompleto'] . '! Tivemos dificuldade no envio de seu email. Por favor tente novamente.',
                'erro' => $erro,
                'loadurl' => ''
            );
        }
        return $html;
    }

    public static function LembrarSenha() {
        $input = Input::all();

        if (Mail::send('emails.novasenha', $input, function($message) {
                    $info = Input::all();
                    $message->from(STORE_EMAIL_TESTE, STORE_NAME);
                    $message->to($info['email_cadastrado'], 'Nova senha')->subject("Solicitação de nova senha.");
                })) {
            $html = array('status' => 'pass',
                'info' => 'Como solicitado segue sua nova senha.',
                'erro' => '',
                'loadurl' => ''
            );
        } else {
            $erro[] = 'Problemas no envio do email';
            $html = array('status' => 'fail',
                'info' => 'Caro Sr(a)' . $input['nomecompleto'] . '! Tivemos dificuldade no envio de seu email. Por favor tente novamente.',
                'erro' => $erro,
                'loadurl' => ''
            );
        }
        return $html;
    }

    public static function ConviteAmigo() {
        $input = Input::all();
        if (Mail::send('emails.convite', $input, function($message) {
                    $info = Input::all();
                    $message->from(STORE_EMAIL_TESTE, $info['nome']);
                    $message->to($info['to_email_address'], $info['to_nome'])
                            ->subject('Conheça esse produto da ! ' . STORE_NAME);
                })) {
            $html = array('status' => 'pass',
                'info' => 'Enviamos uma email para seu amigo.',
                'erro' => '',
                'loadurl' => ''
            );
        } else {
            $erro[] = 'Problemas no envio do email';
            $html = array('status' => 'fail',
                'info' => 'Caro Sr(a)' . $input['nome'] . '! Tivemos dificuldade no envio de seu email. Por favor tente novamente.',
                'erro' => $erro,
                'loadurl' => ''
            );
        }
        return $html;
    }

    public static function MudancaStatus() {
        //print_r($input);exit;
        $input = Input::all();
        if (Mail::send('emails.auth.lembrar', $input, function($message) {
                    $message->from(Input::get('to_email_address'), 'Lembrar produto');
                    $message->to(STORE_EMAIL_TESTE, 'Produto')
                            ->cc('suporte@internetlojas.com')
                            ->subject('Lembrar de produto!');
                })) {
            $html = array('html' => '<div class="successmsg alert"><a class="clostalert"></a>Caro Sr(a)' . Input::get('nome') . '! Recebemos sua mensagem, em breve entraremos em contato.</div>');
        } else {
            $html = array('html' => '<div class="errormsg alert"><a class="clostalert"></a>Caro Sr(a)' . Input::get('nome') . '! Tivemos dificuldade no envio de seu email. Por favor tente novamente.</div>');
        }
        return $html;
    }

    public static function NovoCadastro($customer) {
        $data = $customer->toarray();
        $info = \Request::all();
        if (Mail::send('emails.cadastro', $data, $info, function($message) {
                    //$info = \Request::all();
                    $message->from(STORE_EMAIL_TESTE, STORE_NAME);
                    $message->to($info['email'], $info['customers_firstname'] . ' ' .
                                    $info['customers_lastname'])
                            ->cc('suporte@internetlojas.com')
                            ->subject('Informações da nova conta!');
                })) {
            return true;
        } else {
            return false;
        }
    }

    public static function NovoPedido($order_id) {
        $order = Order::find($order_id);
        $data = $order->toarray();

        if (Mail::send('emails.pedido', $data, function($message) {
                    $info = Order::where('customer_id', Auth::user()->id)
                            ->orderBy('created_at')
                            ->get();

                    $order_id = $info->toarray();
                    foreach ($order_id as $key => $value) {
                        $pedido = $value;
                    }                //echo "<pre>" ;
                    //print_r($pedido);exit;
                    $message->from(STORE_EMAIL_TESTE, STORE_NAME);
                    $message->to($pedido['customers_email_address'], $pedido['customers_name'])
                            ->cc('suporte@internetlojas.com')
                            ->subject('Informações sobre o pedido!');
                })) {
            return true;
        } else {
            return false;
        }
    }

    public static function Comentario() {
        $input = Input::all();
        if (Mail::send('emails.comentario', $input, function($message) {
                    $info = Input::all();
                    $email = Customer::find(Auth::User()->id)->email;
                    $customer = Customer::find(Auth::User()->id)->customers_firstname;
                    $message->from(STORE_EMAIL_TESTE, STORE_NAME);
                    $message->to($email, $customer)->subject("Comentário realizado.");
                })) {
            $html = array('status' => 'pass',
                'info' => 'Recebemos o comentário para o produto. Um email foi enviado como mais detalhes.',
                'erro' => '',
                'loadurl' => ''
            );
        } else {
            $erro[] = 'Problemas no envio do email';
            $html = array('status' => 'fail',
                'info' => 'Tivemos dificuldade no envio de seu email. Por favor tente novamente.',
                'erro' => $erro,
                'loadurl' => ''
            );
        }
        return $html;
    }

}
