<div class="">
    <div id="especificacoes_selecionada" style="display:none;" data-token="{!!csrf_token()!!}">
        <!--============================== content =================================-->
        @include('layouts.includes.boxes.opcoes_finalizacao')
        <div class="clearfix"></div>
        <div class="destaque_home" id="cupom_frete" style="display:none;" data-acao="imprimir">
            <div class="col-md-6">
                <div class="well well-md">
                    <p class="text-medio" style="min-height:60px">
                        Ganhe descontos na sua compra.<br>
                        Se você possue código de desconto informe no campo abaixo e clique para validá-lo.
                    </p>
                    @include('layouts.includes.boxes.forms.form_cupom_especificacao')
                </div>
            </div>
            <div class="col-md-6">
                <div class="well well-md">
                    <p class="text-medio" style="min-height:60px">
                        Informe o CEP para pesquisar o valor do frete:<br>

                    </p>
                    @include('layouts.includes.boxes.forms.form_frete_especificacao')
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="destaque_home" id="resultado" style="display:none;">
            <p class="text-medio text-center"><strong>Escolha uma forma de envio para continuar.</strong></p>
            <div class="text-center">
                @include('layouts.includes.boxes.forms.form_resultado_frete')
            </div>
            <div id="label_frete" style="display:none;">
                <table class="table table-hover text-medio text-center">
                    <tbody>
                    <tr>
                        <td>
                            Resumo: Valor - <span id="vl_final"></span>
                        </td>
                        <td>
                            Desconto: - <span id="vl_desc_final"></span>
                        </td>
                        <td>
                            Frete: - <span id="escolha_frete"></span>
                        </td>
                        <td></span>
                            Valor Total: - <span id="vl_total_final"></span>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="destaque_home" id="btn-opcoes" style="display:none">
            <div id="info_encerrar"></div>
            <div class="well well-md">
                <button style="margin:auto" type="button" class="btn bg-smallgray fg-black no-radius text-medio" id="btn-encerrar" onclick="Encerrar()">
                    CONTINUAR
                </button>
            </div>
        </div>
        @include('layouts.includes.boxes.forms.form_orcamento')
    </div>
</div>
