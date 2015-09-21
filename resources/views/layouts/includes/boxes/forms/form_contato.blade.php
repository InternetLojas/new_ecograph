{!! Form::open(array(
'url'=>route('email.contato'),
'method'=>'post',
'id' => 'contato',
'name'=>'contato',
'class'=>'form-horizontal',
'role'=>'Form'
))
!!}
<div id="mensagem_contato"></div>
<div id="info_contato"></div>
<div class="form-group padding-top5">
    <div class="col-sm-2">
        <label for="nome" class="text-smallmedio fg-white">Nome</label>
    </div>
    <div class="col-sm-10 fg-dark ">
        <input type="text" class="form-control no-radius" placeholder="Como gostaria de ser chamado?" id="nome" value="" name="nome" required>
    </div>
</div>
<div class="form-group padding-top5">
    <div class="col-sm-2">
        <label for="email" class="text-smallmedio fg-white">Email</label>
    </div>
    <div class="col-sm-10 fg-dark">
        <input type="email" class="form-control no-radius" placeholder="Seu email para contato" id="email" value="" name="email" required>
    </div>
</div>
<div class="form-group padding-top5">
    <div class="col-sm-2">
        <label for="email" class="text-smallmedio fg-white">Telefone</label>
    </div>
    <div class="col-sm-10 fg-dark">
        <input type="tel" class="form-control no-radius" placeholder="Seu telefone para contato" id="telefone" value="" name="telefone" required>
    </div>
</div>
<div class="form-group padding-top5">
    <div class="col-sm-2">
        <label class="text-smallmedio fg-white">Mensagem</label>
    </div>
    <div class="col-sm-10 fg-dark">
        <textarea id="mensagem" name="mensagem" rows="3" style="width:100%" ></textarea>
    </div>
</div>
<div class="form-group padding-top5">
    <div class="col-sm-offset-2 col-sm-10">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <a href="javascript:void(0)" onclick="EmailEnviar('contato', '{{route('email.contato')}}');" id="btn_contato" class="btn bg-smallgray fg-dark no-radius pull-right">Enviar</a>
    </div>
</div>
{!!Form::close()!!}
<div style="margin-top: 20px"> </div>