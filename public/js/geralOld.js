/*
 ******************************************************
 *********utilizado para realizar a busca rápida*******
 ******************************************************
 */
function openAjax()
{
    var Ajax;
    try {
        Ajax = new XMLHttpRequest(); // XMLHttpRequest para browsers mais populares, como: Firefox, Safari, dentre outros.
    } catch (ee) {
        try {
            Ajax = new ActiveXObject("Msxml2.XMLHTTP"); // Para o IE da MS
        } catch (e) {
            try {
                Ajax = new ActiveXObject("Microsoft.XMLHTTP"); // Para o IE da MS
            } catch (e) {
                Ajax = false;
            }
        }
    }
    return Ajax;
}

function carregaAjax(div, getURL) {
//document.getElementById(div).style.display = "block";
    $('#' + div).css('display', 'block');
    if (document.search.keyword.value.length >= 3) {
        $('#home-slider').css('display', 'none');
        $('#container-busca').css('display', 'block');
        if (document.getElementById) { // Para os browsers complacentes com o DOM W3C.
            var exibeResultado = document.getElementById(div); // div que exibirá o resultado.
            var Ajax = openAjax(); // Inicia o Ajax.
            Ajax.open("GET", getURL, true); // fazendo a requisição
            Ajax.onreadystatechange = function() {
                if (Ajax.readyState == 1) { // Quando estiver carregando, exibe: carregando...
                    exibeResultado.innerHTML = "<div>Pesquisando...</div>";
                }
                if (Ajax.readyState == 4) { // Quando estiver tudo pronto.
                    if (Ajax.status == 200) {
                        var resultado = Ajax.responseText; // Coloca o retornado pelo Ajax nessa variável
                        resultado = resultado.replace(/\+/g, ""); // Resolve o problema dos acentos
                        resultado = resultado.replace(/ã/g, "a");
                        resultado = unescape(resultado); // Resolve o problema dos acentos
                        exibeResultado.innerHTML = resultado;
                    } else {
                        exibeResultado.innerHTML = "Nada encontrado...!";
                    }
                }
            }
            Ajax.send(null); // submete
        }
    } else {
        $('#home-slider').css('display', 'block');
        $('#container-busca').css('display', 'none');
    }
}
/*
 ******************************************************
 ****** fim do script para realizar a busca rápida*****
 ******************************************************
 */

/*
 function CampoFormat(Campo, e, quale) {
 
 var key = '';
 var len = 0;
 var strCheck = '0123456789';
 var aux = '';
 var whichCode = (window.Event) ? e.which : e.keyCode;
 var max_len = '';
 if (whichCode === 13 || whichCode === 8 || whichCode === 0)
 {
 return true; // Enter backspace ou FN qualquer um que nÃ£o seja alfa numerico
 }
 
 key = String.fromCharCode(whichCode);
 if (strCheck.indexOf(key) === -1) {
 return false; //NÃ?O E VALIDO
 }
 
 
 if (quale === 'cep' || quale === 'zipcode' || quale === 'postcode') {
 //alert(Campo.value);
 //cep; '00.000-000'
 max_len = 11;
 aux = Remove_Format(Campo.value, max_len);
 len = aux.length;
 if (len >= max_len)
 {
 return false; //impede de digitar um CEP maior que 10
 }
 aux += key;
 Campo.value = Mont_Format(aux, quale, max_len);
 return false;
 }
 
 if (quale == 'dt_nasc') {
 // dt_nasc; 00/00/0000
 max_len = 11;
 aux = Remove_Format(Campo.value, max_len);
 len = aux.length;
 if (len >= max_len)
 {
 return false; //impede de digitar um telefone maior que 10
 }
 aux += key;
 Campo.value = Mont_Format(aux, quale, max_len);
 return false;
 }
 
 if (quale == 'cpf') {
 //CPF; 000.000.000-00
 max_len = 14;
 aux = Remove_Format(Campo.value, max_len);
 len = aux.length;
 if (len >= max_len)
 {
 return false; //impede de digitar um telefone maior que 10
 }
 aux += key;
 // alert(Campo.value);
 Campo.value = Mont_Format(aux, quale, max_len);
 return false;
 }
 if (quale == 'cnpj') {
 //CNPJ; 00.000.000/0000-00
 max_len = 18;
 aux = Remove_Format(Campo.value, max_len);
 len = aux.length;
 if (len >= max_len)
 {
 return false; //impede de digitar um telefone maior que 10
 }
 aux += key;
 Campo.value = Mont_Format(aux, quale, max_len);
 return false;
 }
 if (quale == 'rg') {
 //RG; 00.000.000-0
 max_len = 13;
 aux = Remove_Format(Campo.value, max_len);
 len = aux.length;
 if (len >= max_len)
 {
 return false; //impede de digitar um telefone maior que 10
 }
 aux += key;
 Campo.value = Mont_Format(aux, quale, max_len);
 return false;
 }
 //campos ddd e telefones
 if (quale == 'ddd' || quale == 'ddd1' || quale == 'ddd2') {
 //ddd; (xx)
 max_len = 5;
 aux = Remove_Format(Campo.value, max_len);
 len = aux.length;
 if (len >= max_len)
 {
 return false; //impede de digitar um telefone maior que 10
 }
 aux += key;
 Campo.value = Mont_Format(aux, quale, max_len);
 return false;
 }
 if (quale == 'telephone' || quale == 'telephone1') {
 max_len = 11;
 aux = Remove_Format(Campo.value, max_len);
 len = aux.length;
 if (len >= max_len)
 {
 return false; //impede de digitar um telefone maior que 10
 }
 aux += key;
 Campo.value = Mont_Format(aux, quale, max_len);
 return false;
 }
 if (quale === 'cel') {
 var estadosp = document.getElementById('state').value;
 if (estadosp == "SP")
 max_len = 12;
 else
 max_len = 11;
 aux = Remove_Format(Campo.value, max_len);
 len = aux.length;
 if (len >= max_len)
 {
 return false; //impede de digitar um telefone maior que 10
 }
 aux += key;
 Campo.value = Mont_Format(aux, quale, max_len);
 return false;
 }
 
 }
 function Mont_Format(STR, cod, max)
 {
 if (cod === 'cnpj') {
 max = max - 1;
 }
 
 var aux = len = '';
 aux = '';
 for (i = 0; i < max; i++)
 {
 aux += STR.charAt(i - 3);
 if (cod === 'dt_nasc') {
 if (i === 4)
 {
 aux += '/';
 }
 if (i === 6)
 {
 aux += '/';
 }
 
 }
 
 if (cod === 'cpf') {
 if (i === 5)
 {
 aux += '.';
 }
 if (i == 8)
 {
 aux += '.';
 }
 
 if (i == 11)
 {
 aux += '-';
 }
 }
 
 if (cod === 'cnpj') {
 if (i === 4)
 {
 aux += '.';
 }
 if (i === 7)
 {
 aux += '.';
 }
 
 if (i === 10)
 {
 aux += '/';
 }
 if (i == 14)
 {
 aux += '-';
 }
 
 }
 
 if (cod === 'rg') {
 if (i == 4)
 {
 aux += '.';
 }
 if (i == 7)
 {
 aux += '.';
 }
 
 if (i == 10)
 {
 aux += '-';
 }
 
 }
 
 if (cod === 'postcode' || cod === 'cep' || cod === 'zipcode') {
 if (i === 4)
 {
 aux += '.';
 }
 if (i === 7)
 {
 aux += '-';
 }
 //alert(aux);
 }
 //campos ddd e telefones
 if (cod == 'ddd' || cod == 'ddd1' || cod == 'ddd2') {
 if (i == 1)
 {
 aux += '(';
 }
 if (i == 4) {
 aux += ')';
 }
 }
 if (cod == 'telephone' || cod == 'telephone1') {
 if (i == 6)
 {
 aux += '-';
 }
 
 }
 var estadosp = document.getElementById('state').value;
 if (estadosp == "SP")
 imax = 7;
 else
 imax = 6;
 if (cod == 'cel') {
 if (i == imax)
 {
 aux += '-';
 }
 
 }
 //fim campo ddd e telefones
 
 }
 return aux;
 }
 
 function Remove_Format(STR, maximo)
 {
 var strCheck = '0123456789';
 var i = aux = '';
 len = STR.length;
 for (i = 0; i < maximo; i++)
 {
 if (strCheck.indexOf(STR.charAt(i)) != -1)
 {
 aux += STR.charAt(i);
 }
 }
 //alert(aux);
 return aux;
 }
 */

/*
 ******************************************************
 ************script para mostrar os modais*************
 ******************************************************
 */
function modalconta()
{
    $(document).ready(function()
    {
        $("#ModalConta").modal('show');
    });
}

function modallembrar(id, product)
{
    $(document).ready(function()
    {
        alert('Iremos agendar para você um lembrete para o produto \n' + product);
        document.getElementById("lembrar-product").innerHTML = product;
        $('#product_id').val(id);
        $("#ModalLembrar").modal('show');
    });
}

function modalconsulte(id, product)
{
    $(document).ready(function()
    {
        alert('Iremos providenciar informações adicionais referente ao produto\n' + product);
        document.getElementById("consultar-product").innerHTML = product;
        $('#product_consulte').val(id);
        $("#ModalConsulte").modal('show');
    });
}

function modalconvite()
{
    $(document).ready(function()
    {
        $("#ModalConvite").modal('show');
    });
}

function modalcomentario()
{
    $(document).ready(function()
    {
        $("#ModalComentario").modal('show');
    });
}

function modalfabricantes()
{
    $(document).ready(function()
    {
        $("#ModalFabricantes").modal('show');
    });
}
/*
 ******************************************************
 ******** fim de script para mostrar os modais*********
 ******************************************************
 */
/*
 *buscar endereço do cep se existe*
 */
function EnderecoCEP() {

    var whoo = "formtipoconta";
    overlay('on', whoo);
    $('#mensagem_' + whoo).html('');
    $('#info_' + whoo).html('');

    if ($.trim($("#postcode").val()) !== "")
    {
        CEP = $.trim($("#postcode").val());
        $('#mensagem_' + whoo).removeClass('errormsg alert');
        $('#info_' + whoo).removeClass('infomsg alert');
        overlay('on', whoo);

        $.getScript("http://cep.republicavirtual.com.br/web_cep.php?formato=javascript&cep=" + CEP.replace("-", ""), function()
        {
            if (resultadoCEP["resultado"] == '1')
            {
                $("#street").val(unescape(resultadoCEP["tipo_logradouro"]) + " " + unescape(resultadoCEP["logradouro"]));
                $("#suburb").val(unescape(resultadoCEP["bairro"]));
                $("#city").val(unescape(resultadoCEP["cidade"]));
                $("#state").val(unescape(resultadoCEP["uf"]));
                var url = $('#' + whoo).attr('action');
                ValidaTipoConta(whoo, url);
            } else {
                alert("Endereço não encontrado para o cep informado " + CEP);
                ValidaTipoConta(whoo, url);
            }
            //$("#ajax-loading").hide();
        });
    } else {

        $('#mensagem_' + whoo).addClass('errormsg alert');
        $('#mensagem_' + whoo).html('ERRO!');
        $('#mensagem_' + whoo).delay(2000).fadeOut(500);
        $('#info_' + whoo).addClass('infomsg alert');
        $('#info_' + whoo).html('Por favor! Informe um endereço postal pertinente.');
        $('#' + whoo).css({
            opacity: 1
        });
        overlay('off', whoo);
        $("#postcode").focus();

    }
}


/*
 ******************************************************
 *********utilizado para encontrar valor de frete******
 ******************************************************
 */
function findCEP()
{
    var CEP = "";
    //var optionList = GET_OBJECT_LIST(); //get an array of Object, object has id & name
    if ($.trim($("#cep").val()) != "")
    {
        CEP = $.trim($("#cep").val());
        //var resultadoCEP = "";
        $("#ajax-loading").css('display', 'block');
        $("#lupa").css('display', 'none');
        $.getScript("http://cep.republicavirtual.com.br/web_cep.php?formato=javascript&cep=" + CEP.replace("-", ""), function()
        {
            if (resultadoCEP["resultado"] == '1')
            {
                $("#street").val(unescape(resultadoCEP["tipo_logradouro"]) + " " + unescape(resultadoCEP["logradouro"]));
                $("#suburb").val(unescape(resultadoCEP["bairro"]));
                $("#city").val(unescape(resultadoCEP["cidade"]));
                $("#state").val(unescape(resultadoCEP["uf"]));
                $("#nr").focus();
                $("#estado").val(unescape(resultadoCEP["uf"]));
            } else {
                alert("Endereço não encontrado para o cep informado " + CEP);
            }
            $("#ajax-loading").hide();
        });
    } else {
        alert('Informe o CEP para a pesquisa');
    }
}

function Endereco() {
    $("#end").css('display', 'none');
    $("#end_alt").css('display', 'inline');
}
function CorreioCEP(peso)
{
    document.getElementById("vl_pac").innerHTML = "";
    document.getElementById("vl_sedex").innerHTML = "";
    document.getElementById("prazo_pac").innerHTML = "";
    document.getElementById("prazo_sedex").innerHTML = "";
    if ($.trim($("#zipcode").val()) !== "")
    {
        $("#ajax-loading").css('display', 'inline');
        $.ajax(
                {
                    type: "GET",
                    url: 'frete',
                    dataType: "json",
                    data: "parans=" + peso,
                    success: function()
                    {
                        $("#ajax-loading").css('display', 'none');
                    },
                    error: function()
                    {
                        $("#ajax-loading").css('display', 'none');
                        $("#ajax-resultado").css('display', 'inline-block');
                        $("#erro").append("<img src=\"images/icons/access_denied_24.png\" style=\"float:left\" /><b>Erro no pedido ao servidor.</b>");
                    },
                });
    }
}

function GeraFretes(whoo, URL)
{
    var zipcode = $('#zipcode').val();
    overlay('on', whoo);
    $('#mensagem_' + whoo).html('');
    $('#info_' + whoo).html('');
    if (zipcode === '') {
        $('#mensagem_' + whoo).addClass('errormsg alert');
        $('#mensagem_' + whoo).html('ERRO!');
        $('#mensagem_' + whoo).delay(2000).fadeOut(500);
        $('#info_' + whoo).addClass('infomsg alert');
        $('#info_' + whoo).html('Por favor! Informe um endereço postal pertinente.');
        $('#' + whoo).css({
            opacity: 1
        });
        overlay('off', whoo);
        zipcode.focus();
    } else {
        $('#' + whoo).css({
            opacity: 0.2
        });
        $('#mensagem_' + whoo).html('');
        $('#info_' + whoo).html('');
        $('#mensagem_' + whoo).removeClass('errormsg alert');
        $('#info_' + whoo).removeClass('infomsg alert');
        overlay('on', whoo);

        var formulario = $('#' + whoo).serializeArray();
        //console.log(formulario);
        $.post(URL, formulario, function(data) {
            $('#enviando_' + whoo).delay(2000).fadeOut(500);
            var obj = JSON.parse(data);
            //console.log(data);
            if (obj.status === 'fail') {
                $('#mensagem_' + whoo).html('');
                $('#info_' + whoo).html('');
                $('#mensagem_' + whoo).addClass('errormsg alert');
                $('#mensagem_' + whoo).html('ERRO!');
                $('#mensagem_' + whoo).delay(2000).fadeOut(500);
                $('#info_' + whoo).addClass('infomsg alert');
                var li = '';
                obj.erro.forEach(function(entry) {
                    li += '<li>' + entry + '</li>';
                });
                $('#info_' + whoo).html('<ul>' + li + '</ul>');
                $('#' + whoo).css({
                    opacity: 1
                });
                overlay('off', whoo);
            } else {
                overlay('off', whoo);
                $('#' + whoo).css({
                    opacity: 1
                });
                $('#mensagem_' + whoo).removeClass('errormsg alert');
                $('#mensagem_' + whoo).addClass('successmsg alert');
                $('#mensagem_' + whoo).html('SUCESSO! Escolha um frete abaixo.');
                $('#info_' + whoo).addClass('infomsg alert');
                $('#info_' + whoo).html(obj.info);
                $('#extra_' + whoo).html(obj.extra);
                $('#valores_' + whoo).html(obj.table);
                $('#mensagem_' + whoo).delay(2000).fadeOut(800);
            }
        });
    }
}

function atualizarfrete(valor, servico, user)
{
    //valor do carrinho de compras
    var preco = $("#vlDeclarado").val();
    var carrinho = +preco;
    //identificar o valor do frete escolhido (38,35)
    var frete = +valor.replace(",", ".");
    //seta o valor do frete escolhido reais
    $('#escolha_frete').html('R$ ' + valor);
    //valor do desconto concedido
    var vl_discount_avista = $("#vl_discount_avista").val();
    //calculo
    var subtotal = parseFloat(frete + carrinho);
    var totalgeral = parseFloat(frete + carrinho - vl_discount_avista);
    var str_subtotal = subtotal.toFixed(2);
    $('#cartotal').html('R$ ' + str_subtotal);
    var str_totalgeral = totalgeral.toFixed(2);
    $('#totalgeral').html('R$ ' + str_totalgeral);
    //atualiza o form
    $('#vl_frete_escolhido').val(valor);
    $('#tipo_frete').val(servico);

    if (user === '1') {
        document.getElementById("formas_pagamento").style.display = "block";
    } else {
        document.getElementById("login_carrinho").style.display = "block";
    }
}
/*
 ******************************************************
 ***************fim de script para frete***************
 ******************************************************
 */

/*
 *******************************************************
 ***   script para controle da página de carrinho    ***
 *******************************************************
 */
function ValidaCarrinho(whoo, URL)
{
    var vl_frete = $('#vl_frete_escolhido').val();
    var tipo_frete = $('#tipo_frete').val();
    var forma_pagamento = $('#forma_pagamento').val();
    overlay('on', whoo);
    $('#mensagem_' + whoo).html('');
    $('#info_' + whoo).html('');
    var mensagem = '';
    if (vl_frete === '' || tipo_frete === '' || forma_pagamento === '') {
        mensagem += 'Escolha um tipo de pagamento para continuar.\n';
        if (forma_pagamento === '') {
            mensagem += 'Escolha um tipo de frete para continuar.\n';
        }
        $('#mensagem_' + whoo).html('');
        $('#info_' + whoo).html('');
        //overlay('on', whoo);
        $('#mensagem_' + whoo).addClass('errormsg alert');
        $('#mensagem_' + whoo).html('ERRO!');
        $('#mensagem_' + whoo).delay(2000).fadeOut(800, function() {
            $('#enviando_' + whoo).delay(1000).fadeOut(500);
            $('#info_' + whoo).addClass('infomsg alert');
            $('#info_' + whoo).html('Por favor! Para prosseguir é necessário o valor do frete, o tipo de frete e a forma de pagamento.');
            $('#' + whoo).css({
                opacity: 1
            });
        });
        $('#info_' + whoo).delay(2000).fadeOut(800);
        overlay('off', whoo);
        $('info_calc_frete').addClass('errormsg alert');
        $('#info_calc_frete').html(mensagem);
        $('#info_calc_frete').delay(2000).fadeOut(800);
        $('#info_calc_frete').htm('');
    } else {
        overlay('on', whoo);
        $('#enviando_' + whoo).show();
        $('#' + whoo).css({
            opacity: 1
        });
        $('#mensagem_' + whoo).html('');
        $('#info_' + whoo).html('');
        $('#mensagem_' + whoo).removeClass('errormsg alert');
        $('#info_' + whoo).removeClass('infomsg alert');
        $('#mensagem_' + whoo).addClass('successmsg alert');
        $('#info_' + whoo).addClass('infomsg alert');
        $('#mensagem_' + whoo).html('SUCESSO');
        $('#info_' + whoo).html('Redirecionando para resumo do pedido.');
        $('#' + whoo).attr('action', URL);
        $('#mensagem_' + whoo).delay(2000).fadeOut(800, function() {
            $('#' + whoo).submit();
        });
    }
}
/*
 *******************************************************
 ***     script para controle da página de Checkout    ***
 *******************************************************
 */
function Checkout(whoo) {
    var payment = $('#payment').val();
    var vl_discount_avista = $('#vl_discount_avista').val();
    var vl_discount_cupom = $('#vl_discount_cupom').val();
    var discount_avista_id = $('#discount_avista_id').val();
    var total_compra = $('#total_compra').val();
    var vl_frete = $('#vl_frete').val();
    var tipo_frete = $('#tipo_frete').val();
    if (payment === '' || vl_discount_avista === '' || vl_discount_cupom === '' || discount_avista_id === '' || total_compra === '' || vl_frete === '' || tipo_frete === '') {
        $('#mensagem_' + whoo).addClass('errormsg alert');
        $('#mensagem_' + whoo).html('ERRO!');
        $('#mensagem_' + whoo).delay(2000).fadeOut(600, function() {
            $('#info_' + whoo).addClass('infomsg alert');
            $('#info_' + whoo).html('Por favor! Verifique os valores para tipo de pagamento, valor para desconto a vista, valor do frete e o total da compra.');
        });
        return false;
    } else {
        overlay('on', whoo);
        var url = $('#' + whoo).attr('action');
        var formulario = $('#' + whoo).serializeArray();
        $('#fase1_' + whoo).fadeIn(200);
        $.post(url, formulario, function(data) {
            var obj = JSON.parse(data);
            if (obj.status === 'fail') {
                CheckoutFail(obj, whoo);
            } else {
                var url_externa = obj.url_externa;
                var url_interna = obj.url_interna;
                var neworder_id = obj.neworder_id;
                var submeter = obj.submeter;
                $('#neworder_id').html('\'' + neworder_id + '\'');

                $('#mensagem_' + whoo).html('');
                $('#info_' + whoo).html('');
                $('#fase1_' + whoo).delay(4000).fadeOut(400, function() {
                    $('#fase2_' + whoo).show();
                    $('#fase2_' + whoo).delay(4000).fadeOut(400, function() {
                        $('#fase3_' + whoo).show();
                        if (submeter) {
                            //$('#formfinalizacao').attr('action', url_externa);
                            CheckoutSubmeter(obj, whoo, 'formfinalizacao', payment);
                        } else {
                            CheckoutNao_Submeter(obj, whoo, 'formfinalizacao', payment);

                        }
                    });
                });

            }
        });
    }
}
/*
 **  Erros do checkout **
 */
function CheckoutFail(obj, whoo) {
    $('#mensagem_' + whoo).html('');
    $('#info_' + whoo).html('');
    overlay('off', whoo);
    $('#mensagem_' + whoo).addClass('errormsg alert');
    $('#mensagem_' + whoo).html('ERRO!');
    $('#mensagem_' + whoo).delay(2000).fadeOut(600, function() {
        $('#info_' + whoo).addClass('infomsg alert');
        $('#info_' + whoo).html('Por favor! Verifique os erros mostrados a seguir.');
        $('#info_' + whoo).delay(4000).fadeOut(400, function() {
            $('#info_' + whoo).html('');
            var li = '';
            obj.erro.forEach(function(entry) {
                console.log(entry[0]);
                li += '<li class="alert danger"><strong>' + entry[0] + '</strong></li>';
            });
            $('#info_' + whoo).removeClass('infomsg alert');
            $('#info_' + whoo).html('<ul>' + li + '</ul>');
            $('#info_' + whoo).fadeIn(300);
            $('#mensagem_' + whoo).removeClass('errormsg alert');
        });
    });
}
/*
 **  Acessa checkout externo **
 */
function CheckoutSubmeter(obj, whoo, form_externo, payment) {
    var metodo = obj.metodo;
    $('#' + form_externo).serializeArray();
    $('#mensagem_' + form_externo).html('');
    $('#info_' + form_externo).html('');

    if (obj.form) {
        var inputs_hidden = '';
        var form = JSON.parse(obj.form);
        console.log(form);
        $.each(form, function(index, value) {
            inputs_hidden = inputs_hidden + '<input type="hidden" id="' + index + '" name="' + index + '" value="' + value + '" />\n';
        });
        $('#input_' + form_externo).html(inputs_hidden);
        $('#' + form_externo).attr('method', metodo);
        $('#' + form_externo).attr('action', obj.url_externa);
        $('#info_' + form_externo).html('Transferindo para ' + payment + ' em 10s');
    } else {
        console.log(form);
        $('#' + form_externo).attr('method', metodo);
        $('#' + form_externo).attr('action', obj.url_externa);
        overlay('on', '#' + form_externo);
        $('#info_' + form_externo).html('Transferindo para ' + payment + ' em 10s');

    }
    $('#fase3_' + whoo).delay(4000).fadeOut(400, function() {
        overlay('off', whoo);
        $('#processando').slideUp('slow', function() {
            $('#processamento_finalizado').slideDown();
            $('#fase4_formfinalizacao').show();
            $('#neworder_Id').html(obj.neworder_Id);
            $('#enviando_' + form_externo).css('display', 'block');
            setTimeout($('#' + form_externo).submit(), 100 * 1000);
        });
    });
}

function CheckoutNao_Submeter(obj, whoo, form_externo, payment) {
    var metodo = obj.metodo;
    var $btn_boleto = $('#btn_boleto');
    $btn_boleto.on('click', function() {
        window.location = url_interna;
    });
    $('#' + form_externo).serializeArray();
    $('#mensagem_' + form_externo).html('');
    $('#info_' + form_externo).html('');
    $('#fase3_' + whoo).delay(4000).fadeOut(400, function() {
        overlay('off', whoo);
        $('#processando').slideUp('slow', function() {
            $('#processamento_finalizado').slideDown();
            $('#fase4_formfinalizacao').show();
            $('#neworder_Id').html(obj.neworder_Id);
            $('#enviando_' + form_externo).css('display', 'block');
        });
    });
}

/*
 *******************************************************
 * fim de script para controle da página de Checkout ***
 ******************************************************
 */

/*
 *******************************************************
 ***     script para controle da página de resumo    ***
 *******************************************************
 */

function ValidaCaixa(whoo, URL)
{
    if (!$("#agree").is(':checked')) {
        $('#mensagem_' + whoo).addClass('errormsg alert');
        $('#mensagem_' + whoo).html('ERRO!');
        $('#mensagem_' + whoo).delay(2000).fadeOut(800, function() {
            $('#' + whoo).css({
                opacity: 1
            });
        });
        $('#enviando_' + whoo).delay(4000).fadeOut(500);
        $('#info_' + whoo).addClass('infomsg alert');
        $('#info_' + whoo).html('Por favor! É necessário o concorde dos dados apresentados.');
        $('#info_' + whoo).delay(2000).fadeIn(800);
        overlay('off', whoo);
        return false;
    }

    var payment = $('#payment').val();
    var vl_discount_avista = $('#vl_discount_avista').val();
    var vl_discount_cupom = $('#vl_discount_cupom').val();
    var discount_avista_id = $('#discount_avista_id').val();
    var total_compra = $('#total_compra').val();
    var vl_frete = $('#vl_frete').val();
    var tipo_frete = $('#tipo_frete').val();
    overlay('on', whoo);
    $('#mensagem_' + whoo).html('');
    $('#info_' + whoo).html('');
    if (payment === '' || vl_discount_avista === '' || vl_discount_cupom === '' || discount_avista_id === '' || total_compra === '' || vl_frete === '' || tipo_frete === '') {
        $('#mensagem_' + whoo).html('');
        $('#info_' + whoo).html('');
        //overlay('on', whoo);
        $('#mensagem_' + whoo).addClass('errormsg alert');
        $('#mensagem_' + whoo).html('ERRO!');
        $('#mensagem_' + whoo).delay(2000).fadeOut(800, function() {
            $('#enviando_' + whoo).delay(1000).fadeOut(500);
            $('#info_' + whoo).addClass('infomsg alert');
            $('#info_' + whoo).html('Por favor! Verifique os dados informados.');
            $('#' + whoo).css({
                opacity: 1
            });
        });
        $('#info_' + whoo).delay(2000).fadeOut(800);
        overlay('off', whoo);
        //zipcode.focus();
    } else {
        overlay('on', whoo);
        $('#enviando_' + whoo).show();
        $('#' + whoo).css({
            opacity: 0.2
        });
        $('#mensagem_' + whoo).html('');
        $('#info_' + whoo).html('');
        $('#mensagem_' + whoo).removeClass('errormsg alert');
        $('#info_' + whoo).removeClass('infomsg alert');
        var formulario = $('#' + whoo).serializeArray();
        //console.log(formulario);
        $.post(URL, formulario, function(data) {
            $('#enviando_' + whoo).delay(2000).fadeOut(500);
            var obj = JSON.parse(data);
            //console.log(data);
            if (obj.status === 'fail') {
                $('#mensagem_' + whoo).html('');
                $('#info_' + whoo).html('');
                $('#mensagem_' + whoo).addClass('errormsg alert');
                $('#mensagem_' + whoo).html('ERRO!');
                $('#mensagem_' + whoo).delay(2000).fadeOut(500);
                $('#info_' + whoo).addClass('infomsg alert');
                var li = '';
                obj.erro.forEach(function(entry) {
                    li += '<li>' + entry + '</li>';
                });
                $('#info_' + whoo).html('<ul>' + li + '</ul>');
                $('#' + whoo).css({
                    opacity: 1
                });
                overlay('off', whoo);
            } else {
                overlay('off', whoo);
                $('#' + whoo).css({
                    opacity: 1
                });
                $('#mensagem_' + whoo).addClass('successmsg alert');
                $('#info_' + whoo).addClass('infomsg alert');
                $('#mensagem_' + whoo).html('SUCESSO');
                $('#info_' + whoo).html(obj.info);
                $('#' + whoo).attr('action', obj.loadurl);
                $('#mensagem_' + whoo).delay(2000).fadeOut(800, function() {
                    $('#' + whoo).submit();
                });
            }
        });
    }
}
/*
 *******************************************************
 *** fim de script para controle da página de resumo ***
 ******************************************************
 */

function sugestao_verifica()
{
    var strMensagem;
    strMensagem = '';
    if (document.sugestao.testemunho_nome.value.length < 2) {
        if (document.sugestao.testemunho_nome.value.length == 0) {
            strMensagem = strMensagem + '\n Por favor informe no mínimo dois caracteres para o seu nome.';
        } else if (document.sugestao.testemunho_nome.value.length == 1) {
            strMensagem = strMensagem + '\n  Por favor informe no mínimo dois caracteres para o seu nome.';
        }
    }
    if (document.sugestao.testemunho_nome.value.length < 2) {
        if (document.sugestao.testemunho_nome.value.length == 0) {
            strMensagem = strMensagem + '\n Por favor informe no mínimo dois caracteres para o seu nome.';
        } else if (document.sugestao.testemunho_nome.value.length == 1) {
            strMensagem = strMensagem + '\n  Por favor informe no mínimo dois caracteres para o seu nome.';
        }
    }
    if (document.search.keyword.value == "Código ou nome do produto") {
        strMensagem = strMensagem + '\n Para efetivar a busca o campo pesquisa dever ser preenchido com no mínimo dois caracteres.'
    }
    if (strMensagem != '') {
        alert(strMensagem);
        return false;
    }
    return true;
}

function search_verifica()
{
    var strMensagem;
    strMensagem = '';
    if (document.search.keyword.value.length < 2) {
        if (document.search.keyword.value.length == 0) {
            strMensagem = strMensagem + '\n Por favor informe no mínimo dois caracteres.';
        } else if (document.search.keyword.value.length == 1) {
            strMensagem = strMensagem + '\n Por favor informe no mínimo dois caracteres.';
        }
    }
    if (document.search.keyword.value == "Código ou nome do produto") {
        strMensagem = strMensagem + '\n Para efetivar a busca o campo pesquisa dever ser preenchido com no mínimo dois caracteres.'
    }
    if (strMensagem != '') {
        alert(strMensagem);
        return false;
    }
    return true;
}

/*
 ******************************************************
 ***** script para controlar login de usuario *********
 ******************************************************
 */

function AcessoLogin(whoo, URL) {
    var postcode = $('#email_address').val();
    //console.log(postcode);
    if (postcode === '') {
        $('#mensagem_' + whoo).html('');
        $('#info_' + whoo).html('');
        overlay('on', whoo);
        $('#mensagem_' + whoo).addClass('errormsg alert');
        $('#mensagem_' + whoo).html('ERRO!');
        $('#mensagem_' + whoo).fadeOut(800, function() {
            $('#enviando_' + whoo).delay(1000).fadeOut(500);
            $('#info_' + whoo).addClass('infomsg alert');
            $('#info_' + whoo).html('Por favor! Informe um endereço postal pertinente.');
            $('#' + whoo).css({
                opacity: 1
            });
            overlay('off', whoo);
            $('#info_' + whoo).delay(2000).fadeOut(400);
            $('#postcode').focus();
        });
    } else {
        var formulario = $('#' + whoo).serializeArray();
        $('#' + whoo).css({
            opacity: 1
        });
        $('#mensagem_' + whoo).html('');
        $('#info_' + whoo).html('');
        overlay('on', whoo);
        //usando ajax para receber resultados
        $.post(URL, formulario, function(data) {
            $('#enviando_' + whoo).show();
            var obj = JSON.parse(data);
            if (obj.status === 'fail') {
                overlay('off', whoo);
                $('#mensagem_' + whoo).addClass('errormsg alert');
                $('#mensagem_' + whoo).html('ERRO!');
                $('#mensagem_' + whoo).fadeOut(400, function() {
                    $('#enviando_' + whoo).delay(2000).fadeOut(400);
                    $('#info_' + whoo).addClass('infomsg alert');
                    var li = '';
                    obj.erro.forEach(function(entry) {
                        li += '<li>' + entry + '</li>';
                    });
                    $('#info_' + whoo).html('<ul>' + li + '</ul>');
                    $('#' + whoo).css({
                        opacity: 1
                    });
                });
                $('#info_' + whoo).delay(4000).fadeOut(400);
            } else {
                $('#mensagem_' + whoo).removeClass('errormsg alert');
                $('#mensagem_' + whoo).addClass('successmsg alert');
                $('#mensagem_' + whoo).html('SUCESSO! Dados validados corretamente.');
                $('#info_' + whoo).addClass('infomsg alert');
                $('#mensagem_' + whoo).delay(1200).fadeIn(400, function() {
                    $('#info_' + whoo).html(obj.info);
                    $('#' + whoo).css({
                        opacity: 1
                    });
                });
                $('#mensagem_' + whoo).delay(4000).fadeOut(800, function() {
                    $('#info_' + whoo).html('');
                    $('#info_' + whoo).html('Aguarde enquanto redirecionamos ...');
                    $('#info_' + whoo).delay(2000).fadeOut(400, function() {
                        window.location = obj.loadurl;
                    });
                });
            }
        });
    }
}

/*
 ******************************************************
 ***** fim script para controlar login de usuario *****
 ******************************************************
 */
function AdicionaItem(id, URL) {
    var formulario = document.getElementById(id);
    var info = '#info_modalAdicionando';
    var mensagem = '#mensagem_modalAdicionando';
    var DataString = $(formulario).serialize();
    console.log(DataString);
    /***chamada ajax***/
    $('#verificando_modalAdicionando').css('display', 'block');
    $.ajax({
        type: 'POST',
        url: URL,
        dataType: "json",
        data: DataString,
        success: function(data) {
            if (data.info.status === 'erro') {
                InfoErro(data.info.html, 'modalAdicionando', id);
            } else {
                InfoAcerto(data.info.html, 'modalAdicionando', id);
            }
            return false;
        },
        /***quando houver erro***/
        error: function(e)
        {
            $(mensagem).html('Erro!');
            $(info).html('Tivemos dificuldade de acessar o servidor. Tente novamente.');
            return false;
        }
    });
    return false;
}

function VerificaTipoConta()
{
    var strMensagem;
    var formulario = document.getElementById('formtipoconta');
    strMensagem = '';
    if (formulario.entry_postcode.value.length === 0) {
        strMensagem = strMensagem + '\n Por favor informe um endereço postal pertinente.';
    }
    if (strMensagem !== '') {
        $("#info_formtipoconta").html('<div class="errormsg alert"><a class="clostalert"><strong>Erro! </strong></a>Por favor informe um endereço postal pertinente</div>');
        $('.clostalert').click(function()
        {
            $(this).parent('.alert').fadeOut()
        });
        return false;
    }

}

/*
 ******************************************************
 ******* script para controlar visual de modais *******
 ******************************************************
 */
function overlay(d, whoo) {
    var LightBox = document.getElementById('overlay-bcash').style.display;
    document.getElementById('overlay-bcash').style.display = (LightBox === 'none' ? 'block' : 'none');
    var alturaTela = $(document).height();
    var larguraTela = $(window).width();
    if (d === 'on') {
//colocando o fundo preto
        $('#overlay-bcash').css({'width': larguraTela, 'height': alturaTela, 'z-index': '2000'});
        $('#enviando_' + whoo).css({'display': 'block', 'z-index': '2010'});
        $('#overlay-bcash').fadeIn(1000);
        $('#overlay-bcash').fadeTo("slow", 0.8);
    } else {
//elimina o fundo preto
        $('#overlay-bcash').css({'width': '0', 'height': '0'});
        $('#enviando_' + whoo).hide();
        $('#overlay-bcash').fadeIn(1000);
        $('#overlay-bcash').hide();
    }
}

function loader(v) {
    if (v == 'on') {
        $('#loginform').css({
            opacity: 0.2
        });
        $('#loader').show();
    } else {
        $('#loginform').css({
            opacity: 1
        });
        $('#loader').hide();
    }
}
/*
 ******************************************************
 ***** fim de script para controlar visual de modais***
 ******************************************************
 */

/*
 ******************************************************
 ***** script para verificar dados para cadastro ******
 ******************************************************
 */
function Concorda()
{
    //var formulario = $('#' + whoo).serializeArray();
    var agree = $('#agree');

    //console.log(agree.attr('value'));
    if (agree.val() !== 'on') {

        return false;
    }
    $("#concorde").css('display', 'none');
}
function InfoErro(data, modal_box, id) {
    if (modal_box !== 'ModalConta') {
        var info = '#info_' + modal_box;
    } else {
        var info = '#info_' + id;
    }
    $('#hide_lightbox').css('display', 'none');
    $('#close_lightbox').css('display', 'block');
    if (modal_box !== 'ModalConta') {
        $('#verificando_' + modal_box).delay(300).fadeOut(800);
    } else {
        $('#verificando_' + id).delay(300).fadeOut(800);
    }

    $(info).html(data);
    //$(info).delay(3000).fadeOut(700);
    //$(this).parent('.alert').fadeOut();
    $(document).ready(function()
    {
        var alturaTela = $(document).height();
        var larguraTela = $(window).width();
        //colocando o fundo preto
        $('#overlay-bcash').css({'width': larguraTela, 'height': alturaTela});
        $('#overlay-bcash').fadeIn(1000);
        $('#overlay-bcash').fadeTo("slow", 0.8);
        //var left = ($(window).width() / 2) - ($('#light_box').width() / 2);
        //var top = ($(window).height() / 2) - ($('#light_box').height() / 2);

        //$('#light_box').css({'top': top, 'left': left});
        //$('#light_box').css('display', 'block');
        if (modal_box !== 'ModalConta') {
            if (modal_box == 'modalAdicionando') {
                $(info).html('<div class="infomsg alert"><a class="clostalert"></a>Esse item não pode ser adicionado. Tente novamente.</div>');
            } else {
                $(info).html('<div class="infomsg alert"><a class="clostalert"></a>Dados de acesso informado com erro! Tente Novamente.</div>');
            }

            $('#' + modal_box).modal('show');
        } else {
            $(info).html('<div class="infomsg alert"><a class="clostalert"></a>Dados informado com erro! Tente Novamente.</div>');
        }

        return false;
    });
    return false;
}

function InfoAcerto(data, modal_box, id) {
    var info = '#info_' + modal_box;
    $('#hide_lightbox').css('display', 'block');
    $('#close_lightbox').css('display', 'none');
    $('#verificando_' + modal_box).delay(300).fadeOut(800);
    $(info).html(data);
    $(info).delay(3000).fadeOut(700);
    $(document).ready(function()
    {

        var alturaTela = $(document).height();
        var larguraTela = $(window).width();
        //colocando o fundo preto
        $('#overlay-bcash').css({'width': larguraTela, 'height': alturaTela});
        $('#overlay-bcash').fadeIn(1000);
        $('#overlay-bcash').fadeTo("slow", 0.8);
        //var left = ($(window).width() / 2) - ($('#light_box').width() / 2);
        //var top = ($(window).height() / 2) - ($('#light_box').height() / 2);

        //$('#light_box').css({'top': top, 'left': left});
        //$('#light_box').css('display', 'block');

        if (modal_box !== 'ModalConta') {
            if (modal_box == 'modalAdicionando') {
                $(info).html('<div class="infomsg alert"><a class="clostalert"></a>Item adicionado corretament.</div>');
            } else {
                $(info).html('<div class="infomsg alert"><a class="clostalert"></a>Dados de acesso corretos! Aguarde enquanto acessamos sua conta...</div>');
            }
            $('#' + modal_box).modal('show');
        } else {
            document.getElementById(id).submit();
        }
        $(this).parent('.alert').fadeOut();
        return false;
    });
    return false;
}

function ValidaTipoConta(whoo, URL) {
    var postcode = $('#postcode').val();
    //console.log(postcode);
    if (postcode === '') {
        $('#mensagem_' + whoo).html('');
        $('#info_' + whoo).html('');
        overlay('on', whoo);
        $('#mensagem_' + whoo).addClass('errormsg alert');
        $('#mensagem_' + whoo).html('ERRO!');
        $('#mensagem_' + whoo).fadeOut(800, function() {
            $('#enviando_' + whoo).delay(1000).fadeOut(500);
            $('#info_' + whoo).addClass('infomsg alert');
            $('#info_' + whoo).html('Por favor! Informe um endereço postal pertinente.');
            $('#' + whoo).css({
                opacity: 1
            });
            overlay('off', whoo);
            $('#info_' + whoo).delay(2000).fadeOut(400);
            $('#postcode').focus();
        });
        //return false;
    } else {
        var formulario = $('#' + whoo).serializeArray();
        $('#' + whoo).css({
            opacity: 1
        });
        $('#mensagem_' + whoo).html('');
        $('#info_' + whoo).html('');
        overlay('on', whoo);
        //usando ajax para receber resultados
        $.post(URL, formulario, function(data) {
            $('#enviando_' + whoo).show();
            var obj = JSON.parse(data);
            if (obj.status === 'fail') {
                overlay('off', whoo);
                $('#mensagem_' + whoo).addClass('errormsg alert');
                $('#mensagem_' + whoo).html('ERRO!');
                $('#mensagem_' + whoo).fadeOut(800, function() {
                    $('#enviando_' + whoo).delay(1000).fadeOut(500);
                    $('#info_' + whoo).addClass('infomsg alert');
                    var li = '';
                    obj.erro.forEach(function(entry) {
                        li += '<li>' + entry + '</li>';
                    });
                    $('#info_' + whoo).html('<ul>' + li + '</ul>');
                    $('#' + whoo).css({
                        opacity: 1
                    });
                    $('#info_' + whoo).delay(2000).fadeOut(400);
                });
            } else {
                $('#mensagem_' + whoo).removeClass('errormsg alert');
                $('#mensagem_' + whoo).addClass('successmsg alert');
                $('#mensagem_' + whoo).html('SUCESSO! Dados validados corretamente.');
                $('#mensagem_' + whoo).delay(1200).fadeOut(800, function() {
                    $('#info_' + whoo).html(obj.info);
                    $('#' + whoo).css({
                        opacity: 1
                    });
                });
                $('#info_' + whoo).delay(1000).fadeOut(800, function() {
                    $('#mensagem_' + whoo).html('');
                    //$('#mensagem_' + whoo).html('Aguarde finalizando o cadastro e redirecionando ...');
                    $('#' + whoo).attr('action', obj.loadurl);
                    $('#info_' + whoo).delay(1000).fadeOut(400, function() {
                        $('#' + whoo).submit();
                    });
                });
            }
        });
    }

}

function CheckCadastro() {
    var whoo = 'cadastro';
    $('#concorde').css('display', 'none');
    var formulario = $('#' + whoo).serializeArray();
    $('#' + whoo).css({
        opacity: 1
    });
    $('#mensagem_' + whoo).html('');
    $('#info_' + whoo).html('');
    overlay('on', whoo);
    var URL = $('#' + whoo).attr('action');
    //usando ajax para receber resultados
    $.post(URL, formulario, function(data) {
        $('#enviando_' + whoo).show();
        var obj = JSON.parse(data);
        if (obj.status === 'fail') {
            overlay('off', whoo);
            $('#mensagem_' + whoo).addClass('errormsg alert');
            $('#mensagem_' + whoo).html('ERRO!');
            $('#mensagem_' + whoo).css('display', 'block');
            //$('#mensagem_' + whoo).delay(5000).fadeOut(800, function() {
            $('#enviando_' + whoo).delay(1000).fadeOut(500);
            //$('#info_' + whoo).addClass('infomsg alert');
            var li = '';
            obj.erro.forEach(function(entry) {
                li += '<li>' + entry + '</li>';
            });
            $('#info_' + whoo).html('<ul class="">' + li + '</ul>');
            $('#info_' + whoo).css('display', 'block');
            $('#' + whoo).css({
                opacity: 1
            });
            //mostra os erros contidos no formulário de cadastro              
            $("#modal-erros").modal('show');
            //});
            return false;
        } else {
            $('#' + whoo).css({
                opacity: 1
            });
            $('#enviando_' + whoo).delay(1000).fadeOut(500);
            $('#mensagem_' + whoo).removeClass('errormsg alert');
            $('#mensagem_' + whoo).addClass('successmsg alert');
            $('#mensagem_' + whoo).html('SUCESSO! Dados validados corretamente.');
            $('#mensagem_' + whoo).delay(1200).fadeOut(400, function() {
                $('#info_' + whoo).html(obj.info);
            });
            $('#info_' + whoo).delay(1200).fadeOut(400, function() {
                $('#' + whoo).css({
                    opacity: 1
                });
                $('#info_' + whoo).removeClass('infomsg alert');
                $('#info_' + whoo).html('');
                $('#info_' + whoo).addClass('successmsg alert');
                $('#info_' + whoo).html('Aguarde finalizando o cadastro e redirecionando ...');
                window.location = obj.loadurl;
            });
            return false;
        }
    });
    return false;
    // }
}
/*
 ******************************************************
 *** fim script para verificar dados para cadastro ****
 ******************************************************
 */

/*
 ******************************************************
 ********** script para mostrar o gateway***********
 ******************************************************
 */
//function Gateway() {
//$('#gateway-image').delay(5000).fadeOut(800, function() {
//    $('#img-sucesso').slideUp('slow');
//    $('#gateway_finalizado').slideDown();
//});
//$('#gateway_finalizado').css('display', 'block');
//$('#gateway_finalizado').slideDown();
//}

function Desconto(cart, discount_id, vl_desconto) {
//identificar o valor do frete escolhido (38,35)
    var valor_escolhido = $('#vl_frete_escolhido').val();
    //substitui a virgula por ponto
    var frete = +valor_escolhido.replace(",", ".");
    //alert('FRETE '+frete);
    //carrinho
    var carrinho = +cart;
    //fixa em 2 digitos a casa decimal
    //alert('CARRINHO '+carrinho);
    //desconto
    var vl_discount_avista = (+vl_desconto).toFixed(2);
    //alert('DESCONTO '+vl_desconto);
    //calculos
    //var vl_discount_avista = (vl_discount_avista*carrinho).toFixed(2);
    var totalgeral = +(carrinho + frete - vl_discount_avista).toFixed(2);
    //alert('TOTAL '+totalgeral);
    //seta os valores
    $('#descontos').html('R$ ' + parseFloat(vl_discount_avista));
    $('#totalgeral').html('R$ ' + (parseFloat(totalgeral)));
    //seta os valores para o form
    $('#discount_avista_id').val(discount_id);
    $('#vl_discount_avista').val(vl_discount_avista);
    $('#forma_pagamento').val(discount_id);
}

function ValidaCupom(whoo, URL)
{
    overlay('on', whoo);
    $('#enviando_' + whoo).show();
    $('#' + whoo).css({
        opacity: 0.2
    });
    $('#mensagem_' + whoo).html('');
    $('#info_' + whoo).html('');
    $('#mensagem_' + whoo).removeClass('errormsg alert');
    $('#info_' + whoo).removeClass('infomsg alert');
    $('#' + whoo).css({
        opacity: 0.2
    });
    var formulario = $('#' + whoo).serializeArray();
    //console.log(formulario);
    $.post(URL, formulario, function(data) {
        var obj = JSON.parse(data);
        //console.log(data);
        if (obj.status === 'fail') {
            $('#info_' + whoo).html('');
            //overlay('on', whoo);
            $('#mensagem_' + whoo).addClass('errormsg alert');
            $('#mensagem_' + whoo).html('ERRO!');
            $('#mensagem_' + whoo).delay(2000).fadeOut(500);
            $('#enviando_' + whoo).delay(1000).fadeOut(500);
            $('#info_' + whoo).addClass('infomsg alert');
            var li = '';
            obj.erro.forEach(function(entry) {
                li += '<li>' + entry + '</li>';
            });
            $('#info_' + whoo).html('<ul>' + li + '</ul>');
            $('#' + whoo).css({
                opacity: 1
            });
            overlay('off', whoo);
            $('#discount_code').focus();
            $('#info_' + whoo).delay(2000).fadeOut(800);
            overlay('off', whoo);
        } else {
            overlay('off', whoo);
            $('#' + whoo).css({
                opacity: 1
            });
            $('#mensagem_' + whoo).removeClass('errormsg alert');
            $('#mensagem_' + whoo).addClass('successmsg alert');
            $('#mensagem_' + whoo).html('SUCESSO! Seu cupom foi validado.');
            $('#info_' + whoo).addClass('infomsg alert');
            $('#info_' + whoo).html(obj.info);
            $('#extra_' + whoo).html(obj.extra);
            $('#btn_cupom_descartar').css('display', 'block');
            $('#btn_cupom_confirmar').css('display', 'block');
            $('#btn_cupom').css('display', 'none');
            $('#btn_cupom_confirmar').focus();
        }
    });
}

function UsaCupom(cupom)
{
    var vl_frete = +($("#vl_frete").val());
    var vl_discount_avista = $("#vl_discount_avista").val();
    var vl_discount_cupom = cupom.vl_desconto_cupom;
    var total_geral = cupom.total_compra - vl_discount_avista - vl_discount_cupom + vl_frete;
    //atualiza o form
    $('#vl_discount_cupom').val(vl_discount_cupom);
    $('#str_vl_discount_cupom').html('R$ ' + vl_discount_cupom);
    $('#total_geral').html('R$ ' + total_geral);
    $('#ModalCupom').modal('hide');

    return false;
}

/*
 ******************************************************
 *********** fim de script para descontos  ************
 ******************************************************
 */
function resolucaoTela()
{
    var hoje = new Date();
    var data = new Date("December 31, 2023");
    var cookie_data = data.toGMTString();
    var o_cookie = "resolucao=" + screen.width;
    var o_cookie = o_cookie + ";expires=" + cookie_data;
    document.cookie = o_cookie;
}
/*
 ******************************************************
 *********** script para controle de email ************
 ******************************************************
 */
function EmailEnviar(whoo, URL)
{
    var formulario = $('#' + whoo).serializeArray();
    //var $info = '#info_' + whoo;
    //var $mensagem = '#mensagem_' + whoo;

    $('#' + whoo).css({
        opacity: 1
    });
    $('#mensagem_' + whoo).html('');
    $('#info_' + whoo).html('');
    $.post(URL, formulario, function(data) {
        $('#enviando_' + whoo).show();
        var obj = JSON.parse(data);
        //console.log(data);
        if (obj.status === 'fail') {
            $('#' + whoo).css({
                opacity: 0.2
            });
            $('#mensagem_' + whoo).addClass('errormsg alert');
            $('#mensagem_' + whoo).html('ERRO!');
            var LightBox = document.getElementById('overlay-bcash').style.display;
            document.getElementById('overlay-bcash').style.display = (LightBox === 'none' ? 'block' : 'none');
            $('#mensagem_' + whoo).fadeOut(800, function() {
                $('#info_' + whoo).html('');
                $('#mensagem_' + whoo).removeClass('errormsg alert');
                var li = '';
                obj.erro.forEach(function(entry) {
                    li += '<li>' + entry + '</li>';
                });
                $('#info_' + whoo).html('<ul>' + li + '</ul>');
                $('#info_' + whoo).addClass('infomsg alert');
                $('#info_' + whoo).show();
                $('#enviando_' + whoo).fadeOut(500);
                $('#' + whoo).css({
                    opacity: 1
                });
            });
            return false;
        } else {
            $('#enviando_' + whoo).fadeOut(500);
            $('#' + whoo).css({
                opacity: 1
            });
            $('#mensagem_' + whoo).removeClass('errormsg alert');
            $('#mensagem_' + whoo).addClass('successmsg alert');
            $('#mensagem_' + whoo).html('SUCESSO! Email encaminhado.');
            //$('#mensagem_cadastro').show();

            $('#mensagem_' + whoo).delay(1000).fadeOut(800, function() {
                $('#info_' + whoo).html('');
                //this.hide();
            });
        }
    });
}

/*
 ******************************************************
 ********* fim script para controle de email **********
 ******************************************************
 */

function toogleMenu() {
    /*menu principal*/
    var attr = document.getElementById('menuappsNavApps').style.display;
    var class_ = '';
    document.getElementById('menuappsNavApps').style.display = (attr === 'block' ? 'none' : 'block');
    document.getElementById('menuappsNavCat').style.display = 'none';
    document.getElementById('menuappsIconDownAppsMobile').setAttribute('class', 'icon-chevron-down white font18');
    class_ = document.getElementById('menuappsIconMaisAppsMobile').getAttribute('class');
    document.getElementById('menuappsIconMaisAppsMobile').setAttribute('class', (class_ === 'icon-plus-sign white font18' ? 'icon-minus-sign white font18' : 'icon-minus-sign white font18'));
}
function toogleMenuCat() {
    /*menu das categorias */
    var attr = document.getElementById('menuappsNavCat').style.display;
    var class_ = '';
    document.getElementById('menuappsNavCat').style.display = (attr === 'block' ? 'none' : 'block');
    document.getElementById('menuappsNavApps').style.display = 'none';
    document.getElementById('menuappsIconMaisAppsMobile').setAttribute('class', 'icon-plus-sign white font18');
    class_ = document.getElementById('menuappsIconDownAppsMobile').getAttribute('class');
    document.getElementById('menuappsIconDownAppsMobile').setAttribute('class', (class_ === 'icon-chevron-down white font18' ? 'icon-chevron-up white font18' : 'icon-chevron-down white font18'));
}

function toogleMenuCatV() {
    /*menu das categorias do menu esquerdo */
    var sidewidt = document.getElementById('sidewidtcatv').style.display;
    var MenuLeft = document.getElementById('MenuLeft').style.display;
    var NavCatV = document.getElementById('menuappsNavCatV').style.display;
    var attr = document.getElementById('menuappsNavCat').style.display;
    document.getElementById('sidewidtcatv').style.display = (sidewidt === 'block' ? 'none' : 'block');
    document.getElementById('MenuLeft').style.display = (MenuLeft === 'block' ? 'none' : 'block');
    document.getElementById('menuappsNavCatV').style.display = (NavCatV === 'block' ? 'none' : 'block');
    document.getElementById('menuappsNavCat').style.display = (attr === 'none' ? 'block' : 'none');
}
//submenu categoria da esquerda
function opensubmenuleft(id) {
    var attr = document.getElementById('CatVprole' + id).style.display;
    //var class_ = '';
    //document.getElementById('prole' + id).style.display = (attr === 'block' ? 'none' : 'block');
    $('#CatVprole' + id).addClass('dl-menuopen');
    //document.getElementById('menuappsNavCat').style.display = 'none';
    //document.getElementById('menuappsIconDownAppsMobile').setAttribute('class', 'icon-chevron-down white font18');
    //class_ = document.getElementById('menuappsIconMaisAppsMobile').getAttribute('class');
    //document.getElementById('menuappsIconMaisAppsMobile').setAttribute('class', (class_ === 'icon-plus-sign white font18' ? 'icon-minus-sign white font18' : 'icon-minus-sign white font18'));

}
function ConfiguraPacote(idPacote, idCateg) {
    //function ConfiguraPacote(idPacote,idAtrib,idCateg){
    var form = document.cart_quantity;
    var getURL = 'precos/';
    var RadioFormato = null;
    var Formato = null;
    RadioFormato = form.formato;
    var RadioPapel = null;
    var Papel = null;
    RadioPapel = form.papel;
    var RadioAcabamento = null;
    var Acabamento = null;
    RadioAcabamento = form.acabamento;
    var i = '0';
    if (!RadioFormato.length) {
        Formato = RadioFormato.value;
        //idFormato = "1";
    } else {
        for (i = 0; i < RadioFormato.length; i++) {
            if (RadioFormato[i].checked) {
                Formato = RadioFormato[i].value;
                //idFormato = '1';
            }
        }
    }
    //alert(Formato);
    if (!RadioPapel.length) {
        Papel = RadioPapel.value;
        //idPapel = '2';
    } else {
        for (i = 0; i < RadioPapel.length; i++) {
            if (RadioPapel[i].checked) {
                Papel = RadioPapel[i].value;
                //idPapel = '2';
            }
        }
    }
//alert(Papel);
    if (!RadioAcabamento.length) {
        Acabamento = RadioAcabamento.value;
        //idAcabamento = '3';
    } else {
        for (i = 0; i < RadioAcabamento.length; i++) {
            if (RadioAcabamento[i].checked) {
                Acabamento = RadioAcabamento[i].value;
                //idAcabamento = "3";
            }
        }
    }
    //alert('precos/' + Formato + '/' + Papel + '/' + Acabamento + '/' + idCateg);
    //form.submit();

    $.ajax({
        type: "GET",
        url: 'precos/' + Formato + '/' + Papel + '/' + Acabamento + '/' + idCateg,
        dataType: "json",
        data: '',
        // enviado com sucesso
        success: function(data) {
            // $.each(data, function()
            // {
            $('#price-qtd').css('display', 'none');
            $('#price-qtd-resultado').css('display', 'block');
            $('#price-qtd-resultado').html(data.html);
            //$('#esconde').css('display', 'none');
            //$('#confirmar').focus();
            //$("#ajax-resultado").css('display', 'block');
            //$("#code").val(code);
            //$("#discount_cupom").val(discount_cupom);
            //$("#ajax-resultado").html(data.html);
            //$("#ajax-loading").hide();
            //if(data.vl_desc == 0){
            //    $("#confirmar").hide();
            //}
            //});
        },
        // quando houver erro
        error: function(e)
        {
            alert('ERRO');
            //$("#ajax-resultado").css('display', 'inline-block');
            //$("#ajax-loading").hide();
            //$("#ajax-resultado").html('<div class="errormsg alert"><a class="clostalert">close</a>Erro no pedido ao servidor. Tente novamente.</div>');
        }
    });



    //getURL += 'formato=' + idFormato + '_' + Formato + '&papel=' + idPapel + '_' + Papel + '&acabamento=' + idAcabamento + '_' + Acabamento + '&categoria=' + idCateg;
    //alert(getURL);
    // document.getElementById('resultado').style.display = "block";
    // if (document.getElementById) {


    //  } //else alert('Erro');
}

/****************************************/
/******NOVA ECOGRAPH*********************/
/****************************************/
function Calculadora(current_id, categoria) {
    $('#escolhido').val(current_id);
    $('#nome_categoria').val(categoria);
    var URL = $('#calc').attr('action');
    //var data = "escolhido=" + current_id;
    $('#categ_selecionada').val(categoria);
    var formulario = $('#calc').serializeArray();
    //$('#tabela').hide(600);

    //console.log(formulario);
    $.post(URL, formulario, function(data) {
        var obj = JSON.parse(data);
        console.log(obj);
        //var cores = '';
        //var enoblecimento = ''
        //var valor = '';
        //var preco = '';
        var back_menu = '';
        //var image = '';
        $('#lista_formato').html();
        $('#lista_cores').html();
        $('#lista_papel').html();
        $('#lista_acabamento').html();
        $('#lista_enoblecimento').html();
        $('#lista_preco').html();
        $('#orc_categoria_id').val(current_id);
        $('#orc_categoria_nome').val(categoria);
        /*$.each(obj, function(key, val) {
         if (key === 'informacao') {
         if (val.info !== '') {
         if (key === 'parent') {
         
         }
         if (key === 'informacao') {
         $('#descricao_categoria').html(val.info);
         }
         if (key === 'descricao') {
         $('#descricao_categoria').html(val.desc);
         }
         if (key === 'back_menu') {
         back_menu = val.background;
         $('.head-itens').css('background-color', back_menu);
         }
         }
         }
         
         });*/
        $('#tabela').slideUp('slow');
        $('#tabela').slideDown('slow', function() {
            $('#tabela').fadeIn(800, function() {
                $('#nome_escolhido').html(categoria);
                var imagem = obj.imagem.image;
                $.each(obj, function(key, val) {
                    if (key === 'informacao' && val.info !== '') {
                        $('#mensagem_calculadora').addClass('text-alert');
                        $('#mensagem_calculadora').html(val.info);
                    }
                    if (key === 'back_menu') {
                        back_menu = val.background;
                        $('.head-itens').css('background-color', back_menu);
                    }
                    if (key === 'descricao') {
                        $('#descricao_categoria').html(val.desc);
                    }
                    if (key === 'parans') {
                        $.each(obj.parans, function(tipo, parans) {
                            GeraLista(tipo, parans, current_id);
                        });
                    }

                    if (key === 'qtd') {
                        var item = '';
                        $.each(obj.qtd, function(k, qtd) {
                            item += GeraQtd(k, qtd, imagem);
                        });
                        $('#lista_preco').html('<ul class=\"recent_post unstyled\">' + item + '</ul>');
                    }
                });
                $('#especificacoes_selecionada').slideUp('slow');
                $('#lista_perfis').slideUp('slow');
                $('#orcamento_gerado').slideUp('slow');
            });
        });

    });
    /*$.getJSON(
     url,
     data,
     function(data) {
     var formato = '';
     var cores = '';
     var papel = '';
     var acabamento = '';
     var enoblecimento = ''
     var valor = '';
     var preco = '';
     var back_menu = '';
     //var image = '';
     $('#lista_formato').html();
     $('#lista_cores').html();
     $('#lista_papel').html();
     $('#lista_acabamento').html();
     $('#lista_enoblecimento').html();
     $('#lista_preco').html();
     console.log(data);
     $.each(data, function(key, val) {
     if (key === 'parent') {
     $('#orc_categoria_id').val(val.pai);
     }
     if (key === 'informacao') {
     $('#descricao_categoria').html(val.info);
     }
     if (key === 'descricao') {
     $('#descricao_categoria').html(val.desc);
     }
     
     
     if (key === 'parans') {
     
     if (key === 'qtd') {
     //imagem = val.image;
     $.each(val, function(y, qtd) {
     valor += '<li><input type=\"radio\" name=\"pacote\" id=\"pacote_' + y + '\" onclick=\"SetaEscolhas(\'' + y + '\')\" value=\"\" disabled />\n\
     <input type=\"hidden\" id=\"peso_' + y + '\" name=\"peso\" value=\"\" />\n\
     \n<span class=\"afasta\" id=\"qtd_' + y + '\">' + qtd.unidade + ' un</span>\n\n\
     \n<span class=\"afasta\" id=\"preco_' + y + '\"></span>\n\
     </li>\n';
     });
     preco = valor;
     }
     });
     $('#tabela').slideUp('slow');
     $('#tabela').slideDown('slow', function() {
     $('#tabela').fadeIn(800, function() {
     $('#nome_escolhido').html(categoria);
     $('#lista_formato').html('<ul class=\"recent_post\">' + formato + '</ul>');
     $('#lista_cores').html('<ul class=\"recent_post\">' + cores + '</ul>');
     $('#lista_papel').html('<ul class=\"recent_post\">' + papel + '</ul>');
     $('#lista_acabamento').html('<ul class=\"recent_post\">' + acabamento + '</ul>');
     $('#lista_enoblecimento').html('<ul class=\"recent_post\">' + enoblecimento + '</ul>');
     $('#lista_preco').html('<ul class=\"recent_post\">' + preco + '</ul>');
     $('.head-itens').css('height', '35px');
     $('.head-itens').css('color', '#FFFFFF');
     });
     });
     }
     );*/
}

function GeraQtd(y, qtd, imagem) {
    var valor = '';
    //var hidden = '';        
    valor += '<li><input type=\"radio\" name=\"pacote\" id=\"pacote_' + y + '\" onclick=\"SetaEscolhas(\'' + y + '\',\'' + imagem + '\')\" value=\"\" disabled />\n\
        <span class=\"afasta\" id=\"qtd_' + y + '\">' + qtd.unidade + ' un</span>\n\
        <span class=\"afasta\" id=\"preco_' + y + '\"></span>\n\
        </li>\n';
    return valor;
    /* hidden = '<input type=\"hidden\" id=\"peso_' + y + '\" name=\"peso\" value=\"\" />\n\
     <input type=\"hidden\" id=\"pacote_' + y + '\" name=\"pacote\" value=\"' + qtd.id + '\" />\n';*/

}
function GeraLista(tipo, parans, current_id) {

    var lista_cores = ['4x0', '4x4'];
    cores = '<li>\n<input type=\"radio\" name=\"cores\" id=\"cores_0\" onclick=\"TrocaCheked(\'cores\',\'0\');\" value=\"' + lista_cores[0] + '\" />\n\n\
         <span class=\"afasta\" id=\"param_c_0\">' + lista_cores[0] + '</span>\n</li>\n';
    cores += '<li>\n<input type=\"radio\" name=\"cores\" id=\"cores_1\" onclick=\"TrocaCheked(\'cores\',\'1\');\" value=\"' + lista_cores[1] + '\" />\n\n\
         <span class=\"afasta\" id=\"param_c_1\">' + lista_cores[1] + '</span>\n</li>\n';
    $('#lista_cores').html('<ul class=\"recent_post unstyled\">' + cores + '</ul>');
    if (tipo === 'formato') {
        var formato = '';
        var f = 0;
        $.each(parans, function(k, item) {
            //alert(k + ' - ' + item.id + '-' + item.nome);
            formato += '<li>\n<input type=\"radio\" name=\"formato\" id=\"formato_' + f + '\" onclick=\"TrocaCheked(\'formato\',' + f + ');\" value=\"' + item.id + '\" />\n\n\
         <span class=\"afasta\" id=\"param_f_' + f + '\">' + item.nome + '</span>\n</li>\n';
            f = f + 1;
            // }
        });
        $('#lista_formato').html('<ul class=\"recent_post unstyled\">' + formato + '</ul>');
    }
    if (tipo === 'papel') {
        var papel = '';
        var p = 0;
        $.each(parans, function(k, item) {
            //alert(k + ' - ' + item.id + '-' + item.nome);
            papel += '<li>\n<input type=\"radio\" name=\"papel\" id=\"papel_' + p + '\" onclick=\"TrocaCheked(\'papel\',' + p + ');\" value=\"' + item.id + '\" />\n\n\
         <span class=\"afasta\" id=\"param_p_' + p + '\">' + item.nome + '</span>\n</li>\n';
            p = p + 1;
            // }
        });
        $('#lista_papel').html('<ul class=\"recent_post unstyled\">' + papel + '</ul>');
    }
    if (tipo === 'acabamento') {
        var acabamento = '';
        var a = 0;
        $.each(parans, function(k, item) {
            //alert(k + ' - ' + item.id + '-' + item.nome);
            acabamento += '<li>\n<input type=\"radio\" name=\"acabamento\" id=\"acabamento_' + a + '\" onclick=\"CalculaPreco(\'' + current_id + '\',' + a + ');\" value=\"' + item.id + '\" />\n\n\
         <span class=\"afasta\" id=\"param_a_' + a + '\">' + item.nome + '</span>\n</li>\n';
            a = a + 1;
            // }
        });
        $('#lista_acabamento').html('<ul class=\"recent_post unstyled\">' + acabamento + '</ul>');
    }
}
function SetaImagem(imagem) {
    $('#image_escolhida').attr('src', imagem);
}
function SetaEscolhas(localizador, imagem) {
    $('#especificacoes_selecionadas').slideDown('slow');
    var qtd = $('#qtd_' + localizador).text();
    var peso = $('#peso_selecionado_' + localizador).val();
    var preco = $('#preco_' + localizador).text();
    var produto = $('#nome_categoria').val();
    var qt_vl = qtd + " - " + preco;
    $('#orc_peso').val(peso);
    $('#orc_pacote_qtd').val(qtd);
    $('#orc_pacote_valor').val(preco);
    $('#especificacoes').html();
    var cor = $('#cor_nome').val();
    var formato = $('#formato_nome').val();
    var papel = $('#papel_nome').val();
    var acabamento = $('#acabamento_nome').val();

    var escolhas = {
        "Formato": formato,
        "Papel": papel,
        "Acabamento": acabamento,
        "Cor": cor,
        "Enoblecimento": "Outro"
    };
    var th = '<th style="width:14%">Imagem</th>';
    var td = '<td style="width:14%"><img id="image_escolhida" src="" alt="" title="" width="100%" class="polaroid"  style="max-width:100px"  /></td>';
    $.each(escolhas, function(item, valor) {
        //console.log(item);
        th += '\n<th style="width:14%">\n' + item + '\n</th>\n';
        td += '\n<td style="width:14%">\n<b class=\"red\">' + valor + '</b>\n</td>\n';
    });
    th += '\n<th style="width:14%">\nQtd/Valor\n</th>\n';
    td += '\n<td style="width:14%">\n<b class=\"red\">' + qt_vl + '</b>\n</td>\n';
    $('tr#especificacoes_head').html(th);
    $('tr#especificacoes').html(td);
    $('#produto_escolhido').html(produto);
    SetaImagem(imagem);
    $('#info_especificacoes').addClass('notice marker-on-bottom bg-amber fg-white');
    $('#info_especificacoes').html('Veja os detalhes de seu pacote abaixo.');
    $('#info_especificacoes').delay(2000).fadeOut(400);
    $('#especificacoes_selecionada').slideDown('slow', function() {
        $('tr#especificacoes_head').css('display', 'block');
        $('tr#especificacoes').css('display', 'block');
    });
}
function TrocaCheked(whoo, localizador) {
    $('#especificacoes_selecionadas').slideDown('slow');
    var valor = $('#' + whoo + '_' + localizador).val();
    var param = null;
    if (whoo === 'cores') {
        param = $('#param_c_' + localizador).text();
        $('#cor_nome').val(param);
        for (numero = 0; numero < 5; numero++) {
            //deschecando
            if ($("#papel_" + numero).is(":checked")) {
                $("#papel_" + numero).attr("checked", false);
            }
            if ($("#acabamento_" + numero).is(":checked")) {
                $("#acabamento_" + numero).attr("checked", false);
            }
            if ($("#pacote_" + numero).is(":checked")) {
                $("#pacote_" + numero).attr("checked", false);
            }
            $('#preco_' + numero).html('');
        }

    }
    if (whoo === 'formato') {
        param = $('#param_f_' + localizador).text();
        $('#formato_nome').val(param);
        for (numero = 0; numero < 5; numero++) {
            //deschecando
            if ($("#cor_" + numero).is(":checked")) {
                $("#cor_" + numero).attr("checked", false);
            }
            if ($("#papel_" + numero).is(":checked")) {
                $("#papel_" + numero).attr("checked", false);
            }
            if ($("#acabamento_" + numero).is(":checked")) {
                $("#acabamento_" + numero).attr("checked", false);
            }
            if ($("#pacote_" + numero).is(":checked")) {
                $("#pacote_" + numero).attr("checked", false);
            }
            $('#preco_' + numero).html('');
        }

    }
    if (whoo === 'papel') {
        param = $('#param_p_' + localizador).text();
        $('#papel_nome').val(param);
        for (numero = 0; numero < 5; numero++) {
            //deschecando
            if ($("#acabamento_" + numero).is(":checked")) {
                $("#acabamento_" + numero).attr("checked", false);
            }
            if ($("#pacote_" + numero).is(":checked")) {
                $("#pacote_" + numero).attr("checked", false);
            }
            $('#preco_' + numero).html('');
        }

    }
    $('#orc_' + whoo + '_id').val(valor);
    $('#orc_' + whoo + '_nome').val(param);
    $('#especificacoes').slideUp('slow');
}
function CalculaPreco(categoria, localizador) {
    //TrocaCheked('preco');
    var acabamento_valor = $('#acabamento_' + localizador).val();
    var param = $('#param_a_' + localizador).text();
    $('#acabamento_nome').val(param);
    var categoria_nome = $('#nome_escolhido').text();
    //$('#orc_categoria_id').val(categoria);
    //$('#orc_categoria_nome').val(categoria_nome);
    $('#orc_subcategoria_id').val(categoria);
    $('#orc_subcategoria_nome').val(categoria_nome);
    $('#orc_acabamento_id').val(acabamento_valor);
    $('#orc_acabamento_nome').val(param);
    for (numero = 0; numero < 5; numero++) {
        $('#pacote_' + numero).attr('disabled', false);
    }
    //var pacote = $('#pacote_'+numero).val();
    var url = $('#calculadora').attr('action');
    $('#categ_selecionada').val(categoria);
    var formulario = $('#calculadora').serializeArray();
    $.post(url, formulario, function(data) {
        var localizador = 0;
        var valor = null;
        var peso_selecionado = '';
        data.peso.forEach(function(entry) {
            peso = parseFloat(entry);
            peso_selecionado += '<input type="hidden" name="peso_selecionado" id="peso_selecionado_' + localizador + '" value="' + peso + '" />\n';
            $('#peso_selecionado').html(peso_selecionado);
            localizador = localizador + 1;
        });

        var localizador = 0;
        data.preco.forEach(function(entry) {
            //peso = parseFloat(entry.peso);
            valor = parseFloat(entry);
            $('#preco_' + localizador).html('<strong>R$ ' + valor + '</strong>');
            $('#pacote_' + localizador).val(valor);
            //$('#peso_' + localizador).val(peso);
            localizador = localizador + 1;
        });
        $('#info_tabela').addClass('notice marker-on-bottom bg-amber fg-white');
        $('#info_tabela').html('Escolha a quantidade desejada na lista abaixo.');
        $('#info_tabela').delay(2000).fadeOut(400);
    });
}
function EscolhaPerfil() {
    $('#orcamento_gerado').fadeOut(800);
    var categoria = $('#escolhido').val();
    var url_modal = 'lista_perfis' + '/' + categoria;

    //var data = "categoria=" + categoria;
    $.getJSON(
            url_modal,
            function(data) {
                //console.log(data);
                var div = '';
                var button = '';
                //var div_list = '';
                //var img = '';
                $.each(data, function(key, val) {
                    div += '<div class="listview">';
                    $.each(val, function(k, item) {
                        //alert(item.nome_perfil);
                        button += '<button type="button" style="float:left;width:24%;background-color:#343434;padding:0.5%" class="list button fg-white" onclick="VerTemplate(\'' + item.id_perfil + '\', \'' + item.nome_perfil + '\')"  title="Escolher o template para Musica">\n\
                                <div class="list-content">\n\
                                <span class="list-title">\n\
                                <img title="' + item.nome_perfil + '" src="' + item.logo_perfil + '" class="icon on-left">\n\
                                ' + item.nome_perfil + '\n\
                                </span>\n\
                                </div>\n\
                                </button>';
                    });
                    div += button + '</div>';
                });
                $('#listview').html(div);
                $('#info_perfis').addClass('notice marker-on-bottom bg-orange fg-black');
                $('#info_perfis').html('<p class="title"><i class="icon-smiley on-left"></i> Escolha um perfil que mais se adequa as suas necessidade.</p>');
                $('#info_perfis').delay(3000).fadeOut(400);
                $('#lista_perfis').slideUp('slow');
                $('#lista_perfis').css('display', 'block');

            });
}
function VerTemplate(id, nome) {
    $('#lista_perfis').slideUp(800, function() {
        $('#portfolio').slideDown('slow');
    });
    var action = 'portfolio';
    $('#orc_id_perfil').val(id);
    $('#orc_nome_perfil').val(nome);
    $('#form_orcamento').attr('action', action);
    $('#form_orcamento').attr('method', 'post');
    $('#btn_portfolio').css('display', 'block')
 
}
function FreteOrcamento() {
    if ($.trim($("#orc_cep").val()) !== "") {
        CEP = $("#orc_cep").val();
        peso = $('#orc_peso').val();
        $('#orc_peso_frete').val(peso);
        var formulario = $('#correio').serializeArray();
        var url = "calcula_frete/" + CEP;
        $('#wait').fadeIn(400);
    } else {
        $("#ajax-loading").hide();
        $("#erro").html("<img src=\"images/icons/access_denied_24.png\" style=\"float:left\" /><b>Erro no pedido ao servidor.</b>");
        return false;
    }
    $.post(url, formulario, function(data) {
        var obj = JSON.parse(data);
        console.log(obj);
        pac = parseFloat(obj.PAC[0]) + 5;
        sedex = parseFloat(obj.SEDEX[0]) + 5;
        labelpac = pac.toFixed(2);
        labelpac = labelpac.replace('.', ',');
        labelpac = "R$ " + labelpac;
        $('#vl_pac').html(labelpac);
        $('#frete_pac').val(pac.toFixed(2));
        labelsedex = sedex.toFixed(2);
        labelsedex = labelsedex.replace('.', ',');
        labelsedex = "R$ " + labelsedex;
        $('#vl_sedex').html(labelsedex);
        $('#frete_sedex').val(sedex.toFixed(2));
        $('#wait').delay(2000).fadeOut(400);
        $('#resultado').slideDown('slow', function() {
            $('#info_frete').addClass('notice marker-on-bottom bg-orange fg-black');
            $('#info_frete').html('<p class="tertiary-text"><i class="icon-smiley on-left"></i> Escolha uma forma de envio.</p>');
            $('#info_frete').delay(2000).fadeOut(400);
            $('#resultado').css('display', 'block');
        });
    });
}

function SetaFrete(tipo, id) {
    var orc_vl_frete = $(id).val();
    $('#prosseguir_orcamento').css('display', 'block');
    $('#orc_vl_frete').val(tipo);
    $('#orc_tipo_frete').val(orc_vl_frete);
    //var form = document.correio;
    //RadioFrete = form.vl_frete;            
    //for (var i = 0; i < RadioFrete.length; i++) {
    //     if (RadioFrete[i].checked) {
    //        $('#orc_vl_frete').val(RadioFrete[i].value);
    //         $('#orc_tipo_frete').val(orc_tipo_frete);
    //amount = parseFloat(RadioFrete[i].value) + parseFloat(montante);
    //amount = amount.toFixed(2);
    //amount = amount.replace('.', ',');
    //  }
    //}
}
function MontarOrcamento() {
    $('#lista_perfis').delay(2000).fadeOut(400, function() {
        $('#orcamento_gerado').fadeIn(800);
    });
}

function EscolherProduto($id) {
    $('#produto_id').val($id);
    $('#listagem').slideUp('slow',function(){
        $('#form_comprar').slideDown('fast',function(){
             $('#form_comprar').css('display','block');
        });
    });
}