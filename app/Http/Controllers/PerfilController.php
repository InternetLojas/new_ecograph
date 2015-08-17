<?php

namespace Ecograph\Http\Controllers;

use Ecograph\Category;
use Ecograph\Perfil;
use Ecograph\Libs\Modais;
use Ecograph\Libs\Utilidades;
use Ecograph\Http\Requests;
use Ecograph\Http\Controllers\Controller;
use Ecograph\ProdutoPerfil;
use Illuminate\Http\Request;

class PerfilController extends Controller {

    private $perfil;
    private $category;
    private $produtoPerfil;

    public function __construct(Perfil $perfil, Category $category, ProdutoPerfil $produtoPerfil) {
        $this->perfil = $perfil;
        $this->category = $category;
        $this->produtoPerfil = $produtoPerfil;
    }

    /**
     * *gera um.
     * thumbnail de perfis
     * incorporados a categoria escolhida
     * @return json
     */
    public function Lista($id) {
        $categoria = $this->category->find($id);
        $modais = Modais::modal($categoria);
        if ($modais) {
            $perfis = Modais::perfis($modais, $this->produtoPerfil);
            //dd($perfis);
            $thumb = Utilidades::Agrupa($perfis, 4, 'busca');
        } else {
            $thumb = array('info' => 'erro');
        }
        //dd($thumb);
        return json_encode($thumb);
    }

}
