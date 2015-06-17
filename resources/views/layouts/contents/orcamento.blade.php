<!--============================== content =================================-->
<div id="orc_offline"></div>
<form name="orc_offline" id="orc_offline" method="post" action="orcamento-offline.html" enctype="multipart/form-data" role="form">              
    <div class="destaque_home_orcamento">
        <p class="bg-smallgray fg-white text-center" >
            Selecione o produto abaixo.
        </p>
        <div class="destaque_home_orcamento">
            {!!HTML::orcamento_categorias()!!}
        </div>
        <p class="bg-smallgray fg-white text-center" >
            Quantidade.
        </p>
        <p class="text-center text-medio"><small>Digite a quantidade desejada. Você pode escolher até 5 quantidades diferentes</small></p>
        <p class="bg-smallgray fg-white text-center" >
            Formato.
        </p>
        <p class="text-center text-medio"><small>Digite o formato. Você pode escolher até 2 formatos diferentes</small></p>
        <p class="bg-smallgray fg-white text-center" >
            Cores.
        </p>
        <p class="bg-smallgray fg-white text-center" >
            Acabamentos.
        </p>
        <p class="bg-smallgray fg-white text-center" >
            Prova de cor.
        </p>
        <p class="bg-smallgray fg-white text-center" >
            Entrega.
        </p>
    </div>
</form>

