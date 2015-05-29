
<form name="basket" id="basket" action="basket" method="post">                                
    @foreach($post_inputs as $key=>$valor)                                
    <input id="{{$key}}" type="hidden" value="{{$valor}}" name="{{$key}}">
    @endforeach
    <!--<div class="input-control checkbox">
        <label>
            <input type="checkbox" name="concorde" id=concorde"/>
            <span class="check"></span>
            Concordo com os itens
        </label>
    </div>-->
    <div class="input-control text">
        <input id="produto_id" type="hidden" value="" name="produto_id">
    </div>

</form>