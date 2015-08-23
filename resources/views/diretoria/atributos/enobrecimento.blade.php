@extends('diretoria.main_admin')
@section('content')
    <div class="container">
        <h1>Enobrecimentos</h1>
        <a href="{{route('enobrecimentos.create')}}"  class="btn btn-default" > Novo Enobrecimento </a>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
            </tr>
            </thead>
            <tbody>
            @forelse($enobrecimentos as $enobrecimento)
                <tr>
                    <td>{!!$enobrecimento->id!!}</td>
                    <td>{!!$enobrecimento->valor!!}</td>
                    <td>
                        <a href="#" title="Editar categoria {{$enobrecimento->valor}}">edit</a> |
                        <a href="#" title="Eliminar categoria {{$enobrecimento->valor}}">delete</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">
                        <div class="alert alert-info">
                            <h2>Ainda não existem enobrecimento cadastrados</h2>
                            <p>Clique no botão "Novo Enobrecimento" para criar uma nova entrada.</p>
                        </div>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
        {!! $enobrecimentos->render() !!}
    </div>
@stop