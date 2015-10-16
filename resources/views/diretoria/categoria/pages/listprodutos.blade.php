<section class="content">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Detalhes da categoria {!!$description->categories_name!!}</h3>
                </div><!-- /.box-header -->
                <div class="box-body">

                    <h4>Produtos</h4>
                    <div class="row">


                        @foreach($CategoryProduct as $product)
                            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                <div class="thumbnail">
                                    @if(Fichas::TrataImg($product->id))
                                        <div id="frente_{{$product->id}}">
                                            {!! HTML::image('images/'.$product->Product->products_image, Fichas::ModelProduto($product->id), array('class'=>'lazy','width'=>'100%')) !!}
                                        </div>
                                        <div id="verso_{{$product->id}}" style="display: none">

                                        </div>
                                    @else
                                        {!! HTML::image('images/theme/naoencontrado.png', Fichas::ModelProduto($product->id), array('class'=>'lazy','width'=>'100%')) !!}
                                    @endif
                                    <div class="caption">
                                        <h3>{!!$product->products_name!!}</h3>
                                        <p>
                                            {!!$product->Product->products_image!!}<br>

                                        </p>
                                        <p>

                                            <a href="javascript:FrenteVerso('{{$product->id}}" class="btn bg-green btn-flat margin"><span id="label_{{$product->id}}">Verso</span></a>

                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach


                    </div>
                </div>
                <div class="box-footer">

                </div>
            </div>
        </div>

    </div>
    <div class="row">
        {!! $CategoryProduct->render() !!}
    </div>
</section>




