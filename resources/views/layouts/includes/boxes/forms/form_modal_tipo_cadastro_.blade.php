<div class="control-group">
    <label class="control-label"><span class="red">*</span>Tipo de conta:</label>
    <div class="controls"> 
        <ul class="list-inline">
            <li>
                <span style="padding: 0 3px;">Pessoa Física: </span>
                {!! Form::radio('customers_pf_pj', 'f',array('checked'=>'true')) !!}
            </li>
            <li>
                <span style="padding: 0 3px">Pessoa Jurídica: </span>
                {!! Form::radio('customers_pf_pj', 'j') !!}
            </li>
        </ul>
    </div>
</div>             
<div class="control-group">
    <label class="control-label"><span class="red">*</span>Informe CEP:</label>  
    <div class="controls"> 
        
        <input type="text" name="entry_postcode" id="postcode" placeholder="CEP">
        <button type="button" class="btn-search" id="btn_tipoconta"></button>
        <input id="street" name="street" type="hidden" />
        <input id="suburb" name="suburb" type="hidden" />
        <input id="city" name="city" type="hidden" />
        <input id="state" name="state" type="hidden" />
        @if (Session::has('facebook_id'))
        {{$get_me =  Session::get('me')}}
        {!! Form::hidden('customers_firstname', $get_me['first_name']) !!}
        {!! Form::hidden('customers_lastname', $get_me['last_name']) !!}
        {!! Form::hidden('email', $get_me['email']) !!}
        @endif
    </div>
</div> 

<div id="mensagem_formtipoconta"></div>
<div id="info_formtipoconta"></div>