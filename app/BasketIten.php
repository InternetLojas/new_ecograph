<?php namespace Ecograph;

use Illuminate\Database\Eloquent\Model;

class BasketIten extends Model {

protected $table = 'basket_itens';
   public function Basket() {
        return $this->BelongsTo('Ecograph\Basket');
    }
}
