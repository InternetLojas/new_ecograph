<!--============================== content =================================-->
<p class="text-medio"><b>{!!Fichas::nomeCategoria(Fichas::parentCategoria($post_inputs['orc_categoria_id']))!!} - {!!Fichas::nomeCategoria($post_inputs['orc_categoria_id'])!!}</b></p>
<p class="bg-gray fg-white text-center text-medio" >
    Inserir arquivo w PDF ou JPEG 300 dpis, cores CMYK.
</p>

<!--============================== content =================================-->
<table class="table table-bordered text-medio">
    <tr>
        <td class=""></td>
        <td class="">Qtd</td>
        <td class="">Produto</td>
        <td class="">Valor</td>
        <td class="">Desconto</td>
        <td class="">Frete</td>
        <td class="">upload de Arquivos</td>
    </tr>
    <tr>
        <td class="">
            <img src="images/{!!Fichas::ImgProduto($post_inputs['orc_categoria_id'])!!}" class="img-responsive" />
        </td>
        <td class="">{!!$post_inputs['orc_pacote_qtd']!!}</td>
        <td class="">
            Produto: {!!Fichas::nomeCategoria(Fichas::parentCategoria($post_inputs['orc_categoria_id']))!!}<br>
            Formato: {!!$post_inputs['orc_formato_nome']!!}<br>
            Cores: {!!$post_inputs['orc_cor_nome']!!}<br>
            Papel: {!!$post_inputs['orc_papel_nome']!!}<br>
            Acabamento: {!!$post_inputs['orc_acabamento_nome']!!}<br>
            Enoblecimento: {!!$post_inputs['orc_enoblecimento_nome']!!}<br>
        </td>
        <td class="">{!!$post_inputs['orc_pacote_valor']!!}</td>
        <td class="">{!!$post_inputs['orc_categoria_id']!!}</td>
        <td class="">{!!$post_inputs['orc_vl_frete']!!}</td>
        <td class="">
            <div class="upload">
                <form name="orc_offline" id="orc_offline" method="post" action="orc_offline.html" enctype="multipart/form-data" role="form">              

                    <div class="form-group file_offline" data-role="input-control">
                        <span>Inserir Arquivo1</span>
                        <input type="file" id="arq1" name="files1" class="form-control no-radius" placehoder="inserir Arquivo 1" data-token="{!! csrf_token() !!}"/>
                    </div>
                    <div class="form-group file_offline" data-role="input-control">
                        <span>Inserir Arquivo2</span>
                        <input type="file" id="arq2" name="files2" class="form-control no-radius" placehoder="inserir Arquivo 2" data-token="{!! csrf_token() !!}"/>
                    </div>
                </form>
            </div>
        </td>
    </tr>
    
</table>
<table class="table text-medio">
    <tr>
        <td class="">
            Utilize nosso Gabarito
        </td>
        <td class=""></td>
        <td class=""></td>
        <td class="">
            Valor Total
        </td>
        <td class="">
            Continuar Comprando
            Finalizar Compra
        </td>
    </tr>
</table>
