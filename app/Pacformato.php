<?php namespace Ecograph;

use Illuminate\Database\Eloquent\Model;

class Pacformato extends Model {

    protected $table = 'pacformatos';

    protected $fillable = [
        'category_id',
        'category_formato_id',
        'pacote_id'
    ];

    public function CategoryFormato(){

        return $this->BelongsTo('Ecograph\CategoryFormato');

    }

    public function PacPapeis(){

        return $this->hasMany('Ecograph\Pacpapel');

    }

}
