<?php

namespace Ecograph\Http\Controllers;

use Ecograph\Http\Requests;
use Ecograph\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Utilidades;
use Validator;
use EnvioEmail;
class MailController extends Controller {

    //private
    private $request;

    public function __construct(Request $request) {
        $this->request = $request;
    }

    /**
     * Recebe toda solicitação de envio de email
     *
     * @return view
     */
    public function Enviar($tipo) {
        //check if its our form
        if (Session::token() !== Input::get('_token')) {
            $data = array('info' => array(
                    'status' => 'li',
                    'html' => '<ul><li>Erro de sessão!</li></ul>'
                )
            );
            return Response::json($data);
        }
        if ($tipo != 'novasenha') {
            return Redirect::to('email/' . $tipo)->withInput(Input::except('_token'));
        }
        return Redirect::to('email/' . $tipo)->withInput();
    }

    /**
     * Controla o email para lembrar o cliente que um certo produto está novamente em estoque
     *
     * @return json
     */
    public function Lembrar() {
        $erros = array();
        $post_inputs = $this->request->all();
        //check if its our form
        /* if (Session::token() !== $post_inputs['_token']) {
          $erros[] = 'Esse formulário ja havia sido postado.';
          $data = array('status' => 'fail',
          'info' => 'Erro de sessão',
          'erro' => $erros,
          'loadurl' => ''
          );
          return json_encode($data);
          //return Response::json($data);
          } */
        //nome, email, product_id
        //$post_inputs = Input::all(Input::except('_token'));
        //chechar se é um email válido
        if (!Utilidades::validate_email($post_inputs['email'])) {
            $erros[] = 'O seu email parece não estar no formato correto.';
        }
        //$txtRegExp = /^[a-zA-ZéúíóáÉÚÍÓÁèùìòàÈÙÌÒÀõãñÕÃÑêûîôâÊÛÎÔÂëÿüïöäËYÜÏÖÄ\-\'\s]*$/;
        $rules = array(
            'email' => 'required',
            'nome' => 'required|regex:/^[a-zA-ZéúíóáÉÚÍÓÁèùìòàÈÙÌÒÀõãñÕÃÑêûîôâÊÛÎÔÂëÿüïöäËYÜÏÖÄçÇ\-\'\s]*$/|min:3|max:80',
            'product_id' => 'required|numeric'
        );
        $validation = Validator::make($post_inputs, $rules);
        if ($validation->fails()) {
            foreach ($validation->getMessageBag()->toArray() as $atributo => $erro) {
                foreach ($erro as $key => $value) {
                    $erros[] = $value;
                }
            }
        }
        if (count($erros) > 0) {
            $data = array('status' => 'fail',
                'info' => 'Erro de dados',
                'erro' => $erros,
                'loadurl' => ''
            );

            return json_encode($data);
        } else {
            //$post_inputs['subject'] = ;

            $data = EnvioEmail::LembrarProduto();
            return json_encode($data);
        }
    }

    /**
     * Controla o email para responder ao cliente sobre produto que tem preço excepcional
     *
     * @return json
     */
    public function Consultar() {
        $erros = array();
        //check if its our form
        if (Session::token() !== Input::get('_token')) {
            $erros[] = 'Esse formulário ja havia sido postado.';
            $data = array('status' => 'fail',
                'info' => 'Erro de sessão',
                'erro' => $erros,
                'loadurl' => ''
            );
            return json_encode($data);
            //return Response::json($data);           
        }
        //nome, email, product_consulte
        $post_inputs = Input::all(Input::except('_token'));

        //chechar se é um email válido
        if (!Utilidades::validate_email($post_inputs['email'])) {
            $erros[] = 'O seu email parece não estar no formato correto.';
        }
        $rules = array(
            'email' => 'required',
            'nome' => 'required|regex:/^[a-zA-Z\s]*$/|min:3|max:80',
            'product_consulte' => 'required|numeric'
        );

        $validation = Validator::make($post_inputs, $rules);
        if ($validation->fails()) {
            foreach ($validation->getMessageBag()->toArray() as $atributo => $erro) {
                foreach ($erro as $key => $value) {
                    $erros[] = $value;
                }
            }
        }

        if (count($erros) > 0) {
            $data = array('status' => 'fail',
                'info' => 'Erro de dados',
                'erro' => $erros,
                'loadurl' => ''
            );

            return json_encode($data);
        } else {
            $data = EnvioEmail::ConsultarProduto();
            //echo '<pre>';print_r($data);exit;
            return json_encode($data);
        }
    }

    /**
     * Controla o email para enviar os dados de contato de um cliente
     *
     * @return json
     */
    public function Contato() {
        $erros = array();
        $post_inputs = $this->request->all();
        //chechar se é um email válido
        if (!Utilidades::validate_email($post_inputs['email'])) {
            $erros[] = 'O seu email parece não estar no formato correto.';
        }
        $rules = array(
            'email' => 'required',
            'nome' => 'required|regex:/^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$/i|min:3|max:80',
            'telefone' => 'required|min:8',
            'mensagem' => 'required|regex:/^[a-zA-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ0-9?$@#()!,+\-=_:.&€£*%\s]+$/i|min:3|max:200'
        );

        $validation = Validator::make($post_inputs, $rules);
        if ($validation->fails()) {
            foreach ($validation->getMessageBag()->toArray() as $atributo => $erro) {
                foreach ($erro as $key => $value) {
                    $erros[] = $value;
                }
            }
        }

        if (count($erros) > 0) {
            $data = array('status' => 'fail',
                'info' => 'Erro de dados',
                'erro' => $erros,
                'loadurl' => ''
            );

            return json_encode($data);
        } else {
            
            $data = EnvioEmail::EnviarContato();
            //echo '<pre>';print_r($data);exit;
            return json_encode($data);
        }
    }

    /**
     * Controla o email email para inscrição de  um cliente na newsletter
     *
     * @return json
     */
    public function News() {
        $erros = array();
        //check if its our form
        if (Session::token() !== Input::get('_token')) {
            $erros[] = 'Esse formulário ja havia sido postado.';
            $data = array('status' => 'fail',
                'info' => 'Erro de sessão',
                'erro' => $erros,
                'loadurl' => ''
            );
            return json_encode($data);
            //return Response::json($data);           
        }
        //newsEmail, nomecompleto
        $post_inputs = Input::all(Input::except('_token'));

        //chechar se é um email válido
        if (!Utilidades::validate_email($post_inputs['newsEmail'])) {
            $erros[] = 'O seu email parece não estar no formato correto.';
        }
        $rules = array(
            'newsEmail' => 'required',
            'nomecompleto' => 'required|regex:/^[a-zA-Z\s]*$/|min:3|max:255'
        );

        $validation = Validator::make($post_inputs, $rules);
        if ($validation->fails()) {
            foreach ($validation->getMessageBag()->toArray() as $atributo => $erro) {
                foreach ($erro as $key => $value) {
                    $erros[] = $value;
                }
            }
        }

        if (count($erros) > 0) {
            $data = array('status' => 'fail',
                'info' => 'Erro de dados',
                'erro' => $erros,
                'loadurl' => ''
            );

            return json_encode($data);
        } else {
            //armazena informações sobre o cliente que desja newsletter
            $newsletter = new Subscribe();
            $newsletter->newsEmail = $post_inputs['newsEmail'];
            $newsletter->nomecompleto = $post_inputs['nomecompleto'];
            if ($newsletter->save()) {
                $data = EnvioEmail::InscreverNews();
                return json_encode($data);
            } else {
                $erros[] = 'Tivemos dificuldade de acessar o servidor. Por favor tente novamento';
                $data = array('status' => 'fail',
                    'info' => 'Erro no servidor',
                    'erro' => $erros,
                    'loadurl' => ''
                );
                return json_encode($data);
            }

            //echo '<pre>';print_r($data);exit;
        }
    }

    /**
     * Controla o email email  para requisição de nova senha de cliente
     *
     * @return json
     */
    public function Novasenha() {
        $erros = array();
        //check if its our form
        if (Session::token() !== Input::get('_token')) {
            $erros[] = 'Esse formulário ja havia sido postado.';
            $data = array('status' => 'fail',
                'info' => 'Erro de sessão',
                'erro' => $erros,
                'loadurl' => ''
            );
            return json_encode($data);
            //return Response::json($data);           
        }
        //newsEmail, nomecompleto
        $post_inputs = Input::all(Input::except('_token'));

        //chechar se é um email válido
        if (!Utilidades::validate_email($post_inputs['email_cadastrado'])) {
            $erros[] = 'O seu email parece não estar no formato correto.';
        }
        $rules = array(
            'email_cadastrado' => 'required'
        );

        $validation = Validator::make($post_inputs, $rules);
        if ($validation->fails()) {
            foreach ($validation->getMessageBag()->toArray() as $atributo => $erro) {
                foreach ($erro as $key => $value) {
                    $erros[] = $value;
                }
            }
        }

        if (count($erros) > 0) {
            $data = array('status' => 'fail',
                'info' => 'Erro de dados',
                'erro' => $erros,
                'loadurl' => ''
            );

            return json_encode($data);
        } else {
            $check_email = Customer::where('email', $post_inputs['email_cadastrado'])->lists('id');
            if (count($check_email) == 0) {
                $erro[] = 'Email informado não existe no cadastro.';
                $data = array('status' => 'fail',
                    'info' => 'Email não encontrao.',
                    'erro' => $erro,
                    'loadurl' => ''
                );
                return json_encode($data);
            } else {
                //altera a senha e muda no banco
                // e envia uma nova e para o cliente via email
                $data = EnvioEmail::Lembrarsenha();
                return json_encode($data);
            }
        }
    }

    /**
     * Controla o email para convidar cliente conhecer um produto
     *
     * @return json
     */
    public function Convite() {
        $erros = array();
        //check if its our form
        if (Session::token() !== Input::get('_token')) {
            $erros[] = 'Esse formulário ja havia sido postado.';
            $data = array('status' => 'fail',
                'info' => 'Erro de sessão',
                'erro' => $erros,
                'loadurl' => ''
            );
            return json_encode($data);
            //return Response::json($data);           
        }
        //nome, from, to_name,to_email_address,products_id
        $post_inputs = Input::all(Input::except('_token'));

        //chechar se é um email válido
        if (!Utilidades::validate_email($post_inputs['email_from'])) {
            $erros[] = 'O seu email parece não estar no formato correto.';
        }
        //chechar se é um email válido
        if (!Utilidades::validate_email($post_inputs['to_email_address'])) {
            $erros[] = 'O email do seu amigo parece não estar no formato correto.';
        }
        //$txtRegExp = /^[a-zA-ZéúíóáÉÚÍÓÁèùìòàÈÙÌÒÀõãñÕÃÑêûîôâÊÛÎÔÂëÿüïöäËYÜÏÖÄ\-\'\s]*$/;
        $rules = array(
            'nome' => 'required|regex:/^[a-zA-ZéúíóáÉÚÍÓÁèùìòàÈÙÌÒÀõãñÕÃÑêûîôâÊÛÎÔÂëÿüïöäËYÜÏÖÄçÇ\-\'\s]*$/|min:3|max:80',
            'to_nome' => 'required|regex:/^[a-zA-ZéúíóáÉÚÍÓÁèùìòàÈÙÌÒÀõãñÕÃÑêûîôâÊÛÎÔÂëÿüïöäËYÜÏÖÄçÇ\-\'\s]*$/|min:3|max:80',
            'product_id' => 'required|numeric',
            'email_from' => 'required',
            'message' => 'required|regex:/^[a-zA-ZéúíóáÉÚÍÓÁèùìòàÈÙÌÒÀõãñÕÃÑêûîôâÊÛÎÔÂëÿüïöäËYÜÏÖÄçÇ.,\-\'\s]*$/|min:10|max:200',
            'to_email_address' => 'required'
        );
        $validation = Validator::make($post_inputs, $rules);
        if ($validation->fails()) {
            foreach ($validation->getMessageBag()->toArray() as $atributo => $erro) {
                foreach ($erro as $key => $value) {
                    $erros[] = $value;
                }
            }
        }
        if (count($erros) > 0) {
            $data = array('status' => 'fail',
                'info' => 'Erro de dados',
                'erro' => $erros,
                'loadurl' => ''
            );

            return json_encode($data);
        } else {
            $data = EnvioEmail::ConviteAmigo();
            return json_encode($data);
        }
    }

    /**
     * Controla o email que envia os dados de um pedido novo realizado
     *
     * @return json
     */
    public function Pedido() {
        EnvioEmail::NovoPedido();
        $html = array('html' => '<div class="errormsg alert"><a class="clostalert">close</a>Erro! Preencha todos os campos corretamente e tente novamente.</div>');

        return Response::json($html);
    }

    /**
     * Controla o email para informa o cliente sobre mudança de status de pedidos
     *
     * @return json
     */
    public function Status() {
        $rules = array('products_id' => 'required|numeric',
            'to_email_address' => 'required|email');
        //$validation = Validator::make(Input::all(), $rules);
        $input = input::all();
        $validation = Validator::make($input, $rules);
        if ($validation->passes()) {
            $html = EnvioEmail::MudancaStatus();
            return Response::json($html);
        } else {
            $html = array('html' => '<div class="errormsg alert"><a class="clostalert">close</a>Erro! Preencha todos os campos corretamente e tente novamente.</div>');
            return Response::json($html);
        }
    }

    /**
     * Controla o email para lembrar o cliente que um certo produto está novamente em estoque
     *
     * @return json
     */
    public function Comentario() {
        $erros = array();
        //verifica se o cliente está logado
        if (!Auth::user()) {
            $erros[] = 'Para fazer comentário você precisa estar logado.';
            $data = array('status' => 'fail',
                'info' => 'Cliente não logado',
                'erro' => $erros,
                'loadurl' => ''
            );
            return json_encode($data);
        }
        //check if its our form
        if (Session::token() !== Input::get('_token')) {
            $erros[] = 'Esse formulário ja havia sido postado.';
            $data = array('status' => 'fail',
                'info' => 'Erro de sessão',
                'erro' => $erros,
                'loadurl' => ''
            );
            return json_encode($data);
            //return Response::json($data);           
        }
        //reviews_rating, texto, product_id
        $post_inputs = Input::all(Input::except('_token'));

        //$txtRegExp = /^[a-zA-ZéúíóáÉÚÍÓÁèùìòàÈÙÌÒÀõãñÕÃÑêûîôâÊÛÎÔÂëÿüïöäËYÜÏÖÄ\-\'\s]*$/;
        $rules = array(
            'reviews_rating' => 'required|numeric',
            'texto' => 'required|regex:/^[a-zA-ZéúíóáÉÚÍÓÁèùìòàÈÙÌÒÀõãñÕÃÑêûîôâÊÛÎÔÂëÿüïöäËYÜÏÖÄçÇ\-\'\s]*$/|min:3|max:80',
            'product_id' => 'required|numeric'
        );
        $validation = Validator::make($post_inputs, $rules);
        if ($validation->fails()) {
            foreach ($validation->getMessageBag()->toArray() as $atributo => $erro) {
                foreach ($erro as $key => $value) {
                    $erros[] = $value;
                }
            }
        }
        if (count($erros) > 0) {
            $data = array('status' => 'fail',
                'info' => 'Erro de dados',
                'erro' => $erros,
                'loadurl' => ''
            );

            return json_encode($data);
        } else {
            //armazena informações sobre o cliente que desja newsletter
            $comentario = new Comentario();
            $comentario->reviews_rating = $post_inputs['reviews_rating'];
            $comentario->texto = $post_inputs['texto'];
            $comentario->product_id = $post_inputs['product_id'];
            $comentario->customer_id = Auth::User()->id;
            if ($comentario->save()) {
                $data = EnvioEmail::Comentario();
                return json_encode($data);
            } else {
                $erros[] = 'Tivemos dificuldade de acessar o servidor. Por favor tente novamento';
                $data = array('status' => 'fail',
                    'info' => 'Erro no servidor',
                    'erro' => $erros,
                    'loadurl' => ''
                );
                return json_encode($data);
            }
        }
    }

}
