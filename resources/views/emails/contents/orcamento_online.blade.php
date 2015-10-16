<!-- RESUMO-->
<!--============================== content =================================-->
<table class="mail-wrapper">
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
                                    <h2>Orçamento OnLine</h2>
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
                            Recebemos sua solicitação para gerar um orçamento.<br>
                            Abaixo segue a especificação de suas necessidades.<br>
                            Obrigado por seu interesse.
                        </blockquote>
                    </td>
                </tr>
                <tr>
                    <td>
                        <style type="text/css" media="screen">
                            /* Estilo básico */
                            .mail-footer p{margin:0;padding:2px 6px;margin-bottom:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;line-height: 14px}
                            .mail img{line-height:100%;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic}
                            .mail a img{border:none}
                            .mail{margin:0; padding:0; width:100% !important}
                            .mail a,.mail a:link{text-decoration:none!important}

                            /* Base CSS */
                            table[class="orc-mail"]{
                                width: 100%;
                                background:#fff;
                                font-family:Arial, Helvetica, sans-serif !important;
                                font-size: 14px;
                            }
                            table[class="wrapper"]{
                                width: 100%;
                                background:#fff;
                                font-family:Arial, Helvetica, sans-serif !important;
                                padding: 3px;
                                font-size: 12px;
                            }
                            table[class="mail-footer"]{
                                width: 100%;
                                background:#fff;
                                font-family:Arial, Helvetica, sans-serif !important;
                                padding: 3px;
                                font-size: 12px;
                                margin: 10px 0;
                            }
                            th[class="head text-center"]{
                                font-size: 12px;
                                border:1px solid #bcbcbc!important;
                                text-align: center;
                            }
                            td[class="head text-medio"]{
                                border:1px solid #bcbcbc!important;
                                font-size: 11px;
                            }
                            td[class="mail-wrapper"] {
                                padding: 10px 0!important;
                            }
                            td[class="mail-col"]{
                                padding-top:35px;
                                padding-bottom:15px;
                            }

                            /* Header CSS*/
                            @media only screen and (max-width: 650px) {
                                td[class="mail-header"] table { width: 100%; }
                                td[class="mail-header"] img {
                                    width: 100%;
                                    height: auto !important;
                                }

                                td[class="mail-content"] table { width: 100%; }
                                td[class="mail-content"] img {
                                    width: 100%;
                                    height: auto !important;
                                }
                                td.brand {
                                    width: 30%;
                                }
                                td.site {
                                    width: 70%;
                                }
                                td[class="mail-wrapper"] {
                                    padding: 0px 0!important;
                                }
                            }
                        </style>
                        <table class="" border="0" cellpadding="0" cellspacing="0" width="100%">
                            <tbody>
                            <tr>
                                <td class="" valign="top" width="100%" align="center">
                                    <!--============================== especificacao =================================-->
                                    @include('emails.orcamentos.especificacao_online')
                                    <!--============================== especificacao =================================-->
                                    <!--============================== detalhes =================================-->
                                    @include('emails.orcamentos.detalhes_online')
                                    <!--============================== detalhes =================================-->
                                </td>
                            </tr>
                            <tr>
                                <td class="mail-product-footer" valign="top" width="100%" align="center">
                                    <!--Footer-->
                                    <!--============================== footer =================================-->
                                    @include('emails.orcamentos.footer')
                                    <!--============================== footer =================================-->
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                </tbody>
            </table>
            <!--fim da descricao-->
        </td>
    </tr>
    </tbody>
</table>