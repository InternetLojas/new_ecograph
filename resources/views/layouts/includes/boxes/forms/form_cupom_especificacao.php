<div id="info_cupom"></div>
<div id="mensagem_cupom"></div>
<form class="form-horizontal" role="form" id="cupom" name="cupom">
    <div class="form-group">
        <div class="input-group">
            <div class="form-group">
                <div class="col-md-3 col-md-push-1">
                    <label class="control-label text-medio  bg-smallgray" for="discount_code">
                        <span class="btn-block" style="text-align:center; padding:5px">Cupom</span>
                    </label>
                </div>
                <div class="col-md-5">                
                    <input type="text" id="discount_code" name="discount_code" class="form-control no-radius" placeholder="Informe Codigo" required />
                </div>
                <div class="col-md-pull-1 col-md-2">
                    <a href="javascript:void(0)" class="btn bg-yellow fg-black no-radius" onclick="javascript:ValidaCupom('cupom', 'desconto');" title="Valide seu cupom">
                        Validadar
                    </a>                                    
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" name="_token" value="" class="token"/>
</form>

