<?php

namespace Ecograph\Http\Controllers;

use Ecograph\Customer;
use Ecograph\CustomerDiscount;
use Ecograph\Http\Requests;
use Ecograph\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Ecograph\Descontoacrescimo;
use Validator;
use Session;

class DescontoController extends Controller {

    private $discount;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {

        $this->middleware('auth');
    }

    /**
     * Controle o cupom de desconto.
     *
     * @return json
     */
    public static function Desconto(Request $request, CustomerDiscount $customerDiscount) {
        $post_inputs = $request->all();
        if(! \Auth::check()){
            return redirect()->route('clientes.login'); 
        }
        $erros = array();
        //check if its our form
        //regras a serem validadas
        $rules['discount_code'] = 'required|min:5|max:20';
        $discount_code = $post_inputs['discount_code'];
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
            $erros = array();
            $user_id = \Auth::user()->id;
            $customer = Customer::find($user_id);
            $desconto = Descontoacrescimo::where('class', 'discount_cupon')->get()->first();
            //$conf = $desconto->toarray();
            $conf_id = $desconto->id;
            //dd($conf_id);
            $code = Descontoacrescimo::find($conf_id)->Confdesconto()
                ->where('desconto_key','discount_codes')->get()->first()->desconto_value;
            if($discount_code != $code){
                $erros[] = 'O Cupom .<b>' . $discount_code . '</b> não existe no nosso sistema';
                $data = array('status' => 'fail',
                    'info' => 'Cupom inexistente',
                    'erro' => $erros,
                    'loadurl' => ''
                );
                return json_encode($data);
            }
            $erros = [];
            $confdescontos = Descontoacrescimo::find($conf_id)->Confdesconto()->get()->first();
            $CustomerDiscount = $customer->CustomerDiscount()->where('conf_descontos_code_id',$conf_id)->first();
            if(!is_null($CustomerDiscount)){
                $discount_nr_vezes = $CustomerDiscount->discount_nr_vezes;
                $number_of_use = Descontoacrescimo::find($conf_id)->Confdesconto()
                    ->where('desconto_key','number_of_use')->get()->first()->desconto_value;

                if($number_of_use==$discount_nr_vezes ){
                    $erros[] = 'O cupom "'.$discount_code.'"" já foi utilizado o máximo de vezes permitido';
                    $data = array('status' => 'fail',
                        'info' => 'Cupom inválido.',
                        'erro' => $erros,
                        'loadurl' => ''
                    );
                    return json_encode($data);
                } else {
                    $expires_date = Descontoacrescimo::find($conf_id)->Confdesconto()
                        ->where('desconto_key','expires_date')->get()->first()->desconto_value;
                    if ($expires_date < date('d-m-Y')) {
                        $erros[] = 'O Cupom .<b>' . $discount_code . '</b> perdeu a validade em ' . $expires_date;
                        $data = array('status' => 'fail',
                            'info' => 'Perda de validade',
                            'erro' => $erros,
                            'loadurl' => ''
                        );
                        return json_encode($data);
                    }
                }
                //$configuracao[$conf[0]['id']][$confdescontos->desconto_key] = $confdescontos->desconto_value;
            } else {
                //primeiro uso
                $row_discount = [
                    'customer_id' => $user_id,
                    'conf_descontos_code_id' => $conf_id,
                    'discount_order_id' => '',
                    'discount_nr_vezes' => 1
                ];
                $customer->CustomerDiscount()->firstOrCreate($row_discount);
                //cria a sessão do código
                Session::set('conf_descontos_code_id',$conf_id);
                 Session::set('discount_code',$discount_code);
                $configuracao[$conf_id][$confdescontos->desconto_key] = $confdescontos->desconto_value;
                $extra = '<p class="maint-text>Esse cupom .<b>' . $confdescontos->desconto_value . '</b> tem o uso autorizado.</p>';
                $data = array('status' => 'pass',
                    'info' => 'Cupom validado.',
                    'erro' => '',
                    'extra' => $extra,
                    'config' => $configuracao
                );

                return json_encode($data);
            }

        }
    }

}
