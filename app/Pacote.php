<?php

namespace Ecograph;

use Illuminate\Database\Eloquent\Model;

class Pacote extends Model {

    protected $table = 'pacotes';

    protected $fillable = [
        'category_id',
        'quantity'
    ];

    public function Categories() {
        return $this->belongsTo('Ecograph\Category');
    }

    public function PacFormatos() {
        return $this->hasMany('Ecograph\Pacformato');
    }
}
