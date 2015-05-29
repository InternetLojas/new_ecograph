<div class="grid">
    <div class="row">
        <nav class="navigation-bar dark text-center">
            <nav class="navigation-bar-content">

                <item class="element text-center umterco">
                    Total de Resultados: {!!$total!!}
                </item>
                <item class="element text-center umterco">
                    De 1 até {!!count($products)!!} [{!!\Request::get('page')!!}]
                </item>
                <item class="element text-center umterco">
                    Alterar layout:
                    <i class="icon-list on-left"></i><a class="activedefault" href="advanced_search_result.php?busca=acougue&filtro=" > Lista</a>
                    <i class="icon-grid on-left"></i><a href="advanced_search_result.php?busca=acougue&filtro=" > Coluna</a>
                </item>
            </nav>
        </nav>
    </div>
</div>
@foreach(Utilidades::Agrupa($products, '3','busca') as $row)
<div class="row">
    @foreach($row as $key=>$product)
    <div class="umterco">                    
        <div class="thumb_cat bg-transparent text-center">
            <a class="img-preloader img-ficha" href="{{ URL::to('produtos/') }}/{{ $product['id'] }}/{{ URLAmigaveis::Slug(Fichas::nomeProduto($product['id']),'-',true) }}.html" title="{{ Fichas::nomeProduto($product['id']) }}">
                @if(Fichas::TrataImg($product['id']))
                {!! HTML::image('images/'.Fichas::ImgProduto($product['id']), Fichas::ModelProduto($product['id']), array('class'=>'lazy','width'=>'100%')) !!}
                @else
                {!! HTML::image('images/theme/naoencontrado.png', Fichas::ModelProduto($product['id']), array('class'=>'lazy','width'=>'100%')) !!}
                @endif
            </a>
            <div class="product-box">
                @include('layouts.includes.button_array_listagem')
            </div>
        </div>
    </div>               
    @endforeach
</div>
@endforeach 