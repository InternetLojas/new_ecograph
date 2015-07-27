<?php

namespace Ecograph;

use Illuminate\Database\Eloquent\Model;

class CategoryFormato extends Model {

    protected $table = 'category_formato';

    protected $fillable = [
        'category_id',
        'formato_id'
    ];

    public function PacFormatos() {
        return $this->hasMany('Ecograph\Pacformato');
    }

}
