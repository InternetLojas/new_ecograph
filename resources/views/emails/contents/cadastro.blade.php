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
                                                <img src="{{URL::to('images/icons/read-mail.png')}}" alt="Confirmação de Cadasto" width="29" height="29" v-align="top" style="display:block;border:0"/>
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
                                    <h2>A {{STORE_NAME}} lhe dá as boas vinda! </h2>
                                    Prezado(a) Sr(a). {{ $customers_firstname }} {{ $customers_lastname }}<br>
                                    Agora você pode desfrutar dos serviços que oferecemos.
                                    Alguns destes serviços são:
                                    Carrinho Permanente - Qualquer produto adicionado ao seu carrinho permanecerá neste até que você o apague ou realize a compra.
                                    Livro de Endereços - Podemos entregar suas compras em um endereços que não seja o seu! por exemplo: isso é perfeito para enviar o presente diretamente para o local do anivesário
                                    Histórico de Compras - Veja a relação de todas suas compra realizadas em nossa loja.
                                    Comentários - Compartilhe sua opinião com outros clientes.<br>
                                    Para qualquer dúvida sobre nossos serviços por favor envie um e-mail para: {{STORE_ADDRESS_CONTACT}}
                                    Saiba mais sobre sua conta na sua área exclusiva. Para isso basta efetuar o login com o <strong>Usuário</strong>: {{$email}}.<br>
                                    Utilize a senha criada no cadastro.<br><br>
                                    Após fazer o login clique em "Minha Conta".<br><br><br>
                                    A Equipe {{STORE_NAME}} agradece sua prefêrencia.
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
                                    <img src="{{URL::to('images/icons/icone_duvidas.jpg')}}" alt="Alerta" width="32" height="32" v-align="top" style="display:block;border:0"/>
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
                                                    Para sua comodidade e seguranca as informações inseridas em seu cadastro estão sujeitas a confirmação apos qualquer compra realizada na {{STORE_SITE}}<br>
                                                    Caso haja uma divergência nos dados que possa atrasar a entrega do pedido você será informado pelo e-mail de cadastro.
                                                </p>
                                            </blockquote>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center" width="648" style="padding:5px;font-family: Verdana, Arial, 'Trebuchet MS', sans-serif; font-size:14px; color: #323232; line-height:18px;">
                                            <blockquote style="color:#ADADAD; text-align:justify;line-height:20px;">
                                                <h3 style="margin:auto;text-align:left;color:#434343">                                             
                                                    AVISOS IMPORTANTES                                            
                                                </h3>
                                                <ul style="padding: 5px 0;display:block; margin:auto;font-size:14px !important; color:#090909">

                                                    <li>Qualquer pedido de compra cuja quantidade possa ser caracterizada como revenda, ou quando a SEFAZ do seu estado retiver a(s) mercadoria(s) por outro motivo, ela(s) ficam sujeita(s) ao recolhimento de ICMS no posto fiscal da fronteira do estado de destino.</li>
                                                    <li>Atenção compradores do estado do AMAZONAS: o pedido de compra está sujeito a fiscalização da SEFAZ/AM e as taxa de armazenagem.</li>
                                                    <li>Atenção compradores do estado do CEARÁ: segundo o Decreto 29.560, Art. 6-A, parágrafos 2 e 3, mercadorias enviadas a esse estado estão sujeitas a recolhimento de ICMS quando excederem o limite de 500 UFIRCE (Unidade Fiscal de Referência do estado do Ceará).<br>
                                                        Como o valor da UFIRCE varia, recomendamos consultar a tabela em vigor.<br>
                                                        A guia de recolhimento não pode ser emitida antecipadamente, por meio de GNRE.<br>
                                                        O estado do Ceará criou uma guia específica, chamada DAE, na qual é preciso constar a especificação do código do selo fiscal, obtido somente na fronteira do estado.<br>
                                                        As mercadorias serão liberadas somente após o recolhimento do ICMS junto a SEFAZ/CE, ou mediante apresentação de documento emitido pelo agente de transporte.</li>
                                                    <li>Atenção compradores do Estado do MATO GROSSO: conforme a legislação estadual, os pedidos estão sujeitos ao recolhimento da GNRE.</li>
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