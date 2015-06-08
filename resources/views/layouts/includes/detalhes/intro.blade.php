<section id="all_produtos">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @foreach(array_chunk($listagem, 4) as $lista)
                <ul class="list-group">
                    @foreach($lista as $key=>$item)
                    <li class="list-group-item col-lg-3 col-md-3">
                        <button class="btn btn-detalhes bg-gray" onclick="Calculadora('{!! $item[0] !!}', '{!! $item[1] !!}')" title="Clique para ver os detalhes desse produto" >
                            <div class="list-content">
                                <span class="list-title">{!!$item[1]!!}</span>
                            </div>
                        </button>
                    </li>
                    @endforeach   
                </ul>
                @endforeach
            </div>
        </div>
    </div>
</section>