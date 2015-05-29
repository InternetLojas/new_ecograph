<div class="row">
    <div class="example produtos" class="text-center">
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
                                {!! HTML::image('images/'.Fichas::ImgProduto($itens['id']), Fichas::nomeProduto($itens['id']), array('class'=>'img-cart','width'=>'100%')) !!}
                            </a>
   
                        </div>
                    </td>
                    <td class="center span3 nome">
                        {!!$itens['name']!!}<br>

                        @foreach ($cart[$itens['id']][0] as $key=>$vl)
                        @if($key != 'id' && $key != 'basket_id' && $key != 'created_at' && $key != 'updated_at')
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
    </div>
</div>