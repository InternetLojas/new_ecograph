<?php

namespace Ecograph;

use Illuminate\Database\Eloquent\Model;

class Order extends Model {

    protected $table = "orders";
    protected $fillable = [
        'customer_id',
        'customers_name',
        'customers_company',
        'customers_nr_rua',
        'customers_street_address',
        'customers_comp_ref',
        'customers_suburb',
        'customers_city',
        'customers_postcode',
        'customers_state',
        'customers_state_code',
        'customers_country',
        'customers_ddd',
        'customers_telephone',
        'customers_email_address',
        'customers_cpf_cnpj',
        'customers_pf_pj',
        'customers_rg_ie',
        'customers_ip_address',
        'delivery_name',
        'delivery_company',
        'delivery_nr_rua',
        'delivery_street_address',
        'delivery_comp_ref',
        'delivery_suburb',
        'delivery_city',
        'delivery_postcode',
        'delivery_state',
        'delivery_state_code',
        'delivery_country',
        'billing_name',
        'billing_company',
        'billing_nr_rua',
        'billing_street_address',
        'billing_comp_ref',
        'billing_suburb',
        'billing_city',
        'billing_postcode',
        'billing_state',
        'billing_state_code',
        'billing_country',
        'payment_method',
        'currency',
        'currency_value',
        'orders_status'
    ];
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
