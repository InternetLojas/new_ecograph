<?php

namespace Ecograph;

use Illuminate\Database\Eloquent\Model;

class Palco extends Model {

    protected $fillable = [
        'banner_id'
    ];

    public function banner() {
        return $this->belongsTo('Ecograph\Banner');
    }

    public function Slider() {
        return $this->hasMany('Ecograph\Slider');
    }

    public function scopePalcos($query, $banner_id) {
        return $query->where('banner_id', '=', $banner_id);
    }

}
