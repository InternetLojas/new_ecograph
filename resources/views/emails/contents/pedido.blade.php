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
                                    Prezado(a) Sr(a). {{$pedido['customers_name']}}<br>
                                    seu pedido foi REGISTRADO com sucesso em nosso sistema com o número {{$pedido['id']}}.<br>
                                    Estamos <strong>AGUARDANDO CONFIRMAÇAO DO PAGAMENTO</strong>.<br>
                                    Lembramos sempre que o processo de envio será iniciado somente apos a confirmação do pagamento.<br>
                                    Sempre que necessitar de informações sobre os pedidos realizados em nossa loja virtual basta acessar {{STORE_SITE}} e clicar sobre a guia "Meus Dados", guia "Meus Pedidos".<br>
                                    Se preferir poderá entrar em contato com nossa central do cliente através do telefone {{STORE_FONE1}}
                                </blockquote>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <!--fim da descricao-->
                <!--extras-->
                <table width="650" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" class="wrapper">
                    <tbody>
                        <tr>
                            <td width="650" align="left" style="font-family:Verdana,Geneva,sans-serif;font-size:12px !important;line-height:16px">
                                <blockquote style="text-align:justify;line-height:20px;border-left: 10px solid #D1D1D6; background-color: #C08002; padding: 10px; color: #212121;">
                                    Dados sobre o pagamento
                                </blockquote>
                            </td>
                        </tr>
                        <tr>
                            <td width="650" align="left" style="font-family:Verdana,Geneva,sans-serif;font-size:12px !important;line-height:16px">
                                <table width="600" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" class="wrapper">
                                    <thead>
                                    <tr>
                                        <th class="head text-center">Data do pedido</th>
                                        <th class="head text-center">Enviado para</th>
                                        <th class="head text-center">Qtd de produtos</th>
                                        <th class="head text-center">Forma de Pgmto</th>
                                        <th class="head text-center">Vl Total</th>
                                        <th class="head text-center">Situação do Pedido</th>
                                        <th class="head text-center">Detalhes</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                        <tr>
                                            <td  class="head text-medio">{{Utilidades::toview($pedido['created_at']) }}</td>
                                            <td  class="head text-medio">{{$pedido['delivery_name']}}</td>
                                            <td class="center"></td>
                                            <td  class="head text-medio">{{$pedido['payment_method']}}</td>
                                            <td  class="head text-medio">{{$totais['Total Geral']}}</td>
                                            <td  class="head text-medio">
                                                <span class="label label-success">{{Utilidades::SituacaoPedido($pedido['orders_status'])}}</span>
                                            </td>
                                            <td  class="head text-medio">
                                                <a class="btn btn-success" href="{{route('clientes.pedidos',['id' => $pedido['id']])}}" title="Ver os detalhes desse produto">
                                                    ver o pedido
                                                </a>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <!--fim do extras-->
            </td>
        </tr>
    </tbody>
</table>