<div class="user place-right">
	<div class="toolbar no-spaces">
		<!--acesso-->
		@if(!Auth::user())
		<a href="javascript:CriarConta('{{csrf_token()}}')" class="button bg-yellow fg-white botoes-topo" id="btn_tipo_conta" role="button" data-hint="Crie agora a sua conta"> <i class="icon-user fg-dark"></i> Cadastro </a>
		<a href="{{ URL::to('/clientes/login.html') }}" class="button bg-yellow fg-white botoes-topo" data-hint="Entre agora na sua conta"> <i class="icon-checkmark fg-dark"></i> Entrar </a>
		@else
		<a href="{{ URL::to('clientes/minha-conta.html')}}" class="button bg-yellow fg-white botoes-topo" data-hint="Informações sobre a minha conta" > <i class="icon-cabinet fg-dark"></i> Meus dados </a>
		<a href="{{ URL::to('/clientes/logout.html') }}" class="button bg-yellow fg-white botoes-topo" data-hint="Encerre a sessão com segurança" > <i class="icon-exit fg-dark"></i> Sair </a>
		@endif
               
		<!-- Carrinho -->
		@if(Cart::count()>0)
		<a href="{{ URL::to('/carrinho/lista.html') }}" class="button bg-yellow fg-white botoes-topo" data-hint="Saiba mais sobre seus produtos no carrinho"> <i class="icon-cart fg-dark"></i> {{Cart::count()}} item(s) - {{ Utilidades::toreal(Cart::total()) }} </a>
		@else
		<a href="javascript:Void(0)" class="button bg-yellow fg-white botoes-topo" data-hint="Seu carrinho está vazio"> <i class="icon-cart fg-dark"></i> {{Cart::count() }} item(s) </a>
		@endif
	</div>
	<p class="text-right">
		@if(Auth::user())
		Bem Vindo {!!Auth::user()->customers_firstname!!}
		@else
		Olá Visitante!
		@endif
	</p>
</div>