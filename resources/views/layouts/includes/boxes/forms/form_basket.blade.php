{!! Form::open(array(
'method' => 'post',
'name'=>'basket',
'id'=>'basket',
'role' => 'Form')) !!}
    <div class="form-group text">
        @foreach($post_inputs as $key=>$valor)                                
        <input id="{{$key}}" type="hidden" value="{{$valor}}" name="{{$key}}" class="form-control">
        @endforeach
        <input id="produto_id" type="hidden" value="" name="produto_id" class="form-control">
    </div>
{!!Form::close()!!}