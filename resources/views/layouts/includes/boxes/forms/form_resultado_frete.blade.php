<form>
    <div class="form-group">       
        <div class="input-group" data-role="input-group">
            <ul class="list-inline text-medio">                
                <li>
                    <span class="check"></span>
                    SEDEX: <span id="vl_sedex" ></span>
                    <input id="frete_sedex" type="radio" value="" name="vl_frete" onclick="SetaFrete('SEDEX', 'frete_sedex')" />
                </li>
                <li>
                    <span class="check"></span>
                    TRANSPORTADORA (<small class="fg-red">o cliente escolhe sua transportadora</small>)
                    <input id="frete_transportadora" type="radio" value="0.00" name="vl_frete" onclick="SetaFrete('TRANSPORTADORA', 'frete_transportadora')" />
                </li>
                <li>
                    <span class="check"></span>
                    RETIRAR NA LOJA (<small class="fg-red">sem custo para envio</small>) 
                    <input id="frete_retirar_loja" type="radio" value="0.00" name="vl_frete" onclick="SetaFrete('RETIRAR NA LOJA', 'frete_retirar_loja')" />
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