
<section class="content">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Configuração de papeis para categoria {!!$cat_name!!}</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered">
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
                                    {!! Form::open(['url'=>route('weight.update',['id'=>$cat_id]),'method'=>'put', 'class' => 'form-horizontal']) !!}
                                    <table class="table table-condensed">
                                        <thead>
                                        <tr>
                                            <th>Papel</th>
                                            <th>#</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($papel[$formato_id] as $papel_id => $items)
                                            <!--verifica se o formato é autorizado para o papel corrente-->
                                            @if (in_array($formato_id, $formato_autorizado[0][$papel_id]))
                                                <tr>
                                                    <td>
                                                        {{$items['papel_nome']}}
                                                    </td>
                                                    <td>
                                                        <table class="table table-striped">

                                                            @forelse($items as $chave => $value)
                                                                @if(!is_null($value))
                                                                    @if($chave == 'pacotes')
                                                                        <tr>
                                                                            <td>Qtd</td>
                                                                            @forelse($value['pacote_id'] as $pacote_id => $quantity)
                                                                                <td>{{$quantity}}</td>
                                                                            @empty
                                                                            @endforelse
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Peso</td>
                                                                            @forelse($value['weight'] as $pacpapel_id => $weight)
                                                                                <td>
                                                                                    {!! Form::text('weight['.$pacpapel_id.']', $weight, ['class' => 'form-control']) !!}

                                                                                </td>
                                                                            @empty
                                                                            @endforelse
                                                                        </tr>
                                                                    @endif
                                                                @endif
                                                            @empty
                                                            @endforelse

                                                        </table>
                                                    </td>
                                                </tr>
                                            @endif
                                        @empty
                                        @endforelse
                                        </tbody>
                                    </table>
                                    {!!Form::submit('Atualizar peso', ['class'=>'btn btn-success pull-right']) !!}
                                    {!! Form::close() !!}
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
