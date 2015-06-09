<div class="">
            <div id="info_carrinho"></div>
        <div class="head_carrinho">
            <table class="table">
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
        </div>
    <div class="">



        <div class="content_carrinho">
            
            <div class="carrinho">
                <table class="">
                    <tbody> 
                        @foreach ($contents as $produtos => $itens) 
                        <tr>
                            <td>
                                <div class="col-cesta-title-img"></div>
                            </td>
                            <td class="">
                                <a class="" href="{{ URL::to('produtos/') }}/{{ $itens['id']}}/{{ URLAmigaveis::Slug(Fichas::nomeProduto($itens['id']),'-',true) }}.html" title="{{ $itens['name']}}">
                                    {!! HTML::image('images/'.Fichas::ImgProduto($itens['id']), Fichas::ImgProduto($itens['id']), array('class'=>'img-cart','width'=>'100%')) !!}
                                </a>
                            </td>
                            <td>
                                {!!$itens['name']!!}<br>
                                @foreach ($itens['options'] as $key=>$vl)
                                @if($key != 'categoria' && $key != 'categoria_id' && $key != 'formato_id' && $key != 'papel_id' && $key != 'acabamento_id' &&  $key != 'perfil' && $key != 'perfil_id')
                                <b class='fg-crimson'>{!! $key !!}</b> - {!! $vl !!}<br>
                                @endif
                                @endforeach
                            </td>
                            <td>
                                {!!$itens['qty']!!} - {!!$itens['options']['unidade']!!}
                            </td>
                            <td>{!! Utilidades::toReal($itens['price'])!!}</td>
                            <td>Frete</td>
                            <td>Desconto</td>
                            <td> 
                                <a href="javascript:void(0)" onclick="RemoverItem('{{ $itens['id'] }}')" title="Clique para remover o item do carrinho" class="btn bg-yellow fg-white no-radius"> 
                                    Remover
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<form name="basket" id="basket" action="basket" method="post">  
    @foreach ($contents as $produtos => $itens) 
    <input id="{{$key}}" type="hidden" value="{{$itens['id']}}" name="produto_id[]">
    @endforeach
</form>
