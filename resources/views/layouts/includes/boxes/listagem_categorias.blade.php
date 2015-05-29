<nav class="sidebar compact">
    <ul class="">       
        <li class="title">
            <a href="{{ URL::to('produtos/') }}/{{$parent}}/{{ $filho }}/{{ URLAmigaveis::Slug(Fichas::nomeCategoria($parent),'-',true) }}.html" class="bullet_{{ Fichas::nomeCategoria($parent) }}">{{ Fichas::nomeCategoria($filho) }}</a>
        </li>
        @foreach ($categorias as $key=>$subs)
        <li class="">  
            <a href="{{ URL::to('produtos/detalhes') }}/{{$parent}}/{{$subs['id']}}/{{ URLAmigaveis::Slug(Fichas::nomeCategoria($subs['id']),'-',true) }}.html" title="Quero outra configuração para {{ Fichas::nomeCategoria($subs['id']) }}" class="noactive default filho bullet_{{ $subs['id'] }}">{{ Fichas::nomeCategoria($subs['id']) }}</a>
        </li>
        @endforeach
    </ul>
</nav>
