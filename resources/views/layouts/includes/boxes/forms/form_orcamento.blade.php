<form id="form_orcamento" name="form_orcamento" method="POST" >
    <fieldset>
        <label></label>
        <div class="input-control text" data-role="input-control" >
            <input id="orc_peso" type="hidden" value="" name="orc_peso">
            <input id="orc_vl_frete" type="hidden" value="" name="orc_vl_frete">
            <input id="orc_tipo_frete" type="hidden" value="" name="orc_tipo_frete">
            <input id="orc_categoria_id" type="hidden" value="" name="orc_categoria_id">
            <input id="orc_categoria_nome" type="hidden" value="" name="orc_categoria_nome">
            <input id="orc_subcategoria_id" type="hidden" value="" name="orc_subcategoria_id">
            <input id="orc_subcategoria_nome" type="hidden" value="" name="orc_subcategoria_nome">
            <input id="orc_formato_id" type="hidden" value="" name="orc_formato_id">
            <input id="orc_formato_nome" type="hidden" value="" name="orc_formato_nome">
            <input id="orc_cor_id" type="hidden" value="" name="orc_cor_id">
            <input id="orc_cor_nome" type="hidden" value="" name="orc_cor_nome">
            <input id="orc_papel_id" type="hidden" value="" name="orc_papel_id">
            <input id="orc_papel_nome" type="hidden" value="" name="orc_papel_nome">
            <input id="orc_acabamento_id" type="hidden" value="" name="orc_acabamento_id">
            <input id="orc_acabamento_nome" type="hidden" value="" name="orc_acabamento_nome"> 
            <input id="orc_enoblecimento_id" type="hidden" value="" name="orc_enoblecimento_id">
            <input id="orc_enoblecimento_nome" type="hidden" value="" name="orc_enoblecimento_nome">
            <input id="orc_pacote_qtd" type="hidden" value="" name="orc_pacote_qtd">
            <input id="orc_pacote_valor" type="hidden" value="" name="orc_pacote_valor">
            <!-- parte referente ao portifólio -->
            <input id="orc_id_perfil" type="hidden" value="" name="orc_id_perfil">
            <input id="orc_nome_perfil" type="hidden" value="" name="orc_nome_perfil">
            <input type="hidden" name="_token" value="{!!csrf_token()!!}"/>
        </div>
    </fieldset>
</form>   