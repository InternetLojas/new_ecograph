<?php

namespace Ecograph;

use Illuminate\Database\Eloquent\Model;

class Confshipping extends Model {

    public function Shipping() {
        return $this->belongsTo('Ecograph\Shipping');
    }

    public function scopeDetalhes($query, $shipping_key) {
        return $query->where('shipping_title', 'like', $shipping_key);
    }

}
