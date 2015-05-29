<style>
    .metro .produtos:before {content: "produtos";}
</style>
<div id="all_produtos" class="example produtos text-center">
    @foreach(array_chunk($listagem, 4) as $lista)
    <div class="row">
        <div class="listview">
            @foreach($lista as $key=>$item)
            <button  class="list fg-white active{!!$layout['style_a']!!} btn-detalhes" onclick="Calculadora('{!! $item[0] !!}', '{!! $item[1] !!}')" title="Clique para ver os detalhes desse produto" >
                <div class="list-content">
                    <span class="list-title">{!!$item[1]!!}</span>
                </div>
            </button>
            @endforeach   
        </div>
    </div>
    @endforeach
</div>
@if(is_array($solicitado))
<form id="calc" name="calc" method="POST" action="{!!URL::to('calculadora')!!}">
    <input type="hidden" name="escolhido" id="escolhido" value="{!!$solicitado['filho']!!}">
    <input type="hidden" name="categoria" id="nome_categoria" value="{!!Fichas::nomeCategoria($solicitado['filho'])!!}">
    <input type="hidden" name="_token" value="{!!csrf_token()!!}"/>
</form>
@else
<form id="calc" name="calc" method="POST" action="{!!URL::to('calculadora')!!}">
    <input type="hidden" name="escolhido" id="escolhido" value="">
    <input type="hidden" name="categoria" id="nome_categoria" value="">
    <input type="hidden" name="_token" value="{!!csrf_token()!!}"/>
</form>
@endif
<div id="info_calculadora"></div>