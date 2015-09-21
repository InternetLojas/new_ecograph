<!-- HEADER-->
@include('layouts.includes.pre_header')
<div class=" text-center header destaque_home">
    <div class="btn-group btn-group-justified btn-group-xs hidden-xs">
        <div class="col-md-4 no-padding">
            <a href="{{ route('index') }}" title="{{META_DESCRIPTION}}" class="logo">
                <!-- logo --> 
                {!! HTML::image('images/theme/escudo.png', $alt="escudo.png", $attributes = array('title'=>STORE_NAME,'class'=>'img-logo')) !!} 
            </a>
        </div>
        <div class="col-md-4">
            @include('layouts.includes.boxes.forms.form_search')
        </div>
        <div class="col-md-4">
            @include('layouts.includes.boxes.carrinho')
        </div>
    </div>
</div>
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Ops!</strong> Credenciais não válidas.<br><br>
        <ul class="list-unstyled">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

