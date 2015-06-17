<form id="calculadora" name="calculadora" method="POST" action="{!!URL::to('calcula_preco')!!}">
    <div id="peso_selecionado"></div>
    <input type="hidden" name="categoria" id="categ_selecionada" value="" />
    <input type="hidden" name="cor_nome" id="cor_nome" value="" />
    <input type="hidden" name="cor" id="cor_id" value="" />
    <input type="hidden" name="formato" id="formato_id" value="" />
    <input type="hidden" name="formato_nome" id="formato_nome" value="" />
    <input type="hidden" name="papel_nome" id="papel_nome" value="" />
    <input type="hidden" name="papel" id="papel_id" value="" />
    <input type="hidden" name="acabamento_nome" id="acabamento_nome" value="" />
    <input type="hidden" name="acabamento" id="acabamento_id" value="" />
    <input type="hidden" name="enoblecimento_nome" id="enoblecimento_nome" value="" />
    <input type="hidden" name="enoblecimento" id="enoblecimento_id" value="" />
    <input type="hidden" name="_token" value="{!!csrf_token()!!}"/>
</form>