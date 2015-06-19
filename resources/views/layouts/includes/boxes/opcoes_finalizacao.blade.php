<div class="col-md-2 ">
    <div class="thumbnail bg-fracogray text-center">
        <span class="badge fg-black position-top" id="img_escolhida_thumb"></span>
        <img id="image_escolhida" src="" alt="" title="" class="img-responsive img-thumbnail"  />
    </div>
</div>
<div class="col-md-4 text-medio">
    <p>Especificações Selecionadas</p>
    <ul class="list-unstyled" id="lista_especificacao"></ul>
</div>
<div class="col-md-2 text-center text-medio">
    <img src="images/theme/printer.jpg" alt="calculadora.png" class="img-responsive" />
    <button type="button" class="btn bg-green fg-white no-radius text-center" title="Crie um orçamento exclusivo" onclick="ImprimirOrcamento(@if (Auth::guest()) '0' @else '1' @endif);"  >
        IMPRIMI ORC
    </button>
</div>
<div class="col-md-4">
    <ul class="list-unstyled text-medio">
        <li>
            <img src="images/icons/logo_info_desenho.jpg" alt="printer.jpg"  class="img-responsive" />
            <button type="button" class="btn bg-smallgray btn-lg no-radius" title="Deixe que criamos sua arte" id="btn_comprar"  >
                <small>Personalizar nossos desenhos</small>                    
            </button>
        </li>
        <li>
            <img src="images/icons/logo_info_ftp.jpg" alt="logo_info_ftp.jpg"  class="img-responsive" />
            <button type="button" class="btn bg-smallgray btn-lg no-radius" tile="Envie seu arquivo PDF" onclick="PDF(@if (Auth::guest()) '0' @else '1' @endif); ;"  >
                <small>Envie seu arquivo PDF.</small>
            </button>
        </li>
    </ul>
</div>