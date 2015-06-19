@if($page == 'vitrine')
<ul class="nav nav-stacked nav-tabs">
    @foreach($listagem as $key=>$item)
    <li>
        <a class="btn bg-fracogray fg-black nav-hz" href="produtos/detalhes/{!! Fichas::parentcategoria($item[0])!!}/{!!$item[0] !!}/{!!URLAmigaveis::Slug(Fichas::nomecategoria($item[0]), '-', true)!!}.html" title="Clique para ver os detalhes desse produto" >
            <div class="list-content">
                <span class="list-title">{!!$item[1]!!}</span>
            </div>
        </a>
    </li>
    @endforeach
</ul>
@else
<ul class="nav nav-stacked nav-tabs">
    @foreach($listagem as $key=>$item)
    <li>
        <a class="btn bg-fracogray fg-black nav-hz" href="javascript:Void()" onclick="Calculadora('{!! $item[0] !!}', '{!! $item[1] !!}')" title="Clique para ver os detalhes desse produto" >
            <div class="list-content">
                <span class="list-title">{!!$item[1]!!}</span>
            </div>
        </a>
    </li>
    @endforeach
</ul>
@endif