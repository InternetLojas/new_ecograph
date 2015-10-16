@extends('diretoria.main_admin')
@section('content')
    <div class="container">
        <h1>Pacotes</h1>
        <a href="{{route('pacotes.create')}}"  class="btn btn-default" > Novo Pacote </a>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>Category</th>
                <th>Qtd</th>
            </tr>
            </thead>
            <tbody>
            @forelse($pacotes as $pacote)
                <tr>
                    <td>{!!$pacote->id!!}</td>
                    <td>{!!$pacote->categories_id!!}</td>
                    <td>{!!$pacote->quantity!!}</td>
                    <td>
                        <a href="#" title="Editar categoria {{$pacote->quantity}}">edit</a> |
                        <a href="#" title="Eliminar categoria {{$pacote->quantity}}">delete</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3">
                        <div class="alert alert-info">
                            <h2>Ainda não existem pacotes cadastrado</h2>
                            <p>Clique no botão "Novo Pacote" para criar uma nova entrada.</p>
                        </div>
                    </td>
                </tr>
            @endforelse

            </tbody>
        </table>
        {!! $pacotes->render() !!}
    </div>
@stop