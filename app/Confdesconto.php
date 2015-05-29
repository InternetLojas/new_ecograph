<?php

namespace Ecograph;

use Illuminate\Database\Eloquent\Model;

class Confdesconto extends Model {

    // Add your validation rules here
    public static $rules = [
            // 'title' => 'required'
    ];
    // Don't forget to fill this array
    protected $fillable = [];

    public function desconto() {
        return $this->belongsTo('Descontoacrescimo');
    }

}
