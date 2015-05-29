<section id="aguarde">
    <div class="jumbotron">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 span6">
                    <h2>
                        Aguarde! Estamos redirecionando para o sistema de pagamento SOLICITADO!
                        <span class="icon-arrow-right hidden-xs hidden-sm pull-right"></span>
                    </h2>
                    <p class="lead">
                        Quando a janela abrir siga as instruções contidas na página.
                    </p>                        
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 span6">
                    {{ HTML::image('images/banners/box-acessando.jpg', $alt='box-acessando.jpg', array('width'=>'100%','title'=>'Acessando área segura.')) }}
                </div>
            </div>
        </div>
    </div>
</section>
<section id="gifanimada" style="display:none">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 span12">
            {{ HTML::image('img/preloading.gif', $alt='preloading.gif', array('style'=>'style="display:block;width:100%; max-width:128px; margin:auto"', 'title'=>'Aguarde enquanto estamos redirecionando seu pedido.')) }}
        </div>
    </div>
</section>
<section> 
    <div id="overlay-bcash" style="display: none" >
        <div class="container">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading text-center ">
                        <span class="icon-arrow-down"></span> Faça o pagamento com segurança!
                    </div>
                    <div class="panel-body">
                        <div id="lightbox">
                            <div id="gateway_frame"> </div>
                        </div>
                        @if($gateway=='Boleto')
                        <br>
                        <div class="row">
                            <a href="{{ URL::to('loja/finalizacao/sucesso/'.$gateway) }}" class="btn btn-orange pull-right" title="Clique para retornar para loja">
                                <i class="icon icon-ok-sign"></i>Retornar para loja
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if($gateway=='DepositoBancario')
    <div class="container">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading text-center ">
                    <span class="icon-arrow-down"></span> Faça o pagamento com segurança!
                </div>
                <div class="panel-body">
                    <div id="depositobancario" style="display: none" >
                        <h4><b>ATENÇÃO</b></h4>
                        <p>VALIDADE DO PEDIDO: 10 DIAS. APÓS ESTE PRAZO O MESMO SERÁ AUTOMATICAMENTE CANCELADO.<br>
                        <p>SOLICITAMOS ACONFIRMAÇÃO DO SEU PAGAMENTO POR MEIO DA NOSSA CENTRAL DE ATENDIMENTO:</p>
                        {{HTML::deposito(Session::get('deposito'))}}
                        <ul class="list-unstyled">
                            <li> - MS (67) 3521-4704 </li>
                            <li> - SP (11) 2626-3882 </li>
                            <li> - RJ (21) 3005-9146 </li>
                            <li> - MG (31) 2626-1017 </li>
                            <li> - PR (41) 2626-9013 </li>
                        </ul>
                    </div>
                    <br>
                    <div class="row">
                        <a href="{{ URL::to('loja/finalizacao/sucesso/'.$gateway) }}" class="btn btn-orange pull-right" title="Clique para retornar para loja">
                            <i class="icon icon-ok-sign"></i>Retornar para loja
                        </a>
                    </div>

                </div>                        
            </div>
        </div>
    </div>
    @endif
</section>