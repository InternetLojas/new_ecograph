<!--============================== content =================================-->
<div id="orc_online"></div>
<div class="destaque_home">
    {!! Form::open(array(
    'route' =>'orcamento.online',
    'method' => 'post',
    'name'=>'orc_online',
    'id'=>'orc_online',
    'class' => 'form-horizontal',
    'role' => 'Form')) !!}

    @if (is_array($erros) && count($erros) > 0)
        <div class="alert alert-danger">
            <strong>Opa!</strong> Existem erros no envio da informação.<br><br>
            <ul>
                @foreach ($erros as $key=> $erro)
                    {{dd($erro)}}
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <p class="bg-gray fg-white text-center" >
        Selecione o produto abaixo.
    </p>
    <div class="destaque_home_orcamento">
        @foreach (Utilidades::Agrupa($produtos, '6', 'busca') as $row)
            <div class="row">
                <ul class="list-unstyled list-inline text-left text-smallmedio">
                    @foreach ($row as $key => $items)
                        <li class="col-md-2 pd-5">
                            <div class="radio">
                                <label>
                                    <input type="radio" name="produtos" value="{{$items}}" >
                                    {{$items}}
                                </label>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endforeach
        <div class="row">
            <input type="text" name="outros_prod" id="input" class="form-control" value="" placeholder="Informe outro produto">
        </div>
    </div>
    <p class="bg-gray fg-white text-center" >
        Quantidade.
    </p>
    <p class="text-center text-smallmedio">
        Digite a quantidade desejada. Você pode escolher até 5 quantidades diferentes
    </p>
    <div class="destaque_home_orcamento">
        <div class="row">
            <div class="col-md-1">
            </div>
            <div class="col-md-2">
                <input type="text" name="qtd[1]" class="form-control" value=""  placeholder="Informe qtd">
            </div>
            <div class="col-md-2">
                <input type="text" name="qtd[2]" class="form-control" value=""  placeholder="Informe qtd">
            </div>
            <div class="col-md-2">
                <input type="text" name="qtd[3]" class="form-control" value=""  placeholder="Informe qtd">
            </div>
            <div class="col-md-2">
                <input type="text" name="qtd[4]" class="form-control" value=""  placeholder="Informe qtd">
            </div>
            <div class="col-md-2">
                <input type="text" name="qtd[5]" class="form-control" value=""  placeholder="Informe qtd">
            </div>
            <div class="col-md-1">
            </div>
        </div>
    </div>
    <p class="bg-gray fg-white text-center" >
        Formato.
    </p>
    <p class="text-center text-smallmedio">
        Digite o formato. Você pode escolher até 2 formatos diferentes
    </p>
    <div class="destaque_home_orcamento">
        <div class="row">
            <div class="col-md-6">
                <div class="col-md-6">
                    <div class="row">
                        <p class="text-center text-medio">Formato Aberto:</p>
                        <span class="col-md-5">
                            <input type="text" name="formato_aberto[1]" class="form-control" value=""  placeholder="ex: 21,00">
                        </span>
                        <span class="col-md-2 text-small"> X </span>
                        <span class="col-md-5">
                            <input type="text" name="formato_aberto[2]" class="form-control" value=""  placeholder="ex: 12,00">
                        </span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <p class="text-center text-medio">Formato Fechado:</p>
                        <span class="col-md-5">
                            <input type="text" name="formato_fechado[1]" class="form-control" value=""  placeholder="ex: 21,00">
                        </span>
                        <span class="col-md-2 text-small"> X </span>
                        <span class="col-md-5">
                            <input type="text" name="formato_fechado[2]" class="form-control" value=""  placeholder="ex: 12,00">
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="col-md-6">
                    <div class="row">
                        <p class="text-center text-medio">Formato Aberto:</p>
                        <span class="col-md-5">
                            <input type="text" name="formato_aberto[3]" class="form-control" value=""  placeholder="ex: 21,00">
                        </span>
                        <span class="col-md-2 text-small"> X </span>
                        <span class="col-md-5">
                            <input type="text" name="formato_aberto[4]" class="form-control" value=""  placeholder="ex: 12,00">
                        </span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <p class="text-center text-medio">Formato Fechado:</p>
                        <span class="col-md-5">
                            <input type="text" name="formato_fechado[3]" class="form-control" value=""  placeholder="ex: 21,00">
                        </span>
                        <span class="col-md-2 text-small"> X </span>
                        <span class="col-md-5">
                            <input type="text" name="formato_fechado[4]" class="form-control" value=""  placeholder="ex: 12,00">
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <p class="bg-gray fg-white text-center" >
        Cores.
    </p>
    <div class="destaque_home_orcamento">
        <div class="row">
            <ul class="list-unstyled list-inline text-left text-smallmedio">
                @foreach ($cores as $key => $items)
                    <li class="col-md-3 pd-5">
                        <div class="radio">
                            <label>
                                <input type="radio" name="cores" value="{{$items}}">
                                {{$items}}
                            </label>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="row">
            <p class="text-center text-medio">
                Demais cores (Pantones). Digite o código abaixo.
            </p>
            <input type="text" name="outra_cor" class="form-control" value=""  placeholder="ex: 5x5 cores,cmyk + pantone:877 C">

        </div>
    </div>
    <p class="bg-gray fg-white text-center" >
        Acabamentos.
    </p>
    <div class="destaque_home_orcamento">
        @foreach (Utilidades::Agrupa($acabamentos, '6', 'busca') as $row)
            <div class="row">
                <ul class="list-unstyled list-inline text-left text-smallmedio">
                    @foreach ($row as $key => $items)
                        <li class="col-md-2 pd-5">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="acabamentos[]" value="{{$items}}" >
                                    {{$items}}
                                </label>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endforeach
        <div class="row">
            <input type="text" name="outro_acabamento" id="input" class="form-control" value="" placeholder="Informe outro acabamento">
        </div>
    </div>
    <p class="bg-gray fg-white text-center">
        Prova Cor.
    </p>
    <div class="destaque_home_orcamento">
        <div class="row">
            <ul class="list-unstyled list-inline text-left text-smallmedio">
                @foreach ($provacor as $key => $items)
                    <li class="col-md-4 pd-5">
                        <div class="radio">
                            <label>
                                <input type="radio" name="provacor" value="{{$items}}">
                                {{$items}}
                            </label>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <p class="bg-gray fg-white text-center" >Entrega.</p>
    <div class="destaque_home_orcamento">
        <div class="row">
            <ul class="list-unstyled list-inline text-left text-smallmedio">
                @foreach ($entrega as $key => $items)
                    <li class="col-md-3 pd-5">
                        <div class="radio">
                            <label>
                                <input type="radio" name="entrega" value="{{$items}}">
                                {{$items}}
                            </label>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <hr>
    <button type="submit" class="btn btn-lg bg-dark fg-white no-radius pull-right">Enviar Orçamento</button>
    {!!Form::close()!!}
</div>