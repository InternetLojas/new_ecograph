
<table cellpadding="0" cellspacing="0">
    <tbody>
        <tr class="row">
            <td class="mail-col" valign="top" width="">
                <table cellpadding="0" cellspacing="0">
                    <tbody>
                        <tr>
                            <td valign="top" align="left">
                                Produto: <strong>{!!$post_inputs['orc_subcategoria_nome']!!}</strong>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>
<table class="table table-bordered" cellpadding="0" cellspacing="0">
    <thead class="text-center text-medio">
        <tr>
            <th class="text-center">Qtd</th>
            <th class="text-center">Especificações Selecionadas</th>
            <th class="text-center">Valor</th>
            <th class="text-center">Desconto</th>
            <th class="text-center">Frete</th>
            <th class="text-center">
                Valor Total                                   
            </th>
        </tr>
    </thead>
    <tbody>
        <tr class="text-medio">
            <td >
                {!!$post_inputs['orc_pacote_qtd']!!}
            </td>
            <td valign="top" align="left">
                Produto: {!!$post_inputs['orc_subcategoria_nome']!!}<br>
                Formato: {!!$post_inputs['orc_formato_nome']!!}<br>
                Cores: {!!$post_inputs['orc_cor_nome']!!}<br>
                Material: {!!$post_inputs['orc_papel_nome']!!}<br>
                Acabamento: {!!$post_inputs['orc_acabamento_nome']!!}<br>
                Enoblecimento: {!!$post_inputs['orc_enoblecimento_nome']!!}<br>
            </td>
            <td >
                {!!$post_inputs['orc_pacote_valor']!!}
            </td>
            <td >
                R$ 0,00
            </td>
            <td >
                {!!Utilidades::toReal($post_inputs['orc_vl_frete'])!!}
            </td>
            <td >
                {!!$post_inputs['orc_vl_frete']!!}
            </td>
        </tr>
    </tbody>
</table>