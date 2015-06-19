<!--<form name="form_edicao" id="form_edicao" method="post" role="form" action="editor/carregar">-->
    <div class="form-group" data-role="input-control" >
        <input type="text" name="nome_empresa" class="form-control no-radius" placeholder="Nome da Empresa" />
    </div>
    <div class="form-group" data-role="input-control" >
        <input type="text" name="atividade" class="form-control no-radius" placeholder="Atividade" />
    </div>
    <div class="form-group" data-role="input-control" >
        <input type="text" name="nome" value="{!!$customer['customers_firstname']!!} {!!$customer['customers_lastname']!!}" class="form-control no-radius" placeholder="Seu nome"/>
    </div>
    <div class="form-group" data-role="input-control" >
        <input type="text" name="cargo" class="form-control no-radius" placeholder="Seu cargo"/>
    </div>
    <div class="form-group" data-role="input-control" >
        <input type="tel" name="cel" value="{!!$customer['customers_cel']!!}" class="form-control no-radius" placeholder="Celular" />
    </div>
    <div class="form-group" data-role="input-control" >
        <input type="tel" name="cel1" value="{!!$customer['customers_cel1']!!}" class="form-control no-radius" placeholder="Celular"/>
    </div>
    <div class="form-group" data-role="input-control" >
        <input type="tel" name="fone" value="{!!$customer['customers_telephone']!!}" class="form-control no-radius" placeholder="Telefone"/>
    </div>
    <div class="form-group" data-role="input-control" >
        <input type="tel" name="fone1" value="{!!$customer['customers_telephone1']!!}" class="form-control no-radius" placeholder="Telefone"/>
    </div>
    <div class="form-group" data-role="input-control" >
        <input type="text" name="end" id="end" value="{!!$default_address['entry_street_address']!!} {!!$default_address['entry_nr_rua']!!} - {!!$default_address['entry_suburb']!!}" class="form-control no-radius" placeholder="Endereço"/>
    </div>
    <div class="form-group" data-role="input-control" >
        <input type="text" name="cep" id="cep" value="{!!$default_address['entry_postcode']!!}" class="form-control no-radius" placeholder="Cep"/>
    </div>
    <div class="form-group" data-role="input-control" >
        <input type="text" name="email" value="{!!$customer['email']!!}" class="form-control no-radius" placeholder="seu email"/>
    </div>
    <div class="form-group" data-role="input-control" >
        <input type="text" name="site" class="form-control no-radius" placeholder="Seu site"/>
    </div>
    <div class="form-group" data-role="input-control" >
        <input type="text" name="obs" class="form-control no-radius" placeholder="Alguma observação"/>
    </div>
<!--</form>-->