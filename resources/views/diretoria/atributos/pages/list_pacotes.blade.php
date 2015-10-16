<div class="row">

    <div class="col-md-10 col-md-offset-1">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Pacotes</h3>
                <div class="box-tools pull-right">
                    <!-- Buttons, labels, and many other things can be placed here! -->
                    <!-- Here is a label for example -->
                    <span class="label label-primary">Label</span>
                </div><!-- /.box-tools -->
            </div><!-- /.box-header -->
            <!-- form start -->
            @forelse($pacotes as $category_id=>$group_pacotes)
                {!!
                Form::open(['url'=>route('quantity.update',['id'=>$category_id]),
                'method'=>'put',
                'class' => 'form-horizontal'])
                !!}

                    <div class="box-body">

                        <div class="col-md-12">
                            <div class="form-group col-md-1">
                                <label>
                                    {{$categories->find($category_id)->categories_name}}
                                </label>
                            </div>

                            @forelse($group_pacotes as $pacote)
                                <div class="form-group col-md-1">
                                    <input type="text" class="form-control" name="quantity[{{$pacote->id}}]" value="{{$pacote->quantity}}" >
                                </div>
                            @empty
                            @endforelse

                        </div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                       <button type="submit" class="btn bg-maroon btn-flat margin pull-right" >Atualizar</button>

                    </div>
                {!!Form::close()!!}
            @empty
                <div class="alert alert-info">
                    <h2>Ainda não existem pacotes cadastrado</h2>
                    <p>Clique no botão "Novo Pacote" para criar uma nova entrada.</p>
                </div>
            @endforelse

        </div><!-- /.box -->

    </div>
</div>