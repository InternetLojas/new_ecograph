<!-- CARINHO-->
<div class="title_content">
    include('layouts.includes.boxes.breadcrumbs')
    <h1>
        <img src="images/icons/icone-box-car.jpg" class="img-responsive" />
        Seu - 
        <small>carrinho</small>
    </h1>
</div> 
@include('layouts.includes.boxes.forms.form_carrinho')
<div class="row">
    <div id="info_frete"></div>
    <h2><i class="icon-shipping on-left"></i> Calcule <small class="on-right"> o frete</small></h2>
    <div class="example frete">
        @include('layouts.includes.boxes.forms.form_frete')
    </div>
</div>
<!--cupom-->
<div id="desconto" style="display:none">
    <div class="row">
        <div id="info_cupom"></div>
        <div id="mensagem_cupom"></div>
        <h2>
            <i class="icon-shipping on-left"></i> Sensacional <small class="on-right"> desconto</small>
        </h2>                        
        @include('layouts.includes.boxes.forms.form_desconto')
    </div>
</div>
<div id="formas_pagamento" style="display:none">
    <div class="row">
        <div id="info_pgmto"></div>
        <h2>
            <i class="icon-coins on-left"></i> Escolha como <small class="on-right"> pagar</small>
        </h2>
        <!--Painel com as formas de pagamento disponíveis-->
        @include('layouts.includes.boxes.forms.form_tipo_pgmto')
    </div>
</div>
<div class="row">
    @include('layouts.includes.boxes.resumo_valores_carrinho')
</div>
<div class="row">
    @include('layouts.includes.boxes.forms.form_resumo')
</div>

