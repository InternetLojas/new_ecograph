<?php namespace Ecograph;

use Illuminate\Database\Eloquent\Model;

class CustomerDiscount extends Model {

    protected $fillable = [
        'customer_id',
        'conf_descontos_code_id',
        'discount_order_id',
        'discount_nr_vezes'
    ];
    public function Customer(){
        return $this->belongsToMany('Ecograph\Customer');
    }
    public function ConfDesconto(){
        return $this->belongsToMany('Ecograph\ConfDesconto');
    }
}
