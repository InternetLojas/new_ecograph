<?php

namespace Ecograph;

use Illuminate\Database\Eloquent\Model;

class Descontoacrescimo extends Model {

    protected $table = 'descontoacrescimos';
    protected $fillable = array('title',
        'tipo',
        'description',
        'class',
        'status',
    );
    protected $guarded = ['id'];

    public function ConfDesconto() {
        return $this->hasMany('Ecograph\Confdesconto');
    }

    public function scopeId($query, $class) {
        return $query->where('class', $class);
    }

    public function scopeClasse($query, $class) {
        return $query->where('class', $class)
                        ->where('status', '1');
    }

    public function scopeAtivos($query) {
        return $query->where('status', '1');
    }

}
