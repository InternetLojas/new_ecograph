@extends('diretoria.main_admin')
@section('content')
    <div class="container">
        <h1>Papeis</h1>
        <a href="{{route('papeis.create')}}"  class="btn btn-default" > Novo Papel </a>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
            </tr>
            </thead>
            <tbody>
            @forelse($papeis as $papel)
                <tr>
                    <td>{!!$papel->id!!}</td>
                    <td>{!!$papel->valor!!}</td>
                    <td>
                        <a href="#" title="Editar categoria {{$papel->valor}}">edit</a> |
                        <a href="#" title="Eliminar categoria {{$papel->valor}}">delete</a>
                    </td>
                </tr>
                @empty
                    <tr>
                        <td colspan="3">
                            <div class="alert alert-info">
                                <h2>Ainda não existem papeis cadastrado</h2>
                                <p>Clique no botão "Novo Formato" para criar uma nova entrada.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {!! $papeis->render() !!}
    </div>
@stop