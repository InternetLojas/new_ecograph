<table class="head_carrinho text-medio">
    <tbody>
        <tr>
            <td class="col-cesta-title">
                <span class="cesta_title fg-white">
                    Entrega
                </span>
            </td>
            <td>Tipo de Frete</td>
            <td>Endereço</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </tbody>
</table>
<table class="body_carrinho">
    <tbody>
        <tr>
            <td class="col-cesta-img">
                <div class="col-cesta-title-img"></div>
            </td>
            <td class="td-content-carrinho">                
                <table class="items">
                    <tbody>
                        <tr>
                            <td class="vinte">                                
                            </td>
                            <td>
                                frete
                            </td>
                            <td class="text-medio endereco">

                                <b class="shipping">Nome:</b> {!! $default_address['entry_firstname'] !!} {!! $default_address['entry_lastname'] !!}<br /> 
                                <b class="shipping">Av/Rua:</b> {!! $default_address['entry_street_address'] !!}<br /> 
                                <b class="shipping">Nº:</b> {!! $default_address['entry_nr_rua'] !!} <br />
                                <b class="shipping">Complemento:</b> {!! $default_address['entry_comp_ref'] !!}<br /> 
                                <b class="shipping">Bairro:</b> {!! $default_address['entry_suburb'] !!}<br /> 
                                <b class="shipping">Cidade:</b> {!! $default_address['entry_city'] !!}, 
                                <b class="shipping">CEP:</b> {!! $default_address['entry_postcode'] !!}<br /> 
                                <b class="shipping">Estado:</b> {!! $default_address['entry_state'] !!}<br> 
                                <b class="shipping">País:</b> Brasil

                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>