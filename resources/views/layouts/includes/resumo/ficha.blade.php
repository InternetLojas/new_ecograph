<div class="row">
    <div class="example ficha" class="text-left">
        <div class="pull-right" style="margin-right:30px">
            <table class="table table-striped table-bordered ">
                <tr>
                    <td><span class="extra bold">Sub-Total :</span></td>
                    <td><span class="bold">{{ Utilidades::toReal(Cart::total()) }}</span></td>
                </tr>
                <tr>
                    <td><span class="extra bold">Frete :</span></td>
                    <td><span class="bold">{{ Utilidades::toReal($vl_frete) }}</span></td>
                </tr>
                <tr>
                    <td><span class="extra bold">Desconto a vista :</span></td>
                    <td><span class="bold red" >{{ Utilidades::toReal($vl_desconto_avista) }}</span></td>
                </tr>
                <tr>
                    <td><span class="extra bold">Desconto cupom:</span></td>
                    <td><span class="bold red" id="desconto_promocional">R$ 0,00</span></td>
                </tr>
                <tr>
                    <td><span class="extra bold">TOTAL :</span></td>
                    <td><span class="bold" id="totalgeral">{{ Utilidades::toReal(Cart::total()+$vl_frete-$vl_desconto_avista) }}</span></td>
                </tr>
            </table>
        </div>
    </div>
    @include('layouts.includes.boxes.forms.form_lista_resumo')
</div>
