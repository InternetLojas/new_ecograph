<section class="content">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Pedidos</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <!-- /.row -->
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                <tr>
                                    <th class="head text-center">Pedido nr</th>
                                    <th class="head text-center">Nome</th>
                                    <th class="head text-center">Email</th>
                                    <th class="head text-center">Telefone</th>
                                    <th class="head text-center">Ações</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $key => $value)
                                    <tr>
                                        <td class="text-center">{{ $value->id }}</td>
                                        <td class="text-center">{{ $value->customers_name }}</td>
                                        <td class="text-center">{{ $value->customers_email_address }}</td>
                                        <td class="text-center">{{ $value->customers_ddd }} {{ $value->customers_telephone }}</td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <a class="btn btn-default" href="{{ route('diretoria.pedido.items',['id'=> $value->id ] ) }}" title="Ver items desse pedido">
                                                    <i class="fa fa-align-left"></i> Ver itens</a>
                                                <a class="btn btn-default" href="{{ route('categories.edit', ['id'=> $value->id ]) }}" title="Ver items desse pedido">
                                                    <i class="fa fa-align-center"></i> Ver valores</a>
                                                <a class="btn btn-default" href="#" title="Ver items desse pedido">
                                                    <i class="fa fa-align-right"></i> Eliminar o pedido</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                </div>
                <div class="box-footer">
                    footer
                </div>
            </div>
        </div>
        {!! $orders->render() !!}
    </div>
</section>