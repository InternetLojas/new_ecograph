<?php namespace Ecograph;

use Illuminate\Database\Eloquent\Model;

class FileMidia extends Model {
    protected $fillable = ['logo1','logo2','logo3', 'img1','img2','img3'];
/**
    * Relationships
    */
    public function file()
    {
        return $this->belongsTo('Ecograph\File', 'file_id');
    }
 

}
