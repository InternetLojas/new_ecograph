@extends('diretoria.main_admin')
@section('content')
    <div class="container">
        <h1>Editar atributos da categoria</h1>
        <hr>
        <!--<a href="#"  class="btn btn-default" > Nova Categoria </a>-->
        <table class="table table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>Categoria</th>
                <th>Verificar</th>
            </tr>
            </thead>
            <tbody>
            @foreach($categories as $category)
                <tr>
                    <td>{!!$category->id!!}</td>
                    <td><a href="#" title="Detalhes sobre {{$category->name}}" >{!!$description->find($category->id)->categories_name!!}</a></td>
                    <td>
                        <a href="{{ route('categorie.formatos.edit', ['id'=> $category->id ]) }}" title="Editar formato da {{$category->name}} ">Formato</a> |
                        <a href="{{ route('categorie.papeis.edit', ['id'=> $category->id ]) }}" title="Editar papel da {{$category->name}} ">Papel</a> |
                        <a href="{{ route('categorie.cores.edit', ['id'=> $category->id ]) }}" title="Editar cor da {{$category->name}} ">Cor</a> |
                        <a href="{{ route('categorie.acabamentos.edit', ['id'=> $category->id ]) }}" title="Editar acabamento da {{$category->name}} ">Acabamento</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {!! $categories->render() !!}
    </div>
@stop