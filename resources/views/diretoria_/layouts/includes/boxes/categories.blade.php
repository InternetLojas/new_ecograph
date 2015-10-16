<h4 class="title-sidebar"><span>Categorias</span></h4>
    <ul id="navmenu-v" class="nav nav-list">
      	@foreach($box[1] as $key=>$categories) 
	      	@foreach($categories as $k=>$cat)
				@if($cat['parent']==0)
					<li>
					{{ HTML::link('/categorias/'.$k,$cat['nome'], array('class'=>'menuheader')) }}
					@if(count($cat['prole']>0))
						<ul class="categoryitems">
							@foreach($cat['prole'] as $k1=>$cat1)
								<li>
									{{ HTML::link('/categorias/'.$k1,$cat1['nome'], array('class'=>'menuheader')) }}
									@if(count($cat['prole']>0))
										<ul class="categoryitems">
											@foreach($cat1['prole'] as $k2=>$cat2)
												<li>
													{{ HTML::link('/categorias/'.$k2,$cat2['nome'], array('class'=>'menuheader')) }}
												</li>
											@endforeach
										</ul>
									@endif
								</li>
							@endforeach
						</ul>
					@endif
					</li>
				@endif
	      	@endforeach
      	@endforeach
    </ul>