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
                        <span id="wait" style="display:none;">                           
                            <img src="images/img/loader.gif" class="img-responsive" alt="Image" width="16">  
                        </span>
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
            <p id="label_frete" class="text-medio text-center" style="display:none;">
                <strong>
                    Resumo: Valor - <span id="vl_final"></span>
                    <span id="vl_desc_final"></span>
                    Frete: <span id="escolha_frete"></span>
                    Valor Total: <span id="vl_total_final"></span>
                </strong>
            </p>
             <div id="info_encerrar"></div>   
        </div>
        <div class="clearfix"></div> 
        <div class="destaque_home" id="btn-opcoes" style="display:none">             
            <div class="well well-md"> 
                <div class="text-center">
                    <!--<button type="button" class="btn bg-smallgray fg-black no-radius text-medio" onclick="SolicitarOrcamento()">
                        SOLICITAR ORÇAMENTO
                    </button>-->
                    <div class="text-center">                       
                        <button type="button" title="Gere o orçamento para impressão" class="btn bg-smallgray fg-black no-radius text-medio" id="btn-imprimir" onclick="Encerrar()">
                            CONTINUAR
                        </button>
                        <button type="button" title="Encontre o desenho que mais lhe convem" class="btn bg-smallgray fg-black no-radius text-medio" id="btn-personalizar" onclick="Encerrar()">
                            CONTINUAR
                        </button>
                        <button type="button" title="Envie sua arte para nós" class="btn bg-smallgray fg-black no-radius text-medio" id="btn-enviar" onclick="Encerrar()">
                            CONTINUAR
                        </button>
                    </div>
                </div>
            </div>        
        </div>
        @include('layouts.includes.boxes.forms.form_orcamento') 
    </div>
</div>
