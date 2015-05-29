
@if (is_array($populares))  
<div class="ribbed-cyan">
            <div class="padding20 fg-dark text-center subtitle">
Na sua próxima visita conheça esses produtos.
</div>
</div>
@foreach(Utilidades::Agrupa($populares, '4','busca') as $row)
<div class="row">
    @foreach($row as $key=>$product)
    <div class="span3">                    
        <div class="thumb_cat bg-transparent text-center">
            <a class="img-preloader img-ficha" href="{{ URL::to('produtos/') }}/{{ $product['id'] }}/{{ URLAmigaveis::Slug(Fichas::nomeProduto($product['id']),'-',true) }}.html" title="{{ Fichas::nomeProduto($product['id']) }}">
                @if(Fichas::TrataImg($product['id']))
                {!! HTML::image('images/'.Fichas::ImgProduto($product['id']), Fichas::ModelProduto($product['id']), array('class'=>'lazy','width'=>'100%')) !!}
                @else
                {!! HTML::image('images/theme/naoencontrado.png', Fichas::ModelProduto($product['id']), array('class'=>'lazy','width'=>'100%')) !!}
                @endif
            </a>
            <!--<div class="product-box">
                include('layouts.includes.button_array_listagem')
            </div>-->
        </div>
    </div>               
    @endforeach
</div>
@endforeach
   @endif
