<?php

namespace Ecograph;

use Illuminate\Database\Eloquent\Model;

class Formato extends Model {

    protected $table = 'formatos';
    protected $fillable = [
        'valor'
    ];
    public function Categories(){
        return $this->belongsToMany('Ecograph\Category');
    }


}
