@extends('diretoria.main_admin')
@section('content')
    <div class="container">
        <h1>Acabamentos</h1>
        <a href="#"  class="btn btn-default" > New Attribute </a>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
            </tr>
            </thead>
            <tbody>
            @foreach($acabamentos as $acabamento)
                <tr>
                    <td>{!!$acabamento->id!!}</td>
                    <td>{!!$acabamento->valor!!}</td>
                    <td>
                        <a href="#" title="Editar categoria {{$acabamento->valor}}">edit</a> |
                        <a href="#" title="Eliminar categoria {{$acabamento->valor}}">delete</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {!! $acabamentos->render() !!}
    </div>
@stop