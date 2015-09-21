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
                                        <td style="text-align:left;padding:5px 10px">
                                            <h2>Contato de Cliente</h2>
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
                                <p>Você tem um contato de: "<b>{{$nome}}</b>". Como mensagem foi enviado:<br>
                                {{ $mensagem }}</p>
                                <p>Contate  "<b>{{$nome}}</b>" via email, "{{ $email }}" ou via telefone  "{{ $telefone }}".</p>

                            </td>
                        </tr>
                    </tbody>
                </table>
                <!--fim da descricao-->
            </td>
        </tr>
    </tbody>
</table>