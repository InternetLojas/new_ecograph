<?php

namespace Ecograph;

use Illuminate\Database\Eloquent\Model;

class OrderTotal extends Model {

    protected $table = "ordertotals";
    protected $guarded = ["id"];

    public function Order() {
        return $this->belongsTo('Ecograph\Order', 'order_id');
    }

}
