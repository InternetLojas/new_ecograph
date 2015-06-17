<!--============================== content =================================-->
<p class="text-medio"><b>{!!$ativo!!} - {!!$perfil!!}</b></p>
<p class="bg-dark fg-white text-center" >
    Preencha os campos abaixo com as informações que deverá conter o seu produto.
</p>
<div class="destaque_home_edicao">
    <!--============================== content =================================-->
    <div id="info_basket"></div>
    <form name="basket" id="basket" method="post" action="resumo.html" enctype="multipart/form-data" role="form">              
        <div class="editor">
            <div class="col-md-7">
                <p class="legend-editor-texto  bg-gray fg-white" ><b>Inserir Texto</b></p>
                @include('layouts.includes.boxes.forms.form_edicao') 
            </div>
            <div class="col-md-5">
                <p class="legend-editor-logos  bg-gray fg-white" ><b>Inserir Logo/Imagem</b></p>
                @include('layouts.includes.boxes.uploads_files')
                <div class="">
                    <div class="row">
                        <img src="images/{!!$img_categoria!!}" class="img-responsive img-editor" />
                    </div>
                    <div class="row">
                        <button type="button" name="comprar" id="btn_portfolio" class="btn btn-editor bg-dark fg-white no-radius">
                            Finalizar compra
                        </button>
                        <p class="tex-muted text-center text-medio">
                            <small>*No prazo de até 48 horas enviamos o layout do seu produto para conferência.</small>
                        </p>
                    </div>
                </div>
            </div>       
            @foreach($form_orcamento as $key => $vl)
            <input type="hidden" name="{{$key}}" value="{{$vl}}" />
            @endforeach
            <input type="hidden" name="user" value="{!!Auth::user()->id!!}" />  
        </div>
    </form>
    @include('layouts.includes.modais.modal_comprar')
</div>
