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
                                            <h2>Convite de amigo</h2>
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
                                    Caro Sr(a). <strong>{{Input::get('to_nome')}}</strong>!<br>
                                    Tomamos a liberdade de lhe encaminhar esse email que foi gerado no nosso site ({{STORE_SITE}}) pelo Sr(a). <strong>{{Input::get('nome')}}</strong>.<br>
                                    Ele acredita que o produto <strong>"{{ProductDescription::find(Input::get('product_id'))->products_name}}"</strong> possa lhe interessar.<br>
                                    Reproduzimos abaixo o mensagem por ele postada e um link para que o Sr(a). possa visualizar o produto no nosso site.
                                    Obrigado!.
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
                                <blockquote style="text-align:justify;line-height:20px;border-left: 10px solid #C08002; background-color: #FFFFFF; padding: 10px; color: #212121;">
                                    <p><i>"{{Input::get('message')}}"</i></p>
                                    <p>
                                        Conheça o produto clicando no botão.<br>
                                        <a class="" href="{{ URL::to('produtos') }}/{{ Input::get('product_id') }}/{{ URLAmigaveis::Slug(ProductDescription::find(Input::get('product_id'))->products_name,'-',true) }}.html" title="Detalhes do produto {{ Utilidades::truncate(ProductDescription::find(Input::get('product_id'))->products_name) }}">
                                              Detalhes
                                        </a>
                                    </p>
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