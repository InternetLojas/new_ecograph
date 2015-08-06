@extends('diretoria.main_admin')
@section('content')
    <div class="container">
        <h1>Formatos</h1>
        <a href="{{route('formatos.create')}}"  class="btn btn-default" > Novo Formato </a>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
            </tr>
            </thead>
            <tbody>
            @forelse($formatos as $formato)
                <tr>
                    <td>{!!$formato->id!!}</td>
                    <td>{!!$formato->valor!!}</td>
                    <td>
                        <a href="#" title="Editar categoria {{$formato->valor}}">edit</a> |
                        <a href="#" title="Eliminar categoria {{$formato->valor}}">delete</a>
                    </td>
                </tr>
                @empty
                    <tr>
                        <td colspan="3">
                            <div class="alert alert-info">
                                <h2>Ainda não existem formatos cadastrado</h2>
                                <p>Clique no botão "Novo Formato" para criar uma nova entrada.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {!! $formatos->render() !!}
    </div>
@stop