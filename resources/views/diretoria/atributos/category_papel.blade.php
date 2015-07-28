@extends('diretoria.main_admin')
@section('content')
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Configuração de papeis para categoria {!!$cat_name!!}</h1>
                    <h2>Editar peso do papeis</h2>
                    <table class="table table-bordered table-condensed">
                        @forelse($configuracao as $formato_id => $formatos)
<?php dd($formatos) ?>
                        @empty
                        @endforelse
                    </table>

                    <h2>Editar atributo do papel</h2>
                    @if($errors->any())
                        <ul class="alert alert-warning">
                            @foreach($errors->all() as $erro)
                                <li>
                                    {!! $erro !!}
                                </li>
                            @endforeach
                        </ul>
                    @endif
                    {!! Form::open(['route' =>['categories.update.papel',$cat_id],'method'=>'put', 'class' => 'form-horizontal']) !!}
                    <div class="form-group">
                        @forelse($papeis as $papel)
                            <div class="col-sm-3">
                                <div class="checkbox">
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="papel[{{$papel->id}}]" value="{{$papel->id}}" @if(in_array($papel->id,$catpapeis)) checked @endif >{{$papel->valor}}</label>
                                </div>
                            </div>
                        @empty
                            <p>Sem atributo papel</p>
                        @endforelse
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            {!! Form::submit('Edit Category', ['class'=>'btn btn-primary']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop