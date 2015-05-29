<!-- EDICAO-->
<div class="title_pagina">
    <div class="icone_pagina">
        <img src="images/icons/icone-box-acabamento.jpg" width="100%" alt="" />
    </div>
    <div class="title_content">
        @include('layouts.includes.boxes.breadcrumbs')               
        <h3>Edição</h3>
    </div>
</div>
<div class="clearfix"></div>
<div class="row">
    <p class="fg-white" style="text-align:center;padding: 3px 0;background-color:{!!$layout['back_menu']!!}">
        Preencha os campos abaixo com as informações que deverá conter o seu produto.
    </p>
    <div id="progress"  class="progress-bar ribbed-red fg-white padding10" data-role="progress-bar" data-value="50" ></div>
    @if(Session::has('success'))
    <div class="alert alert-success">
        {!! Session::get('success') !!}
    </div>
    @endif

    <div class="alert alert-success hide" id="upload-success">
        Upload realizado com sucesso!
    </div>
</div>
<style>
    .metro .editor:before {content: ""}
    .metro .example {border:none}
</style>
<div class="example editor">
    <div class="row">
        <div class="span7">     
            @include('layouts.includes.boxes.forms.form_edicao')  
        </div>
        <div class="span5">
            @include('layouts.includes.boxes.uploads_files')
        </div>
        <div id="files" class="files"></div>
    </div>
</div>

