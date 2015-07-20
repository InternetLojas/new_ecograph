<div id="info_cupom"></div>
<div id="mensagem_cupom"></div>
<span style="display:block;float:left" >
<img id="wait-cupom" style="display:none" src="images/img/loader.gif" class="img-responsive" alt="Image" width="16">
</span>
<form class="form-horizontal" role="form" id="cupom" name="cupom">
    <div class="form-group">
        <div class="col-md-3 col-md-push-1">
            <label for="discount_code">
                <span class="btn text-medio  bg-smallgray btn-block no-radius">Cupom</span>
            </label>
        </div>
        <div class="col-md-5">
            <input type="text" id="discount_code" name="discount_code" class="form-control no-radius" placeholder="Informe Codigo" required />
        </div>
        <div class="col-md-pull-1 col-md-2">
            <a href="javascript:void(0)" id="btn-validar" class="btn bg-yellow fg-black no-radius" onclick="javascript:ValidaCupom('cupom', 'desconto');" title="Valide seu cupom">
                <span style="float:left">Validar</span>
            </a>
            <!--<button type="button" id="btn_cupom_confirmar" class="btn bg-gray fg-black no-radius" style="display:none">Confirmar</button>-->
        </div>
    </div>
    <input type="hidden" name="_token" value="" class="token"/>
    <input type="hidden" id="perc_desconto" name="perc_desconto">
</form>
