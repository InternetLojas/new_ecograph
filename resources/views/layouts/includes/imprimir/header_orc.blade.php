<table class="mail-header" cellpadding="0" cellspacing="0" width="100%">
    <!--Header-->
    <tbody>
        <tr>
            <td class="mail-header" width="650">
                <!--============================== header =================================-->
                <table cellpadding="0" cellspacing="0">
                    <tbody>
                    <tr>
                        <td width="650">
                            <table cellpadding="0" cellspacing="0">
                                <tbody>
                                <tr >
                                    <td class="mail-col" valign="top" width="650">
                                        <table cellpadding="0" cellspacing="0">
                                            <tbody>
                                            <tr>
                                                <td class="mail-first-child" valign="bottom" width="400" align="center">
                                                    <img class="contentImgEditable" alt="logo" src="images/theme/escudo.png">
                                                </td>
                                                <td class="mail-header-menu" valign="bottom" align="right">
                                                    <div class="contentEditable">
                                                        São Paulo, {!!date('d/m/Y')!!}
                                                    </div>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="mail-pattern" style="padding-bottom:20px" width="560" align="left">
                                        <h3>Solicitação de Orçamento</h3>
                                        <p class="text-medio fg-gray">
                                           Olá! Prezado {!!$customer->customers_firstname!!}.<br>
                                            Segue abaixo os itens solicitado para seu orçamento.
                                        </p>
                                        <p class="text-medio fg-gray">
                                            Iremos analizar suas necessidades e lhe retornaremos nossa cotação.<br>
                                            Obrigado por escolher a <strong>{{STORE_NAME}}</strong>.
                                        </p>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <!--============================== header =================================-->
            </td>
        </tr>
    <!--/Header-->
    </tbody>
</table>