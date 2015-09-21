<h1 class="heading1">
    <span class="maintext"> <i class="icon-thumbs-up"></i> Pagamento processado com êxito</span>
</h1>
<div class="container">
    <div class="row">
        <div class="well">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 span6">
                    {{ HTML::image('images/banners/box-sucesso.jpg', $alt='box-sucesso.jpg', array('width'=>'100%','title'=>'Sucesso.', 'id'=>'img-sucesso')) }}
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 span6">
                    @if($ativo == 'PagSeguro')
                        <ul>
                            <li>status: {{$info['status']}}</li>
                            <li>Método de pagamento: {{$info['paymentMethod']}}</li>
                            @if($info['paymentMethod']=='2')
                                <li>Link para imprimir o boleto: <a href="{{$info['entra']}}" title=Imprimir Boleto target="_blank">Imprimir Boleto</a></li>
                            @else
                                <li>Condições: Pagamento em {{$info['extra']}}</li>
                            @endif
                        </ul>
                    @endif
                    <p>
                        Se tiver <small><strong>algum</strong></small> questionamento sobre como realizar uma compra, por favor acesse <br>
                        <a href="{{ URL::to('home/contact_us/') }}" title="Contato"><i class="glyphicon glyphicon-envelope"></i> Contato</a>
                    </p>
                    <hr>
                    <p>
                        Um email foi enviado para informar os detalhes do seu pedido.<br>
                        Se não receber em até uma hora, por favor acesse <br>
                        <a href="{{ URL::to('home/contact_us/') }}" title="Contato">
                            <i class="icon-envelope"></i> Contato</a>
                    </p>
                    <p>
                        Outras informações você encontra na sua página personalizada.
                        <br>
                        Siga esses links:
                    </p>
                    <ul>
                        <li><a href="{{ URL::to('clientes/minhaconta/') }}" title="Tudo sobre sua conta"><span class="glyphicon glyphicon-pencil "></span> Minha Conta</a></li>
                        <li><a href="{{ URL::to('clientes/meusenderecos/') }}" title="Administre seus endereços"><span class="glyphicon glyphicon-tag "></span> Meus endereços</a></li>
                        <li><a href="{{ URL::to('clientes/meuspedidos/') }}" title="Saiba tudo sobre seus pedidos"><span class="glyphicon glyphicon-tags"></span> Meus pedidos</a></li>
                        <li><a href="{{ URL::to('clientes/carrinho/') }}" title="Administre o seu carrinho"><span class="glyphicon glyphicon-shopping-cart"></span> Meu carrinho</a></li>
                    </ul>

                    <p class="text-right">
                        Assim que seu pagamento for processado sua compra será enviada. <br>
                        O tempo de entrega depende do metódo de envio escolhido.
                    </p>
                    <h3>Aproveite e faça um comentário sobre seu pedido</h3>
                    <textarea rows="3" >Adicione um comentário...</textarea>
                    <p class="pull-right"> Obrigado por utilizar <em>{{STORE_NAME}}</em></p>
                    <div class="row mt10">
                        <a class="ajax btn btn-orange pull-right tooltip-test" data-original-title="Adicionar comentário" href="{{ URL::to('loja/comentario') }}/343" >Enviar comentário</a>
                    </div>
                    <a href="{{URL::to('/inicio')}}" data-original-title="Voltar para o início" title="Acrescentar mais produtos no carrinho" class="btn btn-orange pull-right" style="margin-right:5px">
                        <i class="icon-arrow-left icon-white"></i> Início
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

