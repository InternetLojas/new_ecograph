<form name="form_edicao" id="form_edicao" method="post" role="form" action="editor/carregar">
    <legend class="legend-editor" style="background-color:{!!$layout['back_menu']!!}">Inserir Texto</legend>
    <fieldset>
        <div class="input-control text" data-role="input-control" >
            <input type="text" name="nome_empresa" value="" placeholder="Nome da Empresa"/>
            <button class="btn-clear"></button>
        </div>
        <label></label>
        <div class="input-control text" data-role="input-control" >
            <input type="text" name="atividade" value="" placeholder="Nome da Empresa"/>
            <button class="btn-clear"></button>
        </div>
        <label></label>
        <div class="input-control text" data-role="input-control" >
            <input type="text" name="nome" value="" placeholder="Nome da Empresa"/>
            <button class="btn-clear"></button>
        </div>
        <label></label>
        <div class="input-control text" data-role="input-control" >
            <input type="text" name="cargo" value="" placeholder="Nome da Empresa"/>
            <button class="btn-clear"></button>
        </div>
        <label></label>
        <div class="input-control text" data-role="input-control" >
            <input type="text" name="cel1" value="" placeholder="Nome da Empresa"/>
            <button class="btn-clear"></button>
        </div>
        <label></label>
        <div class="input-control text" data-role="input-control" >
            <input type="text" name="cel2" value="" placeholder="Nome da Empresa"/>
            <button class="btn-clear"></button>
        </div>
        <label></label>
        <div class="input-control text" data-role="input-control" >
            <input type="text" name="fone1" value="" placeholder="Nome da Empresa"/>
            <button class="btn-clear"></button>
        </div>
        <label></label>
        <div class="input-control text" data-role="input-control" >
            <input type="text" name="fone2" value="" placeholder="Nome da Empresa"/>
            <button class="btn-clear"></button>
        </div>
        <label></label>
        <div class="input-control text" data-role="input-control" >
            <input type="text" name="end" value="" placeholder="Nome da Empresa"/>
            <button class="btn-clear"></button>
        </div>
        <label></label>
        <div class="input-control text" data-role="input-control" >
            <input type="text" name="cep" value="" placeholder="Nome da Empresa"/>
            <button class="btn-clear"></button>
        </div>
        <label></label>
        <div class="input-control text" data-role="input-control" >
            <input type="text" name="email" value="" placeholder="Nome da Empresa"/>
            <button class="btn-clear"></button>
        </div>
        <label></label>
        <div class="input-control text" data-role="input-control" >
            <input type="text" name="site" value="" placeholder="Nome da Empresa"/>
            <button class="btn-clear"></button>
        </div>
        <label></label>
        <div class="input-control text" data-role="input-control" >
            <input type="text" name="obs" value="" placeholder="Nome da Empresa"/>
            <button class="btn-clear"></button>
        </div>
        <input type="hidden" name="_token" value="{!!csrf_token()!!}" />
        <input type="hidden" name="user" value="{!!Auth::user()->id!!}" />
    </fieldset>
</form>
<div class="clearfix"></div>