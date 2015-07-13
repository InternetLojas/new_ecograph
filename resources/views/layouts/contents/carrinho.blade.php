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
    array('url'=>URL::to('loja/validacaixa'),
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
            <input type="hidden" name="forma_pagamento" id="forma_pagamento" value="Bcash" />
            <input type="hidden" name="payment" id="payment"  value="2" />
            <input type="hidden" name="discount_cupom" id="discount_cupom" value="0" />
            <input type="hidden" name="vl_frete" id="vl_frete" value="{{$post_inputs['orc_vl_frete']}}" />
            <input type="hidden" name="total_compra" id="total_compra" value="{{Cart::total()+$post_inputs['orc_vl_frete']-$post_inputs['orc_desconto_valor']}}" />
            <input type="hidden" name="tipo_frete" id="tipo_frete" value="{{$post_inputs['orc_tipo_frete']}}" />
        </div>
    </fieldset>
    <div id="mensagem_formresumo"></div>
    <div id="info_formresumo"></div>
    <!-- CONCORDE DAS REGRAS-->
    <div class="panel panel-danger">
        <div class="panel-heading">
            <h3 class="panel-title">
                        <span class="main-text">
                            <i class="icon-check"></i> Concorde.
                        </span>
            </h3>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <div class="col-lg-12 col-md-12 col-xs-8 col-sm-8">
                    <label>Estou ciente das informações acima e concordo com esse resumo.
                        <input type="checkbox" name="agree" id="agree" class="form-control" checked>
                    </label>
                    <span id="concorde" class="red" style="display:none"><strong>Verifique</strong></span>
                </div>
                <!--<div id="mensagem_cadastro"></div>
                <div id="info_cadastro"></div>-->
            </div>
        </div>
    </div>
    <div class="row">
        <button type="button" data-original-title="Ir para o caixa" title="Efetuar o pagamento" class="btn btn-red pull-right tooltip-test" id="btn_resumo">
            <i class="icon-ok-circle icon-white"></i> Caixa
        </button>
        <a href="{{route('index')}}" data-original-title="Voltar para o início" title="Acrescentar mais produtos no carrinho" class="btn bg-dark fg-white no-radius pull-right" style="margin-right:5px">
            <i class="icon-arrow-left icon-white"></i> Início
        </a>
    </div>
    {!!form::close()!!}
@else
    <div class="row">
        <a href="{{URL::route('index')}}" data-original-title="Voltar para o início" title="Acrescentar mais produtos no carrinho" class="btn bg-dark fg-white no-radius pull-right" >
            <i class="icon-arrow-left icon-white"></i> Início
        </a>
    </div>
@endif





