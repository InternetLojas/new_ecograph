<form>
    <div class="form-group">       
        <div class="input-group" data-role="input-group">
            <ul class="list-inline text-medio">
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
            </ul>
        </div>            
        <!--<label></label>
        <div class="input-control text" data-role="input-control" >
            Prazo para entrega através PAC: <b><span id="prazo_pac"></span></b><br>
            Prazo para entrega através SEDEX: <b><span id="prazo_sedex"></span></b>
        </div>-->
    </div>
</form>