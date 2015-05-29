<div class="span3">
    @include('layouts.includes.sidebar_left')
</div>
<div class="span9">
    @include('layouts.includes.boxes.header_listagem')
    <div class="clearfix"></div>
    <div id="info_basket"></div>
    <div id="listagem">
        @include('layouts.includes.boxes.listagem')
    </div>
    <div class="clearfix"></div>
    <div id="form_comprar" style="display:none">
        <h1>
            <a href="/"><i class="icon-arrow-left-3 fg-darker smaller"></i></a>
            Verifique <small class="on-right">sua escolha</small>
        </h1>
        @include('layouts.includes.boxes.forms.form_basket')
    </div>
</div>