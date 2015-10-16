<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Configuração de acabamentos para categoria {!!$cat_name!!}</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered table-condensed">
                        <thead>
                        <tr>
                            <th>Formato</th>
                            <th>#</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($formato as $formato_id => $items)
                            <tr>
                                <td>
                                    {{$items['formato_nome']}}
                                </td>
                                <td>
                                    <table class="table table-bordered table-condensed">
                                        <thead>
                                        <tr>
                                            <th>Papel</th>
                                            <th>
                                                #
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($papel[$formato_id] as $papel_id => $items_p)
                                            @if(is_array($items_p['pacotes']))
                                                <tr>
                                                    <td>
                                                        {{$items_p['papel_nome']}}
                                                    </td>
                                                    <td>

                                                        <table class="table table-bordered  table-condensed">
                                                            <thead>
                                                            <tr>
                                                                <th>Cores</th>
                                                                <th>
                                                                    #
                                                                </th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @forelse($cores as $cor_id => $items_c)
                                                                <tr>
                                                                    <td>
                                                                        {{$items_c['cor_nome']}}
                                                                    </td>
                                                                    <td>
                                                                        {!! Form::open(['url'=>route('prices.update',['id'=>$cat_id]),'method'=>'put', 'class' => 'form-horizontal']) !!}
                                                                        <table class="table table-bordered table-condensed">
                                                                            <thead>
                                                                            <tr>
                                                                                <th>Enobrecimento</th>
                                                                                <th>Acabamento</th>
                                                                                @forelse($items_p['pacotes']['pacote_id'] as $id =>$quantity)
                                                                                    <th>{{$quantity}}</th>
                                                                                @empty
                                                                                    <th></th>
                                                                                @endforelse
                                                                            </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                            @if(in_array($formato_id,$formato_autorizado[0][$papel_id]))

                                                                                @forelse($acabamentos[$formato_id][$papel_id][$cor_id] as $acabamento_id => $acabamento)

                                                                                    @forelse($acabamento as $nome_acabamento => $configuracao)
                                                                                        <tr>

                                                                                            <td>{{$nome_acabamento}}</td>
                                                                                            @forelse($configuracao as $nome => $conf)
                                                                                                <td>{{$nome}}</td>
                                                                                                @forelse($conf as $chave => $value)
                                                                                                    <td>
                                                                                                        {!! Form::text('price['.$value['pacacabamento_id'].']', $value['price'], ['class' => 'form-control']) !!}

                                                                                                    </td>
                                                                                                @empty
                                                                                                @endforelse
                                                                                            @empty
                                                                                            @endforelse
                                                                                        </tr>
                                                                                    @empty
                                                                                        <tr>
                                                                                            <td></td>
                                                                                            <td></td>
                                                                                            <td></td>
                                                                                            <td></td>
                                                                                            <td></td>
                                                                                            <td></td>
                                                                                            <td></td>
                                                                                            <td></td>
                                                                                            <td></td>
                                                                                            <td></td>
                                                                                            <td></td>
                                                                                            <td></td>
                                                                                        </tr>
                                                                                    @endforelse
                                                                                @empty
                                                                                @endforelse
                                                                            @else
                                                                            @endif

                                                                            </tbody>
                                                                        </table>
                                                                        {!! Form::submit('Atualizar preco', ['class'=>'btn btn-success pull-right']) !!}
                                                                        {!! Form::close() !!}
                                                                    </td>
                                                                </tr>
                                                            @empty
                                                            @endforelse
                                                            </tbody>
                                                        </table>

                                                    </td>
                                                </tr>
                                            @endif
                                        @empty
                                        @endforelse
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        @empty
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>