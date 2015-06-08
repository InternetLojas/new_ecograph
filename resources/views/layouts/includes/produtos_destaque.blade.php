@foreach(Utilidades::Agrupa(Banners::ativos('1'), '4','busca') as $row)
<div class="row">
    @foreach($row as $palco=>$destaque)
    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 span3">                    
        <div class="thumb_cat thumbnail bg-transparent text-center">
            <a href="#" class="thumbnail" title="Saiba mais sobre {{ $destaque['categories_name'] }}">
                <span class="img_destaque destaque{{ $destaque['id_img'] }}" style="background-image:url('{{URL::to('images/banners/destaques/')}}/destaque-00{{ $destaque['id_img'] }}.jpg')"></span>
            </a>
            <div class="product-box">
                <a class="title-destaque" title="{{ $destaque['categories_name'] }}" href="{{ URL::to('produtos/detalhes/') }}/{{$destaque['parent_id']}}/{{ $destaque['category_id'] }}/{{ URLAmigaveis::Slug($destaque['categories_name'],'-',true) }}.html" >
                    {!!$destaque['categories_name'] !!}
                </a>
            </div>
            <div style="padding-left:25px">
                {!!($destaque['categories_info']) !!}
            </div>
        </div>
    </div>               
    @endforeach
</div>
@endforeach 
