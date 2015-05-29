<table class="table striped bordered hovered">

    <tbody>
        <tr>
            <td class="text-center">
                <span class="extra bold">Produtos :</span>
            </td>
            <td class="text-center">
                <span class="bold">{{ Utilidades::toReal($cart_total) }}</span>
            </td>       
        </tr>
        <tr>
            <td>
                <span class="extra bold">
                    Frete :<span id="tipo_escolha_frete"></span> 
                </span>
            </td>
            <td>
                <span class="bold">
                    <span id="escolha_frete"></span>  
                </span>
            </td>
        </tr>
        <tr class="info">
            <td><span class="extra bold ">Sub-Total :</span></td>
            <td><span class="bold totalamout" id="cartotal">{{Utilidades::toReal($cart_total)}}</span></td>
        </tr>
        <tr class="info">
            <td><span class="extra bold">Desconto :</span></td>
            <td><span class="bold red" id="descontos">R$ 0,00</span></td>
        </tr>
        <tr class="info">
            <td><span class="extra bold totalamout">TOTAL :</span></td>
            <td><span class="bold totalamout" id="totalgeral"></span></td>
        </tr>
    </tbody>
</table>