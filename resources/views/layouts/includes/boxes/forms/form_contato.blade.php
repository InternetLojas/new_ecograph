<form class="form-horizontal" role="form">
    <div class="form-group">
        <div class="col-sm-2">
            <label for="nome" class="control-label">Nome</label>
        </div>
        <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="Como gostaria de ser chamado?" id="nome" value="" name="nome" required>

        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2">
            <label for="email" class="control-label">Email</label>
        </div>
        <div class="col-sm-10">
            <input type="email" class="form-control" placeholder="Seu email para contato" id="email" value="" name="email" required>

        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2">
            <label for="email" class="control-label">Telefone</label>
        </div>
        <div class="col-sm-10">
            <input type="tel" class="form-control" placeholder="Seu email para contato" id="telefone" value="" name="telefone" required>

        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2">
            <label class="control-label">Mensagem</label>
        </div>
        <div class="col-sm-10">
            <textarea id="mensagem" name="mensagem" rows="3" cols="55"></textarea>
        </div>
    </div> 
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button type="submit" class="btn btn-default pull-right">Enviar</button>
        </div>
    </div>
</form>