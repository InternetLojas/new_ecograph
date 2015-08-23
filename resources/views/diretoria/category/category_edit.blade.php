@extends('diretoria.main_admin')
@section('content')
    <div class="container">
        <h1>Editar Categoria {!!$description['categories_name']!!}</h1>
        @if($errors->any())
            <ul class="alert alert-warning">
                @foreach($errors->all() as $erro)
                    <li>
                        {!! $erro !!}
                    </li>
                @endforeach
            </ul>
        @endif
        {!! Form::open(['route' =>['categories.edit',$category->id],'method'=>'put', 'class' => 'form-horizontal']) !!}
        <div class="form-group">
            {!! Form::label('name', 'Name: ') !!}
            {!! Form::text('name', $description['categories_name'], ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('description', 'Description: ') !!}
            {!! Form::textarea('description',htmlspecialchars($description['categories_descricao']), ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('formatos', 'Formatos: ') !!}
            @if($list_f)
                {!! Form::textarea('formatos',$list_f, ['class' => 'form-control']) !!}
            @else
                @forelse($formatos as $id => $formato)
                    <div class="checkbox">
                        <label class="checkbox-inline">
                            <input type="checkbox" name="formato[{{$id}}]">{{$formato}}</label>
                    </div>
                @empty
                @endforelse
            @endif
        </div>
        <div class="form-group">
            {!! Form::label('papeis', 'Papeis: ') !!}
            @if($list_p)
                {!! Form::textarea('papeis',$list_p, ['class' => 'form-control']) !!}
            @else
                @forelse($papeis as $id => $papel)
                    <div class="checkbox">
                        <label class="checkbox-inline">
                            <input type="checkbox" name="papel[{{$id}}]">{{$papel}}</label>
                    </div>
                @empty
                @endforelse
            @endif
        </div>
        <div class="form-group">
            {!! Form::submit('Edit Category', ['class'=>'btn btn-success pull-right']) !!}
        </div>
        {!! Form::close() !!}
    </div>
@stop