<style>
    .metro .endereco:before {
        content: "endereco";
    }
    .metro .envio:before {
        content: "envio";
    }
    .metro .produtos:before {
        content: "produtos";
    }
    .metro .pagamento:before {
        content: "pagamento";
    }
    .metro .ficha:before {
        content: "ficha";
    }
</style>
<h3 class="title-cadastro"><b>RESUMO DO PEDIDO</b></h3>
<div class="grid fluid">
    
    @include('layouts.includes.resumo.endereco')
    @include('layouts.includes.resumo.envio')
    @include('layouts.includes.resumo.produtos')
    @include('layouts.includes.resumo.pagamento')
    @include('layouts.includes.resumo.ficha')
</div>

