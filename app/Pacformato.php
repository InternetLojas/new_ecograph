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
        return $this->belongsTo('Ecograph\CategoryFormato');
    }

    public function Pacotes(){

        return $this->belongsTo('Ecograph\Pacote');

    }

    public function PacPapeis(){

        return $this->hasMany('Ecograph\Pacpapel');

    }

}
