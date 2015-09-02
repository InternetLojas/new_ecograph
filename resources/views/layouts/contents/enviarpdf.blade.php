<div class="col-md-12">

    <!--============================== content =================================-->
    <p class="text-medio"><b>{!!$post_inputs['orc_categoria_nome']!!} - {!!$post_inputs['orc_subcategoria_nome']!!}</b></p>
    <p class="bg-gray fg-white text-center text-medio" >
        Inserir arquivo w PDF ou JPEG 300 dpis, cores CMYK.
    </p>

    <!--============================== content =================================-->
    <div class="table-responsive">
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
                <img src="images/{!!Fichas::ImgProduto($post_inputs['orc_categoria_id'])!!}" class="img-responsive" style="max-width:270px" />
            </td>
            <td class="">{!!$post_inputs['orc_pacote_qtd']!!}</td>
            <td class="">
                Produto: {!!$post_inputs['orc_categoria_nome']!!}<br>
                Formato: {!!$post_inputs['orc_formato_nome']!!}<br>
                Cores: {!!$post_inputs['orc_cor_nome']!!}<br>
                Papel: {!!$post_inputs['orc_papel_nome']!!}<br>
                Acabamento: {!!$post_inputs['orc_acabamento_nome']!!}<br>
                Enoblecimento: {!!$post_inputs['orc_enoblecimento_nome']!!}<br>
            </td>
            <td class="">{!!$post_inputs['orc_pacote_valor']!!}</td>
            <td class="">{!!$post_inputs['orc_categoria_id']!!}</td>
            <td class="">{!!Utilidades::toReal($post_inputs['orc_vl_frete'])!!}</td>
            <td class="">
                <div class="upload">
                    <form name="info_basket" id="info_basket" method="post" enctype="multipart/form-data" role="form">

                        <div class="form-group file_offline" data-role="input-control">
                            <span>Inserir Arquivo1</span>
                            <input type="file" id="arq1" name="files1" class="form-control no-radius" placehoder="inserir Arquivo 1" data-token="{!! csrf_token() !!}"/>
                        </div>
                        <div class="form-group file_offline" data-role="input-control">
                            <span>Inserir Arquivo2</span>
                            <input type="file" id="arq2" name="files2" class="form-control no-radius" placehoder="inserir Arquivo 2" data-token="{!! csrf_token() !!}"/>
                        </div>
                        @foreach($post_inputs as $key=>$valor)
                            <input id="{{$key}}" type="hidden" value="{{$valor}}" name="{{$key}}" class="form-control">
                        @endforeach
                        <input id="produto_id" type="hidden" value="" name="produto_id" class="form-control">
                    </form>
                </div>
            </td>
        </tr>
    </table>
    </div>
    @include('layouts.includes.boxes.forms.form_basket')
    @include('layouts.includes.modais.modal_comprar')
    <div class="pull-right">
        <a class="btn bg-green fg-white no-radius text-center" title="Clique para finalizar sua compra" href="#" onclick="AdicionaItem();">Finalizar Compra</a>
    </div>
</div>