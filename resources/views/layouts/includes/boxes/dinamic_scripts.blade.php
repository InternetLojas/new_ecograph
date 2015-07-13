
<script>
    $(function() {
        'use strict';
        $(document).ready(function() {
            $('.flash_message').delay(2000).fadeOut(400);
            $('.alert').delay(3000).fadeOut(400);
//<![CDATA[

            //Inicio Mascara Telefone
            jQuery('input[type=tel]').mask("(99) 9999-9999?9").ready(function(event) {
                var target, phone, element;
                target = (event.currentTarget) ? event.currentTarget : event.srcElement;
                phone = target.value.replace(/\D/g, '');
                element = $(target);
                element.unmask();
                if (phone.length > 10) {
                    element.mask("(99) 99999-999?9");
                } else {
                    element.mask("(99) 9999-9999?9");
                }
            });
            $("#telephone").mask("(99) 9999-9999");
            $("#telephone1").mask("(99) 9999-9999");
            //Fim Mascara Telefone
            //Inicio Mascara CEP
            $("#orc_cep").mask("99999-999");
            $("#cep").mask("99999-999");
            $("#postcode").mask("99999-999");
            $("#zipcode").mask("99999-999");
            //Fim Mascara CEP
            //Inicio Mascara CPF
            $("#cpf").mask("999.999.999-99");
            //Fim Mascara CPF
            //Inicio Mascara CNPJ
            $("#cnpj").mask("99.999.999/9999-99");
            //Fim Mascara CNPJ
            //Inicio Mascara RG
            $("#rg").mask("99.999.999-*");
            //Fim Mascara CPF
            (jQuery);
//]]>
            //*uploads*//
            $("#logo1").change(function() {
                $(this).prev().html($(this).val());
            });
            $("#logo2").change(function() {
                $(this).prev().html($(this).val());
            });
            $("#logo3").change(function() {
                $(this).prev().html($(this).val());
            });
            $("#img1").change(function() {
                $(this).prev().html($(this).val());
            });
            $("#img2").change(function() {
                $(this).prev().html($(this).val());
            });
            $("#img3").change(function() {
                $(this).prev().html($(this).val());
            });
            //****fim do upolads***//
            $('#btn_orcar').click(function()
            {
                Encerrar('orcar');
            });
            $('#btn_portfolio').click(function() {

                @if(Auth::check())
                var logado = true;
                        @else
                        var logado = false
                @endif
                Encerrar('comprar', logado);
            });
            $('#btn_comprar').click(function()
            {
                @if(Auth::check())
                var logado = true;
                        @else
                        var logado = false
                @endif
                Encerrar('comprar', logado);
            });
            //através da modal o cliente escolhe o tipo de conta e cep para criar o cadastro
            var $btn_tipoconta = $('#btn_tipoconta');
            $btn_tipoconta.on('click', function() {
                EnderecoCEP();
            });
            @if($page === 'editor')
            /*através da modal o cliente escolhe o tipo de conta e cep para criar o cadastro*/
            var $btn_editor = $('#btn_editor');
            $btn_editor.on('click', function() {
                ValidarFormEdicao();
            });
            @endif
            @if($page === 'carrinho')
            var $btn_resumo = $('#btn_resumo');
            $btn_resumo.on('click', function() {
                var url = $('#formresumo').attr('action');
                ValidaCaixa('formresumo', url);
            });
            @endif
            @if($page === 'detalhes')
            @if(isset($solicitado))
            Calculadora('{!! $solicitado['filho'] !!}', '{!! Fichas::nomeCategoria($solicitado['filho']) !!}');
                    @endif
                    var $btn_imprimir = $('#btn_imprimir');
            $btn_imprimir.on('click', function() {
                GerarOrcamento();
            });
            @endif

            @if($page === 'home')
            $('#carousel-ecograph').carousel();
            @endif

            @if($page === 'carrinho')
//postagem do carrinho para a floha resumo
            var $btn_carrinho = $('#btn_carrinho');
            $btn_carrinho.on('click', function() {
                var url = $('#resumo').attr('action');
                ValidaCarrinho('resumo', url);
            });
                    @endif

                    var $btn_contato = $('#btn_contato');
            $btn_contato.on('click', function() {
                var url = $('#contato').attr('action');
                EmailEnviar('contato', url);
            });
            @if($page === 'novaconta')
            //controle das mascaras para os telefones
            $('#nr_big').css('display', 'block');
            $('#nr_small').css('display', 'none');
            $('#algarismo_9').click(function() {
                $("#telephone").mask("");
                $("#telephone1").mask("");
                $("#whatsap").mask("");
                $("#cel").mask("");
                if ($(this).is(':checked')) {
                    $('.aviso').css('display', 'block');
                    $('#nr_big').css('display', 'none');
                    $('#nr_small').css('display', 'block');
                    $('#algarismo').attr('checked', false);
                    $('#telephone').val();
                    $('#telephone1').val();
                    $('#whatsap').val();
                    $('#cel').val();
                    $("#telephone").mask("(99) 9 9999-9999");
                    $("#telephone1").mask("(99) 9 9999-9999");
                    $("#whatsap").mask("(99) 9 99999-9999");
                    $("#cel").mask("(99) 9 99999-9999");
                }
            });
            $('#algarismo').click(function() {
                $("#telephone").mask("");
                $("#telephone1").mask("");
                $("#whatsap").mask("");
                $("#cel").mask("");
                if ($(this).is(':checked')) {
                    $('.aviso').css('display', 'none');
                    $('#nr_big').css('display', 'block');
                    $('#nr_small').css('display', 'none');
                    $('#algarismo_9').attr('checked', false);
                    $('#telephone').val();
                    $('#telephone1').val();
                    $('#whatsap').val();
                    $('#cel').val();
                    $("#telephone").mask("(99) 9999-9999");
                    $("#telephone1").mask("(99) 9999-9999");
                    $("#whatsap").mask("(99) 99999-9999");
                    $("#cel").mask("(99) 99999-9999");
                }
            });
//postagem do formulário de cadastro
            var $btn_cadastro = $('#btn_cadastro');
            $btn_cadastro.on('click', function() {
                var whoo = 'cadastro';
                if (!$('#agree').is(':checked')) {
                    $('#concorde').css('display', 'block');
                    $('#mensagem_' + whoo).html('');
                    $('#info_' + whoo).html('');

                    $('#info_' + whoo).removeClass('alert');
                    $('#info' + whoo).removeClass('alert');
                    $('#mensagem_' + whoo).removeClass('alert');
                    //$('#mensagem_' + whoo).addClass('errormsg alert');
                    //$('#mensagem_' + whoo).html('ERRO!');
                    //$('#mensagem_' + whoo).fadeOut(800, function() {
                    $('#info_' + whoo).addClass('alert');
                    $('#info_' + whoo).html('<p class="alert-warning">Por favor! É necessário que você concorde com as regras de uso.</p>');
                    //});
                    $('#info_' + whoo).fadeIn('fast');
                    //overlay('off', whoo);
                    //mostra os erros contidos no formulário de cadastro
                    //$("#modal-erros").modal('show');
                    return false;
                }
                CheckCadastro();
            });
            @endif
});


    })(window.jQuery);
</script>