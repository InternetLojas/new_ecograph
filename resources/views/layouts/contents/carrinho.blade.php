<!-- CARINHO-->
<div class="title_pagina">
    <div class="icone_pagina">
        <img src="images/icons/icone-box-car.jpg" width="100%" alt="" />
    </div>
    <div class="title_content">
        @include('layouts.includes.boxes.breadcrumbs')
        <h3>Carrinho</h3>
    </div>
</div>
<div class="clearfix"></div>
<div class="row">
    <style>
        .metro .carrinho:before {
            content: "carrinho";
        }
        .metro .frete:before {
            content: "frete";
        }
        .metro .pagamento:before {
            content: "pagamento";
        }
    </style>
    <div class="example carrinho">
        @include('layouts.includes.boxes.forms.form_carrinho')
    </div>
</div>
<div class="row">
    <div id="info_frete"></div>
    <h2><i class="icon-shipping on-left"></i> Calcule <small class="on-right"> o frete</small></h2>
    <div class="example frete">
        @include('layouts.includes.boxes.forms.form_frete')
    </div>
</div>
<div class="row">
    <!--cupom-->
    <div id="desconto" style="display:none">
        <div id="info_cupom"></div>
        <div id="mensagem_cupom"></div>
        <style>
            .metro .desconto:before {
                content: "desconto";
            }
        </style>
        <h2><i class="icon-shipping on-left"></i> Sensacional <small class="on-right"> desconto</small></h2>
        <div class="example desconto">
            @include('layouts.includes.boxes.forms.form_desconto')
        </div>
    </div>
</div>
<div class="row">
    <div id="formas_pagamento" style="display:none">
        <div id="info_pgmto"></div>
        <h2><i class="icon-coins on-left"></i> Escolha como <small class="on-right"> pagar</small></h2>
        <div class="example pagamento">
            <!--Painel com as formas de pagamento disponíveis-->
            @include('layouts.includes.boxes.forms.form_tipo_pgmto')
        </div>
    </div>
</div>
<div class="row">
    @include('layouts.includes.boxes.resumo_valores_carrinho')
</div>
<div class="row">
    @include('layouts.includes.boxes.forms.form_resumo')
</div>