<div class="section" id="especificacoes_selecionada" style="display:none" data-token="{!!csrf_token()!!}">
    <!--============================== content =================================-->
    <div class="destaque_home">
        <div class="row">
            @include('layouts.includes.boxes.opcoes_finalizacao')
        </div>
        <div class="row">
            <div id="cupom_frete" style="display:none">
                <br>
                <p>Ganhe descontos na sua compra. Se você possue código de desconto informe no campo abaixo e clique para validá-lo.</p>
                <br>
                <div class="col-md-6">
                    <div id="info_cupom"></div>
                    <div id="mensagem_cupom"></div>
                    @include('layouts.includes.boxes.forms.form_cupom_especificacao')
                </div>
                <div class="col-md-6">
                    <div id="info_correio"></div>
                    <div id="mensagem_correio"></div>
                    @include('layouts.includes.boxes.forms.form_frete_especificacao')
                </div>
            </div>
            <p id="label_frete" style="display:none">
                Resumo: Valor - <span id="vl_final"></span>
                <span id="vl_desc_final"></span>
                Frete: <span id="vl_frete_final"></span>
                Valor Total: <span id="vl_total_final"></span>
            </p>
        </div>
        @include('layouts.includes.boxes.forms.form_orcamento')
    </div>
</div>
