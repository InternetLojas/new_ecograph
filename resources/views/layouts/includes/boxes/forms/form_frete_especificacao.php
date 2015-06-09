<form class="form-horizontal" role="form" id="correio" name="correio">
    <div class="form-group">
        <div class="input-group">
            <div class="col-md-3">
                <label class="text-medio">CEP</label>
            </div>
            <div class="col-md-7">
                <input type="text" class="form-control no-radius" placeholder="Informe o cep" id="orc_cep" name="orc_cep" >
            </div>
            <div class=" col-md-offset-0 col-md-2">
                <a href="javascript:void(0)" class="btn bg-yellow fg-black no-radius" onclick="javascript:FreteOrcamento();">
                    Frete
                </a>
            </div>
        </div>
        <div id="resultado" style="display:none">
            <div class="input-group" data-role="input-group">
                <div class="col-md-12">
                    <p>Escolha um tipo de envio abaixo.</p>
                    <ol class="list-inline text-medio bg-smallgray">
                        <li>
                            <span class="check"></span>
                            PAC: <span id="vl_pac" ></span>
                            <input id="frete_pac" type="radio" value="" name="vl_frete" onclick="SetaFreteOrcamento('PAC', 'frete_pac')" />
                        </li>
                        <li>
                            <span class="check"></span>
                            SEDEX: <span id="vl_sedex" ></span>
                            <input id="frete_sedex" type="radio" value="" name="vl_frete" onclick="SetaFreteOrcamento('SEDEX', 'frete_sedex')" />
                        </li>
                    </ol>
                </div>
            </div>            
            <!--<label></label>
            <div class="input-control text" data-role="input-control" >
                Prazo para entrega através PAC: <b><span id="prazo_pac"></span></b><br>
                Prazo para entrega através SEDEX: <b><span id="prazo_sedex"></span></b>
            </div>-->
        </div>
    </div>
    <input type="hidden" id="orc_peso_frete" name="orc_peso">
    <input type="hidden" name="_token" value="{!!csrf_token()!!}" class="token"/>
</form>

