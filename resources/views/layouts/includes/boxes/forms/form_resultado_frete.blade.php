<form class="form-inline">
    <div class="form-group">
        <div class="col-md-12">
            <ul class="list-inline text-medio">
                <li class="col-md-4">
                    <label for="vl_frete"> SEDEX: <span id="vl_sedex" ></span> </label>
                    <input id="frete_sedex" class="form-control" type="radio" value="" name="vl_frete" onclick="SetaFrete('SEDEX', 'frete_sedex')" />
                </li>
                <li class="col-md-4">
                    <label for="vl_frete">TRANSPORTADORA (<small class="fg-red">o cliente escolhe sua transportadora</small>) </label>
                    <input id="frete_transportadora" class="form-control" type="radio" value="0.00" name="vl_frete" onclick="SetaFrete('TRANSPORTADORA', 'frete_transportadora')" />
                </li>
                <li class="col-md-4">
                    <label for="vl_frete">RETIRAR NA LOJA (<small class="fg-red">sem custo para envio</small>)</label>
                    <input id="frete_retirar_loja" class="form-control" type="radio" value="0.00" name="vl_frete" onclick="SetaFrete('RETIRAR NA LOJA', 'frete_retirar_loja')" />
                </li>
            </ul>
        </div>
    </div>
</form>