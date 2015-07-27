@extends('diretoria.main_admin')

@section('content')
    <div class="row-fluid">
        <div class="col-lg-12">
            <h1 class="page-header">Área de Clientes</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row-fluid">
        <div class="col-lg-6">
            <div class="panel panel-default">
                    <div class="panel-heading">
                        Total de Clientes
                    </div>
                    <div class="panel-body">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue.</p>
                    </div>
                    <div class="panel-footer">
                        Panel Footer
                    </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                       Total de Pedidos
                </div>
                <div class="panel-body">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue.</p>
                </div>
                <div class="panel-footer">
                        Panel Footer
                </div>
            </div>
        </div>        
    </div>
    <div class="row-fluid">

                <div class="col-lg-12">
                    <h1 class="page-header">{{ $page }}</h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-12">
                <!-- will be used to show any messages -->
                @if (Session::has('message'))
                    <div class="alert alert-info">{{ Session::get('message') }}</div>
                @endif
                </div>
            <!-- /.row -->
            <div class="row-fluid">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            DataTables Advanced Tables
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
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
                                                {{ Form::open(array('url' => 'diretoria/clientes/' . $value->id, 'class' => 'pull-right')) }}
                                                    {{ Form::hidden('_method', 'DELETE') }}
                                                    {{ Form::submit('Deletar cliente', array('class' => 'btn btn-warning')) }}
                                                {{ Form::close() }}

                                                <!-- show the nerd (uses the show method found at GET /nerds/{id} -->
                                                <a class="btn btn-small btn-success" href="{{ URL::to('diretoria/clientes/' . $value->id) }}">Mais detalhes</a>

                                                <!-- edit this nerd (uses the edit method found at GET /nerds/{id}/edit -->
                                                <a class="btn btn-small btn-info" href="{{ URL::to('diretoria/clientes/' . $value->id . '/edit') }}">Editar</a>

                                            </td>
                                        </tr>
                                    @endforeach    
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
@endsection