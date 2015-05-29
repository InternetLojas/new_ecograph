<div class="modal fade" id="modalVerificando">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Verificando</h4>
            </div>
            <div class="modal-body">
                <div id="verificando" style="display:none;margin:auto;text-align: center">
                    Aguarde...Verificando informações!
                    {{ HTML::image('img/preloading.gif', $title='Aguarde! Pesquisando...', array('style'=>'width:100%; max-width:128px')) }}
                </div> 
                <div id="mensagem_logincarrinho"></div>
                <div id="info_logincarrinho"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->