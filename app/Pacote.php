<?php

namespace Ecograph;

use Illuminate\Database\Eloquent\Model;

class Pacote extends Model {

    protected $table = 'pacotes';

    protected $fillable = [
        'categories_id',
        'quantity'
    ];

    public function Categories() {
        return $this->hasMany('Ecograph\Category');
    }

    public function PacFormatos() {
        return $this->hasMany('Ecograph\Pacformato');
    }
}
