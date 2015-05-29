
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

<div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading">Panel heading</div>
        <div class="panel-body">
            <p>Text goes here...</p>
        </div>

</div>
                    <table class="table table-striped table-bordered">
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
                                    </p> 
                                </td>
                                <td class="center">{{ $customers->created_at }}</td>
                                <td class="center">
                                    <ul class="unstyled">
                                        <li>
                                            <a href="{{ URL::to('clientes/editar/dados')}}/{{ $customers->id }}">
                                                <i class="icon-folder-close"></i> Atualizar dados</a> 
                                        </li>
                                    </ul>
                                </td>
                            </tr>    
                        </tbody>
                    </table>        
                </div>
                <div class="tab-pane" id="enderecos">

                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                @if($customers->customers_cpf_cnpj == 'j')
                                <th class="name">Empresa</th>
                                @endif
                                <th class="name">CPF/CNPJ</th>
                                <th class="name">RG/IE</th>
                                <th class="name">Telefone</th>
                                <th class="name">Av / Rua</th>
                                <th class="name">Bairro</th>
                                <th class="name">Cidade</th>
                                <th class="name">Estado</th>
                                <th class="name">Nr</th>
                                <th class="name">Referência</th>
                                <th class="name">Referência para entrega</th>
                                <th class="name">Editar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($address as $value)
                            <tr>
                                @if($customers->customers_pf_pj == 'j')
                                <td>{{ $value->entry_company }} - {{ $value->entry_fantasia }}</td>
                                @endif
                                <td>{{ $customers->customers_cpf_cnpj }}</td>
                                <td>{{ $customers->customers_rg_ie }}</td>
                                <td>{{ $customers->ddd }} {{ $customers->customers_telephone }}</td>
                                <td>{{ $value->entry_street_address }}</td>
                                <td>{{ $value->entry_suburb }}</td>
                                <td>{{ $value->entry_city }}</td>
                                <td>{{ $value->entry_state }}</td>
                                <td>{{ $value->entry_nr_rua }}</td>
                                <td>{{ $value->entry_comp_ref }}</td>
                                <td>{{ $value-> entry_ref_entrega }}</td>
                                <td class="center">
                                    <ul class="unstyled">
                                        <li>
                                            <a href="{{ URL::to('clientes/editar/endereco')}}/{{ $customers->id }}">
                                                <i class="icon-folder-close"></i> Atualizar dados</a> 
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <hr class="soft"/>

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
                            @foreach($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->payment_method }}</td>
                                <td>{{ $order->orders_status }}</td>
                                <td>{{ $order->created_at }}</td>
                                <td class="center">
                                    <ul class="unstyled">
                                        <li>
                                            <a href="{{ URL::to('clientes/pedidos')}}/{{ $order->id }}">
                                                <i class="icon-folder-close"></i> Ver pedido</a> 
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                            @endforeach
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