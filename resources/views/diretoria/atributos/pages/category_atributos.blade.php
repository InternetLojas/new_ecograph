

<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <div class="col-md-12">
        <!-- TABLE: LATEST ORDERS -->
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Latest Orders</h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table no-margin table-bordered table-striped dataTable" role="grid">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Ação</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>{!!$category->id!!}</td>
                                <td><a href="#" title="Detalhes sobre {{$category->name}}">{!!$description->find($category->id)->categories_name!!}</a></td>
                                <td>

                                    <span class="label label-success">
                                        <a href="{{ route('categories.detalhes',['id'=> $category->id ] ) }}" title="Ver os produtos {{$category->name}}">produtos</a>
                                        </span>
                                    <span class="label label-info">
                                    <a href="{{ route('categories.atributos',['id'=> $category->id ] ) }}" title="Ver os atributos {{$category->name}}">atributos</a>
                                        </span>
                                    <span class="label label-primary">
                                    <a href="{{ route('categories.edit', ['id'=> $category->id ]) }}" title="Editar categoria {{$category->name}}">edit</a>
                                        </span>
                                    <span class="label label-warning">
                                    <a href="#" title="Eliminar categoria {{$category->name}}">delete</a>
                                        </span>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div><!-- /.table-responsive -->
            </div><!-- /.box-body -->
            <div class="box-footer clearfix">
                <a href="javascript::;" class="btn btn-sm btn-info btn-flat pull-left">Nova Categoria</a>
                <a href="javascript::;" class="btn btn-sm btn-default btn-flat pull-right">Voltar</a>
            </div><!-- /.box-footer -->
        </div><!-- /.box -->
    </div><!-- /.col -->
    <div class="row">
        <div class="col-sm-5">
            <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div>
        </div>
        <div class="col-sm-7">
            <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                {!! $categories->render() !!}
           </div>
        </div>
    </div>
</div><!-- /.row -->