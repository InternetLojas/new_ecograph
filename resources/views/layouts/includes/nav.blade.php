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
    <div class="collapse navbar-collapse  col-lg-offset-1 col-md-offset-1 col-sm-offset-1" id="navbar-ex-collapse">
        <ul class="nav list-unstyled list-inline text-center text-nav top">
            <li class="col-lg-2 col-md-2 col-sm-2">
                <a class="fg-gray @if($page=='home')active @endif user" href="{{ route('index') }}" title ='Início'>
                   <span class="text-muted">Home</span>
                </a>
            </li>
            <span class="element-divider hidden-xs "></span>
            <li class="col-lg-2 col-md-2 col-sm-2 divider">
                <a class="fg-gray @if($page=='produtos' || $page=='detalhes' || $page=='listagem')active @endif user" href="{{ route('produtos') }}" title ='Lista de produtos'> <span>Produtos</span> </a>
            </li>
            <span class="element-divider hidden-xs "></span>
            <li class="col-lg-2 col-md-2 col-sm-2">
                <a class="fg-gray @if($page=='detalhes' || $page=='listagem')active @endif user" href="{{ route('produtos.index') }}" title ='Todos os modelos'> <span>Portfolio</span> </a>
            </li>
            <span class="element-divider hidden-xs "></span>
            <!--<li class="col-lg-2 col-md-2 col-sm-2">
                <a class="fg-gray @if($page=='comocomprar')active @endif user" href="{{ route('comocomprar') }}" title ='Como faço minhas compras'> <span>Como comprar</span> </a>
            </li>
            <span class="element-divider hidden-xs "></span>-->
            <li class="col-lg-2 col-md-2 col-sm-2">
                <a class="fg-gray @if($page=='orcamento')active @endif user" href="{{ route('orcamento.online') }}" title ='Orçamento'> <span>Orçamento</span> </a>
            </li>
            <span class="element-divider hidden-xs "></span>
            <li class="col-lg-2 col-md-2 col-sm-2">
                <a class="fg-gray @if($page=='contato')active @endif user" href="{{ route('contato') }}" title ='Nosso endereço'> <span>Contato</span> </a>
            </li>
        </ul>
    </div>
</div>
<!--</nav>-->
