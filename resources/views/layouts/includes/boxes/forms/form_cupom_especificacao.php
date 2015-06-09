<form class="form-horizontal" role="form" id="cupom" name="cupom">
    <div class="form-group">
        <div class="input-group">
            <div class="col-md-3">
                <label class="text-medio">CUPOM</label>
            </div>
            <div class="col-md-7">
                <input type="text" class="form-control no-radius" placeholder="Informe o cupom" id="discount_code" name="discount_code">
            </div>
            <div class=" col-md-offset-0 col-md-2">
                <a href="javascript:void(0)" class="btn  bg-yellow fg-black no-radius" onclick="javascript:ValidaCupom('cupom', 'desconto');" title="Valide seu cupom">
                    Validadar
                </a>                                    
            </div>
        </div>
    </div>
    <input type="hidden" name="_token" value="{!!csrf_token()!!}" class="token"/>
</form>