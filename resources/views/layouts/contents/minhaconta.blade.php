
<div class="row container">
    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
        <h1 class="heading1">
            <span class="maintext">
                <i class="icon icon-user font18"></i> Conta de {{ $customers->customers_firstname }} {{ $customers->customers_lastname }}</span></h1>
        <h3 class="heading3">
            Bem Vindo !
        </h3>

        <div class="row-fluid">
            <!-- Nav tabs -->
            <ul id="myTab" class="nav nav-tabs">
                <li class="active"><a href="#cadastro" data-toggle="tab">Dados Cadastrais</a></li>
                <li class=""><a href="#enderecos" data-toggle="tab">Meus Endereços</a></li>
                <li class=""><a href="#pedidos" data-toggle="tab">Meus Pedidos</a></li>
                <li class=""><a href="#orcamentos" data-toggle="tab">Meus Orçamentos</a></li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active" id="cadastro">
                    <div class="table-responsive cart_info">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th class="name">Nome</th>
                                <th class="name">Aniversário</th>
                                <th class="name">Email</th>
                                <th class="name">Telefones</th>
                                <th class="name">Tipo cadastro</th>
                                <th class="name">Documentos</th>
                                <th class="name">Cliente desde</th>
                                <th class="name">Editar</th>
                            </tr>
                            </thead>
                            <tbody>

                            <tr class="odd gradeX">
                                <td>{{ $customers->customers_firstname }} {{ $customers->customers_lastname }}</td>
                                <td>{{ $customers->customers_dob }}</td>
                                <td>{{ $customers->email }}</td>
                                <td class="center">
                                    <p>
                                        {{ $customers->customers_ddd }} {{ $customers->customers_telephone }}<br>
                                        {{ $customers->customers_ddd1 }} {{ $customers->customers_telephone1 }}<br>
                                        {{ $customers->customers_ddd2 }} {{ $customers->customers_cel }}
                                    </p>
                                </td>
                                <td class="center">
                                    @if($customers->customers_pf_pj == 'j')
                                        Jurídica
                                    @else
                                        Física
                                    @endif
                                </td>
                                <td class="center">
                                    <p>
                                        @if($customers->customers_pf_pj == 'j')
                                            {{ $customers->customers_cpf_cnpj }}<br>
                                            {{ $customers->customers_rg_ie }}
                                        @else
                                            {{ $customers->customers_cpf_cnpj }}<br>
                                            {{ $customers->customers_rg_ie}}
                                    </p>
                                    @endif
                                </td>
                                <td class="center">{{ $customers->created_at }}</td>
                                <td class="center">
                                    <a class="btn btn-success no-radius" href="{{ route('clientes.conta',['id'=> $customers->id])}}" >detalhes</a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane" id="enderecos">
                    <div class="table-responsive cart_info">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                @if($customers->customers_cpf_cnpj == 'j')
                                    <th class="name">Empresa</th>
                                @endif
                                <th class="name">Av / Rua</th>
                                <th class="name">Bairro</th>
                                <th class="name">Cidade</th>
                                <th class="name">Estado</th>
                                <th class="name">Nr</th>
                                <th class="name">Referência</th>
                                <th class="name">Referência para entrega</th>
                                <th class="name">Detalhes</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($address as $item)
                                <tr>
                                    @if($customers->customers_cpf_cnpj == 'j')
                                        <td class="name">
                                            {!!$item->entry_company!!}
                                        </td>
                                    @endif
                                    <td>{!!$item->entry_street_address!!}</td>
                                    <td>{!!$item->entry_suburb!!}</td>
                                    <td>{!!$item->entry_city!!}</td>
                                    <td>{!!$item->entry_state!!}</td>
                                    <td>{!!$item->entry_nr_rua!!}</td>
                                    <td>{!!$item->entry_comp_ref!!}</td>
                                    <td>{!!$item->entry_ref_entrega!!}</td>
                                    <td>
                                        <a class="btn btn-success no-radius" href="{{route('clientes.endereco',['id'=>$item->id])}}" title="Ver Detalhes">detalhes</a>
                                    </td>
                                </tr>
                            @empty
                                <p>Nenhum endereço cadastrado</p>
                            @endforelse
                            </tbody>
                        </table>
                        <hr class="soft"/>
                    </div>
                </div>
                <div class="tab-pane" id="pedidos">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th class="name">Nr</th>
                            <th class="name">Forma de Pagamento</th>
                            <th class="name">Situação</th>
                            <th class="name">Data</th>
                            <th class="name">Ver Detalhes</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($order as $item)
                            <tr>
                                <td>{!!$item->id!!}</td>
                                <td>{!!$item->payment_method!!}</td>
                                <td>{!!$item->orders_status!!}</td>
                                <td>{!!$item->created_at!!}</td>
                                <td><a class="btn btn-success no-radius" href="{{route('clientes.pedidos',['id'=>$item->id])}}" title="Ver Detalhes">detalhes</a></td>
                            </tr>
                        @empty
                            <p>Nenhum pedido realizado</p>
                        @endforelse
                        </tbody>
                    </table>
                    <hr>
                </div>
                <div class="tab-pane" id="orcamentos">
                    orçamentos
                    <hr>

                </div>
            </div>
        </div>
    </div>
</div>