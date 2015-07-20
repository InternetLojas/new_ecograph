<?php

namespace Ecograph;

use Illuminate\Database\Eloquent\Model;

class OrderTotal extends Model {

    protected $table = "ordertotals";
    protected $guarded = ["id"];
    protected $filleable = [
        'oreder_id',
        'title',
        'text',
        'value'
    ];
    public function Order() {
        return $this->belongsTo('Ecograph\Order');
    }

}
