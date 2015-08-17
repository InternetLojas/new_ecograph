<?php namespace Ecograph;

use Illuminate\Database\Eloquent\Model;

class Papel extends Model {

    protected $table = 'papeis';
    
    protected $fillable = [
        'valor'
    ];

    public function Categories(){
        return $this->belongsToMany('Ecograph\Category');
    }
}
