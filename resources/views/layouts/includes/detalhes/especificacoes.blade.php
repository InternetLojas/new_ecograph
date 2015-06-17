<div class="section" id="especificacoes_selecionada" style="display:none" data-token="{!!csrf_token()!!}">
    <!--============================== content =================================-->
    <div class="destaque_home">
        @include('layouts.includes.boxes.opcoes_finalizacao')
        <div id="cupom_frete" style="display:none">           
            <p class="text-medio">Ganhe descontos na sua compra. Se você possue código de desconto informe no campo abaixo e clique para validá-lo.</p>
            <div id="resultado" style="display:none">
                <div class="row">
                    @include('layouts.includes.boxes.forms.form_resultado_frete')
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    @include('layouts.includes.boxes.forms.form_cupom_especificacao')
                </div>
                <div class="col-md-6">
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
    </div>

    <div class="destaque_home" id="btn-opcoes" style="display:none">
        <div class="col-md-6">       
            <p class="bg-dark fg-white text-center" >
                Não encontrou o produto desejado, clique em solicitar orçamento.
            </p>
            <a href="orcamento.html" title="Solicite um orçamento" class="btn bg-gray fg-white no-radius">
                SOLICITAR ORÇAMENTO
            </a>
        </div>
        <div class="col-md-6">
            <p class="bg-dark fg-white text-center" >
                Clique em ver os desenhos para prosseguir.
            </p>
            <button type="button" class="btn bg-gray fg-white no-radius" onclick="Comprar()">
                VER OS DESENHOS
            </button>
        </div>
    </div>
    @include('layouts.includes.boxes.forms.form_orcamento') 
</div>
