<?php

namespace Ecograph;

use Illuminate\Database\Eloquent\Model;

class Basket extends Model {

    protected $table = 'basketes';
    protected $fillable = [
        'customer_id',
        'products_id',
        'products_model',
        'quantity',
        'final_price'
    ];
    protected $guarded = array('id');

    /**
     * Deletes a blog post and all
     * the associated comments.
     *
     * @return bool
     */
    public function delete() {
        // Delete the comments
        //$this->comments()->delete();
        // Delete the basket
        return parent::delete();
    }

    /* Relationships
    */
    public function Customer()
    {
        return $this->belongsTo('Ecograph\Customer');
    }

     public function BasketIten() {
        return $this->HasMany('Ecograph\BasketIten');
    }

    public function scopeProdutosnacesta($query, $customer_id) {
        return $query->where('customer_id', '=', $customer_id);
    }

    public function scopeProdutoigualnacesta($query, $customer_id, $product_id) {
        return $query->where('customer_id', '=', $customer_id)
                        ->where('product_id', '=', $product_id);
    }

}
