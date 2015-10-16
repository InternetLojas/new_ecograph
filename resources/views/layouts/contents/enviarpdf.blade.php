<div class="row">
    <!--============================== content =================================-->
    <p class="text-medio"><b>{!!$post_inputs['orc_categoria_nome']!!} - {!!$post_inputs['orc_subcategoria_nome']!!}</b></p>
    <p class="bg-gray fg-white text-center text-medio" >
        Inserir arquivo w PDF ou JPEG 300 dpis, cores CMYK.
    </p>
    <div id="info_upload">
        <div id="info_upload_erro"></div>
    </div>
    <form name="upload" id="upload" method="post" enctype="multipart/form-data" role="form">
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
                    <img src="images/{!!$img_categoria!!}" class="img-responsive img-editor"  style="max-width:280px" />
                    <!--<img src="images/{!!Fichas::ImgProduto($post_inputs['orc_categoria_id'])!!}" class="img-responsive img-editor" style="max-width:280px"/>-->
                </td>
                <td class="">{!!$post_inputs['orc_pacote_qtd']!!}</td>
                <td class="">
                    <!--
      "orc_peso" => "0.2"
      "orc_vl_frete" => "39"
      "orc_tipo_frete" => "SEDEX"
      "orc_categoria_id" => "1"
      "orc_categoria_nome" => "Comercial"
      "orc_subcategoria_id" => "5"
      "orc_subcategoria_nome" => "Cartão de visita"
      "orc_formato_id" => "1"
      "orc_formato_nome" => "4 x 5 cm"
      "orc_cor_id" => "1"
      "orc_cor_nome" => "4x0 cores"
      "orc_papel_id" => "1"
      "orc_papel_nome" => "couche 300g"
      "orc_enoblecimento_id" => "2"
      "orc_enoblecimento_nome" => "Corte Especial"
      "orc_acabamento_id" => "2"
      "orc_acabamento_nome" => "Sem acabamento"
      "orc_pacote_qtd" => "100 un"
      "orc_pacote_valor" => "R$ 170,00"
      "orc_desconto_valor" => "17"
      "orc_produto" => "papel-timbrado.html"
      "orc_id_perfil" => ""
      "orc_nome_perfil" => ""
      "_token" => "XzS8M9UPNBEy6MUv8X3Q7UyIHS6UTJ0BUwyT57Ji"

                    -->
                    Produto: {!!$post_inputs['orc_subcategoria_nome']!!}<br>
                    Formato: {!!$post_inputs['orc_formato_nome']!!}<br>
                    Cores: {!!$post_inputs['orc_cor_nome']!!}<br>
                    Papel: {!!$post_inputs['orc_papel_nome']!!}<br>
                    Acabamento: {!!$post_inputs['orc_acabamento_nome']!!}<br>
                    Enobrecimento: {!!$post_inputs['orc_enoblecimento_nome']!!}<br>
                </td>
                <td class="">{!!$post_inputs['orc_pacote_valor']!!}</td>
                <td class="">{!!Utilidades::toReal($post_inputs['orc_desconto_valor'])!!}</td>
                <td class="">{!!Utilidades::toReal($post_inputs['orc_vl_frete'])!!}</td>
                <td class="">
                    <div class="upload">

                        <div class="form-group file" data-role="form-group">
                            <span>Arquivo0</span>
                            <input id="logo0" type="file" name="files[]"  class="form-control no-radius" placehoder="Arquivo 0">
                        </div>
                        <div class="form-group file" data-role="form-group">
                            <span>Arquivo1</span>
                            <input type="file" id="logo1" name="files[]" class="form-control no-radius" placehoder="Arquivo 1" />
                        </div>
                        <div class="form-group file" data-role="input-control">
                            <span>Arquivo2</span>
                            <input type="file" id="logo2" name="files[]" class="form-control no-radius" placehoder="Arquivo 2" />
                            <input type="hidden" name="_token" value="{{csrf_token()}}" />
                        </div>
                        <span class="btn btn-success fileinput-button">
                            <i class="glyphicon glyphicon-plus"></i>
                            <span>Add files...</span>
                            <input type="file" multiple="" name="files[]">
                        </span>
                    </div>
                </td>
            </tr>
        </table>
        <span class="fileupload-process"></span>
        <div class="fileupload-progress fade">
            <div class="progress progress-striped active" aria-valuemax="100" aria-valuemin="0" role="progressbar">
                <div class="progress-bar progress-bar-success" style="width:0%;"></div>
            </div>
            <div class="progress-extended"> </div>
        </div>
        <table class="table table-striped" role="presentation">
            <tbody class="files"></tbody>
        </table>
    </form>
    {!! Form::open(array(
    'method' => 'post',
    'name'=>'pdf_basket',
    'id'=>'pdf_basket',
    'role' => 'Form')) !!}
    <input type="hidden" name="nome_empresa" class="form-control no-radius" />
    <input type="hidden" name="atividade" class="form-control no-radius" />
    <input type="hidden" name="nome" value="{!!$customers->customers_firstname !!} {!!$customers->customers_lastname !!}" class="form-control no-radius"/>
    <input type="hidden" name="cargo" class="form-control no-radius" />
    <input type="hidden" name="cel" value="{!!$customers->customers_ddd2!!} {!!$customers->customers_cel!!}" class="form-control no-radius"/>
    <input type="hidden" name="cel1" value="" class="form-control no-radius"/>
    <input type="hidden" name="fone" value="{!!$customers->customers_ddd!!} {!!$customers->customers_telephone!!}" class="form-control no-radius" />
    <input type="hidden" name="fone1" value="{!!$customers->customers_ddd1!!} {!!$customers->customers_telephone1!!}" class="form-control no-radius"/>
    <input type="hidden" name="end" id="end" value="{!!$default_address->entry_street_address!!} {!!$default_address->entry_nr_rua!!} - {!!$default_address->entry_suburb!!}" class="form-control no-radius" />
    <input type="hidden" name="cep" id="cep" value="{!!$default_address->entry_postcode!!}" class="form-control no-radius" />
    <input type="hidden" name="email" value="{!!$customers->email!!}" class="form-control no-radius" />
    <input type="hidden" name="site" class="form-control no-radius"/>
    <input type="hidden" name="obs" class="form-control no-radius" />
    {!!Form::close()!!}
    @include('layouts.includes.boxes.forms.form_basket')
    @include('layouts.includes.modais.modal_comprar')
</div>
<div class="row">

    <!-- The global progress bar -->
    <div id="progress" class="progress">
        <div class="progress-bar progress-bar-success"></div>
    </div>
    <!-- The container for the uploaded files -->
    <div id="files" class="files"></div>

    <div class="btn-group pull-right">
        <a class="btn bg-very-smallgray fg-black no-radius text-center" title="Valor Total" style="margin: 3px 2px" href="#" role="button">Valor Total{{Utilidades::toReal($total)}}</a>
        <span ></span>
        <a class="btn bg-very-smallgray fg-dark fg-white no-radius text-center" title="Clique para continuar comprando" style="margin: 3px 2px" href="{{route('produtos')}}" role="button"><b>Continuar Comprando</b></a>
    </div>
</div>
<div class="row">
    <div class="btn-group pull-right">
        <button type="button" onclick="PDFValidar('{{route('pdf.validar')}}');" name="Finalizar" title="Clique para finalizar sua compra" class="btn bg-green fg-white text-center no-radius">
            <i class="glyphicon glyphicon-upload"></i> Finalizar compra
        </button>

    </div>
</div>
