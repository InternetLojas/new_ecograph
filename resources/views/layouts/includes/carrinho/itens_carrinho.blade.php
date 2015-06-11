<table class="head_carrinho">
    <tbody>
        <tr>
            <td class="col-cesta-title">
                <span class="cesta_title fg-white">
                    Produto
                </span>
            </td>
            <td>Imagem</td>
            <td>Descrição</td>
            <td>Qtd</td>
            <td>Valor</td>
            <td>Frete</td>
            <td>Desconto</td>
            <td>Total</td>
            <td></td>
        </tr>
    </tbody>
</table>
<table class="body_carrinho">
    <tbody>
        <tr>
            <td class="col-cesta-img">
                <div class="col-cesta-title-img"></div>
            </td>
            <td class="td-content-carrinho">
                @foreach ($contents as $produtos => $itens) 
                <table class="items">
                    <tbody>
                        <tr>
                            <td class="vinte"></td>
                            <td>
                                <a class="" href="{{ URL::to('produtos/') }}/{{ $itens['id']}}/{{ URLAmigaveis::Slug(Fichas::nomeProduto($itens['id']),'-',true) }}.html" title="{{ $itens['name']}}">
                                    {!! HTML::image('images/'.Fichas::ImgProduto($itens['id']), Fichas::ImgProduto($itens['id']), array('class'=>'img-cart','width'=>'100%')) !!}
                                </a>
                            </td>
                            <td class="text-medio">
                                {!!$itens['name']!!}<br>
                                @foreach ($itens['options'] as $key=>$vl)
                                @if($key != 'categoria' && $key != 'categoria_id' && $key != 'formato_id' && $key != 'papel_id' && $key != 'acabamento_id' &&  $key != 'perfil' && $key != 'perfil_id')
                                <b class='fg-crimson'>{!! $key !!}</b> - {!! $vl !!}<br>
                                @endif
                                @endforeach
                            </td>
                            <td>
                                {!!$itens['options']['unidade']!!}
                            </td>
                            <td>
                                {!! Utilidades::toReal($itens['price'])!!}
                            </td>
                            <td>Frete</td>
                            <td>Desconto</td>
                            <td>Total</td>
                            <td>
                                <a href="javascript:void(0)" onclick="RemoverItem('{{ $itens['id'] }}')" title="Clique para remover o item do carrinho" class="btn bg-yellow fg-white no-radius"> 
                                    Remover
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <hr>
                @endforeach
            </td>
        </tr>
    </tbody>
</table>