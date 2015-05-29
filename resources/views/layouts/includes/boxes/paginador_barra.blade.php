		<nav class="navigation-bar dark text-center">
			<nav class="navigation-bar-content">
				<item class="element text-center umterco">
					Total de Resultados: {!!$total!!}
				</item>
				<item class="element text-center umterco">
					De 1 até {!!count($products)!!} [{!!\Request::get('page')!!}]
				</item>
				<item class="element text-center umterco">
					Alterar layout:
					<i class="icon-list on-left"></i><a class="activedefault" href="advanced_search_result.php?busca=acougue&filtro=" > Lista</a>
					<i class="icon-grid on-left"></i><a href="advanced_search_result.php?busca=acougue&filtro=" > Coluna</a>
				</item>

			</nav>
		</nav>