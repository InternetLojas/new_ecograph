<table class="mail-wrapper-content">
    <tbody>
        <tr>
            <td class="mail-header">                                                        
                <table>
                    <tbody>
                        <tr>
                            <td width="650" align="center" style="font-family:Verdana,Geneva,sans-serif;font-size:11px !important;line-height:16px">
                                <!--top-->
                                <table>
                                    <tbody>
                                        <tr>
                                            <td height="50" width="650" align="center" style="background-color:#D90111;color:#c4c4c4;font-family:Verdana,Geneva,sans-serif;font-size:11px !important;line-height:16px">
                                                Essa é uma mensagem de confirmação automática.<br>
                                                Por favor, não responda esse e-mail. Caso deseje, 
                                                <a href="{{STORE_OWNER_EMAIL_ADDRESS}}" title="Fale conosco"> fale conosco</a>.
                                                <div style="display:none">
                                                    <img src="" width="0" height="0" />
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <!--fim do top-->
                                <!--brand-->
                                <table>
                                    <tr>
                                        <td class="brand" style="text-align:left;padding:5px 0;width:33%">
                                            <img src="{{URL::to(LOGOTIPO)}}" alt="{{STORE_NAME}}" width="191" height="49" v-align="top" />
                                        </td>
                                        <td class="site" style="text-align:right;padding:5px 10px;width:67%">
                                            <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%">      
                                                <tr>
                                                    <td>
                                                        <table align="center" border="0" cellpadding="0" cellspacing="0" width="400">
                                                            <tr>                
                                                                <td height="15">&nbsp;</td>
                                                            </tr>              
                                                            <tr>                
                                                                <td>
                                                                    <table align="right" border="0" cellpadding="0" cellspacing="0" width="165">
                                                                        <tr>
                                                                            <td align="center" valign="middle">
                                                                                <a title="Compartilhe no facebook" href="javascript:void(0)" onclick="window.open(
                                                                                            'https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent('{{ URL::to('/') }}') + '&t=' + encodeURIComponent('{{STORE_NAME}} ##{{FACEBOOK_PAGE}} #snippet'),
                                                                                                                        'facebook-share-dialog',
                                                                                                                        'width=626,height=436,top=' + ((screen.height - 436) / 2) + ',left=' + ((screen.width - 626) / 2)
                                                                                                                        );" >
                                                                                    <img src ="{{URL::to('images/icons/fb.png')}}" alt="images" width="30">
                                                                                </a>
                                                                                <span>&nbsp;</span>
                                                                                <a title="Compartilhe no twitter" href="javascript:void(0)" onclick="window.open(
                                                                                                            'https://twitter.com/share?url=' + encodeURIComponent('{{ URL::to('/') }}') + '&t=' + encodeURIComponent('{{STORE_NAME}} ##{{FACEBOOK_PAGE}} #snippet'),
                                                                                                                                                        'facebook-share-dialog',
                                                                                                                                                        'width=626,height=436,top=' + ((screen.height - 436) / 2) + ',left=' + ((screen.width - 626) / 2)
                                                                                                                                                        );" >
                                                                                    <img src ="{{URL::to('images/icons//tw.png')}}" alt="images" width="30">
                                                                            </a>
                                                                            <span>&nbsp;</span>
                                                                            <a title="Compartilhe no Google Plus" href="javascript:void(0)" onclick="window.open(
                                                                                                            'https://twitter.com/share?url=' + encodeURIComponent('{{ URL::to('/') }}') + '&t=' + encodeURIComponent('{{STORE_NAME}} ##{{FACEBOOK_PAGE}} #snippet'),
                                                                                                                                                        'facebook-share-dialog',
                                                                                                                                                        'width=626,height=436,top=' + ((screen.height - 436) / 2) + ',left=' + ((screen.width - 626) / 2)
                                                                                                                                                        );" >
                                                                                <img src="{{URL::to('images/icons/gp.png')}}" alt="images" width="30">
                                                                            </a>
                                                                            <span>&nbsp;</span>
                                                                            <a title="Compartilhe no Pinterest" href="javascript:void(0)" onclick="window.open(
                                                                                                            'https://pinterest.com/share?url=' + encodeURIComponent('{{ URL::to('/') }}') + '&t=' + encodeURIComponent('{{STORE_NAME}} ##{{FACEBOOK_PAGE}} #snippet'),
                                                                                                                                                        'facebook-share-dialog',
                                                                                                                                                        'width=626,height=436,top=' + ((screen.height - 436) / 2) + ',left=' + ((screen.width - 626) / 2)
                                                                                                                                                        );" >
                                                                                <img src="{{URL::to('images/icons/pt.png')}}" alt="images" width="30">
                                                                            </a>
                                                                            <span>&nbsp;</span>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            {{STORE_SITE}}<br>
                                                                            {{date('d/m/Y')}}
                                                                        </td>
                                                                    </tr>
                                                                </table>                                        
                                                            </td>
                                                        </tr>
                                                        <tr>                
                                                            <td height="15">&nbsp;</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                            <!--fim da brand-->
                        </td>
                    </tr>
                </tbody>
            </table>
        </td>
    </tr>
</tbody>
</table>

