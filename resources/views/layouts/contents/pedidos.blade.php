<div class="row container">
    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
        <h1 class="heading1"><span class="maintext"> <i class="icon-signin"></i> Seus pedidos</span></h1>
        <h3 class="heading3">
            Bem Vindo! - Verifique a lista coms os seus últimos pedidos.</b>
        </h3>
        <table class="table table-striped table-bordered bootstrap-datatable datatable">
            <thead>
            <tr>
                <th>Pedido nr</th>
                <th>Data do pedido</th>
                <th>Enviado para</th>
                <th>Qtd de produtos</th>
                <th>Forma de Pgmto</th>
                <th>Custo</th>
                <th>Situação do Pedido</th>
                <th>Ações</th>
            </tr>
            </thead>
            <tbody>

                @if($order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td class="center">{{Utilidades::toview($order->created_at) }}</td>
                        <td class="center">{{$order->delivery_name}}</td>
                        <td class="center">itens</td>
                        <td class="center">{{$order->payment_method}}</td>
                        <td class="center">itens</td>
                        <td class="center">
                            <span class="label label-success">{{Utilidades::SituacaoPedido($order->orders_status)}}</span>
                        </td>
                        <td class="center">
                            <a class="btn btn-success" href="{{ URL::to('clientes/detalhespedidos')}}/{{ $order->id }}" title="Ver os detalhes desse produto">
                                <i class="halflings-icon white zoom-in"></i>
                            </a>
                        </td>
                    </tr>
                @endif

            </tbody>
        </table>

    </div>
</div>