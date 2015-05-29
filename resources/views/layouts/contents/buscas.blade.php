<style>
    .metro .example {
        margin: 0 15px;
    }
    .metro .resultado:before {
        content: "resultados";
    }
</style>
<h3 class="title-cadastro"><b>PESQUISA</b></h3>
<div class="grid fluid">
    <div class="row">
        <div style="margin:0 15px 5px 15px">
            @include('layouts.includes.boxes.paginador_barra')
        </div>
    </div>

    <div class="example resultado text-center">	
        <div class="row">
            {!!$links!!}
        </div>
        @include('layouts.includes.produtos_busca')
    </div>
</div>