<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="{{META_DESCRIPTION}}" />
        <meta name="keywords" content="{{META_KEYWORDS}}" />
        <meta name="subject" content="Ferramentas automotivas a baixo preço" />
        <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.,user-scalable=no">         
        <title>*CONSULTA DE PRODUTO*</title>
        <style type="text/css">
            body {
                margin-left: 0px;
                margin-top: 0px;
                margin-right: 0px;
                margin-bottom: 0px;
                background:#EDEDED;
            }
            table {margin:0 auto}
        </style>
    </head>
    <body>
        <table width="650" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
            <tbody>
                <tr>
                    <td>
                        <style type="text/css" media="screen">
                            /* Estilo básico */
                            .mail p{margin:0;padding:0;margin-bottom:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none}
                            .mail img{line-height:100%;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic}
                            .mail a img{border:none}
                            .mail{margin:0; padding:0; width:100% !important}
                            .mail a,.mail a:link{text-decoration:none!important}

                            /* Base CSS */
                            @media only screen and (max-width: 599px) {
                                td[class="mail-wrapper"] {
                                    padding: 10px 0!important;
                                }                                
                            }

                            /* Header CSS*/
                            @media only screen and (max-width: 599px) {
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
                        <table class="mail">
                            <tbody>
                                <tr>
                                    <td class="mail-wrapper">
                                        <!--header-->
                                        @include('emails.header.header')
                                        <!--fim do header-->
                                        <!--contente-->
                                        @include('emails.contents.orcamento')
                                        <!--fim do content-->
                                        <!--footer-->
                                        @include('emails.footer')
                                        <!--fim do footer-->
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
    </body>
</html>