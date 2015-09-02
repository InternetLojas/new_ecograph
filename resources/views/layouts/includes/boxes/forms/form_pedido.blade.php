{!! Form::open(array(
'route'=> 'loja.pedido',
'method' => 'post',
'name'=>'formpedido',
'id'=>'formpedido')) !!}
<fieldset>                     
    <div class="control-group">
        <input id="id_payment" type="hidden" value="2" name="id_payment">
        <input type="hidden" name="payment" id="payment" value="{{ $gateway }}" />
        <input type="hidden" name="total_compra" id="total_compra" value="{{$total_compra}}" />
        <input type="hidden" name="discount_cupom" id="discount_cupom" value="{{$discount_cupom}}" />
        <input type="hidden" name="vl_frete" id="vl_frete" value="{{ $vl_frete }}" />
        <input type="hidden" name="tipo_frete" id="tipo_frete" value="{{$tipo_frete}}" />
    </div>
</fieldset>
{!!Form::close()!!} 