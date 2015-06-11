<?php

namespace Ecograph;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {

    protected $fillable = array('categories_image',
        'parent_id',
        'sort_order',
        'date_added',
        'last_modified'
    );
    protected $guarded = ['id'];

    public function CategoryProduct() {
        return $this->hasMany('Ecograph\CategoryProduct');
    }

    // public function product() {
    //     return $this->hasMany('Product');
    // }

    public function scopePai($query) {
        return $query->where('parent_id', '=', '0')->get();
    }

    public function scopeFilhos($query, $pai) {
        return $query->where('parent_id', '=', $pai)->get();
    }

    public function scopeDescendentes($query, $id_pai) {
        return $query->where('parent_id', '=', $id_pai);
    }

}
