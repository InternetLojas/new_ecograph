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
                            Novo cliente
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                {{ HTML::ul($errors->all() )}}

                                {{ Form::open(array('url' => 'diretoria/clientes')) }}

                                    <div class="form-group">
                                        {{ Form::label('name', 'Name') }}
                                        {{ Form::text('name', Input::old('name'), array('class' => 'form-control')) }}
                                    </div>

                                    <div class="form-group">
                                        {{ Form::label('email', 'Email') }}
                                        {{ Form::email('email', Input::old('email'), array('class' => 'form-control')) }}
                                    </div>

                                    <div class="form-group">
                                        {{ Form::label('customers_newsletter', 'Permitir Newsletter') }}
                                        {{ Form::select('nerd_level', array('0' => 'Select a Level', '1' => 'Sees Sunlight', '2' => 'Foosball Fanatic', '3' => 'Basement Dweller'), Input::old('nerd_level'), array('class' => 'form-control')) }}
                                    </div>

                                    {{ Form::submit('Cadastrar!', array('class' => 'btn btn-primary')) }}

                                {{ Form::close() }}
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <div class="panel-footer">
                        
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
@endsection