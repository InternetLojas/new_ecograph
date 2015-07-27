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
                <!-- will be used to show any messages -->
                @if (Session::has('message'))
                    <div class="alert alert-info">{{ Session::get('message') }}</div>
                @endif
            <!-- /.row -->
            <div class="row-fluid">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Detalhes do Cliente ---
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
                                               outras informações
                                            </td>
                                        </tr>
                                    @endforeach    
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <div class="panel-footer">
                        <p><a href="{{ URL::to('diretoria/clientes/create') }}">Cadastrar novo cliente</a></p>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
@endsection