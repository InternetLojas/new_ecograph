<?php

namespace Ecograph;

use Illuminate\Database\Eloquent\Model;

class CategoryPapel extends Model {

    protected $table = 'category_papel';

    protected $fillable = [
        'category_id',
        'papel_id'
    ];

    public function PacPapeis() {
        return $this->hasMany('Ecograph\Pacpapel');
    }

}
