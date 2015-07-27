<!-- RESUMO-->
<!--============================== content =================================-->
<div class="title_pagina">
    <div class="icone_pagina">
        <img src="images/icons/icone-box-car.jpg" class="img-responsive pull-left" />
    </div>
    <div class="title_content">
        <h3><span class="text-medio">Loja:produto </span><br>Cesta de compras</h3>
    </div>
</div>
<div id="info_carrinho"></div>
<!--================= tabela dos produtos do carrinho ===================-->
@include('layouts.includes.carrinho.itens_carrinho')
@include('layouts.includes.boxes.forms.form_carrinho')
<!--================= informações sobre entrega ==========================-->
@include('layouts.includes.carrinho.info_endereco')
@if(is_array($post_inputs))
    @include('layouts.includes.carrinho.info_prazos')
    @include('layouts.includes.carrinho.info_cupom')
    @include('layouts.includes.carrinho.info_pagamento')
    {!!
    Form::open(
    array('route'=>('loja.validacaixa'),
    'method' => 'post',
    'id' => 'formresumo',
    'name' => 'formresumo',
    'class'=>'form-inline'))
    !!}
    <fieldset>
        <div class="control-group">
            @foreach($post_inputs as $key=>$valor)
                <input id="{{$key}}" type="hidden" value="{{$valor}}" name="{{$key}}" class="form-control">
            @endforeach
            <input type="hidden" name="order_id" id="order_id" value="2" />
            <input type="hidden" name="payment" id="payment" value="2" />
            <input type="hidden" name="forma_pagamento" id="forma_pagamento" value="Bcash" />
            <input type="hidden" name="total_compra" id="total_compra" value="{{Cart::total()+$post_inputs['orc_vl_frete']-$post_inputs['orc_desconto_valor']}}" />
            <input type="hidden" name="discount_cupom" id="discount_cupom" value="{{$post_inputs['orc_desconto_valor']}}" />
            <input type="hidden" name="frete" id="frete" value="{{ $post_inputs['orc_vl_frete'] }}" />
            <input type="hidden" name="tipo_frete" value="{{ $post_inputs['orc_tipo_frete'] }}" />
        </div>
    </fieldset>
    <div id="mensagem_formresumo"></div>
    <div id="info_formresumo"></div>
    {!!form::close()!!}

@include('layouts.includes.resumo.ficha_resumo')
@else
<div style="display:block;width:100%;padding:12px 0;height:5px;"></div>
 <div class="text-right">
                <a href="{{route('index')}}" data-original-title="Voltar para o início" title="Acrescentar mais produtos no carrinho" class="btn btn-lg bg-dark fg-white no-radius ">
                    <i class="icon-arrow-left icon-white"></i> Início
                </a>
            </div>
<div style="display:block;width:100%;padding:12px 0;height:5px;"></div>
@endif