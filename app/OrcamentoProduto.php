<?php namespace Ecograph;

use Illuminate\Database\Eloquent\Model;

class OrcamentoProduto extends Model {

    protected $fillable = ['orcamento_id',
        'orc_peso',
        'orc_vl_frete',
        'orc_tipo_frete',
        'orc_categoria_nome',
        'orc_subcategoria_nome',
        'orc_formato_nome',
        'orc_cor_nome',
        'orc_papel_nome',
        'orc_acabamento_nome',
        'orc_enoblecimento_nome',
        'orc_pacote_qtd',
        'orc_pacote_valor',
        'orc_desconto_valor',
        'orc_nome_perfil'];

    protected $table = "orcamento_produtos";
    protected $guarded = ["id"];

    public function Orcamento() {
        return $this->belongsTo('Ecograph\Orcamento', 'orcamento_id');
    }

    /*public function getTotalAttribute() {
        return $this->quantity * $this->price;
    }*/
}
