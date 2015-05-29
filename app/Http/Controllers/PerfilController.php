<?php

namespace Ecograph\Http\Controllers;

use Ecograph\Perfil;
use Ecograph\Libs\Modais;
use Ecograph\Libs\Utilidades;
use Ecograph\CategoryDescription;
use Ecograph\Http\Requests;
use Ecograph\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PerfilController extends Controller {

    private $perfil;

    public function __construct(Perfil $perfil) {
        $this->perfil = $perfil;
    }

    /**
     * *gera um.
     * thumbnail de perfis
     * incorporados a categoria escolhida
     * @return json
     */
    public function Lista($categoria) {
        $thumb = '';
        $modais = Modais::modal($categoria);
        if ($modais) {
            $perfis = Modais::perfis($modais);
            $thumb = Utilidades::Agrupa($perfis, 4, 'busca');
        } else {
            $thumb = array('info' => 'erro');
        }
        // dd($thumb);
        return json_encode($thumb);
    }

}
