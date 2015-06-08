<div class="section" id="especificacoes_selecionada" style="display:none">
    <!--============================== content =================================-->
    <div class="destaque_home">
        <div class="row">
            <div class="col-md-2">
                <img id="image_escolhida" src="" alt="" title="" width="100%" class="img-responsive" style="max-width:100px"  />
            </div>
            <div class="col-md-4">
                @include('layouts.includes.boxes.opcoes_finalizacao')
            </div>
            <div class="col-md-2 text-center">
                <img src="images/theme/printer.jpg" alt="calculadora.png" class="img-responsive" />
                <button type="button" class="btn  bg-green fg-white no-radius" title="Crie um orçamento exclusivo" onclick="EditarTemplates(@if (Auth::guest()) '0' @else '1' @endif);"  >
                    IMPRIMI ORC
                </button>

            </div>
            <div class="col-md-4">
                <ul class="nav nav-stacked nav-tabs">
                    <li>
                        <img src="images/icons/logo_info_desenho.jpg" alt="printer.jpg"  class="img-responsive" />
                        <button type="button" class="btn  bg-smallgray btn-lg no-radius" title="Deixe que criamos sua arte" id="btn_comprar" onclick=""  >
                            Desenvolver arte R$ 50,00
                        </button>
                    </li>
                    <li>
                        <img src="images/icons/logo_info_ftp.jpg" alt="logo_info_ftp.jpg"  class="img-responsive" />
                        <button type="button" class="btn btn-block bg-smallgray btn-lg no-radius" title="Envie seu arquivo PDF" id="btn_upload" onclick="(@if (Auth::guest()) '0' @else '1' @endif);"  >
                            Envie seu arquivo PDF.
                        </button>
                    </li>
                </ul>
            </div>
            @include('layouts.includes.boxes.forms.form_orcamento')
        </div>
    </div>
</div>
