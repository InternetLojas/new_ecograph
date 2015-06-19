
@if (is_array($populares)) 

<div class="title_content">
    <h4>
        Na sua próxima visita não deixe de conferir 
        <small>nossos produtos campeõs de visita</small>
    </h4>
</div>
@foreach(Utilidades::Agrupa($populares, '4','busca') as $row)
<div class="row">
    @foreach($row as $key=>$product)
    <div class = "col-xs-3 col-sm-3 col-md-3 col-lg-3 span3">                 
        <div class="thumbnail border no-radius">
            <div class="text-center">
                <div class="thumb_cat bg-transparent text-center">
                    <a class="img-preloader img-ficha" href="{{ URL::to('produtos/') }}/{{ $product['id'] }}/{{ URLAmigaveis::Slug(Fichas::nomeProduto($product['id']),'-',true) }}.html" title="{{ Fichas::nomeProduto($product['id']) }}">
                        @if(Fichas::TrataImg($product['id']))
                        {!! HTML::image('images/'.Fichas::ImgProduto($product['id']), Fichas::ModelProduto($product['id']), array('class'=>'img-responsive','width'=>'100%')) !!}
                        @else
                        {!! HTML::image('images/theme/naoencontrado.png', Fichas::ModelProduto($product['id']), array('class'=>'lazy','width'=>'100%')) !!}
                        @endif
                    </a>
                    <p class="fg-dark">
                        {!!Fichas::nomeproduto($product['id'])!!}
                    </p>
                    <button type="button" onclick="AdicionarCarrinho('{{$product['id']}}');" class="btn btn-success fg-white no-radius" title="{{ Fichas::nomeProduto($product['id']) }}" id="{{$product['id']}}">
                        <i class="icon-cart on-left"></i>Comprar
                    </button>
                </div>
            </div>
        </div>
    </div>               
    @endforeach
</div>
@endforeach
@endif