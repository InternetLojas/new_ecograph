
<h1 class="heading1">
    <span class="maintext">
        <i class="icon-user"></i>
        Bem Vindo {{ $customers->customers_firstname }} {{ $customers->customers_lastname }}
    </span>
</h1>
<div class="row">
    {!! Form::open(['route' =>['endereco.update',$customers->id],'method'=>'put', 'class' => 'form-horizontal', 'onSubmit' =>'return check_form(editar_account)']) !!}

    <!-- Text input-->
    <h3 class="heading3"><b>Meus endereços</b></h3>
    <div class="registerbox">
        <fieldset>
            <div class="control-group">
                <label class="control-label">Nr/Rua/Av</label>
                @foreach($address as $k=>$value)
                    <div class="controls">
                        {!! Form::text('entry_nr_rua', $value['entry_nr_rua'], array('id' =>'entry_nr_rua', 'class' => 'col-lg-2 col-md-2 span2', 'placeholder' => 'informe o número')) !!}
                        {!! Form::text('entry_street_address', $value['entry_street_address'], array('id' =>'entry_street_address', 'class' => 'col-lg-4 col-md-4 span4', 'placeholder' => 'informe o endereço')) !!}
                        @endforeach
                    </div>
                    <div class="control-group">
                        <label class="control-label">Bairro</label>
                        @foreach($address as $k=>$value)
                            <div class="controls">
                                {!! Form::text('entry_suburb', $value['entry_suburb'], array('id' =>'entry_suburb', 'class' => 'col-lg-6 col-md-6 span6', 'placeholder' => 'informe o endereço')) !!}
                                @endforeach
                            </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Cidade/Estado</label>
                        @foreach($address as $k=>$value)
                            <div class="controls">
                                {!! Form::text('entry_city', $value['entry_city'], array('id' =>'entry_city', 'class' => 'col-lg-4 col-md-4 span4', 'placeholder' => 'informe a cidade')) !!}
                                {!! Form::text('entry_state', $value['entry_state'], array('id' =>'entry_state', 'class' => 'col-lg-2 col-md-2 span2', 'placeholder' => 'informe o estado')) !!}
                                @endforeach
                            </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Complemento</label>
                        @foreach($address as $k=>$value)
                            <div class="controls">
                                {!! Form::text('entry_comp_ref', $value['entry_comp_ref'], array('id' =>'entry_comp_ref', 'class' => 'col-lg-6 col-md-6 span6', 'placeholder' => 'informe a cidade')) !!}
                                @endforeach
                            </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Referência</label>
                        @foreach($address as $k=>$value)
                            <div class="controls">
                                {!! Form::text(' entry_ref_entrega', $value['entry_ref_entrega'], array('id' =>' entry_ref_entrega', 'class' => 'col-lg-6 col-md-6 span6', 'placeholder' => 'informe a cidade')) !!}
                                @endforeach
                            </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label"><span class="red">*</span>DDD/Telefone 1</label>
                        <div class="controls">
                            {!! Form::text('customers_ddd', $customers->customers_ddd, array('id' =>'ddd', 'class' => 'col-lg-2 col-md-2 span2','placeholder' => 'informe o DDD','required'=>'true')) !!}
                            {!! Form::text('customers_telephone', $customers->customers_telephone, array('id' =>'customers_telephone', 'class' => 'col-lg-4 col-md-4 span4', 'placeholder' => 'informe seu telefone princinpal','required'=>'true')) !!}
                        </div>
                    </div>
        </fieldset>
        <fieldset>
            <div class="control-group">
                <label class="control-label"><span class="red">*</span>DDD/Telefone 2</label>
                <div class="controls">
                    {!! Form::text('customers_ddd1', $customers->customers_ddd1, array('id' =>'ddd1', 'class' => 'col-lg-2 col-md-2 span2','placeholder' => 'informe o DDD','required'=>'true')) !!}
                    {!! Form::text('customers_telephone1', $customers->customers_telephone1, array('id' =>'customers_telephone1', 'class' => 'col-lg-4 col-md-4 span4', 'placeholder' => 'informe outro telefone')) !!}
                </div>
            </div>

            <div class="control-group">
                <label class="control-label"><span class="red">*</span>DDD/Celular</label>
                <div class="controls">
                    {!! Form::text('customers_ddd2', $customers->customers_ddd2, array('id' =>'ddd2', 'class' => 'col-lg-2 col-md-2 span2','placeholder' => 'informe o DDD','required'=>'true')) !!}
                    {!! Form::text('customers_cel', $customers->customers_cel, array('id' =>'customers_cel', 'class' => 'col-lg-4 col-md-4 span4', 'placeholder' => 'informe o celular')) !!}
                </div>
            </div>
        </fieldset>
        @if($customers->customers_pf_pj == 'j')
            <fieldset>
                <div class="control-group">
                    <label class="control-label"><span class="red">*</span>Nome da Empresa</label>
                    @foreach($address as $k=>$value)
                        <div class="controls">
                            {!! Form::text('entry_company', $customers->entry_company, array('id' =>'entry_company', 'class' => 'col-lg-6 col-md-6 span6','placeholder' => 'informe o nome da Empresa','required'=>'true')) !!}
                        </div>
                    @endforeach
                </div>
                <div class="control-group">
                    <label class="control-label"><span class="red">*</span>Nome Fantasia</label>
                    @foreach($address as $k=>$value)
                        <div class="controls">
                            {!! Form::text('entry_fantasia', $customers->entry_fantasia, array('id' =>'entry_fantasia', 'class' => 'col-lg-6 col-md-6 span6','placeholder' => 'informe o nome da Empresa','required'=>'true')) !!}
                        </div>
                    @endforeach
                </div>
            </fieldset>
        @endif
        <div class="pull-right">
            {!! Form::hidden('customers_default_address_id', $customers->customers_default_address_id, array('id' =>'customers_default_address_id')) !!}
            {!! Form::submit('Atualizar dados!', array('class' => 'btn btn-orange')) !!}
        </div>
    </div>
    {!! Form::close() !!}
</div>