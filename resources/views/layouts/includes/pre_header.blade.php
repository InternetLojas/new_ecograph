<!-- PRE-HEADER-->
<div class="page-container ">
    <div class="navbar">
        <div class="umterco">
            <a href="{{ URL::to('/') }}" title="{{META_DESCRIPTION}}" class=" logo">
                <!-- logo -->
                {!! HTML::image('images/theme/escudo.png', $alt="escudo.png", $attributes = array('title'=>STORE_NAME,'class'=>'img-logo')) !!}
            </a>
        </div>
        <div class="umterco">
            @include('layouts.includes.boxes.forms.form_search')
        </div>
        <div class="umterco carrinho">
            @include('layouts.includes.boxes.carrinho')
        </div>
    </div>
</div>