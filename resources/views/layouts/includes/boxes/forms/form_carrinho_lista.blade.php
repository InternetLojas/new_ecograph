<div class="destaque_home">
        <div id="info_carrinho"></div>
    <table class="table striped bordered hovered">
        <thead>
            <tr>
                <th class="col-lg-3 col-md-2 col-xs-4 col-sm-4 span3">Image</th>
                <th class="col-lg-3 col-md-2 col-xs-4 col-sm-4 span3 nome">Produto</th>
                <th class="col-lg-2 col-md-2 col-xs-2 col-sm-4 span2">Qtd</th> 
                <th class="col-lg-2 col-md-2 col-xs-2 col-sm-4 span2">Preço Un</th>
                <th class="col-lg-2 col-md-2 col-xs-2 col-sm-4 span2">Total</th> 
            </tr>
        </thead> 
        <tbody>
            @foreach ($contents as $produtos => $itens) 
            {!!$itens[0]!!}       
            @endforeach
        </tbody>
    </table> 
    <form name="basket" id="basket" action="basket" method="post">  
        @foreach ($contents as $produtos => $itens) 
        <input id="{{$key}}" type="hidden" value="{{$itens[0]['id']}}" name="produto_id[]">
        @endforeach
    </form>
</div>