<!-- RESUMO-->
<!--============================== content =================================-->
<div class="title_pagina">
    <div class="icone_pagina">
        <img src="images/icons/icone-box-car.jpg" class="img-responsive pull-left" />
    </div>
    <div class="title_content">
        <h3><span class="text-medio">Loja:produto</span><br>Cesta de compras</h3>
    </div>
</div>
<div id="info_carrinho"></div>
<!--================= tabela dos produtos do carrinho ===================-->
@include('layouts.includes.carrinho.itens_carrinho')
@include('layouts.includes.boxes.forms.form_carrinho')
<!--================= informações sobre entrega ==========================-->
@include('layouts.includes.carrinho.info_endereco')






