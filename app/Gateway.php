<?php

namespace Ecograph;

use Illuminate\Database\Eloquent\Model;

class Gateway extends Model {

    protected $table = 'gateways';
    protected $fillable = array('title',
        'description',
        'class',
        'status',
        'presentation_order',
        'image',
        'url'
    );
    protected $guarded = ['id'];

    public function confgateway() {
        return $this->hasMany('Ecograph\Confgateway');
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
