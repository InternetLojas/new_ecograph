<div class="destaque_home">
        <div id="info_carrinho"></div>
    <table class="table striped bordered hovered">
        <thead>
            <tr>
                <th class="col-lg-3 col-md-2 col-xs-4 col-sm-4 span3">Image</th>
                <th class="col-lg-3 col-md-2 col-xs-4 col-sm-4 span3 nome">Produto</th>
                <th class="col-lg-2 col-md-2 col-xs-2 col-sm-4 span2">Qtd</th> 
                <th class="col-lg-2 col-md-2 col-xs-2 col-sm-4 span2">Preço Un</th>
                <th class="col-lg-2 col-md-2 col-xs-2 col-sm-4 span2">Total</th> 
            </tr>
        </thead> 
        <tbody>
            @foreach ($contents as $produtos => $itens) 
            <tr>
                <td class="col-lg-3 col-md-2 col-xs-4 col-sm-4 span3 image">
                    <div class="image-cart">
                        <a class="" href="{{ URL::to('produtos/') }}/{{ $itens['id']}}/{{ URLAmigaveis::Slug(Fichas::nomeProduto($itens['id']),'-',true) }}.html" title="{{ $itens['name']}}">
                            {!! HTML::image('images/'.Fichas::ImgProduto($itens['id']), Fichas::ImgProduto($itens['id']), array('class'=>'img-cart','width'=>'100%')) !!}
                        </a>
                    </div>
                </td>
                <td class="col-lg-3 col-md-2 col-xs-4 col-sm-4 span3 nome">
                    {!!$itens['name']!!}<br>
                    @foreach ($itens['options'] as $key=>$vl)
                    @if($key != 'categoria' && $key != 'categoria_id' && $key != 'formato_id' && $key != 'papel_id' && $key != 'acabamento_id' &&  $key != 'perfil' && $key != 'perfil_id')
                    <b class='fg-crimson'>{!! $key !!}</b> - {!! $vl !!}<br>
                    @endif
                    @endforeach
                </td>
                <td class="col-lg-2 col-md-2 col-xs-2 col-sm-4 span2">                   
                    {!! Form::open(array(
                    'url'=>'carrinho/remover', 
                    'method' => 'get', 
                    'class'=>'form',
                    'id'=>'quantidade'.$itens['id'], 
                    'name'=>'quantidade'.$itens['id'])) !!}                    
                    <div class="row">
                        {!! Form::text('quantity',$itens['qty'], array('id' => $itens['id'],'class'=>'col-md-6')) !!} 
                        <a href="javascript:void(0);" onclick="AtualizarCarrinho('{{ $itens['id'] }}')" title="Clique para atualizar a quantidade" class="col-md-3"> 
                            <i class="fa fa-1x fa-fw -circle fa-refresh"></i> 
                        </a>
                        <a href="javascript:void(0)" onclick="RemoverItem('{{ $itens['id'] }}')" title="Clique para remover o item do carrinho" class="col-md-3"> 
                            <i class="fa fa-1x fa-fw fa-minus-circle"></i>
                        </a>
                    </div>
                    {!! Form::hidden('product_id',$itens['id'])!!} 
                    {!! Form::close() !!}
                </td>
                <td class="col-lg-2 col-md-2 col-xs-2 col-sm-4 span2">{{ Utilidades::toReal($itens['price']) }}</td>
                <td class="col-lg-2 col-md-2 col-xs-2 col-sm-4 span2">{{ Utilidades::toReal($itens['price']*$itens['qty']) }}</td>
            </tr>            
            @endforeach
        </tbody>
    </table> 
    <form name="basket" id="basket" action="basket" method="post">  
        @foreach ($contents as $produtos => $itens) 
        <input id="{{$key}}" type="hidden" value="{{$itens['id']}}" name="produto_id[]">
        @endforeach
    </form>
</div>