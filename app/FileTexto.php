<?php namespace Ecograph;

use Illuminate\Database\Eloquent\Model;

class FileTexto extends Model {

/**
    * Relationships
    */
    protected $fillable = ['file_id','nome_empresa','atividade','nome','cargo','cel1','cel2','fone1','fone2','end','cep','email','site','obs'];
    public function file()
    {
        return $this->belongsTo('Ecograph\File', 'file_id');
    }

}
