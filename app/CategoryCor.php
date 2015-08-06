<?php namespace Ecograph;

use Illuminate\Database\Eloquent\Model;

class CategoryCore extends Model {

    protected $table = 'category_cor';

    protected $fillable = [
        'category_id',
        'cor_id'
    ];

    public function Categories() {
        return $this->belongsTo('Ecograph\Category');
    }

    public function PacCore() {
        return $this->hasMany('Ecograph\Paccor');
    }
}
