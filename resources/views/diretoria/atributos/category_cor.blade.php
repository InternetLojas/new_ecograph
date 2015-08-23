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
                                    <table class="table table-bordered table-condensed">
                                        <thead>
                                        <tr>
                                            <th>Papel</th>
                                            <th>Cores</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($papel[$formato_id] as $papel_id => $items_p)
                                        <tr>
                                            <td>
                                                {{$items_p['papel_nome']}}
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
                                                                    @forelse($items_p['pacotes']['pacote_id'] as $k => $quantity)
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
                                                    @forelse($cores as $cor_id => $items_c)
                                                        <tr>
                                                            <td>
                                                                {{$items_c['cor_nome']}}
                                                            </td>
                                                            <td>

                                                            </td>
                                                        </tr>
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
                    {!! Form::open(['route' =>['categories.atributo.update',$cat_id,'cor'],'method'=>'put', 'class' => 'form-horizontal']) !!}
                    <div class="form-group">
                        @forelse($list_cores as $cores)
                            <div class="col-sm-3">
                                <div class="checkbox">
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="papel[{{$cores->id}}]" value="{{$cores->id}}" @if(in_array($cores->id,$catcores)) checked @endif >{{$cores->valor}}</label>
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