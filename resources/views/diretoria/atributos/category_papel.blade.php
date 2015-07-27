@extends('diretoria.main_admin')
@section('content')
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Atributos da Categoria {!!$cat->name!!}</h1>
                    <form class="form-horizontal" role="form">
                        <div class="form-group">
                            <h2>Formatos</h2>
                            <hr>
                            @forelse($papeis as $papel)
                                <div class="col-sm-3">
                                    <div class="checkbox">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="papel[{{$papel->id}}]" value="{{$papel->id}}" @if(in_array($papel->id,$catpapeis)) checked @endif >{{$papel->valor}}</label>
                                    </div>
                                </div>
                            @empty
                                <p>Sem atributo papeis</p>
                            @endforelse
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default">Sign in</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@stop