@extends('diretoria.main_admin')
@section('content')
<div class="container">
    <h1>Editar Categoria {!!$category->name!!}</h1>
    @if($errors->any())
    <ul class="alert alert-warning">
        @foreach($errors->all() as $erro)
        <li>
            {!! $erro !!}
        </li>
        @endforeach
    </ul>
    @endif
    {!! Form::open(['route' =>['categories.update',$category->id],'method'=>'put', 'class' => 'form-horizontal']) !!}
    <div class="form-group">
        {!! Form::label('name', 'Name: ') !!}
        {!! Form::text('name', $category->name, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('description', 'Description: ') !!}
        {!! Form::textarea('description',$category->description, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('formatos', 'Formatos: ') !!}
        {!! Form::textarea('formatos',$list_f, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('papeis', 'Papeis: ') !!}
        {!! Form::textarea('papeis',$list_p, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::submit('Edit Category', ['class'=>'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}
</div>
@stop