<div class="row">
    <div class="col-md-6">
        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Edição {{$customers->customers_firstname}}</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                <div class="box-group" id="accordion">
                    <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                    <div class="panel box box-primary">
                        <div class="box-header with-border">
                            <h4 class="box-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                    Dados pessoais
                                </a>
                            </h4>
                        </div>

                        <div id="collapseOne" class="panel-collapse collapse in">
                            {!! Form::open(['route' =>['cadastro.update',$customers->id],'method'=>'put', 'class' => 'form-horizontal', 'onSubmit' =>'return check_form(editar_account)']) !!}
                            <div class="box-body  with-border">
                                <!-- Text input-->
                                <div class="form-group">
                                    <div class="col-sm-2">
                                        <label class="control-label pull-right" for="customers_firstname">Nome</label>
                                    </div>
                                    <div class="col-sm-6">
                                        {!! Form::text('customers_firstname',$customers->customers_firstname,  array('id' =>'firstaname', 'class' => 'form-control no-radius', 'placeholder' => 'informe seu nome','required'=>'true')) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-2">
                                        <label class="control-label  pull-right" for="customers_firstname">Sobrenome</label>
                                    </div>
                                    <div class="col-sm-6">
                                        {!! Form::text('customers_lastname', $customers->customers_lastname, array('id' =>'lastaname', 'class' => 'form-control no-radius', 'placeholder' => 'informe seu sobrenome','required'=>'true')) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-2">
                                        <label class="control-label  pull-right" for="customers_firstname">Nome completo</label>
                                    </div>
                                    <div class="col-sm-6">
                                        <select class="size3" name="customers_gender">
                                            <option value="m">M</option>
                                            <option value="f">F</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-2">
                                        <label class="control-label">Dt Aniversário</label>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="controls">
                                            {!! Form::text('customers_dob', Utilidades::toview($customers->customers_dob), array('id' =>'customers_dob', 'class' => 'form-control no-radius','placeholder' => 'informe data de aniversário','required'=>'true')) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-2">
                                        <label class="control-label">Email</label>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="controls">
                                            {!! Form::email('email', $customers->email, array('id' =>'email', 'class' => 'form-control no-radius', 'placeholder' => 'informe seu email','required'=>'true')) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-2">
                                        <label class="control-label  pull-right" for="customers_firstname">
                                            @if($customers->customers_pf_pj == 'f') CPF @else CNPJ @endif
                                        </label>
                                    </div>
                                    <div class="col-sm-2">
                                        {!! Form::text('customers_cpf_cnpj', $customers->customers_cpf_cnpj, array('id' =>'cpf_cnpj', 'class' => 'form-control no-radius', 'placeholder' => 'informe seu CPF/CNPJ')) !!}
                                    </div>
                                    <div class="col-sm-3 col-sm-push-1">
                                        <label class="control-label  pull-left" for="customers_firstname">
                                            @if($customers->customers_pf_pj == 'f') RG @else IE @endif
                                        </label>
                                    </div>
                                    <div class="col-sm-2 col-sm-pull-1">
                                        {!! Form::text('customers_rg_ie', $customers->customers_rg_ie, array('id' =>'rg_ie', 'class' => 'form-control no-radius', 'placeholder' => 'informe seu RG/IE')) !!}
                                    </div>
                                </div>

                            </div>
                            <div class="box-footer">
                                {!! Form::submit('Atualizar dados!', array('class' => 'btn btn-lg bg-dark fg-white no-radius pull-right')) !!}

                            </div>
                            {!! Form::close() !!}
                        </div>
                        <div class="box-header with-border">
                            <h4 class="box-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                    Endereço
                                </a>
                            </h4>
                        </div>


                        <div id="collapseTwo" class="panel-collapse collapse out">
                            {!! Form::open(['route' =>['cadastro.update',$customers->id],'method'=>'put', 'class' => 'form-horizontal', 'onSubmit' =>'return check_form(editar_account)']) !!}
                            <div class="box-body  with-border">
                                <!-- Text input-->
                                <div class="form-group">
                                    <div class="col-sm-2">
                                        <label class="control-label pull-right" for="customers_firstname">Nome</label>
                                    </div>
                                    <div class="col-sm-6">
                                        {!! Form::text('customers_firstname',$customers->customers_firstname,  array('id' =>'firstaname', 'class' => 'form-control no-radius', 'placeholder' => 'informe seu nome','required'=>'true')) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-2">
                                        <label class="control-label  pull-right" for="customers_firstname">Sobrenome</label>
                                    </div>
                                    <div class="col-sm-6">
                                        {!! Form::text('customers_lastname', $customers->customers_lastname, array('id' =>'lastaname', 'class' => 'form-control no-radius', 'placeholder' => 'informe seu sobrenome','required'=>'true')) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-2">
                                        <label class="control-label  pull-right" for="customers_firstname">Nome completo</label>
                                    </div>
                                    <div class="col-sm-6">
                                        <select class="size3" name="customers_gender">
                                            <option value="m">M</option>
                                            <option value="f">F</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-2">
                                        <label class="control-label">Dt Aniversário</label>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="controls">
                                            {!! Form::text('customers_dob', Utilidades::toview($customers->customers_dob), array('id' =>'customers_dob', 'class' => 'form-control no-radius','placeholder' => 'informe data de aniversário','required'=>'true')) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-2">
                                        <label class="control-label">Email</label>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="controls">
                                            {!! Form::email('email', $customers->email, array('id' =>'email', 'class' => 'form-control no-radius', 'placeholder' => 'informe seu email','required'=>'true')) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-2">
                                        <label class="control-label  pull-right" for="customers_firstname">
                                            @if($customers->customers_pf_pj == 'f') CPF @else CNPJ @endif
                                        </label>
                                    </div>
                                    <div class="col-sm-2">
                                        {!! Form::text('customers_cpf_cnpj', $customers->customers_cpf_cnpj, array('id' =>'cpf_cnpj', 'class' => 'form-control no-radius', 'placeholder' => 'informe seu CPF/CNPJ')) !!}
                                    </div>
                                    <div class="col-sm-3 col-sm-push-1">
                                        <label class="control-label  pull-left" for="customers_firstname">
                                            @if($customers->customers_pf_pj == 'f') RG @else IE @endif
                                        </label>
                                    </div>
                                    <div class="col-sm-2 col-sm-pull-1">
                                        {!! Form::text('customers_rg_ie', $customers->customers_rg_ie, array('id' =>'rg_ie', 'class' => 'form-control no-radius', 'placeholder' => 'informe seu RG/IE')) !!}
                                    </div>
                                </div>

                            </div>
                            <div class="box-footer">
                                {!! Form::submit('Atualizar dados!', array('class' => 'btn btn-lg bg-dark fg-white no-radius pull-right')) !!}

                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
