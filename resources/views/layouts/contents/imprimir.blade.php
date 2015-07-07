<div class="printer">
    <img src="images/theme/printer.jpg" alt="calculadora.png"  width="90" class="img-responsive" />
    <a class="btn bg-green fg-white no-radius text-center" title="Clique para imprimir" href="#" onclick="window.print();">Imprimir Orçamento</a>
</div>
<div id="printable" style="width:564px;padding: 20px 2px;margin:15px auto;border:1px solid #9f9f9f;border-top:none">
    <table class="mail" style="background:#fff;font-family:Arial, Helvetica, sans-serif !important;" border="0" cellpadding="0" cellspacing="0" width="100%">
        <tbody>
        <tr>
            <td class="mail-wrapper" style="background:#fff;text-align:center" valign="top" width="100%" align="center">
                <table class="mail-header" style="background-color:#ffffff;" cellpadding="0" cellspacing="0" width="100%">
                    <!--Header-->
                    <tbody>
                    <tr>
                        <td class="mail-header" width="560">
                            <!--============================== header =================================-->
                            @include('layouts.includes.imprimir.header')
                            <!--============================== header =================================-->
                        </td>
                    </tr>
                    <!--/Header-->
                    </tbody>
                </table>
                <table cellpadding="20" cellspacing="0">
                    <!--content-->

                    <!--Banner 560x200-->
                    <tbody>
                    <tr>
                        <td class="mail-pattern" style="padding-bottom:20px" width="560" align="left">
                            <h3>Orçamento Online Nº XXXX</h3>
                            <p class="text-medio fg-gray">
                                Prezado Cliente.<br>
                                Vimos através desta apresentar nossa proposta orçamentária para a confecção do(s) serviço(s) conforme especificação abaixo:
                            </p>
                        </td>
                    </tr>
                    <!--/Banner 560x200-->

                    <!--List With Thumbnails-->
                    <tr>
                        <td class="mail-payment" width="560">
                            <table cellpadding="0" cellspacing="0">
                                <tbody>
                                <tr>
                                    <td style="padding:10px 0;" width="560">
                                        <!--============================== especificacao =================================-->
                                        @include('layouts.includes.imprimir.especificacao')
                                        <!--============================== especificacao =================================-->
                                        <!--============================== frete =================================-->
                                        @include('layouts.includes.imprimir.frete')
                                        <!--============================== frete =================================-->

                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <!--/List With Thumbnails-->
                    <!-- List 2 columns with Thumbnails mail-pattern -->
                    <tr class="contentReplicable">
                        <td class="mail-wrapper two-columns" style="background:#ffffff;" valign="top" width="100%" align="left">
                            <table cellpadding="0" cellspacing="0">
                                <tbody>
                                <tr>
                                    <td valign="top" align="left" width="25">
                                        <!--<img class="contentImgEditable" src="http://mbox12.internetlojas.com/img/templates/img/125x140.gif" alt="produto" style="display: block; border: 0;" width="125" height="140">-->
                                    </td>
                                    <td class="contentEditable" style="font-family: arial,sans-serif;font-size:14px;color: #333;padding-left:20px;" valign="top" width="535" align="left">
                                        <!--<h3 style="font-size:20px;font-family:Arial, Helvetica, sans-serif !important;font-weight: normal;margin:0;">MODELO 01</h3>-->
                                        <p>
                                            Validade da proposta : 10 dias dias. As quantidades poderão variar 10% para mais ou 10% para menos que serão devidamente faturadas para o cliente.
                                            A gráfica não se responsabiliza por erros de fotolito, ctp e arquivo digital quando fornecido pelo cliente.<br>
                                            SOLICITE UMA PROVA DE COR OU ENVIE UMA PROVA DE REFERENCIA, ARQUIVOS SEM PROVA DE CORES ISENTA A RESPONSABILIDADE DE COR A ECOGRAPH.
                                        </p>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <!--Footer-->
                    <tr>
                        <td class="mail-footer" width="560">
                            <!--============================== footer =================================-->
                            @include('layouts.includes.imprimir.footer')
                            <!--============================== footer =================================-->
                        </td>
                    </tr>
                    <!--/Footer-->
                    <!--Footer text-->
                    <tr>
                        <td class="mail-pattern" style="padding-bottom:10px;" width="560">
                            <div style="padding:0 12px;text-align:left;line-height:14px;font-family:Arial,Helvetica,sans-serif !important;font-size:8.5px">
                            </div>
                        </td>
                    </tr>
                    <!--/Footer text-->
                    </tbody>
                </table>
            </td>
        </tr>
        </tbody>
    </table>
</div>