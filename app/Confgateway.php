<?php

namespace Ecograph;

use Illuminate\Database\Eloquent\Model;

class Confgateway extends Model {

    // Add your validation rules here
    public static $rules = [
            // 'title' => 'required'
    ];
    // Don't forget to fill this array
    protected $fillable = [];

    public function gateway() {
        return $this->belongsTo('Gateway');
    }

}
