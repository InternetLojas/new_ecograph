<!-- RESULTADO DO FRETE-->

<div class="row">
    <form class="form-inline">
        <div class="form-group">
            <ul class="list-group list-inline text-medio">
                <li class="list-group-item">
                    <label for="vl_frete" > SEDEX: <span id="vl_sedex" class="text-danger"></span> </label>
                    <input id="frete_sedex" class="form-control" type="radio" value="" name="vl_frete" onclick="SetaFrete('SEDEX', 'frete_sedex')" />
                </li>
                <li class="list-group-item">
                    <label for="vl_frete">TRANSPORTADORA (<small class="fg-red">o cliente escolhe a transportadora</small>) </label>
                    <input id="frete_transportadora" class="form-control" type="radio" value="0.00" name="vl_frete" onclick="SetaFrete('TRANSPORTADORA', 'frete_transportadora')" />
                </li>
                <li class="list-group-item">
                    <label for="vl_frete">RETIRAR NO END. DA ECOGRAPH</label>
                    <input id="frete_retirar_loja" class="form-control" type="radio" value="0.00" name="vl_frete" onclick="SetaFrete('RETIRAR NA LOJA', 'frete_retirar_loja')" />
                </li>
            </ul>
        </div>
    </form>
</div>