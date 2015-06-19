@foreach($perfis_produtos->items() as $key=> $row)
<div class = "col-xs-3 col-sm-3 col-md-3 col-lg-3 span3">
    <div class="thumbnail border no-radius">
        <div class="text-center">
            <div class="thumb_cat bg-transparent text-center">
                <a class="img-preloader img-ficha" href="{{ URL::to('produtos/') }}/{{$row['original']['id'] }}/{{ URLAmigaveis::Slug(Fichas::nomeProduto($row['original']['id']),'-',true) }}.html" title="{{ Fichas::nomeProduto($row['original']['id']) }}">
                    @if(Fichas::TrataImg($row['original']['id']))
                    {!! HTML::image('images/'.Fichas::ImgProduto($row['original']['id']), Fichas::ModelProduto($row['original']['id']), array('class'=>'lazy','width'=>'100%')) !!}
                    @else
                    {!! HTML::image('images/theme/naoencontrado.png', Fichas::ModelProduto($row['original']['id']), array('class'=>'lazy','width'=>'100%')) !!}
                    @endif
                </a>
                <p class="fg-dark">
                    {!!Fichas::nomeproduto($row['original']['id'])!!}
                </p>
                <button type="button" onclick="AdicionaItemCarrinho('{{$row['original']['id']}}');" class="btn btn-success fg-white no-radius" title="{{ Fichas::nomeProduto($row['original']['id']) }}" id="{{$row['original']['id']}}">
                    <i class="icon-cart on-left"></i>Comprar
                </button>
            </div>
        </div>
    </div>
</div>
@endforeach