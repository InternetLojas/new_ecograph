<?php namespace Ecograph;

use Illuminate\Database\Eloquent\Model;

class BasketIten extends Model {

    protected $table = 'basket_itens';

    protected $fillable = [
        'basket_id',
        'formato_id',
        'papel_id',
        'acabamento_id',
        'pacote_id',
        'cor_id',
        'enoblecimento_id'
    ];
    public function Basket() {
        return $this->BelongsTo('Ecograph\Basket');
    }
}
