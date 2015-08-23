<?php namespace Ecograph;

use Illuminate\Database\Eloquent\Model;

class CategoryEnoblecimento extends Model {

    protected $table = 'category_enoblecimento';

    protected $fillable = [
        'category_id',
        'enoblecimento_id'
    ];

    public function Categories() {
        return $this->belongsTo('Ecograph\Category');
    }

}
