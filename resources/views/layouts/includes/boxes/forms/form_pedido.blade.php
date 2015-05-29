{!! Form::open(array(
'url'=> URL::to('loja/pedido'),
'method' => 'post',
'name'=>'formpedido',
'id'=>'formpedido')) !!}
<div id="mensagem_formpedido"></div>
<div id="info_formpedido"></div>
<fieldset>                     
    <div class="control-group">
        <input type="hidden" name="payment" id="payment" value="{{ $gateway }}" />
        <input type="hidden" name="total_compra" id="total_compra" value="{{$total_compra}}" />
        <input type="hidden" name="discount_cupom" id="discount_cupom" value="{{$discount_cupom}}" />
        <input type="hidden" name="vl_frete" id="vl_frete" value="{{ $vl_frete }}" />
        <input type="hidden" name="tipo_frete" id="tipo_frete" value="{{$tipo_frete}}" />
        <input type="hidden" name="_token" value="{{csrf_token()}}" />
    </div>
</fieldset>
{!!Form::close()!!} 