<form name="form_upload" id="form_upload" method="post" role="form" action="editor/upload" enctype="multipart/form-data">
    <fieldset> 
        <legend class="legend-editor" style="background-color:{!!$layout['back_menu']!!}">Inserir Images</legend>
        <label></label>
        <div class="input-control file info-state" data-role="input-control">
            <input type="file" id="logo1" name="files1" data-token="{!! csrf_token() !!}"/>
            <button class="btn-file"></button>
        </div>
        <div class="input-control file info-state" data-role="input-control">
            <input type="file" id="logo2" name="files2" data-token="{!! csrf_token() !!}"/>
            <button class="btn-file"></button>
        </div>
        <div class="input-control file info-state" data-role="input-control">
            <input type="file" id="logo3" name="files3" data-token="{!! csrf_token() !!}"/>
            <button class="btn-file"></button>
        </div>
        <div class="input-control file info-state" data-role="input-control">
            <input type="file" id="img1" name="files4" data-token="{!! csrf_token() !!}"/>
            <button class="btn-file"></button>
        </div>
        <div class="input-control file info-state" data-role="input-control">
            <input type="file" id="img2" name="files5" data-token="{!! csrf_token() !!}"/>
            <button class="btn-file"></button>
        </div>
        <div class="input-control file info-state" data-role="input-control">
            <input type="file" id="img3" name="files6" data-token="{!! csrf_token() !!}"/>
            <button class="btn-file"></button>
            <input type="hidden" name="user" value="{!!Auth::user()->id!!}" />
        </div>
    </fieldset>
</form>
<!-- The container for the uploaded files -->
<div class="row">
    <img class="polaroid" src="images/{!!$img_categoria!!}" alt="" />
    <br>
    <button type="button" class="large inverse fg-white padding5" id="btn_editor">Enviar dados</button>
    <br>
    *No prazo de até 48 horas enviamos o layout do seu produto para conferência.
</div>