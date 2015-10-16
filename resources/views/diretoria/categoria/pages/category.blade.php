
<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <div class="col-md-10 col-md-offset-1">
        <!-- TABLE: LATEST ORDERS -->
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Categorias</h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
                    <div class="box">

                        <div class="box-body">
                            <div class="margin">

                                @foreach($categories as $category)
                                    <div class='col-sm-4'>
                                        <h4>
                                            <a href="{{ route('categories.atributos', ['id'=> $category->id ]) }}" title="Atributos da categoria  {{$description->find($category->id)->categories_name}}">
                                                {{$description->find($category->id)->categories_name}}
                                            </a>
                                        </h4>
                                        {!! HTML::image('images/'.$category->categories_image, $alt=$category->categories_image, array('class'=>'img-responsive', 'title'=>'Aguarde enquanto estamos redirecionando seu pedido.')) !!}

                                    </div><!-- /.col -->
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div><!-- /.table-responsive -->
            </div><!-- /.box-body -->
            <div class="box-footer clearfix">
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
            </div>
        </div><!-- /.box -->

    </div><!-- /.col -->
    <div class="col-md-6">direita</div><!-- /.col -->

</div><!-- /.row -->

<div class="row">
    <div class="col-md-12">
        <a href="javascript::;" class="btn btn-sm btn-success btn-flat pull-left">Nova Categoria</a>
        <a href="javascript::;" class="btn btn-sm btn-warning btn-flat pull-right">Voltar</a>
    </div>
</div>