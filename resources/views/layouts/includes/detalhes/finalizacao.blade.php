<section id="finalizacao" style="display:none">
    <div id="info_finalizacao"></div>
    <div class="clearfix"></div>
    <div class="grid padding5">
        <style>
            .metro .finalizacao:before {
                content: "encerrar";
            }
        </style>
        <div class="grid fluid">
            <div class="example finalizacao">
                <div class="row">
                    <div class="span4">
                        <div class="row">
                            @include('layouts.includes.boxes.opcoes_finalizacao')
                        </div>
                    </div>
                    <div class="span3">
                        <div class="row">
                            <img src="images/theme/printer.jpg" alt="printer.jpg" width="122" />
                            <span class="element-divider place-right"></span>
                            <button type="button" class="element" tile="Crie um orçamento exclusivo" id="btn_imprimir" >
                                <span>Imprimir o orçamento.</span>
                            </button>
                        </div>
                    </div>
                    <div class="span5">
                        <div class="row">
                            <div class="title_pagina">
                                <div class="icone_pagina">
                                    <img src="images/icons/logo_info_desenho.jpg" alt="logo_info_desenho.jpg" width="75" />
                                </div>
                                <div class="title_content">
                                    <button type="button" class="element" tile="Crie um orçamento exclusivo" onclick="EditarTemplates(@if (Auth::guest()) '0' @else '1' @endif);"  >
                                        <span class="padding10">Personalize nossos desenhos.</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="title_pagina">
                                <div class="icone_pagina">
                                    <img src="images/icons/logo_info_ftp.jpg" alt="logo_info_ftp.jpg" width="75" />
                                </div>
                                <div class="title_content">
                                    <button type="button" class="element" tile="Envie seu arquivo PDF" id="btn_upload" onclick="(@if (Auth::guest()) '0' @else '1' @endif);"  >
                                        <span class="padding10">Envie seu arquivo PDF.</span>
                                    </button>
                                </div>
                            </div>
                            <!--<h2>
                            <button type="button" class="large default" tile="Crie um orçamento exclusivo" id="btn_comprar"  >
                            Imprimir o orçamento.
                            </button>
                            </h2>-->
                        </div>
                        <div class="row">
                            <div class="title_pagina">
                                <div class="icone_pagina">
                                    <img src="images/icons/logo_info_desenho.jpg" alt="printer.jpg" width="75" />
                                </div>
                                <div class="title_content">
                                    <button type="button" class="element" tile="Deixe que criamos sua arte" id="btn_comprar" onclick=""  >
                                        <span class="padding10">Desenvolver arte R$ 50,00.</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.includes.boxes.forms.form_orcamento')
</section>