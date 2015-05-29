<!-- / Ennavigation -->
<nav class="navigation-bar">
    <div class="navigation-bar-content"  style="background-color:{!!$layout['back_menu']!!}">
        <div class="element menu-top">
            <a class="pull-menu" href="#"></a>
            <ul class="element-menu">
                <li style="background-color:{{$layout['back_menu']}}">
                    <a class="fg-white @if($page=='home')active{!!$layout['style_a']!!} {{$layout['bullet']}}@endif {!!$layout['hoover_a']!!}" href="{!! URL::to('/') !!}" title ='Início'>
                        <span>Home</span>
                    </a>
                </li>
                <span class="element-divider"></span>
                <li style="background-color:{{$layout['back_menu']}}">
                    <a class="fg-white @if($page=='produtos' || $page=='detalhes' || $page=='listagem')active{!!$layout['style_a']!!} {!!$layout['bullet']!!}@endif {!!$layout['hoover_a']!!}" href="{{ URL::to('/produtos.html') }}" title ='Lista de produtos'>
                        <span>Produtos</span>
                    </a>
                </li>
                <!--<span class="element-divider"></span>
                <li style="background-color:{{$layout['back_menu']}}">
                    <a class="fg-white @if($page=='orcamentos')active{{$layout['style_a']}} {{$layout['bullet']}}@endif {{$layout['hoover_a']}}" href="{{ URL::to('/orcamentos.html') }}" title ='Faça seu orçamento'>
                        <span>Orçamentos</span>
                    </a>
                </li>-->
                <span class="element-divider"></span>
                <li style="background-color:{{$layout['back_menu']}}">
                    <a class="fg-white @if($page=='comocomprar')active{{$layout['style_a']}} {{$layout['bullet']}}@endif {{$layout['hoover_a']}}" href="{{ URL::to('/como-comprar.html') }}" title ='Como faço minhas compras'>
                        <span>Como comprar</span>
                    </a>
                </li>
                <span class="element-divider"></span>
                <li style="background-color:{{$layout['back_menu']}}">
                    <a class="fg-white @if($page=='brindes')active{{$layout['style_a']}} {{$layout['bullet']}}@endif {{$layout['hoover_a']}}" href="{{ URL::to('/brindes.html') }}" title ='Adquira brindes para presentear seus clientes'>
                        <span>Brindes</span>
                    </a>
                </li>
                <li class="divider"><span class="element-divider"></span></li>
                <span class="element-divider"></span>
                <li style="background-color:{{$layout['back_menu']}}">
                    <a class="dropdown-toggle fg-white @if($page=='informacao')active{{$layout['style_a']}} {{$layout['bullet']}}@endif {{$layout['hoover_a']}}" data-toggle="dropdown" href="javascript:void(0);" title="Sobre {{ STORE_NAME }}">
                        Informação </a>
                    <ul class="dropdown-menu inverse fg-black" data-role="dropdown">
                        <li><a class=" {{$layout['style_a']}}" href="{{ URL::to('/sobre.html') }}" title = 'Conheça nossa loja'>Sobre</a></li>                    
                        <li><a class=" {{$layout['style_a']}}" href="{{ URL::to('/entrega.html') }}" title = 'Política de entrega'>Entrega</a></li>
                        <li><a class=" {{$layout['style_a']}}" href="{{ URL::to('/politica.html') }}" title = 'Regras de uso'>Política de uso</a></li>
                        <li><a class=" {{$layout['style_a']}}" href="{{ URL::to('/testemunhos.html') }}" title = 'Saiba o que nossos clientes estão falando'>Testemunhos</a></li>
                        <li><a class=" {{$layout['style_a']}}" href="{{ URL::to('/videos.html') }}" title="Conheça mais sobre as ferramentas com os nossos vídeos">Vídeos</a></li>
                    </ul>
                </li>
                <span class="element-divider"></span>
                <li style="background-color:{{$layout['back_menu']}}">
                    <a href="{!!URL::to('/contato.html')!!}">Contato</a>
                </li>
            </ul>
        </div>
    </div>

</nav>
<!-- / End main navigation -->