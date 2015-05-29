<?php

namespace Ecograph;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model {

    protected $fillable = array('banner_title',
        'banner_group',
        'banner_ativo'
    );
    protected $guarded = ['id'];
    protected $table = 'banners';

    public function palco() {
        return $this->hasMany('Palco');
    }

    public function scopeAtivo($query, $group) {
        return $query->where('banner_ativo', '=', '1')
                        ->where('banner_group', '=', $group);
    }

}
