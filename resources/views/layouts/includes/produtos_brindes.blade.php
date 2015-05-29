@foreach(Utilidades::Agrupa($brindes, '3','busca') as $row)
<div class="row">
    @foreach($row as $palco=>$destaque)
    <div class="span4">                    
        <div class="thumb_cat bg-transparent text-center">
            <a href="#" class="thumbnail" title="Saiba mais sobre {!!Fichas::nomeCategoria($destaque['id'])!!}">
                <span class="img_destaque destaque{{ $destaque['id'] }}" style="background-image:url('{{URL::to('images/categorias/brindes/')}}/brinde{{ $destaque['id'] }}.jpg')"></span>
            </a>
            <div class="product-box">

                <a class="title-destaque" href="{{ URL::to('produtos/detalhes/') }}/{{$destaque['parent_id']}}/{{ $destaque['id'] }}/{{ URLAmigaveis::Slug(Fichas::nomeCategoria($destaque['id']),'-',true) }}.html" class="title-destaque" title="{!!Fichas::nomeCategoria($destaque['id'])!!}">
                    {!!Fichas::nomeCategoria($destaque['id'])!!}
                </a>  

            </div>
            {!!Fichas::infoCategoria($destaque['id'])!!}
        </div>
    </div>               
    @endforeach
</div>
@endforeach 