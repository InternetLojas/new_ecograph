<?php

namespace Ecograph;

use Illuminate\Database\Eloquent\Model;

class CategoryDescription extends Model {

    protected $fillable = array('id',
        'prefixo',
        'categories_name',
        'categories_info',
        'categories_descricao'
    );

}
