<?php namespace Ecograph;

use Illuminate\Database\Eloquent\Model;

class Enoblecimento extends Model {

    protected $table = 'enoblecimentos';
    protected $fillable = [
        'valor',
        'category_id'
    ];
    public function Categories(){
        return $this->belongsTo('Ecograph\Category');
    }

}
