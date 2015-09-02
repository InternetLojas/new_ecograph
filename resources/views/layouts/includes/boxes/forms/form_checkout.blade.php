{!! Form::open(array(
'name'=>'formcheckout',
'id'=>'formcheckout')) !!}
<fieldset>                     
    <div class="control-group">
        <input type="hidden" name="id_pedido" id="id_pedido" value="">
        @foreach ($html as $key=>$vl)
        <input type="hidden" name="{{$key}}" id="{{$key}}" value="{{$vl}}" />
        @endforeach
    </div>
</fieldset>
{!!Form::close()!!}
