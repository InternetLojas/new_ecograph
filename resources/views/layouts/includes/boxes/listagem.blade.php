<div id="info_listagem"></div>
@foreach($perfis_produtos->items() as $key=> $row)
<div class = "col-xs-12 col-sm-6 col-md-3 col-lg-3">
    <div class="thumbnail border no-radius">
        <div class="text-center">
            <div class="thumb_cat bg-transparent text-center">
                <a class="img-preloader img-ficha" href="{{ URL::to('produtos/') }}/{{$row['original']['id'] }}/{{ URLAmigaveis::Slug(Fichas::nomeProduto($row['original']['id']),'-',true) }}.html" title="{{ Fichas::nomeProduto($row['original']['id']) }}">
                    @if(Fichas::TrataImg($row['original']['id']))
                        <div id="frente_{{$row['original']['id']}}">
                            {!! HTML::image('images/'.Fichas::ImgProduto($row['original']['id']), Fichas::ModelProduto($row['original']['id']), array('class'=>'lazy','width'=>'100%')) !!}
                        </div>
                        <div id="verso_{{$row['original']['id']}}" style="display: none">
                            {!! HTML::image('images/'.Fichas::ImgProduto($row['original']['id'],true), Fichas::ModelProduto($row['original']['id']), array('class'=>'lazy','width'=>'100%')) !!}
                        </div>
                    @else
                    {!! HTML::image('images/theme/naoencontrado.png', Fichas::ModelProduto($row['original']['id']), array('class'=>'lazy','width'=>'100%')) !!}
                    @endif
                </a>
                <p class="fg-dark">
                    {!!Fichas::nomeproduto($row['original']['id'])!!}
                </p>
                <button type="button" onclick="FrenteVerso('{{$row['original']['id']}}');" class="btn bg-gray fg-white no-radius" title="Ver frente ou verso {{ Fichas::nomeProduto($row['original']['id']) }}" id="{{$row['original']['id']}}">
                    <span id="label_{{$row['original']['id']}}">Verso</span>
                </button>
                <!--<button type="button" onclick="Comprar('$row['original']['id']}}');" class="btn btn-success fg-white no-radius" title="Comprar  Fichas::nomeProduto($row['original']['id']) }}" id="$row['original']['id']}}">
                    <i class="icon-cart on-left"></i>Comprar
                </button>-->
                <button type="button" onclick="Editar('{{$row['original']['id']}}');" class="btn btn-success fg-white no-radius" title="Editar {{ Fichas::nomeProduto($row['original']['id']) }}" id="{{$row['original']['id']}}">
                    Editar
                </button>
            </div>
        </div>
    </div>
</div>
@endforeach