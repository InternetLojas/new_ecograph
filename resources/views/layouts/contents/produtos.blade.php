<!-- PRODUTOS -->
<div class="grid fluid">
    @foreach($category as $key=>$rows)
    @if($rows['id'] != 28)
    <div class="row">
        <div class="lista">
            <div class="span4">
            <div id="scrollbox{!!$key!!}" data-role="scrollbox{!!$key!!}" data-scroll="vertical">
                {!! HTML::image('images/'.$rows['categories_image'], $alt=$rows['categories_image'], $attributes = array('width'=>'100%')) !!}
            </div>
            </div>
            <div class="span6 centro-{!!Utilidades::Classe($rows['categories_image'])!!}">
            <div id="scrollbox{!!$key++!!}" data-role="scrollbox{!!$key++!!}" data-scroll="vertical">
               
                    {!!HTML::lista_categorias($rows['id']) !!}
      
       </div>
            </div>
            <div class="span2 {!!Utilidades::Classe($rows['categories_image'])!!}">
            <div id="scrollbox{!!$key++!!}" data-role="scrollbox{!!$key++!!}" data-scroll="vertical">
                <a class="btn_categoria center" style="height:100%" href="{{ URL::to('produtos/lista') }}/{{$rows['id']}}/{{ URLAmigaveis::Slug(Fichas::nomeCategoria($rows['id']),'-',true) }}.html" title="Conheça todos os produtos da categoria {{ Fichas::nomeCategoria($rows['id'])}}">ENTRAR</a>
            </div>
            </div>
        </div>
    </div>

    @endif
    @endforeach
</div>