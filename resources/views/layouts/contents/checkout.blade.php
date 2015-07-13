<div class="destaque_home">
    <div class="title_content">
        <h1>
            Processando -
            <small>pedido</small>
        </h1>
    </div>
    <div class="row">
        <div class="col-md-7">
            <div class="panel ">
                <div class="panel-heading bg-dark fg-white no-radius">
                    <h3 class="panel-title">
                        Executando procedimentos. Aguarde!
                         <span id="fase_formpedido">
                            {!! HTML::image('images/img/preloading.gif', $alt='preloading.gif', array('width'=> '100','class'=>'img-responsive','title'=>'Acessando área segura.')) !!}
                            </span>
                    </h3>
                </div>
                <div class="panel-body bg-smallgray">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Epa!!</strong>Existem problemas no seu formulário.
                            <br>
                            <br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>
                                        {{ $error }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div id="processando">
                        <h3>
                            Nesse momento seu pedido está sendo processado.

                        </h3>
                        <ol class="styled rounded fg-dark">
                            <li id="fase0_formpedido" style="display:none">
                                Estamos redirecionando para o sistema de pagamento {!!$gateway!!}.
                            </li>
                            <li id="fase1_formpedido" style="display:none">
                                Gerando seu pedido e recebendo os parâmetros necessários.<br>
                                para calcular o total a ser cobrado (Valor do seu carrinho, fretes, descontos ou acréscimos,etc);
                            </li>
                            <li id="fase2_formpedido" style="display:none">
                                Preparando a forma de pagamento: <strong>{!!$gateway!!}</strong><br>
                                e o ambiente específico para acessar o sistema;
                            </li>
                            <li id="fase3_formpedido" style="display:none">
                                Acessando o sistema de pagamento: <strong>{!!$gateway!!}</strong>, <br>
                                enviando os dados, e aguardando autorização para prosseguir.
                            </li>
                        </ol>
                    </div>
                    <div id="mensagem_formpedido"></div>
                    <div id="info_formpedido"></div>
                    @include('layouts.includes.boxes.forms.form_pedido')
                    @include('layouts.includes.boxes.forms.form_checkout')
                </div>
            </div>
        </div>
        <div class="col-md-5">
            {!! HTML::image('images/banners/box-acesso-gateway.jpg', $alt='box-acesso-gateway.jpg', array('width'=>'100%','title'=>'Acessando área segura.')) !!}
        </div>
    </div>
    <span id="#neworder_id"></span>
</div>
<!--se a varialvel submeter for true será necessário submeter o formulário, caso contrário não-->
<div class="section" id="processamento_finalizado" style="display:none">
    <h1 class="heading1">
        <span class="maintext">
            <i class="icon-thumbs-up"></i>
            Pedido nr de referência <span id="neworder_Id"></span> criado.
        </span>
    </h1>
    <div class="container">
        <div class="row">
            <div class="panel panel-danger text-left">
                <div class="panel-heading">
                    <h4 class="panel-title font24">
                        <i class="icon-ok"></i>&nbsp;Leia as informações abaixo.
                    </h4>
                </div>
                <div class="panel-body">
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        {{ HTML::image('images/banners/box-valeu.jpg', $alt='box-valeu.jpg', array('width'=>'100%','title'=>'Pedido gerado com sucesso.')) }}
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <div id="fase4_formfinalizacao" style="display:none">
                            <!--se acessar gateway externo-->
                            <h3>Sucesso!</h3>
                            <p>O seu pedido foi gerado com sucesso.</p>
                            <p>Você pode ver o histórico de pedidos clicando na página </p>
                            <p>Seu(s) produto(s) chegará(ão) num prazo de 10 a 40 dias úteis conforme o forma de envio escolhida.</p>
                            <p>Assim que confirmarmos o seu pagamento iniciaremos o processo de envio.</p>
                            <p>Esperamos que suas necessidades tenham sido atendidas.</p>
                            @if($submeter)
                                <p>
                                    Se tudo ocorrer bem você automaticamente será redirecinado para <strong>{{$gateway}}</strong>.
                                </p>
                                <p>
                                    Siga as instruções da próxima tela.
                                </p>
                                <p class="text-right">Equipe {{STORE_NAME}}</p>

                                <!--formulário quepermite acessar o gateway externo-->
                                {{ Form::open(
                                    array(
                                     'id' => 'formfinalizacao',
                                    'name' => 'formfinalizacao'))}}
                                <div id="input_formfinalizacao"></div>
                                {{Form::close()}}
                                <div id="mensagem_formfinalizacao"></div>
                                <div id="info_formfinalizacao"></div>
                                <div id="enviando_formfinalizacao" class="pull-right" style="display:none" >
                                    Aguarde...!
                                    {{ HTML::image('img/preloading.gif', $title='Aguarde...', array('style'=>'width:100%; max-width:128px')) }}
                                </div>
                                @endif
                                        <!--se não acessar gateway externo-->
                                @if(!$submeter)
                                    <!--os resultados são mostrados aqui-->
                                    <div class="panel panel-danger text-left">
                                        <div class="panel-heading text-center ">
                                            <h4 class="panel-title font18">
                                                <i class="icon-arrow-down"></i> Pagar usando <strong>{{$gateway}}</strong>
                                            </h4>
                                        </div>
                                        @if($class_payment == 'DepositoBancario')
                                            <div class="panel-body">
                                                @if (Session::has('parametros'))
                                                    <?php $parametros = Session::get('parametros'); ?>
                                                    <p>
                                                        {{$parametros['instrucao']}}<br
                                                                Titular: {{$parametros['titular']}}<br>
                                                        Banco:{{$parametros['banco']}}<br>
                                                        Agência: {{$parametros['agencia']}}<br>
                                                        Conta Corrente: {{$parametros['conta']}}<br>
                                                        CPF: {{$parametros['cpf']}}
                                                    </p>
                                                @endif
                                            </div>
                                        @endif
                                        @if($class_payment == 'Boleto')
                                            <div class="panel-body">
                                                <p>Clique no botão "Ver o boleto" para acessar o seu boleto.</p>
                                                <p>Aguarde o boleto aparecer na nova janela.<br>
                                                    Verifique se sua impressora está ligada e pronta para impressão.
                                                </p>
                                                <p>
                                                    Para iniciar a impressão clique no botão "Imprimir Boleto".
                                                </p>
                                                <p>Após o pagamento do boleto envie o comprovante para o nosso e-mail - {{STORE_OWNER_EMAIL_ADDRESS}} - <br />
                                                <p>
                                                    <strong>Dica:</strong> Não tem scaner para enviar o recibo? Use uma camera fotográfica e envie os dados por escrito.
                                                </p>
                                                <p class="text-right">Equipe {{STORE_NAME}}</p>
                                                <button type="button" data-original-title="Clique aqui para ver o seu boleto" title="Clique aqui para ver o seu boleto" class="btn btn-orange pull-right tooltip-test" id="btn_boleto">
                                                    <i class="icon icon-arrow-left icon-white"></i> Ver o boleto
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                @endif
                        </div>
                    </div>

                    <!--se não acessar gateway externo-->
                    @if(!$submeter)
                        <a href="{{URL::to('/inicio')}}" data-original-title="Voltar para o início" title="Acrescentar mais produtos no carrinho" class="btn btn-orange pull-right" style="margin-right:5px">
                            <i class="icon-arrow-left icon-white"></i> Início
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>