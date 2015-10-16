<!-- RESUMO-->
<!--============================== content =================================-->
<div class="title_pagina">
    <div class="icone_pagina">
        <img src="images/icons/icone-box-car.jpg" class="img-responsive pull-left" />
    </div>
    <div class="title_content">
        <h3><span class="text-medio">Solicitação de Orçamento OnLine</span></h3>
    </div>
</div>
<div class="clearfix"></div><br>
@if($html=='pass')
    <div class="alert">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Sucesso</h3>
            </div>
            <div class="panel-body">
                <p>"Email enviado com sucesso"</p>
            </div>
        </div>
    </div>

@else
    <div class="alert">
        <div class="panel panel-danger">
            <div class="panel-heading">
                <h3 class="panel-title">Erro no envio de email</h3>
            </div>
            <div class="panel-body">
                <p>Infelizmente não pudemos enviar seu email. Por favor tente novamente gerar o orçamento."</p>
            </div>
        </div>
    </div>
    @endif
            <!--================= tabela dos produtos para orçamento ===================-->
    <div id="printable" class="print_orcamento">
        <table class="table mail" border="0" cellpadding="0" cellspacing="0" width="100%">
            <tbody>
            <tr>
                <td class="mail-wrapper" valign="top" width="100%" align="center">
                    <!--============================== header =================================-->
                    @include('layouts.includes.imprimir.header_orc')
                    <!--============================ end header ===============================-->
                    <!--============================== especificacao =================================-->
                    @include('layouts.includes.imprimir.especificacao_orc')
                    <!--============================== especificacao =================================-->
                    <!--============================== frete =================================-->
                    @include('layouts.includes.imprimir.detalhes')
                    <!--============================== frete =================================-->
                </td>
            </tr>
            <tr>
                <td class="mail-product-footer" valign="top" width="100%" align="center">
                    <!--Footer-->
                    <!--============================== footer =================================-->
                    @include('layouts.includes.imprimir.footer')
                    <!--============================== footer =================================-->
                </td>
            </tr>
            </tbody>
        </table>
    </div>

    <div class="row">
        <div style="display:block;margin:auto !important; max-width:650px;padding:15px 0;text-align:center">
            <div id="mensagem_orcamento"></div>
            <div id="info_orcamento"></div>
            <div class="col-md-6">
                <a title="Clique para imprimir" href="#">
                    <img src="images/theme/printer.jpg" alt="calculadora.png"  width="90" class="img-responsive" >
                </a>
            </div>
            <div class="col-md-6">
                <a class="btn bg-green fg-white no-radius " title="Clique para encaminhar o orçamento por email para a loja" href="javascript:void(0)" id="data_orcamento" data-orcamento="{{$html}}">Imprimir</a>
            </div>
        </div>
    </div>
    <!--================= informações sobre entrega ==========================-->