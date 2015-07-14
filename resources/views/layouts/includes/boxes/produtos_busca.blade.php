<!-- BUSCAS -->
@foreach(Utilidades::Agrupa($products, '4','busca') as $row)
<div class="row">
    @foreach($row as $key=>$item)
        <div class= "col-xs-3 col-sm-3 col-md-3 col-lg-3 span3">
            <div class="thumbnail border no-radius">
                <div class="text-center">
                    <div class="thumb_cat bg-transparent text-center">
                        <a class="img-preloader img-ficha" href="{{ URL::to('produtos/') }}/{{$item->id }}/{{ URLAmigaveis::Slug(Fichas::nomeProduto($item->id),'-',true) }}.html" title="{{ Fichas::nomeProduto($item->id) }}">
                            @if(Fichas::TrataImg($item->id))
                                {!! HTML::image('images/'.Fichas::ImgProduto($item->id), Fichas::ModelProduto($item->id), array('class'=>'img-responsive','width'=>'100%')) !!}
                            @else
                                {!! HTML::image('images/theme/naoencontrado.png', Fichas::ModelProduto($item->id), array('class'=>'img-responsive','width'=>'100%')) !!}
                            @endif
                        </a>
                        <p class="fg-dark">
                            {!!Fichas::nomeproduto($item->id)!!}
                        </p>
                        <a class="btn btn-success fg-white no-radius" href="{{ route('produtos.detalhes',
 ['pai'=>Fichas::idparentCategoria($item->id),
  'filho' =>Fichas::idCategoria($item->id),
  'nome_categoria' => URLAmigaveis::Slug(Fichas::nomeProduto($item->id),'-',true).'.html']) }}" title="{{ Fichas::nomeProduto($item->id) }}">
                            <i class="icon-cart on-left"></i>Comprar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    </div>
@endforeach