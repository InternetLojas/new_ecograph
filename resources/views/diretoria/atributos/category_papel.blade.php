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
                            <th>#</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($formato as $formato_id => $items)

                            <tr>
                                <td>
                                    {{$items['formato_nome']}}
                                </td>
                                <td>
                                    {!! Form::open(['url'=>route('weight.update',['id'=>$cat_id]),'method'=>'put', 'class' => 'form-horizontal']) !!}
                                    <table class="table table-bordered table-condensed">
                                        <thead>
                                        <tr>
                                            <th>Papel</th>
                                            <th>#</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($papel[$formato_id] as $papel_id => $items)
                                            <!--verifica se o formato é autorizado para o papel corrente-->
                                            @if (in_array($formato_id, $formato_autorizado[0][$papel_id]))
                                            <tr>
                                                <td>
                                                    {{$items['papel_nome']}}
                                                </td>
                                                <td>
                                                    <table class="table table-bordered table-condensed">

                                                            @forelse($items as $chave => $value)
                                                            @if(!is_null($value))
                                                            @if($chave == 'pacotes')
                                                                    <tr>
                                                                        <td>Qtd</td>
                                                                        @forelse($value['pacote_id'] as $pacote_id => $quantity)
                                                                            <td>{{$quantity}}</td>
                                                                        @empty
                                                                        @endforelse
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Peso</td>
                                                                    @forelse($value['weight'] as $pacpapel_id => $weight)
                                                                        <td>
                                                                            {!! Form::text('weight['.$pacpapel_id.']', $weight, ['class' => 'form-control']) !!}

                                                                        </td>
                                                                    @empty
                                                                    @endforelse
                                                                    </tr>
                                                                @endif
                                                            @endif
                                                            @empty
                                                            @endforelse

                                                    </table>
                                                </td>
                                            </tr>
                                            @endif
                                        @empty
                                        @endforelse
                                        </tbody>
                                    </table>
                                    {!!Form::submit('Atualizar peso', ['class'=>'btn btn-success pull-right']) !!}
                                    {!! Form::close() !!}
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