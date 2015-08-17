<?php namespace Ecograph;

use Illuminate\Database\Eloquent\Model;

class ProdutoPerfil extends Model {

protected $table = 'produtoperfis';
    protected $fillable = [
        'perfil_id',
        'product_id'
    ];

    public function Perfil() {
        return $this->belongsTo('Ecograph\Perfil');
    }
    public function Product() {
        return $this->belongsTo('Ecograph\Product');
    }
}
