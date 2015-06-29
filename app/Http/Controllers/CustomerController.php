<?php

namespace Ecograph\Http\Controllers;

use Ecograph\Http\Requests;
use Ecograph\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Cart;
use Session;
use Validator;
use Hash;
use Ecograph\Customer;
use Ecograph\AddressBook;
use Ecograph\Acesso;
use Ecograph\Libs\Layout;
use Ecograph\Libs\Fichas;
use Ecograph\Libs\Utilidades;
use EnvioEmail;

class CustomerController extends Controller {

    private $layout;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Layout $layout) {
        $this->layout = $layout;
    }

    /**
     * quando o cliente deseja fazer o login.
     * mostra a página com form para se logar
     * @param
     * @return view
     */
    public function Login() {

        $layout = $this->layout->classes('0');
        $layout['color_bg_footer'] = '#003366';
        return view('clientes.index')
                        ->with('title', STORE_NAME . '  Acesso a loja')
                        ->with('page', 'login')
                        ->with('ativo', 'Login')
                        ->with('rota', 'clientes/login.html')
                        ->with('layout', $layout);
    }

    /**
     * quando o cliente deseja fazer o logut.
     * mostra a página com o logout realizado
     * @param
     * @return view
     */
    public function Logout() {
        //Utilidades::tempbasket();
        $populares = '';
        Auth::logout();
        Cart::destroy();
        Session::forget('carrinho');
        Session::forget('facebook_id');
        Session::forget('username');
        Session::forget('admin');
        Session::forget('administrador');
        $layout = $this->layout->classes('6');
        //$populares = Fichas::produtosPopulares();
        return view('clientes.index')->with('title', STORE_NAME . ' Sessão encerrada!')->with('page', 'logout')->with('ativo', 'Sessão encerrada')->with('rota', 'clientes/index')->with('populares', $populares)->with('layout', $layout)->with('class', LAYOUT);
    }

    public function conta() {
        if (Auth::user()->id) {
            // get the customer
            $customers = Customer::find(Auth::user()->id);
            //$address = Customer::find(Auth::user()->id)->address;
            $address = Customer::with('AddressBook')->find(\Auth::user()->id)->AddressBook;
            $default_address = $address->toarray();
        }
        //$address = array();
        //dd($customers);
        return view('clientes.index')
                        ->with('title', STORE_NAME . ' Minha Conta')
                        ->with('message', 'Bem Vindo :' . Customer::find(Auth::user()->id)->customers_firstname)
                        ->with('page', 'minhaconta')
                        ->with('ativo', 'Minha Conta')
                        ->with('rota', 'minhaconta')
                        ->with('customers', $customers)
                        ->with('address', $default_address);
    }

    /**
     * controla o modal com o form formtipoconta
     * quando o cliente passa as informações sobre o login.
     * utiliza função javascript ValidaTipoConta()
     * @param
     * @return json
     */
    public function TipoContaJson(Request $request) {
        $erros = array();
        $post_inputs = $request->all();
        //regras a serem validadas
        $rules['entry_postcode'] = 'required|min:8';
        $validation = Validator::make($post_inputs, $rules);
        if ($validation->fails()) {
            foreach ($validation->getMessageBag()->toArray() as $atributo => $erro) {
                foreach ($erro as $key => $value) {
                    $erros[] = $value;
                }
            }
        }
        if (count($erros) > 0) {
            $data = array('status' => 'fail', 'info' => 'Erro de dados', 'erro' => $erros, 'loadurl' => '');
            return json_encode($data);
        } else {
            $cep = $post_inputs['entry_postcode'];
            //$endereco = Utilidades::BuscaEndereco($cep);
            if ($post_inputs['street'] !== '') {
                $submit = 'criarconta';
                $data = array('status' => 'pass', 'info' => 'Aguarde redirecionamento ...', 'erro' => '', 'loadurl' => $submit);

                return json_encode($data);
            } else {
                $erros[] = 'Não encontramos endereço para o CEP ' . $cep;
                $data = array('status' => 'fail', 'info' => 'Erro de sessão', 'erro' => $erros, 'loadurl' => '');
                return json_encode($data);
            }
        }
    }

    /**
     * *através da modal o cliente posta o cep e tipo para criar a conta.
     * apresenta o formulário de cadastro
     * utiliza função javascript CheckCadastro
     * @return view
     */
    public function CriarConta(Request $request) {
        if (isset($request['customers_pf_pj'])) {
            $post_inputs = $request->all();
            $tipo = $post_inputs['customers_pf_pj'];
            $entry_postcode = $post_inputs['entry_postcode'];
            $entry_street_address = $post_inputs['street'];
            $entry_suburb = $post_inputs['suburb'];
            $entry_city = $post_inputs['city'];
            $entry_state = $post_inputs['state'];
            if (Session::has('facebook_id')) {
                $customers_firstname = $post_inputs['customers_firstname'];
                $customers_lastname = $post_inputs['customers_lastname'];
                $email = $post_inputs['email'];
            } else {
                $customers_firstname = '';
                $customers_lastname = '';
                $email = '';
            }
            $layout = $this->layout->classes('6');
            return view('clientes.index')
                            ->with('title', STORE_NAME . ' Cadastro de Clientes')
                            ->with('page', 'novaconta')
                            ->with('ativo', 'Cadastro')
                            ->with('rota', 'clientes/index')
                            ->with('tipo', $tipo)
                            ->with('entry_postcode', $entry_postcode)
                            ->with('entry_street_address', ($entry_street_address))
                            ->with('entry_suburb', ($entry_suburb))
                            ->with('entry_city', ($entry_city))
                            ->with('entry_state', $entry_state)
                            ->with('customers_firstname', $customers_firstname)
                            ->with('customers_lastname', $customers_lastname)
                            ->with('email', $email)
                            ->with('layout', $layout);
        }
    }

    /**
     * quando o cliente preenche o cadastro e envia os dados.
     * utiliza função javascript CheckCadastro() para validacao
     * @return json
     */
    public function Cadastro(Request $request) {
        $erros = array();
        //dd($request);
        //check if its our form
        $post_inputs = $request->all($request->except('_token', 'email', 'agree', 'customers_revendedor'));

        //regras a serem validadas
        $rules = Customer::$rules;
        $customers_pf_pj = $post_inputs['customers_pf_pj'];
        if (!empty($customers_pf_pj) && $customers_pf_pj == 'f') {
            if (!Utilidades::validate_cpf($post_inputs['customers_cpf_cnpj'])) {
                $erros[] = 'CPF no formato errado.';
            }
        } else {
            if (!Utilidades::validate_cnpj($post_inputs['customers_cpf_cnpj'])) {
                $erros[] = 'CNPJ no formato errado';
            }
            $rules['customers_atuacao'] = 'regex:/^[a-zA-Z\s]*$/|min:5|max:120';
            $rules['entry_company'] = 'required|regex:/^[a-zA-Z\s]*$/|min:5|max:120';
            $rules['entry_fantasia'] = 'regex:/^[a-zA-Z\s]*$/|min:5|max:120';
        }
        if (!Utilidades::validate_email($post_inputs['email'])) {
            //    echo 'aquiii';exit;
            $erros[] = 'O seu email parece não estar no formato correto.';
        } else {
            $check_email = Customer::where('email', $post_inputs['email'])->lists('id');
            if (count($check_email) > 0) {
                $erros[] = 'Esse email ja está cadastrado.';
            }
        }


        //verfica se os dois telefones - fixo e celular estão vazios
        if ($post_inputs['customers_telephone'] == '' && $post_inputs['customers_cel'] == '') {
            $erros[] = 'Informe pelo menos um dos telefones: Fixo ou Celular.';
            $data = array('status' => 'fail',
                'info' => 'Erro de preenchimento',
                'erro' => $erros,
                'loadurl' => '');
            return json_encode($data);
        }
        //retirada das mascaras
        foreach ($post_inputs as $key => $valor) {
            if ($key == 'customers_telephone' || $key == 'customers_cel' || $key == 'customers_telephone1') {
                $new_valor = str_replace(".", "", $valor);
                $post_inputs[$key] = $new_valor;
            }
        }
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
                'loadurl' => '');
            return json_encode($data);
        } else {
            //exit;
            // $post_inputs['customers_cpf_cnpj'] = Input::get('customers_cpf_cnpj');
            // $post_inputs['email'] = Input::get('email');
            //$salve = false;
            //prepara os dados para o cliente
            $customer = new Customer;
            $customer->customers_gender = $post_inputs['customers_gender'];
            $customer->remember_token = $post_inputs['_token'];
            $password = $post_inputs['password'];
            $customer->password = Hash::make($password);
            $customer->customers_firstname = $post_inputs['customers_firstname'];
            $customer->customers_lastname = $post_inputs['customers_lastname'];
            //$customer->customers_dob = $post_inputs[customers_dob');
            $customer->email = $post_inputs['email'];
            $customer->customers_telephone = $post_inputs['customers_telephone'];
            //$customer->customers_ddd = $post_inputs[customers_ddd');
            $customer->customers_telephone1 = $post_inputs['customers_telephone1'];
            //$customer->customers_ddd1 = $post_inputs['customers_ddd1'];
            $customer->customers_cel = $post_inputs['customers_cel'];
            //$customer->customers_ddd2 = $post_inputs['customers_ddd2'];
            $customer->customers_cel1 = $post_inputs['customers_cel1'];
            $customer->customers_newsletter = $post_inputs['customers_newsletter'];
            $customer->customers_cpf_cnpj = $post_inputs['customers_cpf_cnpj'];
            $customer->customers_pf_pj = $post_inputs['customers_pf_pj'];
            //$customer->customers_rg_ie = $post_inputs['customers_rg_ie'];
            //dados do cliente armazenados em customers
            $customer->save();

            //prepara os dados do livro d endereço
            $address = new AddressBook;
            $address->customer_id = $customer->id;
            $address->entry_gender = $post_inputs['customers_gender'];
            if ($post_inputs['customers_pf_pj'] == 'j') {
                $address->entry_company = $post_inputs['entry_company'];
                $address->entry_fantasia = $post_inputs['entry_fantasia'];
            }
            $address->entry_firstname = $post_inputs['customers_firstname'];
            $address->entry_lastname = $post_inputs['customers_lastname'];
            $address->entry_street_address = $post_inputs['entry_street_address'];
            $address->entry_suburb = $post_inputs['entry_suburb'];
            $address->entry_postcode = $post_inputs['entry_postcode'];
            $address->entry_city = $post_inputs['entry_city'];
            $address->entry_state = $post_inputs['entry_state'];
            $address->entry_state_code = $post_inputs['entry_state'];
            $address->entry_nr_rua = $post_inputs['entry_nr_rua'];
            $address->entry_comp_ref = $post_inputs['entry_comp_ref'];
            $address->entry_ref_entrega = $post_inputs['entry_ref_entrega'];
            //dados de endereços aramzenados para o cliente
            $address->save();
            //setando o endereço padrão para o cliente
            $customer->customers_default_address_id = $address->id;
            $customer->update();

            $acessos = new Acesso;
            $acessos->customer_id = $customer->id;
            //dados de acesso criado para o cliente
            $salve = $acessos->save();
            return $this->TratarEmail($salve, $customer);
        }
        //return json_encode($data);
    }

    public function TratarEmail($check, $customer) {
        $erro = array();
        if ($check) {
            //session::put('nova_conta_uf', $address->entry_state);
            if (EnvioEmail::NovoCadastro($customer)) {
                //Session::put('success', '. Enviarmos uma email com suas informações.');
                $data = array('status' => 'pass',
                    'info' => 'Sua conta foi criada com sucesso. Enviarmos uma email com suas informações.',
                    'erro' => '',
                    'loadurl' => URL::to('clientes/conta/sucesso.html'));
            } else {
                $data = array('status' => 'pass',
                    'info' => 'Sua conta foi criada com sucesso. No entanto não conseguimos enviar um email com suas informações.',
                    'erro' => '',
                    'loadurl' => URL::to('clientes/conta/sucesso.html'));
                //Session::put('error', 'Sua conta foi criada com sucesso, mas não conseguimos enviar um email com suas informações.');
            }
        } else {
            $erro[] = 'Não foi possível enviar os dados para o servidor.';
            $data = array('status' => 'fail',
                'info' => 'Erro na criação da conta',
                'erro' => $erro,
                'loadurl' => URL::to('cliente/conta/sucesso.html'));
            //Session::put('error', 'Erro na criação da conta. Por favor tente novamente.');
            //return Redirect::to('inicio')->withError();
        }
        return json_encode($data);
    }

    /**
     * Script CheckCadastro faz validação de alguns campos antes de postar.
     *
     * @return Response
     */
    public function ContaCriada() {
        $layout = $this->layout->classes(0);
        return View::make('clientes.index')
                        ->with('title', STORE_NAME . ' Sua conta foi criada')
                        ->with('page', 'contacriada')
                        ->with('ativo', 'Sucesso')
                        ->with('layout', $layout)
                        ->with('rota', 'clientes/conta/sucesso.html');
    }

    /**
     * Mosta página orcamento.
     *
     * @return View
     */
    public function Orcamento(Request $request) {
        $post_inputs = $request->all();
        $pai = Fichas::parentCategoria($post_inputs['orc_categoria_id']);
        $layout = $this->layout->classes($pai);
        return view('clientes.index')
                        ->with('title', STORE_NAME . ' Monte seu orçamento')
                        ->with('page', 'imprimir')
                        ->with('ativo', 'Orcamento')
                        ->with('post_inputs', $post_inputs)
                        ->with('rota', 'orcamento.html')
                        ->with('layout', $layout);
    }

}
