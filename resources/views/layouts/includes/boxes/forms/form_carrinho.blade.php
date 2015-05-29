<form name="basket" id="basket" action="basket" method="post">    
    <table class="table striped bordered hovered">
        <thead>
            <tr>
                <th class="text-center span3">Image</th>
                <th class="text-center span3">Produto</th>
                <th class="text-center span2">Qtd</th> 
                <th class="text-center span2">Preço Un</th>
                <th class="text-center span2">Total</th>         
            </tr>
        </thead> 
        <tbody>
            @foreach ($contents as $produtos => $itens) 
                <tr>
                <td class="center span3">
                    <div class="image-cart">
                        <a class="" href="{{ URL::to('produtos/') }}/{{ $itens['id']}}/{{ URLAmigaveis::Slug(Fichas::nomeProduto($itens['id']),'-',true) }}.html" title="{{ $itens['name']}}">
                            {!! HTML::image('images/'.Fichas::ImgProduto($itens['id']), Fichas::ImgProduto($itens['id']), array('class'=>'img-cart','width'=>'100%')) !!}
                        </a>
                        <!--<div class="overlay-fluid">
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                        </div>-->
                    </div>
                </td>
                <td class="center span3 nome">
                    {!!$itens['name']!!}<br>
                    @foreach ($itens['options'] as $key=>$vl)
                    @if($key != 'categoria' && $key != 'categoria_id' && $key != 'formato_id' && $key != 'papel_id' && $key != 'acabamento_id' &&  $key != 'perfil' && $key != 'perfil_id')
                    <b class='fg-crimson'>{!! $key !!}</b> - {!! $vl !!}<br>
                    @endif
                    @endforeach
                </td>
                <td class="center span2">
                    {!! $itens['qty']!!}
                </td>
                <td class="center span2">{{ Utilidades::toReal($itens['price']) }}</td>
                <td class="center span2">{{ Utilidades::toReal($itens['price']*$itens['qty']) }}</td>
                </tr>            
            @endforeach
        </tbody>
    </table>
    @foreach($post_inputs as $key=>$valor)                                
    @if($key=='produto_id')
    <input id="{{$key}}" type="hidden" value="{{$valor}}" name="produto_id[]">
    @endif
    @endforeach
    <!--<div class="input-control checkbox">
        <label>
            <input type="checkbox" name="concorde" id=concorde"/>
            <span class="check"></span>
            Concordo com os itens
        </label>
    </div>-->                 

</form>