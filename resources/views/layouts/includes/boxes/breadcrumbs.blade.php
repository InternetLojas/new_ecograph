<!--  breadcrumb -->
<nav class="breadcrumb">
    <ol class="">
        <li>
            <a href="{!! URL::to('inicio') !!}" >{!!Fichas::nomeCategoria($parent)!!}</a>
            <span class="divider"> >> </span>
        </li>
        <li class="active">
            <a href="" >{!!$ativo!!}</a>
            <span class="divider"> >> </span>
        </li>
        <li>{!! $perfil !!}</li>
    </ol>
</nav>