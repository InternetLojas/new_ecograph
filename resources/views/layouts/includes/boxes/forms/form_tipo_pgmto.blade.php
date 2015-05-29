<form name="tipo_pgmto" id="tipo_pgmto" class="form-horizontal">
    
    @foreach(array_chunk($gateways->toarray(), 4, 'busca') as $gateway)
    <div class="row">
        <div class="listview">
            @foreach($gateway as $key=>$valor)
            <div class="span3">
                <div class="input-control radio">
                    <label>
                        {!!HTML::image($valor['image'], $valor['title'], array('title'=>$valor['description'],'class'=>'gateway place-left')) !!}<br>
                        <span id="payment_id{{$valor['id']}}">{!!$valor['title']!!}</span> <input type="radio" name="payment" onclick="Desconto('{{$valor['id']}}','{{$cart_total}}')"/>
                        <span class="check place-right"></span>
                    </label>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endforeach

</form>
