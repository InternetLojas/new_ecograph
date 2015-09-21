<!--navigation -->
<!--<nav class="wrapper" role="navigation" >-->
<div class="navbar navbar-default navbar-static-top">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-ex-collapse">
            <span class="sr-only">Menu principal</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
    </div>
    <div class="collapse navbar-collapse" id="navbar-ex-collapse">
        <ul class="nav list-unstyled list-inline text-center text-nav">
            <li class="col-sm-1 col-md-1"></li>
            <li class="col-sm-2 col-md-2">
                <a class="fg-gray @if($page=='home')active @endif user" href="{{ route('index') }}" title ='Início'> <span>Home</span> </a>
            </li>
            <span class="element-divider hidden-xs section"></span>
            <li class="col-sm-2 col-md-2">
                <a class="fg-gray @if($page=='produtos' || $page=='detalhes' || $page=='listagem')active @endif user" href="{{ route('produtos') }}" title ='Lista de produtos'> <span>Produtos</span> </a>
            </li>
            <span class="element-divider hidden-xs section"></span>
            <li class="col-sm-2 col-md-2">
                <a class="fg-gray @if($page=='produtos' || $page=='detalhes' || $page=='listagem')active @endif user" href="{{ route('produtos.index') }}" title ='Todos os modelos'> <span>Portfolio</span> </a>
            </li>
            <span class="element-divider hidden-xs section"></span>
            <li class="col-sm-2 col-md-2">
                <a class="fg-gray @if($page=='comocomprar')active @endif user" href="{{ route('comocomprar') }}" title ='Como faço minhas compras'> <span>Como comprar</span> </a>
            </li>
            <span class="element-divider hidden-xs section"></span>
            <li class="col-sm-2 col-md-2">
                <a class="fg-gray @if($page=='produtos' || $page=='detalhes' || $page=='listagem')active @endif user" href="{{ route('contato') }}" title ='Nosso endereço'> <span>Faça contato</span> </a>
            </li>
            <li class="col-sm-2 col-md-1"></li>

            <!--<span class="element-divider-end"></span>
        <li class="">
            <a class="fg-gray @if($page=='produtos' || $page=='detalhes' || $page=='listagem')active @endif user href="{ URL::to('/revendedor.html') }" title ='Todos os modelos'> <span>Seja um Revendedor</span> </a>
        </li>-->
        </ul>
    </div>
</div>
<!--</nav>-->
