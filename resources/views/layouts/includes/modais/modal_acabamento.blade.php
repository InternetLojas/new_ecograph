<a class="btn btn-primary" data-toggle="modal" href='#ModalAcabamento'>Trigger modal</a>
<div class="modal fade" id="ModalAcabamento">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Template</h4>
            </div>
            <div class="modal-body">
                @if($concluido)
                    <div class="successmsg alert">
                        <strong>Parabéns!</strong> Edição concluída com sucesso.<br>
                        Você poderá usar o seu template exclusivo quando bem entender.<br>
                        Na página de sua conta pessoal será mostrado os templates a sua disposição.
                    </div>
                    <p>Você tambem pode vê-lo seguindo esse <a href="{{$link_download}}" title="Link para download do template" target="_blank" >Link</a></p>
                    @else
                    <div class="errormsg alert">
                        <strong>Erro!</strong> Não pudemos receber o link.<br>
                        O link para o seu template exclusivo não foi gerado pelo sistema.<br>
                        Por favor volte e tente novamente.<br>
                        Obrigado!
                    </div>
                    @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->