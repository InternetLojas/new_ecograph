<div class="section">
    <!--============================== content =================================-->
    <div class="destaque_home">

        @include('layouts.includes.boxes.breadcrumbs')

        <p class="bg-smallgray" >
            Preencha os campos abaixo com as informações que deverá conter o seu produto.
        </p>
    </div>
</div>
<div class="row">
    <!--============================== content =================================-->
    <div class="destaque_home">
        <div class="col-md-6">
            <p class="legend-editor bg-gray fg-white" >Inserir Texto</p>
            @include('layouts.includes.boxes.forms.form_edicao') 
        </div>
        <div class="col-md-6">
            <p class="legend-editor bg-gray fg-white" >Inserir Imagem</p>
            @include('layouts.includes.boxes.uploads_files')
            <div class="row">
                <img class="polaroid" src="images/{!!$img_categoria!!}" classe="img-responsive" />
                <button type="button" name="comprar" id="btn_upload" class="btn btn-lg bg-green fg-white pull-right no-radius">
                    Finalizar compra
                </button>
                <p class="tex-muted text-center">
                    *No prazo de até 48 horas enviamos o layout do seu produto para conferência.
                </p>
            </div>
        </div>
    </div>
</div>