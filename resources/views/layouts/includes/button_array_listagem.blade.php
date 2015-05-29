<ul class="unstyled inline">
    <li > 
        <button type="button" onclick="AdicionarCarrinho('{{$product['id']}}');" class="warning fg-white small" title="{{ Fichas::nomeProduto($product['id']) }}" id="{{$product['id']}}">
            <i class="icon-cart on-left"></i>Carrinho
        </button>
    </li>
    <li>
        <button onclick="AdicionarEdicao('{{$product['id']}}','add_{{$product['id']}}')" id="add_{{$product['id']}}" title="Quero editar as informações desse modelo" class="button success fg-white small" data-url="{{ URL::to('edicao') }}/{{ URLAmigaveis::Slug(Fichas::nomeProduto($product['id']),'-',true) }}.html" data-produto-id = "{!!$product['id']!!}" data-perfil-id ="{!! $perfil['id'] !!}" data-user-id="{!!Auth::user()->id!!}">
            <i class="icon-pencil on-left"></i>Personalizar
        </button>     
    </li>
</ul>
