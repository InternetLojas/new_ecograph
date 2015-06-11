{!! Form::open(array(
'url'=> URL::to('cadastro.html'),
'method' => 'post',
'name'=>'cadastro',
'id'=>'cadastro')) !!}
<!-- DADOS PESSOAIS -->

<h3 class="title-cadastro">Dados pessoais</h3>
<div class="grid-fluid">
    <div class="">
        <div class="text-center" style="display:none" id="enviando_cadastro">
            Aguarde...!
            {!! HTML::image('images/theme/progress.gif', $title='Aguarde! Verificando...', array('style'=>'width:100%; max-width:234px')) !!}
        </div>
        <style>
            .metro .pessoais:before {
                content: "";
            }
        </style>
        <div class="example pessoais">
            <label class="control-label" for="customers_firstname">Nome completo</label>
            <div class="input-control text size5" data-role="input-control">
                {!! Form::text('customers_firstname','',  array('id' =>'firstaname', 'class' => 'form-control', 'placeholder' => 'informe seu nome','required'=>'true')) !!}
                {!! Form::hidden('customers_lastname','', array('id' =>'lastaname', 'class' => 'form-control', 'placeholder' => 'informe seu sobrenome')) !!}
            </div>
            <div class="input-control select " data-role="input-control">
                <label class="control-label" >Sexo:</label>
                <select class="size3" name="customers_gender">
                    <option value="m">M</option>
                    <option value="f">F</option>
                </select>
            </div>
            @if($tipo == 'f')
            <label class="control-label" for="customers_cpf_cnpj">CPF</label>
            <div class="input-control text size5" data-role="input-control">
                {!! Form::text('customers_cpf_cnpj', '', array('id' =>'cpf', 'class' => 'form-control', 'placeholder' => 'informe seu CPF','required'=>'true', 'maxlength'=>'14', 'required'=>'true')) !!}
            </div>
            <!--<div class=" col-lg-2 col-md-3 col-xs-12 col-sm-12">
            <label class="control-label" for="customers_rg_ie">RG</label>
            </div>
            <div class=" col-lg-10 col-md-9 col-xs-12 col-sm-12">
            <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
            <input id="rg" name="customers_rg_ie" type="text" placeholder="Nr do Documento" class="form-control">
            </div>
            </div>-->
            @endif
        </div>
    </div>
</div>
@if($tipo == 'j')
<!--! DADOS EMPRESA -->
<h3 class="title-cadastro">Dados da empresa</h3>
<div class="grid-fluid">
    <div class="">
        <style>
            .metro .empresa:before {
                content: "";
            }
        </style>
        <div class="example empresa">
            <label class="control-label" for="entry_company">Razão social</label>

            <div class="input-control text size5" data-role="input-control">
                {!! Form::text('entry_company','', array('id' =>'company', 'class' => 'form-control', 'placeholder' => 'informe a Razão Social da Empresa', 'required'=>'true')) !!}
            </div>

            <label class="controls-label" for="entry_fantasia">Fantasia</label>
            <div class="input-control text size5" data-role="input-control">
                <input id="fantasia" name="entry_fantasia" type="text" class="form-control" placeholder="nome fantasia" >
            </div>

            <label class="control-label" for="customers_cpf_cnpj">CNPJ</label>
            <div class="input-control text size5" data-role="input-control">
                <input id="cnpj" name="customers_cpf_cnpj" type="text" placeholder="cnpj" class="form-control" reqired maxlength="15" required>
            </div>
        </div>

        <label class="control-label" for="customers_rg_ie">Inscr. Estadual</label>
        <div class="input-control text size5" data-role="input-control">
            <input id="ie" name="customers_rg_ie" type="text" placeholder="Inscrição Estadual" class="form-control">
        </div>
    </div>
</div>
@endif
<!-- ENDEREÇO-->

<h3 class="title-cadastro">Endereço</h3>
<div class="grid fluid">
    <div class="">
        <style>
            .metro .end:before {
                content: "";
            }
        </style>
        <div class="example end">
            <label class="control-label" for="entry_street_address">Rua/Av</label>
            <div class="input-control text size5" data-role="input-control">
                <input id="street" name="entry_street_address" type="text" placeholder="nome da rua ou da avenida" value="{{ $entry_street_address }}" class="form-control" required>
            </div>

            <label class="control-label" for="entry_nr_rua">Nº</label>
            <div class="input-control text size5" data-role="input-control">
                <input id="nr_rua" name="entry_nr_rua" type="text" placeholder="nº" class="form-control" required>
            </div>

            <label class="control-label" for="entry_comp_ref">Complemento</label>
            <div class="input-control text size5" data-role="input-control">
                <input id="complemento" name="entry_comp_ref" type="text" placeholder="complemento" class="form-control">
            </div>

            <label class="control-label" for="entry_suburb">Bairro</label>
            <div class="input-control text size5" data-role="input-control">
                <input id="suburb" name="entry_suburb" value="{{ $entry_suburb }}" type="text" placeholder="bairro" class="form-control" required>
            </div>

            <label class="control-label" for="entry_city">Cidade</label>

            <div class="input-control text size5" data-role="input-control">
                <input id="city" name="entry_city" value="{{ $entry_city }}" type="text" placeholder="cidade" class="form-control" required>
            </div>

            <label class="control-label" for="entry_state">UF</label>
            <div class="input-control select" data-role="input-control">
                @if(isset($entry_state))
                {!! Form::select('entry_state', Utilidades::estados() , $entry_state, array('id' => 'state', 'class' => 'size3')) !!}
                @else
                {!! Form::select('entry_state', Utilidades::estados() , 'SP', array('id' => 'state', 'class' => 'size3')) !!}
                @endif
            </div>

            <label class="control-label" for="entry_postcode">CEP</label>

            <div class="input-control text size5" data-role="input-control">
                <input id="cep" name="entry_postcode" type="text" placeholder="Código Postal" class="form-control" v-model="cep" v-on="keyup:buscar" maxlength="9" value="{{ $entry_postcode }}" required>
            </div>
            <div class="input-control text size5" data-role="input-control">
                <a href="javascript:findCEP()" title="Pesquise o endereço" id="lupa"> {!! HTML::image('images/img/search-icon.gif', $alt="search-icon.gif", $attributes = array('title' => 'Clique para pesquisar o endereço','width'=>'26')) !!} </a>
            </div>
            <div class="input-control text size5" data-role="input-control">
                <span id="ajax-loading" style="display:none"> {!! HTML::image('images/img/preloading.gif', $alt="preload_img.gif", $attributes = array('width'=>'32')) !!} </span>
            </div>
        </div>
    </div>
</div>
<!--! DADOS PARA CONTATO-->
<h3 class="title-cadastro">Dados para contato</h3>
<div class="grid fluid">
        <!--<span class="pull-right" id="nr_big">Optar por <b>usar o Nr 9</b> na frente <input type="checkbox" id="algarismo_9" name="algarismo_9" /></span>
        <span class="pull-right" id="nr_small" style="display:none">Optar por <b>não usar o Nr 9</b> na frente <input type="checkbox" id="algarismo" name="algarismo" /></span>--></h3>

<div class="">
    <label class="control-label" for="customers_telephone">Telefone Fixo</label>
    <div class="input-control text" data-role="input-control">
        <input id="telephone" name="customers_telephone" type="text" placeholder="Telefone" value="" class="form-control"  maxlength="15" required>
        <!--<span class="aviso" style="display:none;color:#990022;font-size:11px">*Usando algarismo 9 na frente.</span>-->
    </div>

    <label class="control-label" for="customers_cel">Celular</label>
    <div class="input-control text" data-role="input-control">
        <input id="cel" name="customers_cel" type="tel" placeholder="Celular" value="" class="form-control"  maxlength="15">
        <span class="icon-mobile-phone tooltip-test font24" data-original-title="Digite seu telefone completo, inclusive com o dígito 9 se for o caso."></span>
    </div>

    <label class="control-label" for="customers_telephone1">WhatsApp </label>
    <div class="input-control text" data-role="input-control">
        <input id="whatsap" name="customers_telephone1" type="tel" placeholder="Seu número para o WhatsApp" value="" class="form-control" maxlength="15">
        <span class="icon-mobile-phone tooltip-test font24" data-original-title="Digite seu telefone completo, inclusive com o dígito 9 se for o caso."></span>
        <!--<span class="aviso" style="display:none;color:#990022;font-size:11px">*Usando algarismo 9 na frente.</span>-->
    </div>
</div>
</div>
<!-- DADOS PARA ACESSO-->

<h3 class="title-cadastro">Dados de acesso</h3>
<div class="grid fluid">
    <div class="">

        <label class="control-label" for="email">Email</label>
        <div class="input-control text" data-role="input-control">
            @if(!empty($customers_firstname))
            {{$get_email = Session::get('me') }}
            <input id="email" name="email" value="{{ $get_email['email'] }}" type="email" placeholder="email" class="form-control" required>
            @else
            <input id="email" name="email" type="email" placeholder="email" class="form-control" required>
            @endif
        </div>

        <label class="control-label" for="password">Senha</label>
        <div class="input-control text" data-role="input-control">
            <input id="senha" name="password" type="password" placeholder="Digite sua senha com no máximo 10 caracteres" value="" class="form-control" maxlength="10" required>
        </div>

        <label class="control-label" for="password">Confirme a senha</label>
        <div class="input-control text" data-role="input-control">
            <input id="confirmation" name="password_confirmation" type="password" placeholder="Digite novamente sua senha com no máximo 10 caracteres" value="" class="form-control" maxlength="10" required>
        </div>
    </div>
</div>
<!-- NEWSLETTER-->

<h3 class="title-cadastro">Newsletter</h3>
<div class="grid fluid">
    <div class="">
        <div class="input-control switch" data-role="input-control">
            <label class="inline-block" style="margin-right: 20px" for="customers_newsletter">Deseja receber nossas ofertas por email?</label>
            <div class="input-control text" data-role="input-control">

                <input type="checkbox" name="customers_newsletter" value="1" checked class="tooltip-test" title="Clique para aceitar nossas ofertas por email">
                <!--SIM-->
                </label>
                <!-- <label>
                <input type="checkbox" name="customers_newsletter" value="0">
                NÃO
                </label>-->
            </div>
        </div>
    </div>
</div>
<!-- CONCORDE DAS REGRAS-->
<h3 class="title-cadastro">/concorde das regras</h3>
<div class="grid fluid">
    <div class="">
        <div class=" col-lg-2 col-md-3 col-xs-12 col-sm-12">
            <p>
                Saiba mais:</label>
                <br>
                <a class="badge badge-dark" href="{{URL::to('/politica')}}" title="Veja nossa política de trabalho"><i class="icon-eye-open"></i> regras</a>
            </p>
        </div>
        <div class="input-control switch" data-role="input-control">
            <label class="inline-block" style="margin-right: 20px">
                <input type="checkbox" name="agree" id="agree" value="" checked>
                Aceito as regras </label>
        </div>
        <span id="concorde" class="red" style="display:none"><strong>Verifique</strong></span>
    </div>
</div>
<div>
    @if($tipo == 'f')
    <input type="hidden" name="customers_pf_pj" value="f" />
    @else
    <input type="hidden" name="customers_pf_pj" value="j" />
    @endif
    <input type="hidden" name="entry_country_id" value="30" />
    <input type="hidden" name="_token" value="{{csrf_token()}}" />
    <!--<div id="mensagem_cadastro"></div>
    <div id="info_cadastro"></div>-->
</div>

<div class="place-right">

    <button id="btn_cadastro" type="button" data-original-title="Carrinho" class="large bg-cyan fg-white tooltip-test" title="Clique para criar a sua conta @if($tipo == 'f')Pessoa Física @else Pessoa Jurídica @endif">
        <i class="icon icon-flag icon-white"></i> Criar conta
    </button>
    <a href="{{URL::to('/inicio')}}" title="Acrescentar mais produtos no carrinho" class="button default large" style="margin-right:5px"> <i class="icon icon-arrow-left icon-white"></i> Início </a>
</div>
{!! Form::close() !!}
