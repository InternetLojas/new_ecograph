<?php

namespace Ecograph;

use Illuminate\Database\Eloquent\Model;

class OrderIten extends Model {

    protected $fillable = [];
    protected $table = "order_itens";
    protected $guarded = ["id"];

    public function Order() {
        return $this->belongsTo('Ecograph\Order', 'order_id');
    }

    public function getTotalAttribute() {
        return $this->quantity * $this->price;
    }

}
