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
                                    <div id="frente_{{$item->id}}">
                                        {!! HTML::image('images/'.Fichas::ImgProduto($item->id), Fichas::ModelProduto($item->id), array('class'=>'img-responsive','width'=>'100%')) !!}
                                    </div>
                                    <div id="verso_{{$item->id}}" style="display: none">
                                        {!! HTML::image('images/'.Fichas::ImgProduto($item->id), Fichas::ModelProduto($item->id), array('class'=>'img-responsive','width'=>'100%')) !!}
                                    </div>
                                @else
                                    {!! HTML::image('images/theme/naoencontrado.png', Fichas::ModelProduto($item->id), array('class'=>'img-responsive','width'=>'100%')) !!}
                                @endif
                            </a>
                            <p class="fg-dark">
                                {!!Fichas::nomeproduto($item->id)!!}
                            </p>
                            <button type="button" onclick="FrenteVerso('{{$item->id}}');" class="btn bg-gray fg-white no-radius" title="Ver frente ou verso {{ Fichas::nomeProduto($item->id)}}" id="{{$item->id}}">
                                <span id="label_{{$item->id}}">Verso</span>
                            </button>
                            <a class="btn btn-success fg-white no-radius" href="produtos/detalhes/{!! Fichas::parentcategoria($category[$item->id])!!}/{!!$category[$item->id] !!}/{!!URLAmigaveis::Slug(Fichas::nomecategoria($category[$item->id]), '-', true)!!}.html" title="Clique para ver os detalhes desse produto" >
                                <span>Detalhes</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endforeach
