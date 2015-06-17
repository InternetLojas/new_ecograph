
<div class="form-group">
    <div class="col-sm-2">
        <label class="control-label">Tipo de Conta</label>
    </div>
    <div class="col-sm-10">
        <div class="radio">
            <label class="radio-inline">
                {!! Form::radio('customers_pf_pj', 'f',array('checked'=>'true')) !!}Pessoa Física:
            </label>
            <label class="radio-inline">
                {!! Form::radio('customers_pf_pj', 'j') !!}Pessoa Jurídica:
            </label>
        </div>
    </div>
</div> 
<div class="form-group">
    <div class="col-md-2">
        <label for="entry_postcode" class="control-label">CEP</label>
    </div>
    <div class="col-md-4">
        <input id="postcode" name="entry_postcode" type="text" class="form-control input-group input-group-lg no-radius size4" placehoder="CEP" required />

    </div>
    <a class="btn col-md-1 bg-dark fg-white no-radius" onclick="EnderecoCEP();">
        <i class="fa fa-search" style="color:#ffffff"></i>
    </a>
</div>
<div class="form-group">
    <input id="street" name="street" type="hidden" />
    <input id="suburb" name="suburb" type="hidden" />
    <input id="city" name="city" type="hidden" />
    <input id="state" name="state" type="hidden" />
    <input name="_token" value="{!!csrf_token()!!}"  type="hidden" />
    @if (Session::has('facebook_id'))
    {{$get_me =  Session::get('me')}}
    {!! Form::hidden('customers_firstname', $get_me['first_name']) !!}
    {!! Form::hidden('customers_lastname', $get_me['last_name']) !!}
    {!! Form::hidden('email', $get_me['email']) !!}
    @endif
</div> 
