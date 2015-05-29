	<h4 class="title-sessao-info menu">ESCOLHA OUTRO PRODUTO</h4>
	<div class="sidewidt">
	<ul class="nav nav-list"> 
	<li class="active menu-title">
	<span class="header_lefts_top">
	<a href="{{ URL::to('produtos/') }}/{{$parent}}/{{ $filho }}/{{ URLAmigaveis::Slug(CategoryDescription::find($parent)->categories_name,'-',true) }}.html" class="bullet_{{CategoryDescription::find($parent)->categories_name}}">{{ CategoryDescription::find($parent)->categories_name }}</a>
	</span>
	<div class="clearfix"></div>
	</li>
	@foreach ($categorias as $subs)
	<li class="noactive">
	<span class="header_lefts_top">
	<a href="javascript:ModalPerfil('{{ $subs->id }}','listar');" class="filho bullet_{{ $subs->id }}">{{ CategoryDescription::find($subs->id)->categories_name }}</a>
	</span>
	<div class="clearfix"></div>
	</li>
	@endforeach
	</ul>                                
	</div>  