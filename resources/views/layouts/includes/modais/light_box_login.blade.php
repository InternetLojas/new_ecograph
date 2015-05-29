<div class="modal fade" id="modalVerificando"> 
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Aguarde!</h4>
            </div>
            <div class="modal-body">
                <div id="verificando_formlogin" style="display:none;margin:auto;text-align: center">
                    Verificando informações...
                    {{ HTML::image('img/preloading.gif', $title='Aguarde! Pesquisando...', array('style'=>'width:100%; max-width:128px')) }}
                </div> 
                <div id="mensagem_formlogin"></div>
                <div id="info_formlogin"></div>
            </div>
            <div class="modal-footer">
                <button type="button" title="Erro de acesso" class="btn btn-fichas btn-green tooltip-test" data-dismiss="modal" id="close_lightbox"><i class="icon icon-off"></i> Fechar janela</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->