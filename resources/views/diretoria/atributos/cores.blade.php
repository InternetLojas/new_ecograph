@extends('diretoria.main_admin')
@section('content')
    <div class="container">
        <h1>Cores</h1>
        <a href="{{route('cores.create')}}"  class="btn btn-default" > Nova Cor </a>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
            </tr>
            </thead>
            <tbody>
            @forelse($cores as $cor)
                <tr>
                    <td>{!!$cor->id!!}</td>
                    <td>{!!$cor->valor!!}</td>
                    <td>
                        <a href="#" title="Editar categoria {{$cor->valor}}">edit</a> |
                        <a href="#" title="Eliminar categoria {{$cor->valor}}">delete</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">
                        <div class="alert alert-info">
                            <h2>Ainda não existem cores cadastradas</h2>
                            <p>Clique no botão "Nova Cor" para criar uma nova entrada.</p>
                        </div>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
        {!! $cores->render() !!}
    </div>
@stop