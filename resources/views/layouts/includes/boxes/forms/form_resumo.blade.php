<div id="mensagem_resumo"></div>
<div id="info_resumo"></div>
{!! Form::open(array(
'url'=>'loja/resumo.html', 
'method' => 'post', 
'id' => 'resumo', 
'name' => 'resumo')) 
!!}
<fieldset>                     
    <div class="control-group">
        <input type="hidden" name="forma_pagamento" id="forma_pagamento" value="" />
        <input type="hidden" name="forma_pagamento_id" id="forma_pagamento_id" value="" />
        <input type="hidden" name="vl_discount_avista" id="vl_discount_avista" value="0" />
        <input type="hidden" name="discount_avista_id" id="discount_avista_id" value="0" />
        <input type="hidden" name="vl_frete_escolhido" id="vl_frete_escolhido" value="" />
        <input type="hidden" name="tipo_frete_escolhido" id="tipo_frete" value="" />
    </div>
</fieldset>

<button type="submit" data-original-title="Resumo" title="Verificar o resumo desse pedido" class=" large place-right bg-cyan" id="btn_resumo">
    <i class="icon-flag icon-white on-left"></i> Resumo
</button>
<a href="{{URL::to('/inicio')}}" data-original-title="Voltar para o início" title="Acrescentar mais produtos no carrinho" class="button btn-orange pull-right" style="margin-right:5px">
    <i class="icon-arrow-left icon-white"></i> Início
</a>  
{!!form::close()!!}