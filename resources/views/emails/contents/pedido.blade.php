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
                                            <h2>Seu pedido está concluído.</h2>
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
                                    Prezado(a) Sr(a). {{$customers_name}}<br>
                                    seu pedido foi REGISTRADO com sucesso em nosso sistema com o número {{$id}}.<br>
                                    Estamos <strong>AGUARDANDO CONFIRMAÇAO DO PAGAMENTO</strong>.<br>
                                    Caso necessite imprimir a segunda via do boleto basta acessar o site {{STORE_SITE}} e clicar sob a guia MEUS PEDIDOS.<br>
                                    Solicitamos que encaminhe o comprovante de pagamento para nosso e-mail {{STORE_OWNER_EMAIL_ADDRESS}} ou para o fax ( 67 ) 3521 - 4704 juntamente com o numero o pedido acima informado.<br>
                                    Se preferir entre em contato com nossas centrais de atendimento para comunicar o pagamento, lembrando sempre que o processo de envio sera iniciado somente apos a confirmação do pagamento.<br>
                                    Sempre que necessitar de informações sobre os pedidos realizados em nossa loja virtual basta acessar {{STORE_SITE}} e clicar sobre a guia "Meus Pedidos".<br>
                                    Se preferir poderá entrar em contato com nossa central do cliente através dos telefones {{STORE_FONE}}
                                </blockquote>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <!--fim da descricao-->
                <!--extras-->
                <table>
                    <tbody>
                        <tr>
                            <td width="650" align="left" style="font-family:Verdana,Geneva,sans-serif;font-size:12px !important;line-height:16px">
                                <blockquote style="text-align:justify;line-height:20px;border-left: 10px solid #D1D1D6; background-color: #C08002; padding: 10px; color: #212121;">
                                    Dados sobre o pagamento
                                </blockquote>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <!--fim do extras-->
            </td>
        </tr>
    </tbody>
</table>