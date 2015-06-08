<form name="form_edicao" id="form_edicao" method="post" role="form" action="editor/carregar">
    <div class="form-group" data-role="input-control" >
        <input type="text" name="nome_empresa" class="form-control no-radius" placeholder="Nome da Empresa"/>
    </div>
    <div class="form-group" data-role="input-control" >
        <input type="text" name="atividade" class="form-control no-radius" placeholder="Atividade"/>
    </div>
    <div class="form-group" data-role="input-control" >
        <input type="text" name="nome" value="{!!$customer['customers_firstname']!!} {!!$customer['customers_laststname']!!}" class="form-control no-radius" placeholder="Seu nome"/>
    </div>
    <div class="form-group" data-role="input-control" >
        <input type="text" name="cargo" class="form-control no-radius" placeholder="Nome da Empresa"/>
    </div>
    <div class="form-group" data-role="input-control" >
        <input type="text" name="cel1" value="{!!$customer['customers_ddd2']!!} {!!$customer['customers_cel']!!}" class="form-control no-radius" placeholder="Nome da Empresa"/>
    </div>
    <div class="form-group" data-role="input-control" >
        <input type="text" name="cel2" value="" class="form-control no-radius" placeholder="Nome da Empresa"/>
    </div>
    <div class="form-group" data-role="input-control" >
        <input type="text" name="fone1" value="{!!$customer['customers_ddd']!!} {!!$customer['customers_telephone']!!}" class="form-control no-radius" placeholder="Nome da Empresa"/>
    </div>
    <div class="form-group" data-role="input-control" >
        <input type="text" name="fone2" value="{!!$customer['customers_ddd1']!!} {!!$customer['customers_telephone1']!!}" class="form-control no-radius" placeholder="Nome da Empresa"/>
    </div>
    <div class="form-group" data-role="input-control" >
        <input type="text" name="end" class="form-control no-radius" placeholder="Nome da Empresa"/>
    </div>
    <div class="form-group" data-role="input-control" >
        <input type="text" name="cep" class="form-control no-radius" placeholder="Nome da Empresa"/>
    </div>
    <div class="form-group" data-role="input-control" >
        <input type="text" name="email" value="{!!$customer['email']!!}" class="form-control no-radius" placeholder="seu email"/>
    </div>
    <div class="form-group" data-role="input-control" >
        <input type="text" name="site" class="form-control no-radius" placeholder="Seu site"/>
    </div>
    <div class="form-group" data-role="input-control" >
        <input type="text" name="obs" class="form-control no-radius" placeholder="Alguma observação"/>
        <input type="hidden" name="_token" value="{!!csrf_token()!!}" />
        <input type="hidden" name="user" value="{!!Auth::user()->id!!}" />
    </div>
</form>