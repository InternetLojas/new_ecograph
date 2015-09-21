@extends('diretoria.main_admin')

@section('content')
    <div class="row-fluid">
        <div class="col-lg-12">
            <h1 class="page-header">Área de Orçamentos</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row-fluid">
        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Total de Orçamentos
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
                            Detalhes do Orçamentos
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Cliente</th>
                                        <th>Situação</th>
                                        <th>Criado</th>
                                        <th class="head text-center">Valor</th>
                                        <th class="head text-center">Desconto</th>
                                        <th class="head text-center">Frete</th>
                                        <th class="head text-center">
                                            Valor Total
                                        </th>
                                        <th>Ações</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orcamentos as $key => $value)
                                        <tr class="odd gradeX">
                                            <td>{{ $value->id }}</td>
                                            <td>{{ $value->customer_id }}</td>
                                            <td>{{ $value->orcamento_status }}</td>
                                            <td>{{  Utilidades::toview($value->created_at) }}</td>
                                            <td class="center">
                                                <table class="table table-condensed table-bordered">
                                                    <thead>
                                                    @forelse($value->OrcamentoProduto as $orcamentosProdutos)
                                                        <tr>
                                                            <td>orc_subcategoria_nome</td>
                                                            <td>orc_categoria_nome</td>
                                                            <td>orc_papel_nome</td>
                                                            <td>orc_subcategoria_nome</td>
                                                            <td>orc_categoria_nome</td>
                                                            <td>orc_papel_nome</td>
                                                        </tr>
                                                    @empty
                                                    @endforelse
                                                    </thead>
                                                    <tbody>
                                                    @forelse($value->OrcamentoProduto as $orcamentosProdutos)

                                                        <tr>
                                                            <td>{{$orcamentosProdutos->orc_subcategoria_nome}}</td>
                                                            <td>{{$orcamentosProdutos->orc_categoria_nome}}</td>
                                                            <td>{{$orcamentosProdutos->orc_papel_nome}}</td>
                                                            <td>{{$orcamentosProdutos->orc_pacote_qtd}}</td>
                                                            <td>{{$orcamentosProdutos->orc_enoblecimento_nome}}</td>
                                                            <td>{{$orcamentosProdutos->orc_acabamento_nome}}</td>
                                                        </tr>
                                                    @empty
                                                    @endforelse
                                                    </tbody>
                                                </table>
                                            </td>
                                            <td>Desconto</td>
                                            <td>Frete</td>
                                            <td>Total</td>
                                            <td>editar</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <div class="panel-footer">
                            <p></p>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
                {!! $orcamentos->render() !!}
            </div>
            <!-- /.row -->
@endsection