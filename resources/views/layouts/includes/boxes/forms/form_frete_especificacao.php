<div id="info_correio"></div>
<div id="mensagem_correio"></div>
<form class="form-inline" role="form" id="correio" name="correio">
    <div class="form-group">
        <div class="col-md-2">
            <label class="control-label text-medio bg-smallgray btn-block" for="orc_cep">
                <span style="padding: 5px;text-align:center">Frete</span>
            </label>
        </div>
        <div class="col-md-5"> 
            <input type="text" class="form-control no-radius" placeholder="Informe o cep" id="orc_cep" name="orc_cep" >                   
        </div>
        <div class="col-md-2">                  
            <a href="javascript:void(0)" class="btn bg-yellow fg-black no-radius" onclick="javascript:FreteOrcamento();">
                Calcular
            </a>
        </div>
        <div class="col-md-3 text-medio text-center">
            <span id="escolha_frete"></span>
        </div>
        <input type="hidden" name="_token" value="" class="token"/>
        <input type="hidden" id="orc_peso_frete" name="orc_peso">
    </div> 
</form>