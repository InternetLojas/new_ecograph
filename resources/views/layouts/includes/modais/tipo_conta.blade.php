<div class="modal fade"  id="ModalConta"> 
    <div class="modal-dialog">
        {!! 
        Form::open(
        array(
        'url'=> URL::to('tipoContaJson'),
        'method' => 'post', 
        'id'=>'formtipoconta', 
        'name'=>'formtipoconta'
        ))
        !!}             

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Modal title</h4>
            </div>
            <div class="modal-body">
                @include('layouts.includes.boxes.forms.form_modal_tipo_cadastro_') 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-orange tooltip-test" data-dismiss="modal" title="Fechar a janela"><i class="icon-off"></i> Fechar</button>
                <button type="button" class="btn btn-primary tooltip-test" title="Enviar meus dados" id="btn_tipoconta"><i class="icon-ok"></i> Enviar</button>
            </div>
        </div>
        {!!form::close()!!}
    </div>
</div>
