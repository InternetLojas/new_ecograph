@extends('diretoria.main_admin')
@section('content')
    <div class="container">
        <h1>Papeis</h1>
        <a href="#"  class="btn btn-default" > New Attribute </a>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
            </tr>
            </thead>
            <tbody>
            @foreach($papeis as $papel)
                <tr>
                    <td>{!!$papel->id!!}</td>
                    <td>{!!$papel->valor!!}</td>
                    <td>
                        <a href="#" title="Editar categoria {{$papel->valor}}">edit</a> |
                        <a href="#" title="Eliminar categoria {{$papel->valor}}">delete</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {!! $papeis->render() !!}
    </div>
@stop