<?php

namespace Ecograph;

use Illuminate\Database\Eloquent\Model;

class CategoryProduct extends Model {

    protected $guarded = ['id'];

    public function Category() {
        return $this->BelongsTo('Ecograph\CategoryProduct');
    }


    public function Product() {
        return $this->BelongsTo('Ecograph\Product');
    }

    public function scopeCategoria($query, $k) {
        return $query->where('product_id', '=', $k)
                        ->take(1)->get();
    }

    public function scopeNrProdutos($query, $k) {
        return $query->where('category_id', '=', $k)
                        ->orderBy('product_id')
                        ->get();
    }


}
