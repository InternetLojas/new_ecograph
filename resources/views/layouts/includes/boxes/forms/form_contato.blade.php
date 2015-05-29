{!! Form::open(array(
'url'=>URL::to('email/contato'),
'method'=>'post',
'id' => 'contato',
'name'=>'contato',
'role'=>'Form'
)) 
!!}  
<fieldset>
    <label>Nome</label>
    <div class="input-control text" data-role="input-control">
        <input type="text" placeholder="Como gostaria de ser chamado?" id="nome" value="" name="nome" required>                
        <button class="btn-clear" tabindex="-1"></button>
    </div>
    <label>Email</label>
    <div class="input-control email" data-role="input-control">
        <input type="email" placeholder="Seu email para contato" id="email" value="" name="email" required>
        <button class="btn-clear" tabindex="-1"></button>
    </div>
    <label>Telefone</label>
    <div class="input-control tel" data-role="input-control">
        <input type="tel" placeholder="Fone principal" id="telefone" value="" name="telefone" required >          
        <button class="btn-clear" tabindex="-1"></button>
    </div>
    <label>Mensagem</label>
    <div class="input-control textarea " data-role="input-control">
        <textarea id="mensagem" name="mensagem" rows="3"></textarea>
    </div>
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <button type="submit" class="large bg-orange fg-white place-right" >Enviar</button>
    <div style="margin-top: 20px">
    </div>
</fieldset>
</form>
