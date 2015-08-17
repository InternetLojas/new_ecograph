<?php

namespace Ecograph;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {

    protected $fillable = array('categories_image',
        'parent_id',
        'sort_order',
        'date_added',
        'last_modified'
    );
    protected $guarded = ['id'];

    public function CategoryProduct() {
        return $this->hasMany('Ecograph\CategoryProduct');
    }

    public function Pacotes() {
        return $this->hasMany('Ecograph\Pacote');
    }
    public function Formato(){
        return $this->belongsToMany('Ecograph\Formato');
    }
    public function Papel(){
        return $this->belongsToMany('Ecograph\Papel');
    }
    public function Cor(){
        return $this->belongsToMany('Ecograph\Cor');
    }
    public function Acabamento(){
        return $this->belongsToMany('Ecograph\Acabamento');
    }
    public function CategoryFormato(){
        return $this->hasMany('Ecograph\CategoryFormato');
    }
    public function CategoryPapel(){
        return $this->hasMany('Ecograph\CategoryPapel');
    }
    public function CategoryCor(){
        return $this->hasMany('Ecograph\CategoryCor');
    }
    public function CategoryAcabamento(){
        return $this->hasMany('Ecograph\CategoryAcabamento');
    }
    /*public function Enoblecimento(){
        return $this->belongsToMany('Ecograph\Enoblecimento');
    }*/


    public function scopePai($query) {
        return $query->where('parent_id', '=', '0')->get();
    }

    public function scopeFilhos($query, $pai) {
        return $query->where('parent_id', '=', $pai)->get();
    }

    public function scopeDescendentes($query, $id_pai) {
        return $query->where('parent_id', '=', $id_pai);
    }

}
