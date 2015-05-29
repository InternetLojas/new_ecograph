<?php

namespace Ecograph;

use Illuminate\Database\Eloquent\Model;

class OrderSituacao extends Model {

    protected $fillable = [];

    public function scopeStatus($query, $class) {
        return $query->where('class', '=', $class)
                        ->where('status_name', 'like', '%Processando%');
    }

}
