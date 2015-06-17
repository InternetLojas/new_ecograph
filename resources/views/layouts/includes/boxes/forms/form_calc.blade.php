@if(is_array($solicitado))
<!--mostra o formulario com os dados postados para recuperar o resultado-->
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