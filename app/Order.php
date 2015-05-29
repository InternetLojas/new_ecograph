<?php

namespace Ecograph;

use Illuminate\Database\Eloquent\Model;

class Order extends Model {

    protected $table = "orders";
    protected $guarded = ["id"];

    public function Customer() {
        return $this->belongsTo('Ecograph\Customer', 'customer_id');
    }

    public function OrderItem() {
        return $this->hasMany('Ecograph\OrderIten');
    }

    public function OrderTotal() {
        return $this->hasMany('Ecograph\OrderTotal');
    }

    public function getTotalAttribute() {
        $total = 0;

        foreach ($this->orderItens as $orderItem) {
            $total += $orderItem->price * $orderItem->quantity;
        }

        return $total;
    }

}
