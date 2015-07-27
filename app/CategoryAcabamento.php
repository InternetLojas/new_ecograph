<?php

namespace Ecograph;

use Illuminate\Database\Eloquent\Model;

class CategoryAcabamento extends Model {

    protected $table = 'category_acabamento';

    protected $fillable = [
        'category_id',
        'acabamento_id'
    ];

    public function PacAcabamentos() {
        return $this->hasMany('Ecograph\Pacacabamento');
    }

}
