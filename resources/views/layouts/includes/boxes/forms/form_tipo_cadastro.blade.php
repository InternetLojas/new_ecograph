{!! Form::open(array(
'url'=> URL::to('tipoContaJson'),
'method' => 'post', 
'id'=>'formtipoconta', 
'name'=>'formtipoconta'))
!!}  
<div id="mensagem_formtipoconta"></div>
<div id="info_formtipoconta"></div>
<fieldset>
    <legend>Criar um a conta</legend>
    <div class="input-control radio default-style inline-block" data-role="input-control">
        <label class="inline-block">
            <input type="radio" name="customers_pf_pj" value="f" checked />
            <span class="check"></span>
            Pessoa Física
        </label>
        <label class="inline-block">
            <input type="radio" name="customers_pf_pj" value="j" />
            <span class="check"></span>
            Pessoa Jurídica
        </label>
    </div>
    <label>CEP</label>
    <div class="input-control text" data-role="input-control">
        <input type="text" name="entry_postcode" id="postcode" placeholder="CEP">
        <button type="button" class="btn-search" id="btn_tipoconta"></button>
        <input id="street" name="street" type="hidden" />
        <input id="suburb" name="suburb" type="hidden" />
        <input id="city" name="city" type="hidden" />
        <input id="state" name="state" type="hidden" />
        @if (Session::has('facebook_id'))
        {{$get_me =  Session::get('me')}}
        {{ Form::hidden('customers_firstname', $get_me['first_name']) }}
        {{ Form::hidden('customers_lastname', $get_me['last_name']) }}
        {{ Form::hidden('email', $get_me['email']) }}
        @endif
    </div>
</fieldset>
<div class="input-control text">
    <button type="button" class="inverse small" data-dismiss="modal" title="Fechar a janela"><i class="icon-off on-left"></i> Fechar</button>
    <button type="button" class="inverse small" title="Enviar meus dados" ><i class="icon-ok on-left"></i> Enviar</button>
</div>
</form>