<div class="row">
    <!--============================== content =================================-->
    <p class="text-medio"><b>{!!$ativo!!} - {!!$perfil!!}</b></p>
    <p class="bg-gray fg-white text-center" >
        Preencha os campos abaixo com as informações que deverá conter o seu produto.
    </p>
    <div class="destaque_home_edicao">
        <!--============================== content =================================-->
        <div id="info_upload"></div>
        <div id="info_upload_erro"></div>
        <form name="upload" id="upload" method="post" enctype="multipart/form-data" role="form">
            <div class="editor com-md-12">
                <div class="col-md-7">
                    <p class="legend-editor-texto  bg-gray fg-white" ><b>Inserir Texto</b></p>
                    @include('layouts.includes.boxes.forms.form_edicao')
                    @foreach($post_inputs as $key => $vl)
                        <input type="hidden" name="{{$key}}" value="{{$vl}}" />
                    @endforeach
                </div>
                <div class="col-md-5">
                    <p class="legend-editor-logos  bg-gray fg-white" ><b>Inserir Logo/Imagem</b></p>
                    @include('layouts.includes.boxes.uploads_files')
                    
                    <div class="row">
                        <img src="images/{!!$img_categoria!!}" class="img-responsive img-editor" />
                   <br>
                        <button type="button" onclick="UploadValidar('{{route('editor.validar')}}')" name="Resumo" class="btn btn-editor bg-dark fg-white no-radius">
                            Finalizar compra
                        </button>
                        <p class="tex-muted text-center text-medio">
                            <small>*No prazo de até 48 horas enviamos o layout do seu produto para conferência.</small>
                        </p>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
