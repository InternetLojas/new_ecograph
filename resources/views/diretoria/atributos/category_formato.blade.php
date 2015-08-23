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
                            <th>Formato</th>
                            <th>Quantidade</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($formato as $formato_id => $items)

                            <tr>
                                <td>
                                    {{$items['formato_nome']}}
                                </td>
                                <td>
                                    {!! Form::open(['url'=>route('quantity.update',['id'=>$cat_id]),'method'=>'put', 'class' => 'form-horizontal']) !!}
                                        <table class="table table-bordered table-condensed">
                                            <tbody>
                                            <tr>
                                                @forelse($items['pacotes'] as $id =>$quantity)
                                                    <td>

                                                        {!! Form::text('quantity['.$id.']', $quantity, ['class' => 'form-control']) !!}

                                                    </td>
                                                @empty
                                                    <td></td>
                                                @endforelse
                                            </tr>
                                            </tbody>
                                        </table>
                                    {!! Form::submit('Atualizar quantidade', ['class'=>'btn btn-success pull-right']) !!}
                                    {!! Form::close() !!}
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
                    {!! Form::open(['route' =>['categories.atributo.update',$cat_id,'formato'],'method'=>'put', 'class' => 'form-horizontal']) !!}
                    <div class="form-group">

                        @forelse($list_formatos as $formato)
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
                            {!! Form::submit('Edit Category', ['class'=>'btn btn-success pull-right']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop