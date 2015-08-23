<?php namespace Ecograph;

use Illuminate\Database\Eloquent\Model;

class Paccor extends Model {
    protected $table = 'paccores';

    protected $fillable = [
        'category_id',
        'pacpapel_id',
        'category_cor_id',
        'pacote_id'

    ];

    public function CategoryCor(){
        return $this->belongsTo('Ecograph\CategoryCor');
    }

    public function PacPapel(){
        return $this->BelongsTo('Ecograph\Pacpapel');
    }
    public function PacAcabamento(){

        return $this->hasMany('Ecograph\Pacacabamento');

    }

}
