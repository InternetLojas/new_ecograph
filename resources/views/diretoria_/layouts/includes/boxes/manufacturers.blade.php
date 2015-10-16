<h4 class="title-sidebar"><span>Fabricantes</span></h4>
 	<ul id="navmenu-v" class="nav nav-list">
      	@foreach ($box[0] as $manufacturers)
			@foreach ($manufacturers as $manufacturer)
				<li>{{ HTML::link('/fabricantes/'.$manufacturer->id,$manufacturer->manufacturers_name,array('class'=>'class="logo_fornec menuheader noexpandable"'))}}</li>				
      		@endforeach
      	@endforeach
    </ul>