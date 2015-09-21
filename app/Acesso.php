<?php namespace Ecograph;

use Illuminate\Database\Eloquent\Model;

class Acesso extends Model {
    protected $fillable =[
        'customer_id',
        'number_of_logons',
        'admin',
        'permite_brinde'
    ];
    public function Customer() {
        return $this->BelongsTo('Ecograph\Customer');
    }
}
