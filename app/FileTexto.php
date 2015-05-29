<?php namespace Ecograph;

use Illuminate\Database\Eloquent\Model;

class FileTexto extends Model {

/**
    * Relationships
    */
    public function file()
    {
        return $this->belongsTo('Ecograph\File', 'file_id');
    }

}
