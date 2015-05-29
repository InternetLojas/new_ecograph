<?php namespace Ecograph;

use Illuminate\Database\Eloquent\Model;

class File extends Model {

/**
    * Relationships
    */
    public function customer()
    {
        return $this->belongsTo('Ecograph\Customer', 'customer_id');
    }
    public function filetextos()
    {
        return $this->hasMany('Ecograph\FileTexto');
    }
     public function filemidias()
    {
        return $this->hasMany('Ecograph\FileMidia');
    }

}
