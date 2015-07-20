<div class="section" id="processamento_info">
    <div class="title_content">
        <h1>
            Processando seu pedido
        </h1>
    </div>
    <div class="row">
        <div class="col-md-7">
            <div id="processando">
                <div id="mensagem_formpedido"></div>
                <div id="info_formpedido"></div>
                <ul class="styled rounded fg-dark">
                    <li id="fase1_formpedido" style="display:none">
                        Gerando seu pedido e recebendo os parâmetros necessários.
                    </li>
                    <li id="fase2_formpedido" style="display:none">
                        Preparando a forma de pagamento: <strong>{!!$gateway!!}</strong>.
                    </li>
                    <li id="fase3_formpedido" style="display:none">
                        Acessando o sistema de pagamento: <strong>{!!$gateway!!}</strong>, <br>
                        enviando os dados, e aguardando autorização para prosseguir.
                    </li>
                </ul>
                @include('layouts.includes.boxes.forms.form_pedido')
            </div>
        </div>
        <div class="col-md-5">
            {!! HTML::image('images/banners/box-acesso-gateway.jpg', $alt='box-acesso-gateway.jpg', array('width'=>'100%','title'=>'Acessando área segura.')) !!}
        </div>
    </div>
</div>
<!--se a varialvel submeter for true será necessário submeter o formulário, caso contrário não-->
<div class="section" id="processamento_finalizado" style="display:none">
    <h1 class="heading1">
        <span class="maintext">
            <i class="icon-thumbs-up"></i>
            Pedido nr de referência <span id="neworder_Id"></span> criado.
        </span>
    </h1>
    <div class="row">
        <div class="panel panel-danger text-left">
            <div class="panel-heading">
                <h3 class="panel-title font24">
                    <i class="icon-ok"></i>&nbsp;Sucesso.
                </h3>
            </div>
            <div class="panel-body">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    {!! HTML::image('images/banners/box-valeu.jpg', $alt='box-valeu.jpg', array('width'=>'100%','title'=>'Pedido gerado com sucesso.')) !!}
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <!--se acessar gateway externo-->
                        <h4>Leia as informações abaixo:</h4>
                        <p>O seu pedido foi gerado com sucesso.</p>
                        <p>Você pode ver o histórico de pedidos clicando na página </p>
                        <p>Seu(s) produto(s) chegará(ão) num prazo de 10 a 40 dias úteis conforme o forma de envio escolhida.</p>
                        <p>Assim que confirmarmos o seu pagamento iniciaremos o processo de envio.</p>
                        <p>Esperamos que suas necessidades tenham sido atendidas.</p>
                        <p>Redirecionando em 10s. Aguarde!</p>
                </div>
            </div>
        </div>
        <div id="mensagem_formcheckout"></div>
        <div id="info_formcheckout"></div>
        @include('layouts.includes.boxes.forms.form_checkout')
    </div>
</div>