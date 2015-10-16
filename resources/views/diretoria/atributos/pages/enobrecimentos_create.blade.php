<div class="row">
    @if($errors->any())
        <ul class="alert alert-warning">
            @foreach($errors->all() as $erro)
                <li>
                    {!! $erro !!}
                </li>
            @endforeach
        </ul>
    @endif
    <div class="col-md-10 col-md-offset-1">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Criar enobrecimentos</h3>
                <div class="box-tools pull-right">
                    <!-- Buttons, labels, and many other things can be placed here! -->
                    <!-- Here is a label for example -->
                </div><!-- /.box-tools -->
            </div><!-- /.box-header -->
            <!-- form start -->

            {!! Form::open(['url'=>route('enobrecimentos.store'), 'class' => 'form-horizontal']) !!}
            <div class="box-body">
                <div class="col-lg-12 col-md-12">

                    <div class="row">
                        <div class="form-group col-lg-2 col-md-2">
                            <label for="category_id">{{$category->categories_name}}</label>
                            {!! Form::hidden('category_id', $category->id, null, ['class' => 'form-control']) !!}
                        </div>
                        @for($i=0;$i<$qtd_inputs;$i++)
                            <div class="form-group col-lg-1 col-md-1">
                                {!! Form::text('valor[]', null, ['class' => 'form-control','placeholder'=>'enobrecimentos']) !!}
                            </div>
                        @endfor
                    </div>
                    <div class="row">
                        <div class="form-group">
                            {!! Form::submit('Adicionar a Enobrecimento para a categoria', ['class'=>'btn bg-maroon btn-flat margin']) !!}
                        </div>
                    </div>


                </div>
            </div><!-- /.box-body -->
            <div class="box-footer">

            </div>
            {!!Form::close()!!}

        </div><!-- /.box -->
    </div>
</div>