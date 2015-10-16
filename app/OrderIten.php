<?php

namespace Ecograph;

use Illuminate\Database\Eloquent\Model;

class OrderIten extends Model {

    protected $fillable = [
        'order_id',
        'product_id ',
        'quantity',
        'product_name'	,
        'products_model ',
        'price',
        'final_price'
    ];
    protected $table = "order_itens";
    protected $guarded = ["id"];

    public function Order() {
        return $this->belongsTo('Ecograph\Order');
    }

    public function getTotalAttribute() {
        return $this->quantity * $this->price;
    }

}
