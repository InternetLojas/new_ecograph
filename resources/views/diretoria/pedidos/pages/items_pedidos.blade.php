<section class="content">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Detalhes Pedido {{$order->id}}</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#customer" data-toggle="tab">Cliente</a></li>
                            <li><a href="#address" data-toggle="tab">Endereços</a></li>
                            <li><a href="#items" data-toggle="tab">Items</a></li>
                            <li><a href="#valores" data-toggle="tab">Custos</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="active tab-pane" id="customer">
                                <!-- Post -->
                                <div class="post">
                                    <div class="user-block">
                                       <span class='username'>
                                          <a href="#">{{$order->customers_name}}</a><br>
                                           Empresa: {{$order->customers_company}}<br>
                                           CPF/CNPJ: {{$order->customers_cpf_cnpj}}<br>
                                           RG: {{$order->customers_rg_ie}}
                                           </span>
                                    </div><!-- /.user-block -->
                                </div><!-- /.post -->

                            </div><!-- /.tab-pane -->
                            <div class="tab-pane" id="address">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                        <tr>
                                            <th class="head text-center">Residência</th>
                                            <th class="head text-center">Pagamento</th>
                                            <th class="head text-center">Entrega</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td class="text-left">
                                                Av/Rua/Nr: {{$order->customers_street_address}} {{$order->customers_nr_rua}}<br>
                                                Bairro: {{$order->customers_suburb}}<br>
                                                Referência: {{$order->customers_comp_ref}}<br>
                                                Cidade: {{$order->customers_city}} - CEP: {{$order->customers_postcode}}<br>
                                                Estado: {{$order->customers_state}}
                                                Telefone: {{$order->customers_telephone}}<br>
                                                Email: {{$order->customers_email_address}}
                                            </td>
                                            <td class="text-left">
                                                Av/Rua/Nr: {{$order->delivery_street_address}} {{$order->delivery_nr_rua}}<br>
                                                Referência: {{$order->delivery_comp_ref}}<br>
                                                Bairro: {{$order->delivery_suburb}}<br>
                                                Cidade: {{$order->delivery_city}} - CEP: {{$order->delivery_postcode}}<br>
                                                Estado: {{$order->delivery_state}}
                                            </td>
                                            <td class="text-left">
                                                Av/Rua/Nr: {{$order->billing_nr_rua}} {{$order->billing_street_address}}<br>
                                                Referência: {{$order->billing_comp_ref}}<br>
                                                Bairro: {{$order->billing_suburb}}<br>
                                                Cidade: {{$order->billing_city}} - CEP: {{$order->billing_postcode}}<br>
                                                Estado: {{$order->billing_state}}
                                            </td>
                                        </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div><!-- /.tab-pane -->
                            <div class="tab-pane" id="valores">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                        <tr>

                                            <th class="head text-center">Produto</th>
                                            <th class="head text-center">Qtd</th>
                                            <th class="head text-center">Preço</th>
                                            <th class="head text-center">Forma de Pgmto</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($orderItem as $key => $value)
                                            <tr>
                                                <td class="text-center">{{ $value->product_name }}</td>
                                                <td class="text-center">{{ $value->quantity }}</td>
                                                <td class="text-center">
                                                    {{ $value->quantity }} x {{ $value->price }} = {{ $value->final_price }}
                                                </td>
                                                <td class="text-center">{{$order->payment_method}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div><!-- /.tab-pane -->
                            <div class="tab-pane" id="items">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                        <tr>

                                            <th class="head text-center">Produto</th>
                                            <th class="head text-center">Qtd</th>
                                            <th class="head text-center">Preço</th>
                                            <th class="head text-center">Forma de Pgmto</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($orderItem as $key => $value)
                                            <tr>

                                                <td class="text-center">{{ $value->product_name }}</td>
                                                <td class="text-center">{{ $value->quantity }}</td>
                                                <td class="text-center">
                                                    {{ $value->quantity }} x {{ $value->price }} = {{ $value->final_price }}
                                                </td>
                                                <td class="text-center">{{$order->payment_method}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div><!-- /.tab-pane -->
                        </div><!-- /.tab-content -->
                    </div><!-- /.nav-tabs-custom -->
                    <!-- /.row -->
                    <!--

    "payment_method" => "Pagamento Digital"

       "id" => 47
        "order_id" => 36
        "product_id" => 447
        "quantity" => 1
        "product_name" => "Cabeleleiro [`products_model`]"
        "products_model" => "cvg-cabeleleiro"
        "price" => "0.0000"
        "final_price" => "0.0000"
                     -->

                </div>
                <div class="box-footer">
                    footer
                </div>
            </div>
        </div>

    </div>
</section>