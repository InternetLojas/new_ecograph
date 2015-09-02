
<span style="display:block;float:left" >
<img id="wait" style="display:none" src="images/img/loader.gif" class="img-responsive" alt="Image" width="16">
</span>
<form class="form-horizontal" role="form" id="correio" name="correio">
    <div class="form-group">
        <div class="col-md-3 col-md-push-1">
            <label for="orc_cep">
                <span class="btn text-medio bg-smallgray btn-block no-radius" >Frete</span>
            </label>
        </div>
        <div class="col-md-5">
            <input type="text" class="form-control no-radius" placeholder="Informe o cep" id="orc_cep" name="orc_cep" >
        </div>
        <div class="col-md-pull-1 col-md-2">
            <a href="javascript:void(0)" class="btn bg-yellow fg-black no-radius" onclick="javascript:FreteOrcamento();">
                <span style="float:left">Calcular</span>
            </a>
        </div>
    </div>
    <input type="hidden" id="pdf" name="pdf" value="0"/>
    <input type="hidden" name="_token" value="" class="token"/>
    <input type="hidden" id="vl_declarado" name="vl_declarado"/>
    <input type="hidden" id="orc_peso_frete" name="orc_peso">
</form>
