<?php

namespace Ecograph;

use Illuminate\Database\Eloquent\Model;

class Ordersituacao extends Model {
	protected $table = 'ordersituacaos';
    protected $fillable = [];

    public function scopeStatus($query, $class) {
        return $query->where('class', '=', $class)
                        ->where('status_name', 'like', '%Processando%');
    }

}
