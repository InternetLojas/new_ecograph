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
        <h2>Cores pré-existentes</h2>
        <div class="row">
            @forelse($cores as $cor)
                <div class="col-sm-3">
                    <label class="">
                        {{$cor->valor}}
                    </label>
                </div>
            @empty
            @endforelse
        </div>
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Criar novas Cor</h3>
                <div class="box-tools pull-right">
                    <!-- Buttons, labels, and many other things can be placed here! -->
                    <!-- Here is a label for example -->
                </div><!-- /.box-tools -->
            </div><!-- /.box-header -->
            <!-- form start -->
            {!! Form::open(['url'=>route('cores.store'), 'class' => 'form-horizontal']) !!}
            <div class="box-body">
                <div class="col-lg-12 col-md-12">
                    <div class="row">
                        <div class="form-group col-lg-2 col-md-2">
                            {!! Form::select('category_id', $category, null, ['class' => 'form-control']) !!}
                        </div>
                        @for($i=0;$i<$qtd_inputs;$i++)
                            <div class="form-group col-lg-1 col-md-1">
                                {!! Form::text('quantity[]', null, ['class' => 'form-control','placeholder'=>'cor']) !!}
                            </div>
                        @endfor
                    </div>
                    <div class="row">
                        <div class="form-group">
                            {!! Form::submit('Adicionar a Cor para a categoria', ['class'=>'btn bg-maroon btn-flat margin']) !!}
                        </div>
                    </div>
                </div>
            </div><!-- /.box-body -->
            <div class="box-footer">
            </div>
            {!!Form::close()!!}
            <!--formatos-->
        </div>
    </div><!-- /.box -->
</div>
