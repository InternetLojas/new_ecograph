<div class="modal fade" id="modalAdicionando">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="close_lightbox">&times;</button>
                <h4 class="modal-title">Parabéns - Item adicionado</h4>
            </div>
            <div class="modal-body">
                <div id="verificando_modalAdicionando" style="display:none;margin:auto;text-align: center">
                </div>
                <!-- Cart-->
                <div class="cart-info"> 
                    @if(Cart::totalItems()>0)
                    <table class="table table-condensed">
                        <thead>
                            <tr>
                                <th class="col-lg-4 col-md-3 col-xs-4 col-sm-4 span4">Image</th>
                                <th class="col-lg-2 col-md-3 col-xs-2 col-sm-2 span2">Qtd</th> 
                                <th class="col-lg-3 col-md-3 col-xs-3 col-sm-3 span3">Preço Un</th>
                                <th class="col-lg-3 col-md-3 col-xs-3 col-sm-3 span3">Total</th>         
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (Cart::contents() as $product) 
                            <tr>
                                <td>
                                    {{ HTML::image('images/'.$product->image, $product->name, array('class'=>'img-car', 'width'=>'30%')) }} 
                                </td>
                                <td>{{ $product->quantity }}&nbsp;x&nbsp;</td>
                                <td>
                                    {{ Utilidades::toreal($product->price) }}</p>
                                </td>
                                <td>{{ Utilidades::toReal($product->price*$product->quantity) }}</td>
                            </tr> 
                            @endforeach
                            <tr>
                            <td></td>
                            <td></td>
                            <td><span class="extra bold totalamout">TOTAL :</span></td>
                            <td><span class="bold totalamout" id="totalgeral">{{ Utilidades::toreal(Cart::total()) }}</span></td>
                            </tr>
                        </tbody>
                    </table>
                    @endif
                    <div id="mensagem_modalAdicionando"></div>
                    <div id="info_modalAdicionando"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" title="Quero escolher mais produtos" class="btn btn-fichas btn-green tooltip-test pull-left" data-dismiss="modal" id="hide_lightbox"><i class="icon icon-ok"></i> Continuar comprando</button>
                <a href="{{ URL::to('/carrinho/lista') }}" title="Saiba mais sobre seus produtos no carrinho" class="btn btn-fichas btn-dark tooltip-test pull-right"><i class="icon icon-pencil"></i> Ver o carrinho</a>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal --> 