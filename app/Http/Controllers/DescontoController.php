<?php

namespace Ecograph\Http\Controllers;

use Ecograph\Http\Requests;
use Ecograph\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Ecograph\Descontoacrescimo;
use Validator;

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
    public static function Desconto(Request $request) {
        $post_inputs = $request->all();
        if(! \Auth::check()){
            return redirect()->route('clientes.login'); 
        }
        $erros = array();
        //check if its our form
        //regras a serem validadas
        $rules['discount_code'] = 'required|min:5|max:20';
        //$post_inputs = Input::all(Input::except('_token'));
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
            //$discount = new Discount();
            //$config = $this->discount->start('discount_cupon');
            $desconto = Descontoacrescimo::where('class', 'discount_cupon')->get();
            $conf = $desconto->toarray();
            $confdescontos = Descontoacrescimo::find($conf[0]['id'])->Confdesconto;
            foreach ($confdescontos->toarray() as $config) {
                $configuracao[$conf[0]['id']][$config['desconto_key']] = $config['desconto_value'];
            }
            $config = $configuracao;
            //dd($config);
            $discount_code = $post_inputs['discount_code'];
            foreach ($config as $key => $valores) {
                if ($discount_code == $valores['discount_codes']) {
                    if ($valores['expires_date'] < date('d-m-Y')) {
                        $erros[] = 'O Cupom .<b>' . $discount_code . '</b> perdeu a validade em ' . $valores['expires_date'];
                        $data = array('status' => 'fail',
                            'info' => 'Perda de validade',
                            'erro' => $erros,
                            'loadurl' => ''
                        );
                        return json_encode($data);
                    } else {
                        $extra = '<p class="maint-text>O cupom .<b>' . $discount_code . '</b> foi validado e está autorizado o uso.<br>Esse cupom é válido até ' . $valores['expires_date'] . '</p>';
                        $data = array('status' => 'pass',
                            'info' => 'Cupom validado.',
                            'erro' => '',
                            'extra' => $extra,
                            'config' => $config
                        );
                        
                        return json_encode($data);
                    }
                }
            }
            $erros[] = 'O Cupom .<b>' . $discount_code . '</b> não existe no nosso sistema';
            $data = array('status' => 'fail',
                'info' => 'Cupom inexistente',
                'erro' => $erros,
                'loadurl' => ''
            );
            return json_encode($data);
        }
    }

}
