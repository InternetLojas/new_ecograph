<div class="destaque_home">
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
                </ul>
                @include('layouts.includes.boxes.forms.form_pedido')
            </div>
        </div>
        <div class="col-md-5">

        </div>
        <h1 class="heading1">
        <span class="maintext">
            <i class="icon-thumbs-up"></i>
            Pedido nr de referência <span id="neworder_Id"></span> criado.
        </span>
        </h1>
    </div>
</div>