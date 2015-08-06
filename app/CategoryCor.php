<?php namespace Ecograph;

use Illuminate\Database\Eloquent\Model;

class CategoryCor extends Model {

    protected $table = 'category_cor';

    protected $fillable = [
        'category_id',
        'cor_id'
    ];

    public function Categories() {
        return $this->belongsTo('Ecograph\Category');
    }

    public function PacCor() {
        return $this->hasMany('Ecograph\Paccor');
    }
}
