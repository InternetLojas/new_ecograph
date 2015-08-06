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
                                            <th>#</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($papel as $papel_id => $items_p)
                                        <tr>
                                            <td>
                                                {{$items_p['papel_nome']}}
                                            </td>
                                            <td>
                                                <table class="table table-bordered table-condensed">
                                                    <thead>
                                                    <tr>
                                                        <th>Cor</th>
                                                        <th>#</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @forelse($cores as $cor_id => $items_c)
                                                        <tr>
                                                            <td>
                                                                {{$items_c['cor_nome']}}
                                                            </td>
                                                            <td>
                                                                <table class="table table-bordered table-condensed">
                                                                    <thead>
                                                                    <tr>
                                                                        <th>Acabamento</th>
                                                                        <th>#</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    <tr>
                                                                        <td></td>
                                                                        <td>
                                                                            <table class="table table-bordered table-condensed">
                                                                                <tr>
                                                                                    @forelse($items_p['pacotes'][$formato_id][$papel_id]['weight'] as $weight)
                                                                                    <td>{{$weight[0]}}</td>
                                                                                    @empty
                                                                                    @endforelse
                                                                                </tr>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                    @forelse($acabamentos as $acabamento_id => $items_a)
                                                                        <tr>
                                                                            <td>
                                                                                {{$items_a['acabamento_nome']}}
                                                                            </td>
                                                                            <td>
                                                                                <table class="table table-bordered table-condensed">
                                                                                    <tr>
                                                                                @forelse($items_a['pacotes'][$formato_id][$papel_id][$cor_id][$acabamento_id]['price'] as $config)
                                                                                    <td>{{$config}}</td>
                                                                                @empty
                                                                                @endforelse
                                                                                    </tr>
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
                    {!! Form::open(['route' =>['categories.update.acabamento',$cat_id],'method'=>'put', 'class' => 'form-horizontal']) !!}
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
                            {!! Form::submit('Edit Category', ['class'=>'btn btn-primary']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop