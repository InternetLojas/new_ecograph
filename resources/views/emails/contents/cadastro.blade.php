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
                                            <h2 style="margin:auto;text-align:center;font-weight: normal;padding:5px;border-bottom: solid 3px #01c09e;">
                                                <img src="{{URL::to('images/theme/confirmado_btn-conf-email.png')}}" alt="Confirmação de Cadasto" width="29" height="29" v-align="top" style="display:block;border:0"/>
                                                Cadastro realizado com sucesso
                                            </h2>
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
                                <blockquote style="text-align:justify;line-height:20px;">
                                    Prezado(a) Sr(a). {{ $customers_firstname }} {{ $customers_lastname }}<br>
                                    Para confirmar seu cadastro e ativar sua conta em nosso site, podendo acessar áreas exclusivas, por favor clique no link abaixo ou copie e cole na barra de endereço do seu navegador.<br>
                                    Após a ativação de sua conta, você poderá ter acesso a sua página de cliente.<br>
                                    Para isso basta efetuar o login com o <strong>Usuário</strong>: {{$email}}.<br>
                                    Utilize a senha criada no cadastro.<br><br>
                                    Foi enviado para seu email - ({{$email}} ) um pedido de confirmação de cadastro, por favor verifique e sigas as instruções!<br>
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
                                <table>
                                    <tr>
                                        <td width="650" valign="top" align="center"  style="padding:5px;border-bottom: solid 3px #01c09e;text-align:center"></td>
                                    </tr>
                                </table>
                                <h2 style="margin:auto;text-align:center;font-weight: normal;padding:5px;border-bottom: solid 3px #01c09e;">
                                    <img src="{{URL::to('img/alert.png')}}" alt="Alerta" width="32" height="32" v-align="top" style="display:block;border:0"/>
                                    Leia as informações abaixo com atenção.
                                </h2>
                                <table class="mail-header" width="650" cellspacing="0" cellpadding="0" style="margin:15px auto">


                                    <tr>
                                        <td align="center" width="648" style="padding:5px;font-family: Verdana, Arial, 'Trebuchet MS', sans-serif; font-size:14px; color: #323232; line-height:18px;">                                                        <p style="padding: 5px;display:block; margin:auto; ">
                                            <blockquote style="color:#ADADAD; text-align:justify;line-height:20px;">
                                                <h3 style="margin:auto;text-align:left;color:#434343">                                             
                                                    INFORMAÇÕES CADASTRAIS                                            
                                                </h3>
                                                <p style="padding: 5px 0;display:block; margin:auto;font-size:14px !important;">
                                                    Para sua comodidade e seguranca as informacoes inseridas em seu cadastro estao sujeitas a confirmacao apos qualquer compra realizada na {{STORE_SITE}}<br>
                                                    Caso haja uma divergencia nos dados que possa atrasar a entrega do pedido, voce sera informado pelo e-mail de cadastro.
                                                </p>
                                            </blockquote>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center" width="648" style="padding:5px;font-family: Verdana, Arial, 'Trebuchet MS', sans-serif; font-size:14px; color: #323232; line-height:18px;">                                                        <p style="padding: 5px;display:block; margin:auto; ">
                                            <blockquote style="color:#ADADAD; text-align:justify;line-height:20px;">
                                                <h3 style="margin:auto;text-align:left;color:#434343">                                             
                                                    AVISOS IMPORTANTES                                            
                                                </h3>
                                                <ul style="padding: 5px 0;display:block; margin:auto;font-size:14px !important;">

                                                    <li>Qualquer pedido de compra cuja quantidade possa ser caracterizada como revenda, ou quando a SEFAZ do seu estado retiver a(s) mercadoria(s) por outro motivo, ela(s) ficam sujeita(s) ao recolhimento de ICMS no posto fiscal da fronteira do estado de destino.</li>
                                                    <li>Atencao compradores do estado do AMAZONAS: o pedido de compra esta sujeito a fiscalizacao da SEFAZ/AM e as taxa de armazenagem.</li>
                                                    <li>Atencao compradores do estado do CEARA: segundo o Decreto 29.560, Art. 6-A, paragrafos 2 e 3, mercadorias enviadas a esse estado estao sujeitas a recolhimento de ICMS quando excederem o limite de 500 UFIRCE (Unidade Fiscal de Referencia do estado do Ceara). Como o valor da UFIRCE varia, recomendamos consultar a tabela em vigor. A guia de recolhimento nao pode ser emitida antecipadamente, por meio de GNRE. O estado do Ceara criou uma guia especifica, chamada DAE, na qual e preciso constar a especificao do codigo do selo fiscal, obtido somente na fronteira do estado. As mercadorias serao liberadas somente apos o recolhimento do ICMS junto a SEFAZ/CE, ou mediante apresentacao de documento emitido pelo agente de transporte.</li>
                                                    <li>Atencao compradores do Estado do MATO GROSSO: conforme a legislacao estadual, os pedidos estao sujeitos ao recolhimento da GNRE.</li>
                                                </ul>
                                            </blockquote>
                                        </td>
                                    </tr>
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