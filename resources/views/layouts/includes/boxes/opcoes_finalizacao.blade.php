<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 span2">
    <div class="thumbnail bg-very-smallgray">
        <div class="text-center">
            <span class="badge fg-black position-top" id="img_escolhida_thumb"></span>
        </div>
        <img id="image_escolhida" src="" alt="" title="" class="img-responsive img-thumbnail"  />
    </div>
</div>
<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 span4 text-medio">
    <p>Especificações Selecionadas</p>
    <ol class="unstyled" id="lista_especificacao"></ol>
</div>
<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 span2 text-center text-medio">
    <img src="images/theme/printer.jpg" alt="calculadora.png" class="img-responsive" />
    <button type="button" class="btn  bg-green fg-white no-radius" title="Crie um orçamento exclusivo" onclick="EditarTemplates(@if (Auth::guest()) '0' @else '1' @endif);"  >
        IMPRIMI ORC
    </button>
</div>
<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 span4">
    <ul class="nav nav-stacked nav-tabs text-medio">
        <li>
            <img src="images/icons/logo_info_desenho.jpg" alt="printer.jpg"  class="img-responsive" />
            <button type="button" class="btn  bg-smallgray btn-lg no-radius" title="Deixe que criamos sua arte" id="btn_comprar" onclick=""  >
                <small>Personalizar nossos desenhos</small>                    
            </button>
        </li>
        <li>
            <img src="images/icons/logo_info_ftp.jpg" alt="logo_info_ftp.jpg"  class="img-responsive" />
            <button type="button" class="btn btn-block bg-smallgray btn-lg no-radius" title="Envie seu arquivo PDF" id="btn_upload" onclick="(@if (Auth::guest()) '0' @else '1' @endif);"  >
                <small>Envie seu arquivo PDF.</small>
            </button>
        </li>
    </ul>
</div>