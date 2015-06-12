{!! Form::open(array(
'url'=>URL::to('email/contato'),
'method'=>'post',
'id' => 'contato',
'name'=>'contato',
'role'=>'Form' 
)) 
!!} 
<div id="mensagem_contato"></div>
<div id="info_contato"></div>
<div class="form-group ">
    <div class="col-sm-2">
        <label for="nome" class="control-label">Nome</label>
    </div>
    <div class="col-sm-10 fg-dark ">
        <input type="text" class="form-control no-radius" placeholder="Como gostaria de ser chamado?" id="nome" value="" name="nome" required>
    </div>
</div>
<div class="form-group">
    <div class="col-sm-2">
        <label for="email" class="control-label">Email</label>
    </div>
    <div class="col-sm-10 fg-dark">
        <input type="email" class="form-control no-radius" placeholder="Seu email para contato" id="email" value="" name="email" required>
    </div>
</div>
<div class="form-group">
    <div class="col-sm-2">
        <label for="email" class="control-label">Telefone</label>
    </div>
    <div class="col-sm-10 fg-dark">
        <input type="tel" class="form-control no-radius" placeholder="Seu telefone para contato" id="telefone" value="" name="telefone" required>
    </div>
</div>
<div class="form-group">
    <div class="col-sm-2">
        <label class="control-label">Mensagem</label>
    </div>
    <div class="col-sm-10 fg-dark">
        <textarea id="mensagem" name="mensagem" rows="3" style="width:100%" ></textarea>
    </div>
</div> 
<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <button type="button" id="btn_contato" class="btn btn-lg pull-right no-radius fg-dark">Enviar</button>
    </div>
</div>
{!!Form::close()!!}
<div style="margin-top: 20px"> </div>