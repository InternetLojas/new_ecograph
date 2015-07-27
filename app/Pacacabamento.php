<?php

namespace Ecograph;

use Illuminate\Database\Eloquent\Model;

class Pacacabamento extends Model {

    protected $table = 'pacacabamentos';

    protected $fillable = [
        'category_id',
        'pacpapel_id',
        'category_acabamento_id',
        'price'
    ];

}
