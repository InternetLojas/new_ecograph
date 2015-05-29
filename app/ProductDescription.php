<?php namespace Ecograph;

use Illuminate\Database\Eloquent\Model;

class ProductDescription extends Model {

 protected $fillable = array('products_name',
        'products_description',
        'products_url',
        'products_viewed'
    );
    protected $guarded = ['id'];

    public function Product() {
        return $this->hasOne('Ecograph/Product');
    }

    public function scopePopular($query, $take = 8) {
        $popular = $query->where('products_viewed', '>', '0')
                ->take($take)
                ->orderBy('products_viewed', 'DESC')
                ->get();
        //echo "<pre>";print_r($popular->toarray());exit;
        return $popular->toarray();
    }

}
