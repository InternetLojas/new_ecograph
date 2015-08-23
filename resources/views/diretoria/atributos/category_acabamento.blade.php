@extends('diretoria.main_admin')
@section('content')
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Configuração de acabamento para categoria {!!$cat_name!!}</h1>

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
                                            <th>
                                                #
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

                                                        <table class="table table-bordered  table-condensed">
                                                            <thead>
                                                            <tr>
                                                                <th>Cores</th>
                                                                <th>
                                                                    #
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
                                                                        {!! Form::open(['url'=>route('prices.update',['id'=>$cat_id]),'method'=>'put', 'class' => 'form-horizontal']) !!}
                                                                        <table class="table table-bordered table-condensed">
                                                                            <thead>
                                                                            <tr>
                                                                                    <th>Acabamento</th>
                                                                                    @forelse($items_p['pacotes']['pacote_id'] as $id =>$quantity)
                                                                                        <th>{{$quantity}}</th>
                                                                                    @empty
                                                                                        <th></th>
                                                                                    @endforelse
                                                                            </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                            @forelse($acabamentos[$formato_id][$papel_id][$items_c['cor_id']] as $acabamento_id => $items_a)

                                                                                <tr>
                                                                                    <td>
                                                                                        @forelse($items_a as $acabamento_nome => $configuracao)
                                                                                            {{$acabamento_nome}}
                                                                                        @empty
                                                                                        @endforelse
                                                                                    </td>
                                                                                    @forelse($items_a as $acabamento_nome => $configuracao)
                                                                                        @forelse($configuracao as $p => $prices)
                                                                                            <td>
                                                                                                {!! Form::text('price['.$prices['pacacabamento_id'].']', $prices['price'], ['class' => 'form-control']) !!}
                                                                                            </td>
                                                                                        @empty
                                                                                        @endforelse
                                                                                    @empty
                                                                                    @endforelse
                                                                                </tr>
                                                                            @empty
                                                                            @endforelse
                                                                            </tbody>
                                                                        </table>
                                                                        {!! Form::submit('Adicionar o preço', ['class'=>'btn btn-success pull-right']) !!}
                                                                        {!!Form::close()!!}
                                                                    </td>
                                                                </tr>
                                                            @empty
                                                            @endforelse
                                                            </tbody>
                                                        </table>

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

                    <h2>Editar atributo do acabamento</h2>
                    @if($errors->any())
                        <ul class="alert alert-warning">
                            @foreach($errors->all() as $erro)
                                <li>
                                    {!! $erro !!}
                                </li>
                            @endforeach
                        </ul>
                    @endif
                    {!! Form::open(['route' =>['categories.atributo.update',$cat_id,'acabamento'],'method'=>'put', 'class' => 'form-horizontal']) !!}
                    <div class="form-group">
                        @forelse($list_acabamentos as $acabamento)
                            <div class="col-sm-3">
                                <div class="checkbox">
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="papel[{{$acabamento->id}}]" value="{{$acabamento->id}}" @if(in_array($acabamento->id,$catacabamentos)) checked @endif >{{$acabamento->valor}}</label>
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