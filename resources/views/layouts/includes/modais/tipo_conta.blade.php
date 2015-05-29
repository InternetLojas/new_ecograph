<div class="modal fade" id="ModalConta">
    <div class="modal-dialog">
        {{ Form::open(array(
                            'url'=>'clientes/criarconta',
                            'id'=>'formtipoconta', 
                            'name'=>'formtipoconta',
                            'method' => 'post', 
                            'class'=>'form-inline', 
                            'onsubmit'=>'return TipoContaJson(this.id,\''.URL::to('tipoContaJson').'\');'))
        }} 
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Informe os dados para continuar</h4>
            </div>
            <div class="modal-body">
                <div id="verificando_formtipoconta" style="display:none;margin:auto;text-align: center">
                    Verificando informações...
                    {{ HTML::image('img/preloading.gif', $title='Aguarde! Pesquisando...', array('style'=>'width:100%; max-width:128px')) }}
                </div> 
                @include('layouts.includes.boxes.form_modal_tipo_cadastro')
                <div id="mensagem_formtipoconta"></div>
                <div id="info_formtipoconta"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-fichas btn-green tooltip-test pull-left" data-dismiss="modal" title="Fechar a janela"><i class="icon icon-ok"></i> Fechar</button>
                <button type="submit" class="btn btn-fichas btn-green tooltip-test pull-left" title="Enviar meus dados"><i class="icon icon-ok"></i> Enviar</button>
            </div>                                      
        </div><!-- /.modal-content -->
        {{Form::close()}}
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->                          
