@extends('diretoria.main_admin')
@section('content')
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Pacotes da Categoria {!!$cat->name!!}</h1>
                    <form class="form-horizontal" role="form">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered table-condensed">
                                        <thead>
                                        <tr>
                                            <th>Formato</th>
                                            <th>Cores</th>
                                            <th>Papel</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($pacotes as $formatos => $formato)
                                            <tr>
                                                <td>{{$formatos}}</td>
                                                <td>cor</td>
                                                <td class="name">
                                                    <table class="table table-condensed">
                                                        @forelse($formato as $papel =>$pacote)
                                                            <thead>
                                                            <tr>
                                                                <th>{{$papel}}</th>
                                                                <th>Qtd</th>
                                                                <th>Peso</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                <td class="papel"></td>
                                                                <td class="qtd">
                                                                    <table class="table table-condensed">
                                                                        <tbody>
                                                                        @forelse($pacote as $pacotes_id =>$quantity)
                                                                            <tr>
                                                                                <td>{{$quantity['quantity']}}</td>
                                                                            </tr>

                                                                        @empty
                                                                        @endforelse
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                                <td class="peso">
                                                                    <table class="table table-condensed">
                                                                        <tbody>
                                                                        @forelse($pacote as $pacotes_id =>$peso)
                                                                            <tr>
                                                                                <td>{{$quantity['weight']}}</td>
                                                                            </tr>

                                                                        @empty
                                                                        @endforelse
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                        @empty
                                                        @endforelse
                                                    </table>
                                                </td>

                                            </tr>
                                        @empty
                                        @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
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
@stop