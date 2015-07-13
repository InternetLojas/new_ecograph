<!--navigation -->
<nav class="wrapper" role="navigation" >
    <ul class="list-unstyled list-inline text-center text-medio">
        <li class="col-md-1"></li>
        <li class="col-md-2">
            <a class="fg-gray @if($page=='home')active @endif user" href="{{ route('index') }}" title ='Início'> <span>Home</span> </a>
        </li>
        <span class="element-divider"></span>
        <li class="col-md-2">
            <a class="fg-gray @if($page=='produtos' || $page=='detalhes' || $page=='listagem')active @endif user" href="{{ route('produtos') }}" title ='Lista de produtos'> <span>Produtos</span> </a>
        </li>
        <span class="element-divider"></span>
        <li class="col-md-2">
            <a class="fg-gray @if($page=='produtos' || $page=='detalhes' || $page=='listagem')active @endif user" href="{{ route('produtos.index') }}" title ='Todos os modelos'> <span>Portfolio</span> </a>
        </li>
        <span class="element-divider"></span>
        <li class="col-md-2">
            <a class="fg-gray @if($page=='comocomprar')active {{$layout['bullet']}}@endif user" href="{{ route('comocomprar') }}" title ='Como faço minhas compras'> <span>Como comprar</span> </a>
        </li>
        <span class="element-divider"></span>
        <li class="col-md-2">
            <a class="fg-gray @if($page=='produtos' || $page=='detalhes' || $page=='listagem')active @endif user" href="{{ route('orcamento') }}" title ='Lista de produtos'> <span>Orçamento Online</span> </a>
        </li>
        <li class="col-md-1"></li>
        <!--<span class="element-divider-end"></span>
        <li class="">
            <a class="fg-gray @if($page=='produtos' || $page=='detalhes' || $page=='listagem')active @endif user href="{{ URL::to('/revendedor.html') }}" title ='Todos os modelos'> <span>Seja um Revendedor</span> </a>
        </li>-->
    </ul>
</nav>