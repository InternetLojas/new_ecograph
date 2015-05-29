<p>
    Ganhe descontos na sua compra.<br>
    Se você possue código de desconto informe no campo abaixo e clique em validar.
</p>
<form id="cupom" name="cupom">
    <fieldset>
        <label>COD</label>
        <div class="input-control text" data-role="input-control" >
            <input type="text" placeholder="Informe o cupom" id="discount_code" name="discount_code" >
            <input type="hidden" name="_token" value="{!!csrf_token()!!}"/>
            <button type="button" class="btn-search" onclick="javascript:ValidaCupom('cupom','desconto');"></button>
        </div>
    </fieldset>
</form> 