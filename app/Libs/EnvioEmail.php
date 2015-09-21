<?php
namespace Ecograph\Libs;
use Ecograph\Customer;
use Ecograph\Orcamento;
use Ecograph\Order;
use Illuminate\Http\Request;
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
     * Controla o email para lembrar cliente que produto está disponível
     *
     * @return json
     */
    public static function EnviarOrcamento($orcamento_id) {
        $customer = Customer::find(\Auth::user()->id);
        $orcamentos = $customer->Orcamento()->find($orcamento_id);
        $orcamentosProdutos = $orcamentos->OrcamentoProduto()->get()->first();
        //encontra o valor do produto
        $vl = str_replace("R$ ","",$orcamentosProdutos->orc_pacote_valor);
        $vl_total = str_replace(',','.',$vl);
        $data = array_merge($orcamentos->toArray(),$orcamentosProdutos->toArray());
        $data['vl_total'] = $vl_total;

        if (Mail::send('emails.orcamento', $data, function ($m) use ($customer) {
            $m->to($customer->email,$customer->customers_firstname.' '.$customer->customers_lastname)
                ->subject('Orçamento Online!')
                ->from('newsite@ecograph.com.br', 'Gráfica Ecograph')
                ->cc('suporte@internetlojas.com');
        })
        ){
            $html = 'pass';
        } else {
            $html = 'fail';
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
        $inputs = \Request::all();
        $data['nome'] = $inputs['nome'];
        $data['email'] = $inputs['email'];
        $data['telefone'] = $inputs['telefone'];
        $data['mensagem'] = $inputs['mensagem'];

        if (Mail::send('emails.contato', $data, function ($m) use ($inputs) {
             $m->to('newsite@ecograph.com.br', 'Gráfica Ecograph')
                ->subject('Contato de Cliente!')
                ->from($inputs['email'], $inputs['nome'])
                ->cc('suporte@internetlojas.com');
        })
        ){
            $erro[] = '';
            $html = array('status' => 'pass',
                'info' => 'Caro Sr(a)' . $inputs['nome'] . '! Recebemos seu contato, em breve entraremos em contato.',
                'erro' => $erro,
                'loadurl' => ''
            );
        } else {
            $erro[] = 'Problemas no envio do email';
            $html = array('status' => 'fail',
                'info' => 'Caro Sr(a)' . $inputs['nome'] . '! Tivemos dificuldade no envio de seu email. Por favor tente novamente.',
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
        if (Mail::send('emails.cadastro', $data, function ($m) use ($info) {
            $m->to($info['email'], $info['customers_firstname'] . ' ' .$info['customers_lastname'])
                ->subject('Informações de sua conta!')
                ->from('ecograph@ecograph.com.br', 'Ecograph')
                ->cc('suporte@internetlojas.com');
        })
        ){
            $erro[] = '';
            $html = array('status' => 'pass',
                'info' => 'Caro Sr(a)' . $info['customers_firstname'] . '! Seu cadastro foi realizado com sucesso.',
                'erro' => $erro,
                'loadurl' => ''
            );
        } else {
            $erro[] = 'Problemas no envio do email';
            $html = array('status' => 'fail',
                'info' => 'Caro Sr(a)' . $info['customers_firstname'] . '! Tivemos dificuldade no envio de seu email. Por favor tente novamente.',
                'erro' => $erro,
                'loadurl' => ''
            );
        }
        return $html;
    }

    public static function NovoPedido($order_id) {
        $customer = Customer::find(\Auth::user()->id);
        $orders = $customer->Order()->findOrFail($order_id);
        $orderItems = $orders->OrderItem()->get();
        $orderTotal = $orders->OrderTotal()->get();
        $data['pedido'] = $orders->toArray();
        $data['items'] = $orderItems->toArray();
        $orderTotais = $orderTotal->toArray();
        foreach ($orderTotais as $id => $orderTotal) {
            $data['totais'][$orderTotal['title']] = $orderTotal['value'];
        }

        //dd($data);
        if (Mail::send('emails.pedido', $data, function ($m) use ($customer) {
            $m->to($customer->email,$customer->customers_firstname.' '.$customer->customers_lastname)
                ->subject('Informações sobre seu pedido!')
                ->from(STORE_EMAIL_TESTE, STORE_NAME)
                ->cc('newsite@ecograph.com');
        })
        ){
            $html = 'pass';
        } else {
            $html = 'fail';
        }
        return $html;
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
