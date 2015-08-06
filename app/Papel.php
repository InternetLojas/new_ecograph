<?php namespace Ecograph;

use Illuminate\Database\Eloquent\Model;

class Papel extends Model {

    protected $table = 'papeis';
    
    protected $fillable = [
        'valor'
    ];
   /* public function CategoryPapel(){
        return $this->hasMany('Ecograph\CategoryPapel');
    }*/
    public function Categories(){
        return $this->belongsToMany('Ecograph\Category');
    }
}
