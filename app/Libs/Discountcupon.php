<?php

Class Discountcupon extends \DescontosAcrescimos {

    public function __construct() {
        parent::__construct();
        //$this->beforeFilter('csrf', array('on' => 'post'));        
    }

    static function start() {
        $desconto = Descontoacrescimo::id('discount_cupon')->whereStatus('1')->get();
        $confdescontos = Descontoacrescimo::find($desconto->first()->id)->Confdescontoacrescimo;

        foreach ($confdescontos as $conf) {
            $configuracao[$conf['desc_acresc_key']] = $conf['desc_acresc_value'];
        }

        return $configuracao;
    }

}
