<!-- HEADER-->

		@include('layouts.includes.pre_header')
		<div class="col-md-12 text-center header wrapper">
			<div class="btn-group btn-group-justified btn-group-xs hidden-xs">
				<div class="col-md-4">
					<a href="{{ URL::to('/') }}" title="{{META_DESCRIPTION}}" class=" logo"> <!-- logo --> {!! HTML::image('images/theme/escudo.png', $alt="escudo.png", $attributes = array('title'=>STORE_NAME,'class'=>'img-logo')) !!} </a>
				</div>
				<div class="col-md-4">
					@include('layouts.includes.boxes.forms.form_search')
				</div>
				<div class="col-md-4">
					@include('layouts.includes.boxes.carrinho')
				</div>
			</div>
		</div>

