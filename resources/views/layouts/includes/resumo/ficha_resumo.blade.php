
<div class="row">
    <div class="col-lg-6 col-md-5 col-sm-6 col-xs-12 pull-right">
        <h3>Resumo Total:</h3>
        <table class="table table-striped table-hover cart-table">
            <tbody>
            <tr>
                <td><strong>Sub Total</strong></td>
                <td>{{Utilidades::toReal(Cart::total())}}</td>
            </tr>
            <tr>
                <td><strong>Frete</strong></td>
                <td>{{Utilidades::toReal($post_inputs['orc_vl_frete'])}}</td>
            </tr>
            <tr>
                <td><strong>Desconto Cupom</strong></td>
                <td>{{Utilidades::toReal($post_inputs['orc_desconto_valor'])}}</td>
            </tr>
            <tr class="big-total">
                <td><strong>Total</strong></td>
                <td>{{Utilidades::toReal(Cart::total()+$post_inputs['orc_vl_frete']-$post_inputs['orc_desconto_valor'])}}</td>
            </tr>
            </tbody>
        </table>
        <form class="form-inline">

            <fieldset>
                <div class="control-group">
                    <label>Concordo com esse resumo.
                        <input type="checkbox" name="agree" id="agree" class="form-control" checked>
                    </label>
                    <span id="concorde" class="red" style="display:none"><strong>Verifique</strong></span>
                </div>
            </fieldset>
            <div class="text-right">
                <a href="{{route('index')}}" data-original-title="Voltar para o início" title="Acrescentar mais produtos no carrinho" class="btn btn-lg bg-dark fg-white no-radius ">
                    <i class="icon-arrow-left icon-white"></i> Início
                </a>

                <button type="button" data-original-title="Ir para o caixa" title="Efetuar o pagamento" class="btn btn-lg btn-red no-radius btn-warning" id="btn_resumo">
                    <i class="icon-ok-circle icon-white"></i> Caixa
                </button>
            </div>
        </form>
    </div>
</div>
<div style="display:block;width:100%;padding:12px 0;height:5px;"></div>