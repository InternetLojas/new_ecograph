<table class="mail-wrapper-content">
    <tbody>
        <tr>
            <td class="mail-content">
                <!--assunto-->
                <table>
                    <tbody>
                        <tr>
                            <td width="650" align="center" style="font-family:Verdana,Geneva,sans-serif;font-size:14px !important;line-height:20px;border-top: solid 3px #D5D5D5;border-bottom: solid 3px #D5D5D5;">
                                <table>
                                    <tr>
                                        <td style="text-align:left;padding:5px 10px;">
                                            <h2>Consulta de produtos</h2>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <!--fim assunto-->
                <!--descricao-->
                <table>
                    <tbody>
                        <tr>
                            <td width="650" align="left" style="font-family:Verdana,Geneva,sans-serif;font-size:12px !important;line-height:16px">
                                <blockquote style="text-align:justify;line-height:20px;border-left: 10px solid #D1D1D6;  padding: 10px; color: #212121;">
                                    Recebemos sua solicitação sobre o preço praticado para o produto <strong>{{Productdescription::find(Input::get('product_consulte'))->products_name}}</strong>.<br>
                                    Em breve você estará recendo informações sobre esse produto.<BR>
                                    Obrigado por seu interesse.
                                </blockquote>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <!--fim da descricao-->
            </td>
        </tr>
    </tbody>
</table>