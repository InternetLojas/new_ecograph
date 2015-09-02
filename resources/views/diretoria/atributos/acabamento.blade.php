@extends('diretoria.main_admin')
@section('content')
    <div class="container">
        <h1>Acabamentos</h1>
        <a href="{{route('acabamentos.create')}}"  class="btn btn-default" > Novo Acabamento </a>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>Enobrecimento</th>
                <th>Acabamento</th>
            </tr>
            </thead>
            <tbody>
            @forelse($acabamentos as $acabamento)
                <tr>
                    <td>{!!$acabamento->id!!}</td>
                    <td>{!!$acabamento->valor!!}</td>
                    <td>{!!$acabamento->enoblecimento!!}</td>
                    <td>
                        <a href="#" title="Editar categoria {{$acabamento->valor}}">edit</a> |
                        <a href="#" title="Eliminar categoria {{$acabamento->valor}}">delete</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">
                        <div class="alert alert-info">
                            <h2>Ainda não existem acabamentos cadastrado</h2>
                            <p>Clique no botão "Novo Acabamento" para criar uma nova entrada.</p>
                        </div>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
        {!! $acabamentos->render() !!}
    </div>
@stop