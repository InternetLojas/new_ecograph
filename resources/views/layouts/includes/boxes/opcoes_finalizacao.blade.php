<div class="col-md-2 ">
    <div class="thumbnail bg-fracogray text-center">
        <span class="badge fg-black position-top" id="img_escolhida_thumb"></span>
        <img id="image_escolhida" src="" alt="" title="" class="img-responsive img-thumbnail"  />
    </div>
</div>
<div class="col-md-3 text-medio">
    <p><b>Especificações Selecionadas</b></p>
    <ul class="list-unstyled" id="lista_especificacao"></ul>
</div>
<div class="col-md-2">
    <div class="text-center text-medio">
    <img src="images/theme/printer.jpg" alt="calculadora.png" class="img-responsive" />
    <button type="button" class="btn bg-green fg-white no-radius text-center" title="Crie um orçamento exclusivo" onclick="ImprimirOrcamento(@if (Auth::guest()) '0' @else '1' @endif);"  >
        IMPRIMIR ORC
    </button>
    </div>
</div>
<div class="col-md-5"> 
            <div class="col-sm-4">
                <img src="images/icons/logo_info_desenho.jpg" alt="printer.jpg"  class="img-responsive" />
            </div>
            <div class="col-sm-8">
                <button type="button" class="btn bg-smallgray btn-lg no-radius text-center" title="Deixe que criamos sua arte" onclick="PersonalizarDesenho(@if (Auth::guest()) '0' @else '1' @endif);"  >
                    <small>Personalizar nossos desenhos</small>                    
                </button>
            </div>
            <div class="clearfix"></div>
            <div class="col-sm-4">
                <img src="images/icons/logo_info_ftp.jpg" alt="logo_info_ftp.jpg"  class="img-responsive" />
            </div>
            <div class="col-sm-8">
                <button type="button" class="btn bg-smallgray btn-lg no-radius text-center" tile="Envie seu arquivo PDF" onclick="PDF(@if (Auth::guest()) '0' @else '1' @endif);"  >
                    <small>Envie seu arquivo PDF.</small>
                </button>
            </div>
            <div class="clearfix"></div>

</div>