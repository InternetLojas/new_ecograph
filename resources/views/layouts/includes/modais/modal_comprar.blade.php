<div class="modal fade" id="modalAdicionando">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Parabéns - Item adicionado</h4>
            </div>
            <div class="modal-body">
                <div id="verificando_modalAdicionando" style="display:none;margin:auto;text-align: center">
                </div>
                @if(Cart::count()>0)
                <table class="table">
                    <thead>
                        <tr>
                            <th class="col-lg-4 col-md-3 col-xs-4 col-sm-4 span4">Image</th>
                            <th class="col-lg-2 col-md-3 col-xs-2 col-sm-2 span2">Qtd</th> 
                            <th class="col-lg-3 col-md-3 col-xs-3 col-sm-3 span3">Preço Un</th>
                            <th class="col-lg-3 col-md-3 col-xs-3 col-sm-3 span3">Total</th>      
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (Cart::content() as $product)
                        <tr>
                            <td>
                                {!! HTML::image('images/'.Fichas::ImgProduto($product->id), Fichas::nomeProduto($product->id), array('class'=>'img-car', 'width'=>'30%')) !!} 
                            </td>
                            <td>{{ $product->quantity }}&nbsp;x&nbsp;</td>
                            <td>
                                {!! Utilidades::toreal($product->price) !!}</p>
                            </td>
                            <td>{!! Utilidades::toReal($product->price*$product->quantity) !!}</td>
                        </tr> 
                        @endforeach
                        <tr>
                            <td></td>
                            <td></td>
                            <td>
                                <span class="extra bold totalamout">TOTAL :</span>
                            </td>
                            <td>
                                <span class="bold totalamout" id="totalgeral">{!! Utilidades::toreal(Cart::total()) !!}</span>
                            </td>
                        </tr>
                    </tbody>
                </table
                @else
                <p>Nenhum item no seu carrinho.</p>
                @endif
            </div>
            <div class="modal-footer">
                <a  class="btn bg-green fg-white no-radius" href="javascript:void()" title="Saiba mais sobre seus produtos no carrinho" onclick="BasketSubmeter();">
                    <i class="icon icon-ok"></i> Ver o Resumo
                </a>
            </div>
        </div>
    </div>
</div>