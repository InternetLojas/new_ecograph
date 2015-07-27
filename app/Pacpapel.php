<?php

namespace Ecograph;

use Illuminate\Database\Eloquent\Model;

class Pacpapel extends Model {

    protected $table = 'pacpapeis';

    protected $fillable = [
        'category_id',
        'pacformato_id',
        'category_papel_id',
        'weight'
    ];

    public function CategoryPapel(){

        return $this->BelongsTo(\Ecograph\CategoryPapel);

    }

    public function PacFormato(){

        return $this->BelongsTo(\Ecograph\PacFormato);

    }


}
