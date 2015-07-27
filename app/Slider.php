<?php

namespace Ecograph;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model {

    protected $fillable = [
        'palco_id',
        'categories_id',
        'descricao'
    ];

    public function Palco(){
        return $this->BelongsTo('Ecograph\Palco');
    }

}
