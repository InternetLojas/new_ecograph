@include('layouts.includes.modais.modal_erros_cadastro')
{!! Form::open(array(
'route'=> ('clientes.cadastro'),
'method' => 'post',
'name'=>'cadastro',
'id'=>'cadastro',
'class' => 'form-horizontal text-medio',
'role' => 'Form')) !!}
@if($tipo == 'j')
<!--! DADOS EMPRESA -->
<h3 class="title-cadastro">Dados da empresa</h3>
<div class="destaque_home_edicao"> 
    <table class="body_cadastro">
        <tbody>
            <tr>
                <td class="col-cesta-img">
                    <div class="col-cesta-title-img"></div>
                </td>
                <td class="td-content-carrinho">
                    <div class="form-group">
                        <div class="col-sm-2">
                            <label class="control-label  pull-right" for="entry_company">Razão Social</label>
                        </div>
                        <div class="col-sm-6">   
                            {!! Form::text('entry_company','', array('id' =>'company', 'class' => 'form-control no-radius', 'placeholder' => 'informe a Razão Social da Empresa', 'required'=>'true')) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2">
                            <label class="control-label  pull-right" for="customers_firstname">Nome Fantasia</label>
                        </div>
                        <div class="col-sm-6">   
                            <input id="fantasia" name="entry_fantasia" type="text" class="form-control no-radius" placeholder="nome fantasia" >
                        </div>
                    </div>                    
                    <div class="form-group">
                        <div class="col-sm-2">
                            <label class="control-label  pull-right" for="customers_cpf_cnpj">CNPJ</label>
                        </div>
                        <div class="col-sm-6">   
                            <input id="cnpj" name="customers_cpf_cnpj" type="text" placeholder="cnpj" class="form-control no-radius" reqired maxlength="15" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2">
                            <label class="control-label  pull-right" for="customers_rg_ie">Inscr. Estadual</label>
                        </div>
                        <div class="col-sm-6">   
                            <input id="ie" name="customers_rg_ie" type="text" placeholder="Inscrição Estadual" class="form-control no-radius">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2">
                            <label class="control-label  pull-right" for="customers_atuacao">Área de Atuação</label>
                        </div>
                        <div class="col-sm-6">   
                            <input id="customers_atuacao" name="customers_atuacao" type="text" class="form-control no-radius" placeholder="qual sua área de atuação" >
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>
@endif
<!-- DADOS PESSOAIS -->
<h3 class="title-cadastro">Dados pessoais</h3>
<div class="destaque_home_edicao"> 
    <table class="body_cadastro">
        <tbody>
            <tr>
                <td class="col-cesta-img">
                    <div class="col-cesta-title-img"></div>
                </td>
                <td class="td-content-carrinho">
                    <div class="form-group">
                        <div class="col-sm-2">
                            <label class="control-label pull-right" for="customers_firstname">Nome</label>
                        </div>
                        <div class="col-sm-6">                
                            {!! Form::text('customers_firstname','',  array('id' =>'firstaname', 'class' => 'form-control no-radius', 'placeholder' => 'informe seu nome','required'=>'on')) !!}
                        </div>
                    </div>            
                    <div class="form-group">
                        <div class="col-sm-2">
                            <label class="control-label  pull-right" for="customers_firstname">Sobrenome</label>
                        </div>
                        <div class="col-sm-6">                
                            {!! Form::text('customers_lastname','', array('id' =>'lastaname', 'class' => 'form-control no-radius', 'placeholder' => 'informe seu sobrenome','required'=>'true')) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2">
                            <label class="control-label  pull-right" for="customers_firstname">Nome completo</label>
                        </div>
                        <div class="col-sm-6">                
                            <select class="size3" name="customers_gender">
                                <option value="m">M</option>
                                <option value="f">F</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2">
                            <label class="control-label  pull-right" for="customers_firstname">CPF</label>
                        </div>
                        <div class="col-sm-2">                
                            {!! Form::text('customers_cpf_cnpj', '', array('id' =>'cpf', 'class' => 'form-control no-radius', 'placeholder' => 'informe seu CPF','required'=>'true', 'maxlength'=>'14', 'required'=>'true')) !!}
                        </div>
                        <div class="col-sm-3 col-sm-push-1">
                            <label class="control-label  pull-left" for="customers_firstname">RG</label>
                        </div>
                        <div class="col-sm-2 col-sm-pull-1">                
                            <input id="rg" name="customers_rg_ie" type="text" placeholder="Nr do Documento" class="form-control no-radius">
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<!-- ENDEREÇO-->
<h3 class="title-cadastro">Endereço</h3>
<div class="destaque_home_edicao"> 
    <table class="body_cadastro">
        <tbody>
            <tr>
                <td class="col-cesta-img">
                    <div class="col-cesta-title-img"></div>
                </td>
                <td class="td-content-carrinho">
                    <div class="form-group">
                        <div class="col-sm-2">
                            <label class="control-label pull-right" for="entry_street_address">CEP</label>
                        </div>
                        <div class="col-sm-6"> 
                            <input id="cep" name="entry_postcode" type="text" placeholder="Código Postal" class="form-control no-radius" v-model="cep" v-on="keyup:buscar" maxlength="9" value="{{ $entry_postcode }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2">
                            <label class="control-label pull-right" for="entry_street_address">Endereço</label>
                        </div>
                        <div class="col-sm-6">   
                            <input id="street" name="entry_street_address" type="text" placeholder="nome da rua ou da avenida" value="{{ $entry_street_address }}" class="form-control no-radius" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2">
                            <label class="control-label pull-right" for="entry_nr_rua">Nº</label>
                        </div>
                        <div class="col-sm-6">   
                            <input id="nr_rua" name="entry_nr_rua" type="text" placeholder="nº" class="form-control no-radius" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2">
                            <label class="control-label pull-right" for="entry_comp_ref">Complemento</label>
                        </div>
                        <div class="col-sm-6"> 
                            <input id="complemento" name="entry_comp_ref" type="text" placeholder="complemento" class="form-control no-radius">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2">
                            <label class="control-label pull-right" for="entry_suburb">Bairro</label>
                        </div>
                        <div class="col-sm-6">  
                            <input id="suburb" name="entry_suburb" value="{{ $entry_suburb }}" type="text" placeholder="bairro" class="form-control no-radius" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2">
                            <label class="control-label pull-right" for="entry_city">Cidade</label>
                        </div>
                        <div class="col-sm-6">  
                            <input id="city" name="entry_city" value="{{ $entry_city }}" type="text" placeholder="cidade" class="form-control no-radius" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2">
                            <label class="control-label pull-right" for="entry_state">Estado</label>
                        </div>
                        <div class="col-sm-6">  
                            @if(isset($entry_state))
                            {!! Form::select('entry_state', Utilidades::estados() , $entry_state, array('id' => 'state', 'class' => 'size3')) !!}
                            @else
                            {!! Form::select('entry_state', Utilidades::estados() , 'SP', array('id' => 'state', 'class' => 'size3')) !!}
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2">
                            <label class="control-label  pull-right" for="customers_telephone">Telefone1</label>
                        </div>
                        <div class="col-sm-2"> 
                            <input id="telephone" name="customers_telephone" type="text" placeholder="Telefone" value="" class="form-control no-radius"  maxlength="15" required>
                        </div>
                        <div class="col-sm-3 col-sm-push-1">
                            <label class="control-label  pull-left" for="customers_telephone1">Telefone2</label>
                        </div>
                        <div class="col-sm-2 col-sm-pull-1">                
                            <input id="telephone" name="customers_telephone1" type="text" placeholder="Telefone" value="" class="form-control no-radius"  maxlength="15">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2">
                            <label class="control-label  pull-right" for="customers_cel">Celeular1</label>
                        </div>
                        <div class="col-sm-2">                
                            <input id="cel" name="customers_cel" type="tel" placeholder="Celular" value="" class="form-control no-radius"   maxlength="15">
                        </div>
                        <div class="col-sm-3 col-sm-push-1">
                            <label class="control-label  pull-left" for="customers_cel1">Celeular2</label>
                        </div>
                        <div class="col-sm-2 col-sm-pull-1">                
                            <input id="cel" name="customers_cel1" type="tel" placeholder="Celular" value="" class="form-control no-radius"   maxlength="15">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2">
                            <label class="control-label pull-right" for="entry_ref_entrega">Referência de Entrega</label>
                        </div>
                        <div class="col-sm-6">  
                            <input id="suburb" name="entry_ref_entrega" value="" type="text" placeholder="Referência de entrega" class="form-control no-radius" required>
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>    
<!-- DADOS PARA ACESSO-->
<h3 class="title-cadastro">Dados de Acesso</h3>
<div class="destaque_home_edicao"> 
    <table class="body_cadastro">
        <tbody>
            <tr>
                <td class="col-cesta-img">
                    <div class="col-cesta-title-img"></div>
                </td>
                <td class="td-content-carrinho">
                    <div class="form-group">
                        <div class="col-sm-2">
                            <label class="control-label pull-right" for="email">Email</label>
                        </div>
                        <div class="col-sm-6">                            
                            @if(!empty($customers_firstname))
                            {{$get_email = Session::get('me') }}
                            <input id="email" name="email" value="{{ $get_email['email'] }}" type="email" placeholder="email" class="form-control no-radius" required>
                            @else
                            <input id="email" name="email" type="email" placeholder="email" class="form-control no-radius" required>
                            @endif                            
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2">
                            <label class="control-label pull-right" for="password">Senha</label>
                        </div>
                        <div class="col-sm-6">
                            <input id="senha" name="password" type="password" placeholder="Digite sua senha com no máximo 10 caracteres" value="" class="form-control  no-radius" maxlength="10" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2">
                            <label class="control-label pull-right" for="password_confirmation">Confirme a senha</label>
                        </div>
                        <div class="col-sm-6">
                            <input id="confirmation" name="password_confirmation" type="password" placeholder="Digite novamente sua senha com no máximo 10 caracteres" value="" class="form-control  no-radius" maxlength="10" required>
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<!-- NEWSLETTER-->
<h3 class="title-cadastro">Newsletter</h3>
<div class="destaque_home_edicao"> 
    <table class="body_cadastro">
        <tbody>
            <tr>
                <td class="col-cesta-img">
                    <div class="col-cesta-title-img"></div>
                </td>
                <td class="td-content-carrinho">
                    <div class="form-group">
                        <div class="col-sm-2">
                            <label class="control-label pull-right" for="customers_newsletter">News</label>
                        </div>
                        <div class="col-sm-6">
                            <div class="checkbox">
                                <label>                                        
                                    <input type="checkbox" name="customers_newsletter" value="1" checked class="tooltip-test" title="Clique para aceitar nossas ofertas por email">Desejo receber informações sobre produtos e promoções da Ecograph.
                                </label>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<!-- REVENDECOR--
<h3 class="title-cadastro">Revenda</h3>
<div class="destaque_home_edicao"> 
    <table class="body_cadastro">
        <tbody>
            <tr>
                <td class="col-cesta-img">
                    <div class="col-cesta-title-img"></div>
                </td>
                <td class="td-content-carrinho">
                    <div class="form-group">
                        <div class="col-sm-2">
                            <label class="control-label pull-right" for="customers_revendedor">Revendedor</label>
                        </div>
                        <div class="col-sm-6">
                            <div class="checkbox">
                                <label>                                        
                                    <input type="checkbox" name="customers_revendedor" value="1" class="tooltip-test" title="Clique se tiver interesse em ser revendedor">
                                    <strong>Tenho interesse em ser Revendedor</strong>.
                                </label>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>-->
<h3 class="title-cadastro">Regras de uso</h3>
<div class="destaque_home_edicao"> 
    <table class="body_cadastro">
        <tbody>
            <tr>
                <td class="col-cesta-img">
                    <div class="col-cesta-title-img"></div>
                </td>
                <td class="td-content-carrinho">

                    <div class="form-group">
                        <div class="col-sm-2">
                            <label class="control-label pull-right" for="agree"></label>
                        </div>
                        <div class="col-sm-6">
                            <div class="checkbox">
                                <label> 
                                    <input type="checkbox" name="agree" id="agree" title="Clique para aceitar as regras da loja" >
                                    Aceito as <a class="" href="{{URL::to('/politica')}}" title="Veja nossa política de trabalho"></a>regras</a>.
                                </label>
                                <span id="concorde" style="display:none"><strong>Verifique</strong></span>
                            </div>
                            @if($tipo == 'f')
                            <input type="hidden" name="customers_pf_pj" value="f" />
                            @else
                            <input type="hidden" name="customers_pf_pj" value="j" />
                            @endif
                            <input type="hidden" name="_token" value="{{csrf_token()}}" />
                        </div>
                        <div class="col-sm-4">
                            <button id="btn_cadastro" type="button" class="btn btn-lg bg-dark fg-white no-radius pull-right" title="Clique para criar a sua conta @if($tipo == 'f')Pessoa Física @else Pessoa Jurídica @endif">
                                Enviar
                            </button>
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
    <div id="info_cadastro" class="text-medio" style="display:none"></div>
    <div id="mensagem_cadastro" class="text-medio" style="display:none"></div>
    <div id="enviando_cadastro" class="text-medio" style="display:none" >
        Aguarde...!
        {!! HTML::image('images/img/preloading.gif', $title='Aguarde! Armazenando dados...', array('style'=>'width:100%; max-width:128px')) !!}
    </div> 
</div>
{!!Form::close()!!}
