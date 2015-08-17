<?php namespace Ecograph;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model {
    protected $table = 'perfis';
    protected $fillable = [
        'nome_perfil',
        'nome_perfil_html',
        'logo_perfil'
    ];

    public function ProdutoPerfil() {
        return $this->hasMany('Ecograph\ProdutoPerfil');
    }

}
