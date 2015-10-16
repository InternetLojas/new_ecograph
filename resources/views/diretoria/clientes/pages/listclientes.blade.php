<section class="content">
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1 col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Clientes</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <!-- /.row -->
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Aniversário</th>
                                    <th>Email</th>
                                    <th>Telefone</th>
                                    <th>Ações</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($customers as $key => $value)
                                    <tr class="odd gradeX">
                                        <td>{{ $value->customers_firstname }} {{ $value->customers_lastname }}</td>
                                        <td>{{ $value->customers_dob }}</td>
                                        <td>{{ $value->email }}</td>
                                        <td class="center">{{ $value->customers_ddd }} {{ $value->customers_telephone }}</td>
                                        <td class="center">
                                            <!-- apaga o cliente (uses the destroy method DESTROY /nerds/{id} -->
                                            <!-- we will add this later since its a little more complicated than the first two buttons -->
                                            {!! Form::open(array('url' => 'diretoria/clientes/' . $value->id, 'class' => 'pull-right'))!!}
                                            {!! Form::hidden('_method', 'DELETE')!!}
                                            <div class="btn-group">
                                                <!-- show the nerd (uses the show method found at GET /nerds/{id} -->
                                                <a class="btn btn-default" href="{{ route('clientes.conta.edit',['id' => $value->id]) }}">Editar cliente</a>
                                                {!! Form::submit('Deletar cliente', array('class' => 'btn btn-default')) !!}
                                            </div>
                                            {!! Form::close() !!}
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
                    {!! $customers->render() !!}
                </div>
            </div>
        </div>
    </div>
</section>
