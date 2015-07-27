<h4 class="title-sidebar"><span>Destaques</span></h4>
@foreach ( Banners::laterais() as $img)
	{{ HTML::image($img[0], $alt="Destaques", $attributes = array('style' =>'display:block;float:left;', 'title' => $img[2], 'width'=>'100%' )) ."\n"}}
@endforeach