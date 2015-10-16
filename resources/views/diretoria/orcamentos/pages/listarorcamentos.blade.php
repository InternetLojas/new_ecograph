<section class="content">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Clientes</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <!-- /.row -->
                    <div class="row">
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
                    <div class="row">
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
                                            @forelse($value->OrcamentoProduto as $orcamentosProdutos)

                                                {{$orcamentosProdutos->orc_subcategoria_nome}}<br>
                                                {{$orcamentosProdutos->orc_categoria_nome}}<br>
                                                {{$orcamentosProdutos->orc_papel_nome}}<br>
                                                {{$orcamentosProdutos->orc_pacote_qtd}}<br>
                                                {{$orcamentosProdutos->orc_enoblecimento_nome}}<br>
                                                {{$orcamentosProdutos->orc_acabamento_nome}}

                                            @empty
                                            @endforelse
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
    </div>
</section>
