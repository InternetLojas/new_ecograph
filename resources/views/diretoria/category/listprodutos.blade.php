@extends('diretoria.main_admin')
@section('content')
    <div class="container">
        if($category->name)
            <h1>Detalhes da categoria: </h1>
            <p></p>
            <h2>Produtos</h2>
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
                                    <button type="button" onclick="FrenteVerso('{{$product->id}}');" class="btn bg-gray fg-white no-radius" title="Ver frente ou verso" id="{{$product->id}}">
                                        <span id="label_{{$product->id}}">Verso</span>
                                    </button>
                                    <a href="javascript:FrenteVerso('{{$product->id}}" class="btn btn-primary"><span id="label_{{$product->id}}">Verso</span></a>
                                    <a href="#" class="btn btn-default">Detalhes</a>
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>

        endif
        <div class="clearfix"></div>
        <a href="#" class="btn btn-default  pull-right" title="retornar">Retornar</a>
            {!! $CategoryProduct->render() !!}
    </div>
@stop