@extends('diretoria.main_admin')
@section('content')
    <div class="container">
        <h1>Categorias</h1>

        <a href="#"  class="btn btn-default" > New Category </a>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($categories as $category)
                <tr>
                    <td>{!!$category->id!!}</td>
                    <td><a href="#" title="Detalhes sobre {{$category->name}}" >{!!$description->find($category->id)->categories_name!!}</a></td>
                    <td>{!!$description->find($category->id)->categories_descricao!!}</td>
                    <td>
                        <a href="{{ route('categories.edit', ['id'=> $category->id ]) }}" title="Editar categoria {{$category->name}}">edit</a> |
                        <a href="#" title="Eliminar categoria {{$category->name}}">delete</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {!! $categories->render() !!}
    </div>
@stop