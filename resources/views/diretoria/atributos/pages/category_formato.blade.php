<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Editar quantidade do formato para categoria {!!$cat_name!!}</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered ">
                        <thead>
                        <tr>
                            <th>Formato</th>
                            <th>Quantidade</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($formato as $formato_id => $items)

                            <tr>
                                <td>
                                    {{$items['formato_nome']}}
                                </td>
                                <td>
                                    {!! Form::open(['url'=>route('quantity.update',['id'=>$cat_id]),'method'=>'put', 'class' => 'form-horizontal']) !!}
                                    <table class="table table-condensed table-striped">
                                        <tbody>
                                        <tr>
                                            @forelse($items['pacotes'] as $id =>$quantity)
                                                <td>
                                                    {!! Form::text('quantity['.$id.']', $quantity, ['class' => 'form-control']) !!}
                                                </td>
                                            @empty
                                                <td></td>
                                            @endforelse
                                        </tr>
                                        </tbody>
                                    </table>
                                    {!! Form::submit('Atualizar quantidade', ['class'=>'btn btn-success pull-right']) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @empty
                        @endforelse
                        </tbody>

                    </table>
                </div>
                <div class="box-footer">
                    <a class="btn btn-default pull-right" href="{{route('diretoria.categories')}}" >Voltar</a>
                </div>
            </div>
        </div>
    </div>
</section>