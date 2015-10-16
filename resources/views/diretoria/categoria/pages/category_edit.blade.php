
<div class="container">
    @if($errors->any())
        <ul class="alert alert-warning">
            @foreach($errors->all() as $erro)
                <li>
                    {!! $erro !!}
                </li>
            @endforeach
        </ul>
        @endif
                <!-- Main row -->
        <div class="row">
            <style>
                .cke{visibility:hidden;}
            </style>
            <!-- Left col -->
            <div class="col-md-10 col-md-offset-1">
                <!-- TABLE: LATEST ORDERS -->
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            Editar Categoria
                            <small>{!!$description['categories_name']!!}</small>
                        </h3>
                        <!-- tools box -->
                        <div class="pull-right box-tools">
                            <button class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                            <button class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                        </div><!-- /. tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <div class="box">
                                <div class="box-body">
                                   <form>
                                    <div class="form-group">
                                        {!! Form::label('name', 'Name: ') !!}
                                        {!! Form::text('name', $description['categories_name'], ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::textarea('description',($description['categories_descricao']), ['id' => 'description', 'rows'=>'10','cols'=>'80','class'=>'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        <h4 class="box-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                                Formatos
                                            </a>
                                        </h4>
                                        @forelse($formatos as $formato)
                                            <div class="col-sm-4">
                                                <div class="checkbox-inline">
                                                    <label>
                                                        <input type="checkbox" name="formato[{{$formato->id}}]" value="{{$formato->id}}" @if(in_array($formato->id,$catformatos)) checked @endif >
                                                        {{$formato->valor}}
                                                    </label>
                                                </div>
                                            </div>
                                        @empty
                                            <p>Sem atributo formato</p>
                                        @endforelse
                                    </div>
                                    <div class="form-group">
                                        <h4 class="box-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                                Papeis
                                            </a>
                                        </h4>
                                        <!--papeis-->
                                        <div class="form-group">
                                            @forelse($papeis as $papel)
                                                <div class="col-sm-4">
                                                    <div class="checkbox-inline">
                                                        <label>
                                                            <input type="checkbox" name="papel[{{$papel->id}}]" value="{{$papel->id}}" @if(in_array($papel->id,$catpapeis)) checked @endif >
                                                            {{$papel->valor}}
                                                        </label>
                                                    </div>
                                                </div>
                                            @empty
                                                <p>Sem atributo papeis</p>
                                            @endforelse
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <h4 class="box-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                                Cores
                                            </a>
                                        </h4>
                                        <!--papeis-->
                                        <div class="form-group">
                                            @forelse($cores as $cor)
                                                <div class="col-sm-3">
                                                    <div class="checkbox">
                                                        <label class="checkbox-inline">
                                                            <input type="checkbox" name="cor[{{$cor->id}}]" value="{{$cor->valor}}" @if(in_array($cor->id,$catcores)) checked @endif >{{$cor->valor}}</label>
                                                    </div>
                                                </div>
                                            @empty
                                                <p>Sem atributo cores</p>
                                            @endforelse
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <h4 class="box-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                                Enobrecimentos
                                            </a>
                                        </h4>
                                        <!--papeis-->
                                        <div class="form-group">
                                            @forelse($enobrecimentos as $enobrecimento)
                                                <div class="col-sm-3">
                                                    <div class="checkbox">
                                                        <label class="checkbox-inline">
                                                            <input type="checkbox" name="enobrecimento[{{$enobrecimento->id}}]" value="{{$enobrecimento->id}}" @if(in_array($enobrecimento->id,$catenobrecimentos)) checked @endif >{{$enobrecimento->valor}}</label>
                                                    </div>
                                                </div>
                                            @empty
                                                <p>Sem atributo enobrecimento</p>
                                            @endforelse
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <h4 class="box-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                                Acabamentos
                                            </a>
                                        </h4>
                                        <!--papeis-->
                                        <div class="form-group">
                                            @forelse($acabamentos as $acabamento)
                                                <div class="col-sm-4">
                                                    <div class="checkbox-inline">
                                                        <label >
                                                            <input type="checkbox" name="acabamento[{{$acabamento->id}}]" value="{{$acabamento->id}}" @if(in_array($acabamento->id,$catacabamentos)) checked @endif ><small><b>{{$acabamento->valor}}</b> {{$acabamento->enoblecimento}}</small>
                                                        </label>
                                                    </div>
                                                </div>
                                            @empty
                                                <p>Sem atributo acabamentos</p>
                                            @endforelse
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        {!! Form::submit('Edit Category', ['class'=>'btn btn-success pull-right']) !!}
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
