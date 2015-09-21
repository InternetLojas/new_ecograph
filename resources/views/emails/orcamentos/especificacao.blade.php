<table cellpadding="0" cellspacing="0" class="orc-mail">
    <tbody>
    <tr>
        <td class="mail-product-name" width="100%">
            Produto: <strong>{!!$orc_subcategoria_nome!!}</strong>
        </td>
    </tr>
    </tbody>
</table>
<table width="600" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" class="wrapper">
    <thead>
    <tr>
        <th class="head text-center">Qtd</th>
        <th class="head text-center">Especificações Selecionadas</th>
        <th class="head text-center">Valor</th>
        <th class="head text-center">Desconto</th>
        <th class="head text-center">Frete</th>
        <th class="head text-center">
            Valor Total
        </th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td  class="head text-medio">
            {!!$orc_pacote_qtd!!}
        </td>
        <td valign="top" align="left" class="head text-medio">
            Produto: {!!$orc_subcategoria_nome!!}<br>
            Formato: {!!$orc_formato_nome!!}<br>
            Cores: {!!$orc_cor_nome!!}<br>
            Material: {!!$orc_papel_nome!!}<br>
            Acabamento: {!!$orc_acabamento_nome!!}<br>
            Enoblecimento: {!!$orc_enoblecimento_nome!!}<br>
        </td>
        <td  class="head text-medio">
            {!!$orc_pacote_valor!!}
        </td>
        <td  class="head text-medio">
            {!!Utilidades::toReal($orc_desconto_valor)!!}
        </td>
        <td  class="head text-medio">
            {!!Utilidades::toReal($orc_vl_frete)!!}
        </td>
        <td  class="head text-medio">
            {!!Utilidades::toReal($orc_vl_frete+$vl_total-$orc_desconto_valor)!!}
        </td>
    </tr>
    </tbody>
</table>