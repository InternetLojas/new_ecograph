<?php

namespace Ecograph;

use Illuminate\Database\Eloquent\Model;

class Palco extends Model {

    protected $fillable = [];

    public function banner() {
        return $this->belongsTo('Banner');
    }

    public function scopePalcos($query, $banner_id) {
        return $query->where('banner_id', '=', $banner_id);
    }

}
