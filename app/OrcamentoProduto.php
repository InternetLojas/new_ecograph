<?php namespace Ecograph;

use Illuminate\Database\Eloquent\Model;

class OrcamentoProduto extends Model {

	protected $fillable = [];
    protected $table = "orcamento_produto";
    protected $guarded = ["id"];

    public function Orcamento() {
        return $this->belongsTo('Ecograph\Orcamento', 'orcamento_id');
    }

    /*public function getTotalAttribute() {
        return $this->quantity * $this->price;
    }*/
}
