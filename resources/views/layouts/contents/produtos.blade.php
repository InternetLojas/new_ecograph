<!-- PRODUTOS -->
@foreach ($array_categ as $key => $categorias)
<div class = "row">
    @foreach ($categorias as $item)
        <div class = "col-xs-12 col-sm-6 col-md-3 col-lg-3">
        <div class="thumbnail bg-very-smallgray">
            <div class="text-center">
                <span class="badge fg-black position-top text-medio">{!!Fichas::nomecategoria($item['id'])!!}</span>
            </div>
            <a title="Detalhes para a categoria {!!Fichas::nomecategoria($item['id'])!!}" id="{!!$item['id']!!}" href="produtos/detalhes/{!! Fichas::parentcategoria($item['id'])!!}/{!!$item['id'] !!}/{!!URLAmigaveis::Slug(Fichas::nomecategoria($item['id']), '-', true)!!}.html">
                <img alt="{!!$item['categories_image']!!}" title = "{!!Fichas::nomecategoria($item['id'])!!}" src = "images/{!!$item['categories_image']!!}">
            </a>
        </div>
    </div>
    @endforeach
</div>
@endforeach