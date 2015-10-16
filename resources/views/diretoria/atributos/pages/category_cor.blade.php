<section class="content">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Configuração de papeis para categoria {!!$cat_name!!}</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered">
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
                </div>
            </div>
        </div>
    </div>
</section>