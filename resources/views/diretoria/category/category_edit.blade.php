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
    {!! Form::open(['route' =>['categories.edit',$category->id],'method'=>'put', 'class' => 'form-horizontal']) !!}
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
        <?php dd($list_f) ; ?>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
            </tr>
            </thead>
            <tbody>
            @forelse($list_f as $formato)
                <tr>
                    <td>{!!$formato->id!!}</td>
                    <td>{!!$formato->valor!!}</td>
                    <td>
                        <a href="#" title="Editar categoria {{$formato->valor}}">edit</a> |
                        <a href="#" title="Eliminar categoria {{$formato->valor}}">delete</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">
                        <div class="alert alert-info">
                            <h2>Ainda não existem formatos cadastrado</h2>
                            <p>Clique no botão "Novo Formato" para criar uma nova entrada.</p>
                        </div>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
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