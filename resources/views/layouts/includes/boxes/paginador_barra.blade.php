
<ul class="list-group list-inline fg-white text-medio">
	<li class="list-group-item bg-transparent">
	Total de Resultados: {!!$total!!}
	</li>
	<li class="list-group-item bg-transparent">
	De 1 até {!!count($products)!!} [{!!\Request::get('page')!!}]
	</li>
	<li class="list-group-item bg-transparent">	
			Alterar layout:
			<i class="icon-list on-left"></i><a class="activedefault" href="advanced_search_result.php?busca=acougue&filtro=" > Lista</a>
			<i class="icon-grid on-left"></i><a href="advanced_search_result.php?busca=acougue&filtro=" > Coluna</a>
	</li>
</ul>
