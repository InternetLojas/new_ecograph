<div id="info_basket"></div>
<div class = "row">
    @include('layouts.includes.boxes.listagem')
    @include('layouts.includes.boxes.forms.form_basket')
    <div id="itens_carrinho" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Produto adicionado na cesta</h4>
                </div>
                <div class="modal-body">
                    Verifique <small class="on-right">sua escolha</small>
                    <img id="escolhido" src="" class="img-responsive" />
                </div>
                <div class="modal-footer">
                    <a class="btn btn-default no-radius" data-dismiss="modal" onclick="BasketSubmeter();">Finalizar</a>
                    <a class="btn btn-primary no-radius" data-dismiss="modal" aria-hidden="true">Fechar</a>
                </div>
            </div>
        </div>
    </div>
</div>