<?php namespace Ecograph;

use Illuminate\Database\Eloquent\Model;

class Acesso extends Model {
    protected $fillable =[
        'customer_id',
        'permite_brinde'
    ];

}
