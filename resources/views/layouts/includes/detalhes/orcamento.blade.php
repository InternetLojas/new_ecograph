<section id="frete_orcamento" style="display:none">
    @if(Auth::check())
    <div class="row">
        <div id="info_frete"></div>
        <style>
            .metro .frete:before {content: "frete";}
            .metro .orcamento:before {content: "orcamento";}
        </style>
        <h2>
            <i class=" icon-dollar on-left"></i>
            Calcule <small class="on-right"> o frete</small>
        </h2>
        <div class="example frete">
            @include('layouts.includes.boxes.forms.form_frete_orcamento')
        </div>
    </div>
    @endif
</section>


