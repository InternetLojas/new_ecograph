<?php namespace Ecograph;

use Illuminate\Database\Eloquent\Model;

class Core extends Model {

    protected $table = 'cores';

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
