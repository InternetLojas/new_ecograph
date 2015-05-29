<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Clique nesse botão para ignorar o cupom e fechar essa janela">&times;</button>
    <h4 class="modal-title">
        <span class="main-text dark">
            <i class="icon-folder-open font14"></i> Tipo de cadastro.
        </span>
        <div class="row">
            <div class="text-center" style="padding:12px 0;color:#d90002; background-color:#b3b4bb; display:none" id="enviando_formtipoconta">
                Aguarde...!
                {{ HTML::image('images/theme/progress.gif', $title='Aguarde! Verificando...', array('style'=>'width:100%; max-width:234px')) }}
            </div>
        </div>
    </h4>
</div>
{{ Form::open(array(
    'url'=> URL::to('tipoContaJson'),
     'method' => 'post', 
     'id'=>'formtipoconta', 
     'name'=>'formtipoconta',
     'class'=>'form-inline'))}}             
<div class="modal-body">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-danger">
                <div class="panel-body">
                    <fieldset>
                        <div class="control-group">
                            <label class="control-label"><span class="red">*</span>Tipo de conta:</label>
                            <div class="controls"> 
                                <ul class="list-inline">
                                    <li>
                                        <span style="padding: 0 3px;">Pessoa Física: </span>
                                        {{ Form::radio('customers_pf_pj', 'f',array('checked'=>'true')) }}
                                    </li>
                                    <li>
                                        <span style="padding: 0 3px">Pessoa Jurídica: </span>
                                        {{ Form::radio('customers_pf_pj', 'j') }}
                                    </li>
                                </ul>
                            </div>
                        </div>             
                        <div class="control-group">
                            <label class="control-label"><span class="red">*</span>Informe CEP:</label>  
                            <div class="controls"> 
                                <input id="postcode" name="entry_postcode" type="text"  />
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
                        </div> 
                    </fieldset>
                    <div id="mensagem_formtipoconta"></div>
                    <div id="info_formtipoconta"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-orange tooltip-test" data-dismiss="modal" title="Fechar a janela"><i class="icon-off"></i> Fechar</button>
    <button type="button" class="btn btn-primary tooltip-test" title="Enviar meus dados" id="btn_tipoconta"><i class="icon-ok"></i> Enviar</button>
</div>
{{form::close()}}