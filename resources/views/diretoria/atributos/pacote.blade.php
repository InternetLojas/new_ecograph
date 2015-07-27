@extends('diretoria.main_admin')
@section('content')
    <div class="container">
        <h1>Pacotes</h1>
        <a href="#"  class="btn btn-default" > New Attribute </a>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>Category</th>
                <th>Qtd</th>
            </tr>
            </thead>
            <tbody>
            @foreach($pacotes as $pacote)
                <tr>
                    <td>{!!$pacote->id!!}</td>
                    <td>{!!$pacote->categories_id!!}</td>
                    <td>{!!$pacote->quantity!!}</td>
                    <td>
                        <a href="#" title="Editar categoria {{$pacote->quantity}}">edit</a> |
                        <a href="#" title="Eliminar categoria {{$pacote->quantity}}">delete</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {!! $pacotes->render() !!}
    </div>
@stop