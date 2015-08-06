<?php

namespace Ecograph;

use Illuminate\Database\Eloquent\Model;

class Acabamento extends Model {

    protected $table = 'acabamentos';
    protected $fillable = [
        'valor'
    ];
    public function Categories(){
        return $this->belongsToMany('Ecograph\Category');
    }


}
