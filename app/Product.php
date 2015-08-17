<?php namespace Ecograph;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {
//
    protected $fillable = array('categories_image',
        'products_quantity',
        'products_model',
        'products_image',
        'products_status',
        'products_price',
        'products_date_added',
        'products_last_modified',
        'products_date_available',
        'products_ordered'
    );
    public function CategoryProduct() {
        return $this->hasMany('Ecograph\CategoryProduct');
    }
    public function ProdutoPerfil() {
        return $this->belongsTo('Ecograph\ProdutoPerfil');
    }
}
