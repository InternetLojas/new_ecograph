<div class="row ">
    <div class="span7 fg-white border">
        <div class="panel">
            <div class="panel-header bg-dark padding20">
                <h1 class="fg-white padding5"> CHECKOUT</h1>
            </div>
            <div class="panel-content text-left bg-gray">
                <h3>Nesse momento seu pedido está sendo processado.</h3>
                <ol class="styled rounded fg-white">
                    <li>
                        Estamos redirecionando para o sistema de pagamento {!!$gateway!!}.                        
                    </li>
                    <li id="fase1_formcheckout" style="display:none">
                        Gerando seu pedido e recebendo os parâmetros necessários.<br>
                        para calcular o total a ser cobrado (Valor do seu carrinho, fretes, descontos ou acréscimos,etc);
                    </li>
                    <li id="fase1_formcheckout" style="display:none">
                        Preparando a forma de pagamento: <strong>{!!$gateway!!}</strong><br>
                        e o ambiente específico para acessar o sistema;
                    </li>
                    <li id="fase3_formcheckout" style="display:none">
                        Acessando o sistema de pagamento: <strong>{!!$gateway!!}</strong>, <br>
                        enviando os dados, e aguardando autorização para prosseguir.
                    </li>                    
                </ol> 
                <div id="mensagem_formcheckout"></div>
                <div id="info_formcheckout"></div>
                @include('layouts.includes.boxes.forms.form_pedido')
                @include('layouts.includes.boxes.forms.form_checkout')
            </div>
        </div>
    </div>
    <div class="span5">
        {!! HTML::image('images/banners/box-acessando.jpg', $alt='box-acessando.jpg', array('width'=>'100%','title'=>'Acessando área segura.')) !!}
    </div>
</div>