<div class="banner">
    <div class="banner_left">
        <div id="carousel-ecograph" class="carousel slide" data-ride="carousel">
            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                @foreach($sliders as $k => $slider)
                    <div class="item @if($k==0) active @endif">
                        <a href="{{route('produtos.detalhes',['pai'=>Fichas::parentCategoria($slider['categories_id']),'filho'=>$slider['categories_id'],'nome'=>URLAmigaveis::slug(Ecograph\CategoryDescription::find($slider['categories_id'])->categories_name,'-',true).'.html'])}}" title="{{$slider['descricao']}}" >
                            {!! HTML::image($slider['img'], $alt="banner-cartao-gratis.png", $attributes = array('title'=>$slider['descricao'],'class'=>'img-responsive')) !!}
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="banner_right">
        {!! HTML::image('images/banners/produtos/banner-milhares.png', $alt="banner-milhares.png", $attributes = array('title'=>'Milhares de desenhos a sua disposição','class'=>'img-responsive')) !!}
    </div>
</div>
