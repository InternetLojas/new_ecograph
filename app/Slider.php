<?php

namespace Ecograph;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model {

    protected $fillable = [];

    public function scopePromo($query, $palco_id) {
        return $query->where('palco_id', '=', $palco_id);
    }

}
