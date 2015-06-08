
<form name="basket" id="basket" action="basket" method="post"> 
    <div class="form-group text">
        @foreach($post_inputs as $key=>$valor)                                
        <input id="{{$key}}" type="hidden" value="{{$valor}}" name="{{$key}}" class="form-control">
        @endforeach
        <input id="produto_id" type="hidden" value="" name="produto_id" class="form-control">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" class="form-control">
    </div>
</form>