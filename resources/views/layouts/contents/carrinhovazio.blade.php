<!-- CARRINHO-->
<!--============================== content =================================-->
<div class="title_pagina">
    <div class="icone_pagina">
        <img src="images/icons/icone-box-car.jpg" class="img-responsive pull-left" />
    </div>
    <div class="title_content">                    
        <h3><span class="text-medio">Loja:produto</span><br>Seu carrinho está vazio</h3>
    </div>
</div>
<!-- Cart-->
<div class="row">
    <div class="col-md-8">
        <div class="panel ">
            
            <div class="panel-body">
                <h3>
                    Você ainda não possui nenum produto adicionado ao seu carrinho.<br>
                    Por favor! clique no botão "Escolher meus produtos" para navegar no nosso portfólio.<br><br>
                </h3>
                <a href="{{URL::to('produtos.html')}}" class="btn btn-lg bg-yellow fg-dark no-radius pull-right" title="Clique para efetuar a sua compra">
                    <i class="icon-info-sign icon-white"></i> Escolher meus produtos
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        {!! HTML::image('images/banners/box-cart-empty.jpg', $alt="Carrinho vazio", $attributes = array('width' => '100%', 'style'=>'max-width:600px;margin:auto;')) !!}
    </div>
</div>
