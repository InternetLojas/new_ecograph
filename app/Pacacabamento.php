<?php

namespace Ecograph;

use Illuminate\Database\Eloquent\Model;

class Pacacabamento extends Model {

    protected $table = 'pacacabamentos';

    protected $fillable = [
        'category_id',
        'paccor_id',
        'category_acabamento_id',
        'pacote_id',
        'price'
    ];
    public function CategoryAcabamento(){
        return $this->BelongsTo('Ecograph\CategoryAcabamento');
    }

    public function PacCor(){
        return $this->BelongsTo('Ecograph\Paccor');
    }
}
