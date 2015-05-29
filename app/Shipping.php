<?php

namespace Ecograph;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model {

    protected $fillable = array('title',
        'description',
        'class',
        'status',
        'presentation_order',
        'url'
    );
    protected $guarded = ['id'];

    public function Confshipping() {
        return $this->hasMany('Ecograph\Confshipping');
    }

    public function scopeId($query, $class) {
        return $query->where('class', '=', $class);
    }

    public function scopeClass($query, $class) {
        return $query->where('class', '=', $class);
    }

    public function scopeAtivos($query) {
        return $query->where('status', '=', '1');
    }

}
