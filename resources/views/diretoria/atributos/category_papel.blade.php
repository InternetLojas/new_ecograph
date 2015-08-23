@extends('diretoria.main_admin')
@section('content')
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Configuração de papeis para categoria {!!$cat_name!!}</h1>

                    <table class="table table-bordered table-condensed">
                        <thead>
                        <tr>
                            <th>Formato</th>
                            <th>Papel</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($formato as $formato_id => $items)
                            <tr>
                                <td>
                                    {{$items['formato_nome']}}
                                </td>
                                <td>
                                    <table class="table table-bordered table-condensed">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>
                                                <table class="table table-bordered table-condensed">

                                                    <tbody>

                                                    <tr>
                                                        @forelse($items['pacotes'] as $id =>$quantity)
                                                            <td>{{$quantity}}</td>
                                                        @empty
                                                            <td></td>
                                                        @endforelse
                                                    </tr>

                                                    </tbody>
                                                </table>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @forelse($papel[$formato_id] as $papel_id => $items_p)

                                            @if(is_array($items_p['pacotes']))
                                                <tr>
                                                    <td>
                                                        {{$items_p['papel_nome']}}
                                                    </td>
                                                    <td>
                                                        {!! Form::open(['url'=>route('weight.update',['id'=>$cat_id]),'method'=>'put', 'class' => 'form-horizontal']) !!}
                                                        <table class="table table-condensed">
                                                            <tbody>
                                                            <tr>
                                                                @forelse($items_p['pacotes']['weight'] as $id =>$weight)
                                                                    <td>
                                                                        {!! Form::text('weight['.$id.']', $weight, ['class' => 'form-control']) !!}
                                                                    </td>
                                                                @empty
                                                                @endforelse
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                        {!! Form::submit('Adicionar peso para o papel', ['class'=>'btn btn-success pull-right']) !!}
                                                        {!! Form::close() !!}
                                                    </td>
                                                </tr>
                                            @endif
                                        @empty
                                        @endforelse
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        @empty
                        @endforelse
                        </tbody>
                    </table>

                    <h2>Editar atributo do papel</h2>
                    @if($errors->any())
                        <ul class="alert alert-warning">
                            @foreach($errors->all() as $erro)
                                <li>
                                    {!! $erro !!}
                                </li>
                            @endforeach
                        </ul>
                    @endif
                    {!! Form::open(['route' =>['categories.atributo.update',$cat_id,'papel'],'method'=>'put', 'class' => 'form-horizontal']) !!}
                    <div class="form-group">
                        @forelse($list_papeis as $papel)
                            <div class="col-sm-3">
                                <div class="checkbox">
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="papel[{{$papel->id}}]" value="{{$papel->id}}" @if(in_array($papel->id,$catpapeis)) checked @endif >{{$papel->valor}}</label>
                                </div>
                            </div>
                        @empty
                            <p>Sem atributo papel</p>
                        @endforelse
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            {!! Form::submit('Edit Category', ['class'=>'btn btn-succes pull-right']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop