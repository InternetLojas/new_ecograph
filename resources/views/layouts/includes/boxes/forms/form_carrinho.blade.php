<form name="basket" id="basket" action="basket" method="post">  
    @foreach ($contents as $key => $itens) 
    <input id="{{$key}}" type="hidden" value="{{$itens['id']}}" name="produto_id[]">
    @endforeach
</form>
