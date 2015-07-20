<form name="tipo_pgmto" id="tipo_pgmto" class="form-horizontal">

    @foreach(array_chunk($gateways->toarray(), 4, 'busca') as $gateway)


        @foreach($gateway as $key=>$valor)
            <div class="col-md-3 ">
                <div class="form-group ">
                    <div class="thumbnail  no-radius">

                        <div class="thumb_cat bg-transparent text-center border">
                            <div class="col-md-8">
                                <label class="control-label text-medio" for="">
                                    {!!HTML::image($valor['image'], $valor['title'], array('title'=>$valor['description'],'class'=>'img-responsive','style' => 'height:27px')) !!}
                                </label>
                            </div>
                            <div class="col-md-4">

                                <input type="radio" name="payment" onclick="Desconto('{{$valor['id']}}','{{$cart_total}}')"/>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach


    @endforeach

</form>
