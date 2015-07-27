@extends('diretoria.main_admin')
@section('content')
    <div class="container">
        <h1>Formatos</h1>
        <a href="#"  class="btn btn-default" > New Attribute </a>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
            </tr>
            </thead>
            <tbody>
            @foreach($formatos as $formato)
                <tr>
                    <td>{!!$formato->id!!}</td>
                    <td>{!!$formato->valor!!}</td>
                    <td>
                        <a href="#" title="Editar categoria {{$formato->valor}}">edit</a> |
                        <a href="#" title="Eliminar categoria {{$formato->valor}}">delete</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <hr>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>Categoria</th>
                <th>Formato</th>
            </tr>
            </thead>
            <tbody>
            @foreach($c_f as $category_formatos)
                <tr>
                    <td>{!!$category_formatos->id!!}</td>
                    <td>{!!$category_formatos->category_id!!}</td>
                    <td>{!!$category_formatos->formato_id!!}</td>
                    <td>
                        <a href="#" title="Editar categoria {{$formato->valor}}">edit</a> |
                        <a href="#" title="Eliminar categoria {{$formato->valor}}">delete</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {!! $formatos->render() !!}
    </div>
@stop