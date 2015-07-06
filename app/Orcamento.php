<?php namespace Ecograph;

use Illuminate\Database\Eloquent\Model;

class Orcamento extends Model {

    protected $table = "orcamentos";
    protected $guarded = ["id"];
    protected $fillable = ['customer_id',
        'file_id',
        'orcamento_status'];

    public function Customer() {
        return $this->belongsTo('Ecograph\Customer', 'customer_id');
    }

    public function OrcamentoProduto() {
        return $this->hasMany('Ecograph\OrcamentoProduto');
    }
    /*
        public function OrderTotal() {
            return $this->hasMany('Ecograph\OrderTotal');
        }

        public function getTotalAttribute() {
            $total = 0;

            foreach ($this->orderItens as $orderItem) {
                $total += $orderItem->price * $orderItem->quantity;
            }

            return $total;
        }*/

}
