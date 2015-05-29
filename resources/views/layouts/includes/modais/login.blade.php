<!-- Modal -->
<div class="modal fade" id="login" tabindex="-3" role="dialog"  aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            {{ Form::open(array('url'=>'clientes/login', 'method' => 'post', 'name' => 'login', 'class'=>'form-horizontal form-custom')) }}

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Clique nesse botão para ignorar o cupom e fechar essa janela">&times;</button>
                <h4 class="modal-title">Acessar a loja</h4>
            </div>                 
            <div class="modal-body">
                <fieldset>
                    <div class="control-group">
                        <label class="control-label"><span class="red">*</span>Seu email:</label>
                        <div class="controls"> 
                            {{ Form::email('email_address', null, array('id' => 'email_address', 'placeholder' => 'Seu endereço de email', )) }}                 
                        </div>
                    </div>             
                    <div class="control-group">
                        <label class="control-label"><span class="red">*</span>Senha:</label>  
                        <div class="controls"> 
                            <input id="customers_password" type="password" name="customers_password" placeholder="Sua senha" />  
                            @if (Session::has('facebook_id'))
                            {{$get_me =  Session::get('me')}}
                            {{ Form::hidden('first_name', $get_me['first_name']) }}
                            {{ Form::hidden('last_name', $get_me['last_name']) }}
                            {{ Form::hidden('email', $get_me['email']) }}
                            @endif
                        </div>
                    </div>              
                </fieldset>
            </div> 
            <div class="modal-footer">
                <button type="button" class="btn btn-orange" data-dismiss="modal" title="Fechar a janela">Fechar</button>
                <button type="submit" class="btn btn-primary" title="Enviar meus dados">Entrar</button>
            </div>
            {{Form::close()}}
        </div>
        <!-- /.modal-content --> 
    </div>
    <!-- /.modal-dialog --> 
</div>
<!-- /.modal -->   