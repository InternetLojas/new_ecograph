<?php namespace Ecograph\Libs;
use Ecograph\Descontoacrescimo;

Class Discount {


    static function start($tipo) {
        $desconto = Descontoacrescimo::where('class', $tipo)->get();
        $conf = $desconto->toarray();
        $confdescontos = Descontoacrescimo::find($conf[0]['id'])->Confdesconto;
        foreach ($confdescontos->toarray() as $config) {
            $configuracao[$conf[0]['id']][$config['desconto_key']] = $config['desconto_value'];
        }
        return $configuracao;
    }

}
