@foreach(Utilidades::Agrupa($products, '4','busca') as $row)
<div class="row">
    <article>
        @foreach($row as $key=>$product)
        <div class="span3">
            <div class="listview">
                <div class="thumb_cat bg-transparent text-center">
                    <a class="img-preloader img-ficha" href="{{ URL::to('produtos/') }}/{{ $product['id'] }}/{{ URLAmigaveis::Slug(Fichas::nomeProduto($product['id']),'-',true) }}.html" title="{{ Fichas::nomeProduto($product['id']) }}"> @if(Fichas::TrataImg($product['id']))
                        {!! HTML::image('images/'.Fichas::ImgProduto($product['id']), Fichas::ModelProduto($product['id']), array('class'=>'lazy','width'=>'100%')) !!}
                        @else
                        {!! HTML::image('images/theme/naoencontrado.png', Fichas::ModelProduto($product['id']), array('class'=>'lazy','width'=>'100%')) !!}
                        @endif </a>
                    <div class="product-box body">
                        <ul class="unstyled inline">
                            <li>
                                <a href="produtos/detalhes/1/5/{{ URLAmigaveis::Slug(Fichas::nomeProduto($product['id']),'-',true) }}.html" class="button warning fg-white small" title="{{ Fichas::nomeProduto($product['id']) }}"> <i class="icon-cart on-left"></i>{!!Fichas::nomeProduto($product['id'])!!} </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </article>
</div>
@endforeach