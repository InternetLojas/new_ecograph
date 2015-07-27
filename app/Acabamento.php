<?php

namespace Ecograph;

use Illuminate\Database\Eloquent\Model;

class Acabamento extends Model {

    protected $table = 'acabamentos';

    public function Categories(){
        return $this->belongsToMany('Ecograph\Category');
    }

}
