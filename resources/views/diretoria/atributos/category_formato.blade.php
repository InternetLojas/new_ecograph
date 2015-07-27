@extends('diretoria.main_admin')
@section('content')
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Configuração de formatos para categoria {!!$cat_name!!}</h1>
                    <h2>Editar quantidade do formato</h2>
                    <table class="table table-bordered table-condensed">
                        <thead>
                        <tr>
                            <th class="text-center">Formato</th>
                            <th class="text-center">Quantidade</th>
                            <th class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($pacotes as $formato_name => $formato)
                            <tr>
                                <td>{{$formato_name}}</td>
                                <td>
                                    <table class="table table-condensed table-hover table-bordered">
                                        <tbody>
                                        <tr>
                                            @forelse($formato as $formato_id => $pacote)
                                                @forelse($pacote as $k => $qtd)
                                                    <td class="qtd text-center">{{$k}} - {{$qtd}}</td>
                                                @empty
                                                @endforelse
                                        </tr>
                                        </tbody>
                                    </table>
                                    @empty
                                    @endforelse
                                </td>
                                <td>
                                    <a href="#" title="Editar pacote ">edit qtd</a>
                                </td>
                            </tr>
                        @empty
                        @endforelse
                        </tbody>
                    </table>
                    <h2>Editar atributo do formato</h2>
                    @if($errors->any())
                        <ul class="alert alert-warning">
                            @foreach($errors->all() as $erro)
                                <li>
                                    {!! $erro !!}
                                </li>
                            @endforeach
                        </ul>
                    @endif
                    {!! Form::open(['route' =>['categories.update.formato',$cat_id],'method'=>'put', 'class' => 'form-horizontal']) !!}
                    <div class="form-group">
                            @forelse($formatos as $formato)
                                <div class="col-sm-3">
                                    <div class="checkbox">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="formato[{{$formato->id}}]" value="{{$formato->id}}" @if(in_array($formato->id,$catformatos)) checked @endif >{{$formato->valor}}</label>
                                    </div>
                                </div>
                            @empty
                                <p>Sem atributo formato</p>
                            @endforelse
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                {!! Form::submit('Edit Category', ['class'=>'btn btn-primary']) !!}
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop