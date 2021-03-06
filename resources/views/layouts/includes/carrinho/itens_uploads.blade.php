@forelse($arq_filemidia as $midia)

    <div class="row">
        <h2>Logos para seu template</h2>

        @if(!empty($midia->logo1))
            <div class = "col-xs-12 col-sm-6 col-md-4 col-lg-4">
                <div class="thumbnail border no-radius">
                    <a>
                        {!! HTML::image('images/documentos/'.\Auth::user()->id.'/'.$midia->logo1, $midia->logo1, array('class'=>'img-responsive')) !!}
                    </a>
                    <p class="fg-dark text-center">Logo1</p>
                </div>
            </div>
        @endif
        @if(!empty($midia->logo2))
            <div class = "col-xs-12 col-sm-6 col-md-4 col-lg-4">
                <div class="thumbnail border no-radius">
                <a>
                    {!! HTML::image('images/documentos/'.\Auth::user()->id.'/'.$midia->logo2, $midia->logo2, array('class'=>'img-responsive')) !!}
                </a>
                    <p class="fg-dark text-center">Logo3</p>
            </div>
                </div>
        @endif
        @if(!empty($midia->logo3))
            <div class = "col-xs-12 col-sm-6 col-md-4 col-lg-4">
                <div class="thumbnail border no-radius">
                <a>
                    {!! HTML::image('images/documentos/'.\Auth::user()->id.'/'.$midia->logo3, $midia->logo3, array('class'=>'img-responsive')) !!}
                </a>
                    <p class="fg-dark text-center">Logo2</p>
            </div>
                </div>
        @endif
    </div>
@empty
@endforelse
<table class="head_carrinho text-medio">
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
                        <td class="text-medio options">
                            {!!$itens['name']!!}<br>
                            @foreach ($itens['options'] as $key=>$vl)
                                @if($key != 'categoria' && $key != 'categoria_id' && $key != 'formato_id' && $key != 'papel_id' && $key != 'acabamento_id' && $key != 'cor_id' && $key != 'enoblecimento_id' &&  $key != 'perfil' && $key != 'perfil_id')
                                    <b class='fg-crimson'>{!! $key !!}</b> - {!! $vl !!}<br>
                                @endif
                            @endforeach
                        </td>
                        <td class="text-medio">
                            {!!$itens['options']['unidade']!!}
                        </td>
                        <td class="text-medio">
                            {!! Utilidades::toReal($itens['price'])!!}
                        </td>
                        <td class="text-medio">
                            @if(is_array($post_inputs))
                                {!!Utilidades::toReal($post_inputs['orc_vl_frete'])!!}
                            @endif
                        </td>
                        <td class="text-medio">
                            @if(is_array($post_inputs))
                                {!!Utilidades::toReal($post_inputs['orc_desconto_valor'])!!}
                            @endif
                        </td>
                        <td class="text-medio">
                            @if(is_array($post_inputs))
                                {!!Utilidades::toReal(Cart::total()+$post_inputs['orc_vl_frete']-$post_inputs['orc_desconto_valor'])!!}
                            @endif
                        </td>
                        <td class="text-medio">
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