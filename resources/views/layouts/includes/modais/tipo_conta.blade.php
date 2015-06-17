<div class="modal fade"  id="ModalConta"> 
    <div class="modal-dialog">
        <div class="modal-content text-medio">
            {!! 
            Form::open(
            array(
            'url'=> URL::to('tipoContaJson'),
            'method' => 'post', 
            'id'=>'formtipoconta', 
            'name'=>'formtipoconta',
            'class'=> 'form-horizontal',
            'role' => 'Form'))
            !!}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Crie agoar sua conta</h4>
            </div>
            <div class="modal-body">
                <div id="mensagem_formtipoconta"></div>
                <div id="info_formtipoconta"></div>
                @include('layouts.includes.boxes.forms.form_modal_tipo_conta')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-small bg-gray no-radius" data-dismiss="modal" title="Fechar a janela"><i class="icon-off"></i> Fechar</button>
            </div>       
            {!!form::close()!!}
        </div>
    </div>
</div>
