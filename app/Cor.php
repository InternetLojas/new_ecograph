<?php namespace Ecograph;

use Illuminate\Database\Eloquent\Model;

class Cor extends Model {

    protected $table = 'cores';

    protected $fillable = [
        'valor'
    ];

    public function Categories(){
        return $this->belongsToMany('Ecograph\Category');
    }

}
