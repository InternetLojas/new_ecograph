<ul class="list-inline list-unstiled">
    <!--acesso-->
    @if(!Auth::user())
    <li class="col-xs-4 text-center">
        <i class="fa lg fa-fw fa-user pull-left"></i>
        <a href="#ModalConta" role="button" data-toggle="modal" title="Crie agora a sua conta" class="fg-gray"><span >Cadastro</span> </a>
    </li>
    <li class="col-xs-4 text-center">
        <i class="fa lg fa-fw icon-checkmark pull-left"></i>
        <a href="{{ URL::to('/clientes/login.html') }}" data-hint="Entre agora na sua conta"  class="fg-gray"><span class="">Entrar</span> </a>
    </li>
    @else
    <li class="col-xs-4 text-center">
        <a href="{{ URL::to('clientes/minha-conta.html')}}" data-hint="Informações sobre a minha conta"  class="fg-gray"><i class="icon-cabinet fg-dark"></i> Meus dados </a>
    </li>
    <div class="col-xs-4 text-center">
        <a href="{{ URL::to('/clientes/logout.html') }}" class="button bg-yellow fg-white botoes-topo" data-hint="Encerre a sessão com segurança"  class="fg-gray"><i class="fa lg fa-fw icon-exit"></i> <span class="">Sair</span> </a>
    </div>
    @endif

    <!-- Carrinho -->
    @if(Cart::count()>0)
    <li class="col-xs-4 text-center">
        <i class="fa lg icon-cart pull-left"></i>
        <a href="{{ URL::to('/carrinho/lista.html') }}" data-hint="Saiba mais sobre seus produtos no carrinho"  class="fg-gray"><span class="">{{Cart::count()}} item(s) - {{ Utilidades::toreal(Cart::total()) }}</span></a>
    </li>
    @else
    <li class="col-xs-4 text-center">
        <i class="fa lg icon-cart pull-left"></i>
        <a href="javascript:Void(0)" data-hint="Seu carrinho está vazio"  class="fg-gray"> <span class=""> Vazio</span> </a>
    </li>
    @endif
</ul>
<!--
<div class="clearfix"></div>
<p class="text-right">
        @if(Auth::user())
        Bem Vindo {!!Auth::user()->customers_firstname!!}
        @else
        Olá Visitante!
        @endif
</p>-->
