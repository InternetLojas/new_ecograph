<div id="mensagem_formresumo"></div>
<div id="info_formresumo"></div>
{!! Form::open(array(
'url'=>route('loja.process'),
'method' => 'post',
'id' => 'formresumo', 
'name' => 'formresumo')) !!}
<input type="hidden" name="payment" id="payment" value="{!!$gateway['id']!!}" />
<input type="hidden" name="total_compra" id="total_compra" value="{{Cart::total()+$vl_frete-$vl_desconto_avista}}" />
<input type="hidden" name="discount_cupom" id="discount_cupom" value="{!!$vl_desconto_avista!!}" />
<input type="hidden" name="frete" id="frete" value="{{ $vl_frete }}" />
<input type="hidden" name="tipo_frete" value="{{ $tipo_frete }}" />
<input type="hidden" name="_token" value="{{csrf_token()}}" />
<div class="row">
    <label class="fg-red"><i class="icon-checkmark on-left"></i> <strong>Estou ciente das informações acima e concordo com esse resumo.</strong>
        <input type="checkbox" name="agree" id="agree" class="form-control" checked>
    </label>     
</div>
<div class="place-right">

    <button type="button" id="btn_resumo" data-hind="Resumo" class="large bg-dark fg-white" >
        <i class="icon icon-flag icon-white"></i> ir para o caixa
    </button>
    <a href="{{URL::to('/inicio')}}" title="Acrescentar mais produtos no carrinho" class="button default large" style="margin-right:5px"> <i class="icon icon-arrow-left icon-white"></i> Início </a>
</div>
{!! Form::close() !!}