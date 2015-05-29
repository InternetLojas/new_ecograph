<div class="grid fluid">
    <div class="span5">
    <div id="mensagem_correio"></div>
<div id="info_correio"></div>
<form id="correio" name="correio">
    <fieldset>
        <label>CEP</label>
        <div class="input-control text" data-role="input-control" >
            <input type="text" placeholder="Informe o cep" id="orc_cep" name="orc_cep">
            <input type="hidden" id="orc_peso_frete" name="orc_peso">
            <input type="hidden" name="_token" value="{!!csrf_token()!!}"/>
            <button type="button" class="btn-search" onclick="javascript:FreteOrcamento();"></button>
        </div>
    </fieldset>
</form>  

    </div>
    <div class="span7">
        <label></label>
<div  id="resultado" style="display:none">
    <div class="input-control radio default-style" data-role="input-control">
        <label>
            <input id="frete_pac" type="radio" value="" name="vl_frete" onclick="SetaFrete('PAC', 'frete_pac')" />
            <span class="check"></span>
            PAC: <span id="vl_pac" style="float:right"></span>
        </label>
    </div>
    <div class="input-control radio  default-style" data-role="input-control">
        <label>
            <input id="frete_sedex" type="radio" value="" name="vl_frete" onclick="SetaFrete('SEDEX', 'frete_sedex')" />
            <span class="check"></span>
            SEDEX: <span id="vl_sedex" style="float:right"></span>
        </label>
    </div>
    <label></label>
    <div class="input-control text" data-role="input-control" >
        Prazo para entrega através PAC: <b><span id="prazo_pac"></span></b><br>
        Prazo para entrega através SEDEX: <b><span id="prazo_sedex"></span></b>
    </div>
</div>
    </div>
</div>