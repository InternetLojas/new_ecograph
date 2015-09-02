/*-----------------------------------------------------------------------------------*/
/*  controla de frente e verso de cartões
 /*-----------------------------------------------------------------------------------*/
function FrenteVerso(id){
    var frente_display = $('#frente_'+id);
    var verso_display = $('#verso_'+id);
    if( frente_display.is(':visible') ) {
        // está visível, faça algo
        verso_display.css('display','block');
        frente_display.css('display','none');
        $('#label_'+id).text('Frente');
    } else {
        // não está visível, faça algo
        verso_display.css('display','none');
        frente_display.css('display','block');
        $('#label_'+id).text('Verso');
    }

}

/*-----------------------------------------------------------------------------------*/
/*  controla o formulário de busca
 /*-----------------------------------------------------------------------------------*/
function SearchVerifica(){
    var strMensagem;
    strMensagem = '';
    if (document.search.keyword.value.length < 4) {
        strMensagem = strMensagem + '\n Por favor informe no mínimo quatro caracteres.';
    }
    if (document.search.keyword.value === "Código ou nome do produto") {
        strMensagem = strMensagem + '\n Para efetivar a busca o campo pesquisa dever ser preenchido com no mínimo quatro caracteres.'
    }
    if (strMensagem !== '') {
        alert(strMensagem);
        return false;
    } else {
        document.search.submit();
    }
}
/*-----------------------------------------------------------------------------------*/
/*  buscar endereço do cep se existe - quando o usuario informa cep na modal tipo de conta
 /*-----------------------------------------------------------------------------------*/
function EnderecoCEP() {
    var whoo = "formtipoconta";
    $('#mensagem_' + whoo).html('');
    $('#info_' + whoo).html('');
    if ($.trim($("#postcode").val()) !== "") {
        CEP = $.trim($("#postcode").val());

        $('#mensagem_' + whoo).removeClass('alert alert-warning');
        $('#info_' + whoo).removeClass('alert alert-info');
        // $.getScript("http://cep.republicavirtual.com.br/web_cep.php?formato=javascript&cep=" + CEP.replace("-", ""), function()
        $.get('http://viacep.com.br/ws/'+CEP+'/json/',function(result){
            console.log(result.logradouro);
            /*
            *
            * "cep": "90810-150",
             "logradouro": "Avenida Jacuí",
             "complemento": "",
             "bairro": "Cristal",
             "localidade": "Porto Alegre",
             "uf": "RS",
             "ibge": "4314902"
            * */
            if (result.erro) {
                alert("Endereço não encontrado para o cep: " + CEP);
                $("#postcode").focus();
            } else {
                $('#street').val(result.logradouro);
                $('#suburb').val(result.bairro);
                $('#city').val(result.localidade);
                $('#state').val(result.uf);
                var url = $('#' + whoo).attr('action');
                ValidaTipoConta(whoo, url);
            }

            //var longstring = result.address;
            //var street = longstring.split(" - ");
            //$("#street").val(unescape(street[0]));
            //$("#suburb").val(unescape(result.district));
            //$("#city").val(unescape(result.city));
            //$("#state").val(unescape(result.state));
            var url = $('#' + whoo).attr('action');
            ValidaTipoConta(whoo, url);
        });
    } else {
        $('#mensagem_' + whoo).addClass('alert alert-warning');
        $('#mensagem_' + whoo).html('ERRO!');
        $('#mensagem_' + whoo).delay(2000).fadeOut(500);
        $('#info_' + whoo).addClass('alert alert-info');
        $('#info_' + whoo).html('<p class="text-center">Por favor! Informe um endereço postal pertinente.</p>');
        $('#' + whoo).css({
            opacity: 1
        });
        $("#postcode").focus();
    }
}

/*-----------------------------------------------------------------------------------*/
/*  verifica se dados postados para nova conta atende regras
 /*-----------------------------------------------------------------------------------*/
function ValidaTipoConta(whoo, URL) {
///tipo de conta - recebe o id do formulario e sua url
    var postcode = $('#postcode').val();
    if (postcode === '') {
//se o cep estiver vazio
        $('#' + whoo).css({
            opacity: 0.2
        });
        $('#mensagem_' + whoo).html('');
        $('#info_' + whoo).html('');

        $('#mensagem_' + whoo).addClass('alert alert-warning');
        $('#mensagem_' + whoo).html('ERRO!');
        $('#mensagem_' + whoo).fadeOut(800, function() {
            $('#enviando_' + whoo).delay(1000).fadeOut(500);
            $('#info_' + whoo).addClass('alert alert-warning');
            $('#info_' + whoo).html('<p class="text-center">Por favor! Informe um endereço postal pertinente.</p>');
            $('#postcode').focus();
        });
    } else {
//se estiver ok
        $('#' + whoo).css({
            opacity: 0.2
        });
        $('#mensagem_' + whoo).html('');
        $('#info_' + whoo).html('');
        var formulario = $('#' + whoo).serializeArray();
        ///encaminha os dados
        $.post(URL, formulario, function(data) {
            $('#enviando_' + whoo).show();
            var obj = JSON.parse(data);
            if (obj.status === 'fail') {
                //se houver falha
                $('#mensagem_' + whoo).addClass('alert alert-warning');
                $('#mensagem_' + whoo).html('ERRO!');
                $('#mensagem_' + whoo).fadeOut(800, function() {
                    $('#enviando_' + whoo).delay(1000).fadeOut(500);
                    var li = '';
                    obj.erro.forEach(function(entry) {
                        li += '<li>' + entry + '</li>';
                    });
                    $('#info_' + whoo).removeClass('alert alert-info');
                    $('#info_' + whoo).html('<ul>' + li + '</ul>');
                    $('#info_' + whoo).css('display', 'block');
                    $('#' + whoo).css({
                        opacity: 1
                    });
                    $('#info_' + whoo).delay(2000).fadeOut(400);
                });
            } else {
                ///se enviar e estiver ok
                $('#' + whoo).css({
                    opacity: 1
                });
                $('#enviando_' + whoo).delay(1000).fadeOut(500);
                $('#mensagem_' + whoo).removeClass('alert alert-warning');
                $('#mensagem_' + whoo).addClass('alert alert-success');
                $('#mensagem_' + whoo).html('<p class="text-center">SUCESSO! Dados validados corretamente.</p>');
                $('#mensagem_' + whoo).delay(1200).fadeOut(800, function() {
                    $('#info_' + whoo).html(obj.info);
                });
                $('#info_' + whoo).delay(1200).fadeOut(400, function() {
                    $('#mensagem_' + whoo).html('');
                    $('#info_' + whoo).removeClass('alert alert-info');
                    $('#info_' + whoo).html('');
                    $('#info_' + whoo).addClass('alert alert-info');
                    $('#' + whoo).attr('action', obj.loadurl);
                    $('#info_' + whoo).html('<p class="text-center">Aguarde finalizando o cadastro e redirecionando ...</p>');
                    $('#info_' + whoo).fadeIn(800);
                    $('#info_' + whoo).delay(1000).fadeOut(400, function() {
                        $('#' + whoo).submit();
                    });
                });
            }
        });
    }
}

/*-----------------------------------------------------------------------------------*/
/*  verifica se os dados postados para criar nova conta estão corretos
 /*-----------------------------------------------------------------------------------*/
function CheckCadastro() {
///encaminha os dados
    var whoo = 'cadastro';
    $('#concorde').css('display', 'none');
    $('#' + whoo).css({
        opacity: 0.2
    });
    $('#mensagem_' + whoo).html('');
    $('#info_' + whoo).html('');
    var formulario = $('#' + whoo).serializeArray();
    var URL = $('#' + whoo).attr('action');
    ///encaminha os dados
    $.post(URL, formulario, function(data) {
        $('#enviando_' + whoo).show();
        var obj = JSON.parse(data);
        if (obj.status === 'fail') {
            $('#enviando_' + whoo).delay(3000).fadeOut(500);
            var li = '';
            obj.erro.forEach(function(entry) {
                li += '<li>' + entry + '</li>';
            });
            $('#info_' + whoo).removeClass('alert alert-info');
            $('#info_' + whoo).html('<ul>' + li + '</ul>');
            $('#info_' + whoo).css('display', 'block');
            $('#' + whoo).css({
                opacity: 1
            });
            //mostra os erros contidos no formulário de cadastro              
            $("#modal-erros").modal('show');
            return false;
        } else {
////se enviar estiver ok
            $('#' + whoo).css({
                opacity: 1
            });
            $('#enviando_' + whoo).delay(1000).fadeOut(500);
            $('#mensagem_' + whoo).removeClass('alert alert-warning');
            $('#mensagem_' + whoo).addClass('alert alert-success');
            $('#mensagem_' + whoo).html('SUCESSO! Dados validados corretamente.');
            $('#mensagem_' + whoo).fadeIn(800);
            $('#mensagem_' + whoo).delay(1200).fadeOut(800, function() {
                $('#info_' + whoo).html(obj.info);
            });
            $('#info_' + whoo).delay(1200).fadeOut(400, function() {
                $('#mensagem_' + whoo).html('');
                $('#info_' + whoo).removeClass('alert alert-info');
                $('#info_' + whoo).html('');
                $('#mensagem_' + whoo).addClass('alert alert-sucess');
                $('#mensagem_' + whoo).html('Aguarde finalizando o cadastro e redirecionando ...');
                $('#mensagem_' + whoo).fadeIn(800);
                delay(1000).fadeOut(400, function() {
                    window.location = obj.loadurl;
                });
            });
            return false;
        }
    });
}
/*
 ******************************************************
 *** fim script para verificar dados para cadastro ****
 ******************************************************
 */

/*-----------------------------------------------------------------------------------*/
/*  Calculadora
 /*-----------------------------------------------------------------------------------*/
function Calculadora(current_id, categoria) {

    $('#escolhido').val(current_id);
    $('#nome_categoria').val(categoria);
    $('#modal_escolhido').html(categoria);
    var URL = $('#calc').attr('action');
    orc_categoria_id = $('#categ_pai').val();
    orc_categoria_nome = $('#categ_nome_pai').val();
    $('#categ_selecionada').val(categoria);
    var formulario = $('#calc').serializeArray();
    $.post(URL, formulario, function(data) {
        var obj = JSON.parse(data);
        console.log(obj);
        $('#lista_formato').html();
        $('#lista_cores').html();
        $('#lista_papel').html();
        $('#lista_enoblecimento').html();
        $('#lista_acabamento').html();
        //$('#naocadastrado').css.('display','none');
        $('#lista_preco').html();
        $('#orc_categoria_id').val(orc_categoria_id);
        $('#orc_categoria_nome').val(orc_categoria_nome);
        $('#tabela').slideUp('slow');
        $('#tabela').slideDown('slow', function() {
            $('#tabela').fadeIn(800, function() {
                $('#nome_escolhido').html(categoria);
                $('#img_escolhida_thumb').html(categoria);
                var imagem = obj.imagem.image;
                $.each(obj, function(key, val) {
                    if (key === 'processamento' && val.erro !== '') {
                        $('#info_calculadora').addClass('alert alert-warning');
                        $('#info_calculadora').html(obj.informacao.info);
                        $('#tabela').css('display', 'none');
                        $('#naocadastrado').css('display','block');
                        //$('#especificacoes_envio').delay(3000).fadeOut(400,function(){
                            $('#especificacoes_selecionada').delay(1500).fadeOut(400);
                            $('#lista_perfis').delay(1600).fadeOut(400);
                            $('#orcamento_gerado').delay(1700).fadeOut(400);
                            $('#info_calculadora').html();
                            $('#cupom_frete').delay(2000).fadeOut(400);
                            $('#resultado').delay(2100).fadeOut(400);
                            $('#naocadastrado').delay(3000).fadeOut(400,function(){
                                $('#info_calculadora').html('<p class="alert">Escolha outra categoria para continuar</p>');
                            });
                        $('#info_calculadora').delay(4000).fadeOut(400);
                       // });
                        //$('#especificacoes_envio').fadeOut.(600);
                        return false;
                    } else {
                        if (key === 'back_menu') {
                            back_menu = val.background;
                        }
                        if (key === 'descricao') {
                            $('#descricao_categoria').html(val.desc);
                        }
                        if (key === 'parans') {
                            GeraLista(obj.parans, current_id);
                        }
                        if (key === 'qtd') {
                            var item = '';
                            $.each(obj.qtd, function(k, qtd) {
                                item += GeraQtd(k, qtd, imagem);
                            });
                            $('#lista_preco').html('<ul id="list_preco" class=\"list-unstyled\">' + item + '</ul>');
                        }
                    }
                });

                $('.listview .list.fg-white').each(function(i) {
                    $(this).attr('class', 'list bg-gray fg-white btn-detalhes');
                });
                $('#especificacoes_selecionada').slideUp('slow', function() {
                    $('#all_produtos').fadeIn('slow');

                });
                $('#lista_perfis').slideUp('slow');
                $('#orcamento_gerado').slideUp('slow');
            });
        });
    });
}
/*-----------------------------------------------------------------------------------*/
/*  GeraLista
 /*-----------------------------------------------------------------------------------*/
function GeraLista(parametros, category_id) {
    var cat_id = $('#orc_categoria_id').val();
    $.each(parametros, function(tipo, parans) {
        var radio = '';
        $.each(parans, function(k, item) {
            on_click_troca = 'TrocaCheked(\'' + tipo + '\',' + k + ',\''+ category_id +'\');';
            on_click_calcula = 'CalculaPreco(\'' + category_id + '\',' + k + ');';
            if (tipo !== 'acabamento') {
                radio += '<li>\n<input type=\"radio\" name=\"' + tipo + '\" id=\"' + tipo + '_' + k + '\" onclick=\"' + on_click_troca + '" value=\"' + item.id + '\" />\n\n\
         <span class=\"afasta\" id=\"param_' + tipo + '_' + k + '\">' + item.nome + '</span>\n</li>\n';
            } else {
                radio += '<li>\n<input type=\"radio\" name=\"' + tipo + '\" id=\"' + tipo + '_' + k + '\" onclick=\"' + on_click_calcula + '" value=\"' + item.id + '\" disabled />\n\n\
         <span class=\"afasta\" id=\"param_' + tipo + '_' + k + '\">' + item.nome + '</span>\n</li>\n';
            }
        });

        $('#lista_' + tipo).html('<ul id="list_' + tipo + '" class=\"list-unstyled\">\n' + radio + '\n</ul>');

    });
}
/*-----------------------------------------------------------------------------------*/
/*  GeraQtd
 /*-----------------------------------------------------------------------------------*/
function GeraQtd(y, qtd, imagem) {
    var valor = '';
    valor += '<li>\n<input type=\"radio\" name=\"pacote\" id=\"pacote_' + y + '\" onclick=\"SetaEscolhas(\'' + y + '\',\'' + imagem + '\')\" value=\"\" disabled />\n\
        <span class=\"afasta\" id=\"qtd_' + y + '\">' + qtd.unidade + ' un</span>\n\
        <span class=\"right afasta\" id=\"preco_' + y + '\"></span>\n\n\
        <div class=\"clearfix\"></div>\n\n\
        </li>\n';
    return valor;
}
/*-----------------------------------------------------------------------------------*/
/*  TrocaCheked
 /*-----------------------------------------------------------------------------------*/
function TrocaCheked(whoo, localizador, categoria) {
    $('#especificacoes_selecionadas').slideDown('slow');
    var valor = $('#' + whoo + '_' + localizador).val();
    var param = null;
    if (whoo === 'formato') {
        param = $('#param_formato_' + localizador).text();
        $('#formato_nome').val(param);
        $('#formato_id').val(valor);
        $('ul#list_cores li').each(function(c) {
            $('#cores_' + c).attr("checked", false);
        });
        $('ul#list_papel li').each(function(p) {
            $('#papel_' + p).attr("checked", false);
        });
        $('ul#list_enoblecimento li').each(function(e) {
            $('#enoblecimento_' + e).attr("checked", false);
        });
        $('ul#list_acabamento li').each(function(a) {
            $('#acabamento_' + a).attr("checked", false);
            $('#acabamento_' + a).attr('disabled', true);
        });
        $('ul#list_preco li').each(function(i) {
            $('#pacote_' + i).attr("checked", false);
            $('#pacote_' + i).attr("disabled", true);
            $('span#preco_' + i).text();
        });

    }
    if (whoo === 'cores') {
        param = $('#param_cores_' + localizador).text();
        $('#cor_id').val(valor);
        $('#cor_nome').val(param);
        $('#orc_cor_id').val(valor);
        $('#orc_cor_nome').val(param);
        $('ul#list_papel li').each(function(i) {
            $('#papel_' + i).attr("checked", false);
        });
        $('ul#list_enoblecimento li').each(function(e) {
            $('#enoblecimento_' + e).attr("checked", false);
        });
        $('ul#list_acabamento li').each(function(a) {

            $('#acabamento_' + a).attr("checked", false);
            $('#acabamento_' + a).attr('disabled', true);
        });

    }
    if (whoo === 'papel') {
        param = $('#param_papel_' + localizador).text();
        $('#papel_id').val(valor);
        $('#papel_nome').val(param);
        if (categoria === '5') {
            disabilita = false;
            $('ul#list_enoblecimento li').each(function(e) {
                $('#enoblecimento_' + e).attr("checked", false);
                $('#enoblecimento_' + e).attr('disabled', true);
            });
            if(valor === '1'){
                $('#acabamento_0').attr('disabled', disabilita);
                $('#acabamento_1').attr('disabled', disabilita);
                $('#acabamento_2').attr('disabled', disabilita);
                $('#acabamento_3').attr('disabled', disabilita);
                $('#acabamento_4').attr('disabled', disabilita);
                $('#acabamento_5').attr('disabled', disabilita);
                $('#acabamento_6').attr('disabled', disabilita);
                $('#acabamento_7').attr('disabled', disabilita);
                $('#acabamento_8').attr('disabled', disabilita);
                $('#enoblecimento_0').attr('disabled', true);
                $('#enoblecimento_1').attr('disabled', false);
                $('#enoblecimento_2').attr('disabled', false);
            }
            if(valor === '2'){
                $('#acabamento_0').attr('disabled', disabilita);
                $('#acabamento_1').attr('disabled', disabilita);
                $('#acabamento_2').attr('disabled', disabilita);
                $('#acabamento_3').attr('disabled', disabilita);
                $('#acabamento_4').attr('disabled', disabilita);
                $('#acabamento_5').attr('disabled', disabilita);
                $('#acabamento_6').attr('disabled', disabilita);
                $('#acabamento_7').attr('disabled', disabilita);
                $('#acabamento_8').attr('disabled', disabilita);
                $('#enoblecimento_0').attr('disabled', true);
                $('#enoblecimento_1').attr('disabled', false);
                $('#enoblecimento_2').attr('disabled', false);
            }
            if(valor === '3' ){
                $('#acabamento_0').attr('disabled', disabilita);
                $('#acabamento_1').attr('disabled', disabilita);
                $('#acabamento_2').attr('disabled', disabilita);
                $('#acabamento_3').attr('disabled', disabilita);
                $('#acabamento_4').attr('disabled', disabilita);
                $('#acabamento_5').attr('disabled', disabilita);
                $('#acabamento_6').attr('disabled', disabilita);
                $('#acabamento_7').attr('disabled', disabilita);
                $('#acabamento_8').attr('disabled', disabilita);
                $('#enoblecimento_0').attr('disabled', false);
                $('#enoblecimento_1').attr('disabled', true);
                $('#enoblecimento_2').attr('disabled', false);
            }
        } else {
            $('ul#list_acabamento li').each(function(i) {
                $('#acabamento_' + i).attr("disabled", false);
                $('#acabamento_' + i).attr("checked", false);
            });
        }


    }

    if (whoo === 'enoblecimento') {
        param = $('#param_enoblecimento_' + localizador).text();
        $('#enobrecimento_id').val(valor);
        $('#enobrecimento_nome').val(param);
        $('#orc_enoblecimento_id').val(valor);
        $('#orc_enoblecimento_nome').val(param);
        disabilita = false;
        $('ul#list_acabamento li').each(function(a) {
            $('#acabamento_' + a).attr("checked", false);
            $('#acabamento_' + a).attr('disabled', true);
        });
        var valor_p = '';
        $('ul#list_papel li').each(function(p) {
            if($('#papel_' + p).is(':checked')){
                valor_p = $('#papel_' + p).val();
            }
        });
        var url_modal = 'lista_acabamento' + '/' + categoria + '/' + valor_p + '/' + valor;
        $.getJSON(
            url_modal,
            function(data) {
                console.log(data);
                var permite = [];
                $.each(data.acabamento, function(key, val) {
                    $('ul#list_acabamento li').each(function(a) {
                        vl_acabamento = $('#acabamento_' + a).val();
                        if( vl_acabamento == val){
                            permite.push(a);
                            return false;
                       }
                    });

                });
                console.log(permite);
                $.each(permite, function(k, indentificador) {
                    $('#acabamento_' + indentificador).attr('disabled', false);
                });
            }
        );
    }

    if (whoo === 'acabamento') {
        param = $('#param_acabamento_' + localizador).text();
        $('#acabamento_id').val(valor);
        $('#acabamento_nome').val(param);

    }

    $('#list_preco').each(function(i) {
        $('#preco_' + i).text();
    });
    $('#orc_' + whoo + '_id').val(valor);
    $('#orc_' + whoo + '_nome').val(param);
    $('#especificacoes').slideUp('slow');
}
/*-----------------------------------------------------------------------------------*/
/*  CalculaPreco
 /*-----------------------------------------------------------------------------------*/
function CalculaPreco(categoria, localizador) {
    acabamento_valor = $('#acabamento_' + localizador).val();
    param = $('#param_acabamento_' + localizador).text();
    $('#acabamento_nome').val(param);
    $('#acabamento_id').val(acabamento_valor);
    $('#orc_acabamento_id').val(acabamento_valor);
    $('#orc_acabamento_nome').val(param);
    //}
    categoria_nome = $('#nome_escolhido').text();
    $('#orc_subcategoria_id').val(categoria);
    $('#orc_subcategoria_nome').val(categoria_nome);

    url = $('#calculadora').attr('action');
    $('#categ_selecionada').val(categoria);
    //cor_id = $('#cores_'+localizador).val();
    //cor_nome = $('#param_cores_'+localizador).html;
    //$('#cor_id').val(cor_id);
    //$('#cor_nome').val(cor_nome);
    var formulario = $('#calculadora').serializeArray();
    $.post(url, formulario, function(data) {
        localizador = 0;
        peso_selecionado = '';
        if(data.status !=='erro'){
            data.peso.forEach(function(entry) {
                peso = parseFloat(entry);
                peso_selecionado += '<input type="hidden" name="peso_selecionado" id="peso_selecionado_' + localizador + '" value="' + peso + '" />\n';
                $('#peso_selecionado').html(peso_selecionado);
                //$('#peso_selecionado_'+locali)
                localizador = localizador + 1;
            });
            localizador = 0;
            data.preco.forEach(function(entry) {
                valor = parseFloat(entry).toFixed(2);
                $('#pacote_' + localizador).val(valor);
                $('#preco_' + localizador).html('<strong>R$ ' + valor.replace(".", ",") + '</strong>');
                $('#pacote_' + localizador).attr('disabled', false);
                localizador = localizador + 1;
            });
        } else {
            //alert('aquio');
            return Calculadora();
        }
    });
}

/*-----------------------------------------------------------------------------------*/
/*  PERSONALIZAR
 /*-----------------------------------------------------------------------------------*/
function PersonalizarDesenho(guest) {
    $('#cupom_frete').css('display', 'none');
    $('#resultado').css('display', 'none');
    $('#btn-opcoes').css('display', 'none');
    $('#btn-encerrar').attr('title','Encontre o desenho que mais lhe convem');
    $('#btn-imprimir').css('display', 'none');
    $('#btn-personalizar').css('display', 'none');
    $('#btn-enviar').css('display', 'none');
    $('#lista_perfis').css('display', 'block');
    $('#cupom_frete').attr('data-acao', 'personalizar');
    if (guest === '1') {//ESTÁ LOGADO         
        $('#logar').slideUp('fast');
        var action = 'produtos/portfolio.html';
        $('#form_orcamento').attr('action', action);
        $('#form_orcamento').attr('method', 'post');
        EscolhaPerfil();
    } else {
        $('#logar').slideDown('fast');
    }
}
/*-----------------------------------------------------------------------------------*/
/*  SetaEscolhas
 /*-----------------------------------------------------------------------------------*/
function SetaEscolhas(localizador, imagem) {
    $('#especificacoes_selecionadas').slideDown('slow');
    $('#cupom_frete').css('display', 'none');
    $('#resultado').css('display', 'none');
    $('logar').css('display', 'none');
    var qtd = $('#qtd_' + localizador).text();
    var peso = $('#peso_selecionado_' + localizador).val();
    //seta o valor declarado para o frete grátis
    vl_declarado = $('#pacote_' + localizador).val();
    //seta o valor declarado para controlar o frete grátis
    $('#vl_declarado').val(vl_declarado);

    var preco = $('#preco_' + localizador).text();
    var produto = $('#nome_categoria').val();
    //var qt_vl = qtd + " - " + preco;
    $('#orc_peso').val(peso);
    $('#orc_pacote_qtd').val(qtd);
    $('#orc_pacote_valor').val(preco);
    $('#especificacoes').html();
    var cor = $('#cor_nome').val();
    //var enoblecimento = $('#enoblecimento_nome').val();
    var formato = $('#formato_nome').val();
    var papel = $('#papel_nome').val();
    var enobrecimento = $('#enobrecimento_nome').val();
    var acabamento = $('#acabamento_nome').val();
    var escolhas_finais = {
        "Produto": produto,
        "Formato": formato,
        "Cores": cor,
        "Material": papel,
        "Enobrecimento": enobrecimento,
        "Acabamento": acabamento,
        "Qtd": qtd,
        "Valor": preco
    };
    var li = '';
    $.each(escolhas_finais, function(item, valor) {
        li += '<li>' + item + ': ' + valor + '</li>';
    });
    $('#lista_especificacao').html(li);
    SetaImagem(imagem);

    var token = $('#especificacoes_envio').attr('data-token');
    $('.token').val(token);
    $('#cupom_frete').slideDown('slow');
}
/*-----------------------------------------------------------------------------------*/
/*  SetaImagem
 /*-----------------------------------------------------------------------------------*/
function SetaImagem(imagem) {
    $('#image_escolhida').attr('src', imagem);
    $('#image_finalizacao').attr('src', imagem);
}
/*-----------------------------------------------------------------------------------*/
/*  EscolhaPerfil
 /*-----------------------------------------------------------------------------------*/
function EscolhaPerfil() {
     $('#info_perfis').removeClass('alert');
    var categoria = $('#escolhido').val();
    var url_modal = 'lista_perfis' + '/' + categoria;
    $.getJSON(
        url_modal,
        function(data) {
            console.log(data);
            var div = '';
            var button = '';
            if (data.info !== 'erro') {
                $.each(data, function(key, val) {
                    div += '<div class="row">';
                    div += '<div class="col-md-12">';
                    $.each(val, function(k, item) {
                        //alert(item.nome_perfil);
                        button += '<div class="umquarto bg-dark">\n\
                                        <button type="button" class=" btn bg-dark fg-white no-radius" onclick="VerTemplate(\'' + item.id + '\', \'' + item.nome_perfil + '\')"  title="Escolher o template para ' + item.nome_perfil + '">\n\
                                        <img title="' + item.nome_perfil + '" src="' + item.logo_perfil + '" class="img-responsive pull-left">\n\
                                        <span class="pull-lef text-medio">' + item.nome_perfil + '</span>\n\
                                </button></div>';
                    });
                    div += button + '</div></div>';
                    button = '';
                });
                $('#lista_perfis').css('display', 'block');
                $('#listview').html(div);
                $('#info_perfis').addClass('alert');
                $('#info_perfis').html('<p class="alert alert-info">Escolha um perfil para a categoria selecionada.</p>');
                $('#info_perfis').delay(3000).fadeOut(400);
                $('#lista_perfis').fadeIn(800);
                $('#ModalPerfil').modal('show');
            } else {
                $('#lista_perfis').css('display', 'block');
                $('#listview').html();
                $('#info_perfis').addClass('alert');
                $('#info_perfis').html('<p class="alert alert-warning">Ainda não existem perfis incorporados a essa categoria.</p>');
                $('#info_perfis').delay(3000).fadeOut(400);
                $('#lista_perfis').fadeIn(800);
                $('#ModalPerfil').modal('show');
            }
        });
}
/*-----------------------------------------------------------------------------------*/
/*  GerarOrcamento
 /*-----------------------------------------------------------------------------------*/
function GerarOrcamento() {
    //$('#finalizacao').slideUp('fast');
    $('#frete_orcamento').slideDown('slow');
    $('#orc_vl_frete').val();
    $('#orc_tipo_frete').val();
    var tipo = null;
    var form = document.correio;
    var RadioFrete = form.vl_frete;
    for (var i = 0; i < RadioFrete.length; i++) {
        if (RadioFrete[i].checked) {
            if (RadioFrete[i].id === "frete_pac") {
                tipo = 'PAC';
            } else {
                tipo = 'SEDEX';
            }
            $('#orc_vl_frete').val(RadioFrete[i].value);
            $('#orc_tipo_frete').val(tipo);
        }
    }
    var whoo = 'form_orcamento';
    var URL = 'orcamento_pdf.php';
    $('#enviando_' + whoo).css('display', 'block');
    $('#' + whoo).attr('action', URL);
    $('#mensagem_' + whoo).addClass('infomsg alert');
    $('#mensagem_' + whoo).html('Aguarde enquanto geramos seu orçamento...');
    $('#mensagem_' + whoo).delay(2000).fadeOut(800, function() {
        $('#' + whoo).submit();
    });
}
/*-----------------------------------------------------------------------------------*/
/*  VerTemplate
 /*-----------------------------------------------------------------------------------*/
function VerTemplate(id, nome) {
    if (id === '') {
        $('#ModalPerfil').modal('show');
    }
    $('#orc_id_perfil').val(id);
    $('#orc_nome_perfil').val(nome);
    //var token = $('#especificacoes_selecionada').attr('data-token');
    //$('.token').val(token);
    //$('#cupom_frete').slideDown('slow');
    $('#ModalPerfil').modal('hide');
    var action = 'produtos/portfolio.html';
    $('#form_orcamento').attr('action', action);
    $('#form_orcamento').attr('method', 'post');
    $('#mensagem_form_orcamento').addClass('alert alert-success');
    $('#mensagem_form_orcamento').html('Aguarde enquanto redirecionamos...');
    $('#mensagem_form_orcamento').delay(2000).fadeOut(800, function() {
        $('#form_orcamento').submit();
    });
}

/*-----------------------------------------------------------------------------------*/
/*  CalcularFrete
 /*-----------------------------------------------------------------------------------*/
function CalcularFrete() {
    $('#lista_perfis').delay(2000).fadeOut(400, function() {
        $('#frete_orcamento').css('display', 'block');
    });
}


/*-----------------------------------------------------------------------------------*/
/*  Comprar 
 /*-----------------------------------------------------------------------------------*/
function Comprar(produto_id) {
    $('#produto_id').val(produto_id);
    var URL = 'basket/adicionar';
    var formulario = $('#basket').serializeArray();

    $.post(URL, formulario, function(data) {
        var obj = JSON.parse(data);
        if (obj.status === 'success') {
            $('#info_listagem').addClass('alert alert-success');
            $('#info_listagem').html('<p class="fg-black"><i class="icon-smiley on-left"></i> Verificando dados para enviar para o seu carrinho, Por favor aguarde...</p>');
            $('#para').html('carrinho');
            $('#info_listagem').delay(3000).fadeOut(800, function() {
                $('#modalAdicionando').modal('show');
                //quando retornar o site vai para o carrinho de compras
                return BasketSubmeter();
            });
        }
    });
}
/*-----------------------------------------------------------------------------------*/
/*  BasketSubmeter
 /*-----------------------------------------------------------------------------------*/
function BasketSubmeter() {
    action_submeter = 'basket/listar.html';
    $('#basket').attr('action', action_submeter);
    $('#basket').attr('method', 'post');
    $('#basket').submit();
}
function Editar(produto_id) {
    $('#produto_id').val(produto_id);
    var URL = 'basket/adicionar';
    var formulario = $('#basket').serializeArray();
    $.post(URL, formulario, function(data) {
        var obj = JSON.parse(data);
        if (obj.status === 'success') {
            $('#info_listagem').addClass('alert alert-success');
            $('#info_listagem').html('<p class="fg-black"><i class="icon-smiley on-left"></i> Verificando dados para enviar para a área de edição, Por favor aguarde...</p>');
            $('#para').html('área de edição');
            $('#modalAdicionando').modal('show');
            $('#info_listagem').delay(3000).fadeOut(800, function() {
                $('#modalAdicionando').modal('show');
                //quando retornar o site vai para o carrinho de compras
                return EditarSubmeter();
            });
        }
    });
}

/*-----------------------------------------------------------------------------------*/
/*  EditarSubmeter
 /*-----------------------------------------------------------------------------------*/
function EditarSubmeter() {
    action_submeter = 'editor/personalizar.html';
    $('#basket').attr('action', action_submeter);
    $('#basket').attr('method', 'post');
    $('#basket').submit();
}

/*-----------------------------------------------------------------------------------*/
/*  UploadValidar
 /*-----------------------------------------------------------------------------------*/
function UploadValidar(url) {
    var formulario = $('#upload').serializeArray();
    $.post(url, formulario, function(data) {
        var obj = JSON.parse(data);
        if (obj.status === 'success') {
            $('#info_upload').addClass('alert alert-success');
            $('#info_upload').html('<p class="fg-black"><i class="icon-smiley on-left"></i> Verificando dados para enviar para o seu carrinho, Por favor aguarde...</p>');
            //$('#para').html('carrinho');
            //$('#modalAdicionando').modal('show');
            $('#info_upload').delay(3000).fadeOut(800, function() {
                return UploadSubmeter(obj.loadurl);
            });
        }
    });
}
/*-----------------------------------------------------------------------------------*/
/*  UploadSubmeter
 /*-----------------------------------------------------------------------------------*/
function UploadSubmeter(url) {
    $('#upload').attr('action', url);
    $('#upload').attr('method', 'post');
    $('#upload').submit();
}
/*-----------------------------------------------------------------------------------*/
/*  FreteOrcamento
 /*-----------------------------------------------------------------------------------*/
function FreteOrcamento() {
    $('#wait').css('display', 'block');
    if ($.trim($("#orc_cep").val()) !== "") {
        CEP = $("#orc_cep").val();
        peso = $('#orc_peso').val();
        //alert(peso);
        $('#orc_peso_frete').val(peso);
        var formulario = $('#correio').serializeArray();
        var url = "calcula_frete/" + CEP;
        $.post(url, formulario, function(data) {
            var obj = JSON.parse(data);
            if (peso > 30) {
                $('#info_correio').addClass('alert alert-info');
                $('#info_correio').html('<p class="fg-black text-medio"><i class="icon-smiley on-left"></i> Carrinho com produto acima de 30KG: "<b>Somente Transportadora ou Retirada na loja.</b>"</p>');
                labelsedex = "R$ " + '999999,99';
                $('#vl_sedex').html(labelsedex);
                $('#frete_sedex').val('0.00');

                $('#mensagens').slideDown('slow');
                $('#mensagens').delay(5000).slideUp('500', function() {                    //
                    $('#wait').fadeOut('slow');
                    $('#info_correio').removeClass('alert alert-info');
                    $('#resultado').css('display', 'block');
                    $('#desconto').css('display', 'block');
                });
                return false;
            }
            if (obj.erro) {
                $('#info_correio').addClass('alert alert-danger');
                $('#info_correio').html('<p class="fg-black text-medio"><i class="icon-smiley on-left"></i> Por favor observe a mensagem do correio: "<b>' + obj.mensagem[0] + '</b>"</p>');
                $('#mensagens').slideDown('slow');
                $('#mensagens').delay(5000).slideUp('500', function() {                    //
                    $('#wait').fadeOut('slow');
                    $('#info_correio').removeClass('alert alert-danger');
                    $('#orc_cep').focus();
                });
                return false;
            }

            if (obj.mensagem !='') {
                $('#info_correio').addClass('alert alert-info');
                $('#info_correio').html('<p class="fg-black text-medio"><i class="icon-smiley on-left"></i> Frete zero para o seu estado.</p>');
                labelsedex = "R$ " + '0,00';
                $('#vl_sedex').html(labelsedex);
                $('#frete_sedex').val('0.00');
                $('#mensagens').slideDown('slow');
                $('#mensagens').delay(5000).slideUp('500', function() {                    //
                    $('#wait').fadeOut('slow');
                    $('#info_correio').removeClass('alert alert-info');
                    $('#resultado').css('display', 'block');
                });
                return false;
            } else {
                $('#info_correio').addClass('alert alert-info');
                $('#info_correio').html('<p class="fg-black text-medio"><i class="icon-smiley on-left"></i> Sucesso! Escolha forma de envio para prosseguir.</p>');
                sedex = parseFloat(obj.SEDEX[0]) + 5;
                labelsedex = sedex.toFixed(2);
                labelsedex = labelsedex.replace('.', ',');
                labelsedex = "R$ " + labelsedex;
                $('#vl_sedex').html(labelsedex);
                $('#frete_sedex').val(sedex.toFixed(2));
                $('#mensagens').slideDown('slow');
                $('#mensagens').delay(5000).slideUp('500', function() {                    //
                    $('#wait').fadeOut('slow');
                    $('#info_correio').removeClass('alert alert-info');
                    $('#resultado').css('display', 'block');
                });
            }
        });
    }else {
        $('#info_correio').addClass('alert alert-danger');
        $('#info_correio').html('<p class="fg-black text-medio"><i class="icon-smiley on-left"></i> Por favor informe o CEP de destino</p>');
        $('#mensagens').slideDown('slow');
        $('#mensagens').delay(5000).slideUp('500', function() {
            $('#orc_cep').focus();
            //$('#desconto').css('display', 'block');
            $('#wait').fadeOut('slow');
            $('#info_correio').removeClass('alert alert-danger');
        });
    }
}

/*-----------------------------------------------------------------------------------*/
/*  SetaFrete
 /*-----------------------------------------------------------------------------------*/
function SetaFrete(tipo, id) {
    $('#label_frete').css('display', 'none');
    vl_frete = +$('#' + id).val();
    //alert(vl_frete);
    perc_desconto = $('#perc_desconto').val();
    //alert(perc_desconto);
    orc_pacote_valor = $('#orc_pacote_valor').val();
    pacote_valor = orc_pacote_valor.replace("R$ ", "");
    valor = pacote_valor.replace(",", ".");
    //alert(valor);
    acao = $('#cupom_frete').attr('data-acao');
    vl_final = $('#orc_vl_frete').val(vl_frete);
    //alert(vl_final);
    $('#vl_final').text($('#orc_pacote_valor').val() + ',00');
    $('#orc_tipo_frete').val(tipo);
    $('#vl_frete_escolhido').val('R$ ' + $('#' + id).val());
    $('#escolha_frete').html('R$ ' + $('#' + id).val());
    //$('#btn-opcoes').slideDown('slow');
    $('#label_frete').fadeIn(500);
    //SetaBtnAcao(acao);
    soma = (+valor - +(valor*perc_desconto)) + vl_frete;
    $('#vl_desc_final').html('R$ ' +((valor*perc_desconto).toFixed(2)).replace('.', ','));
    $('#orc_desconto_valor').val(valor*perc_desconto);
    $('#vl_total_final').html('R$ ' + (soma.toFixed(2)).replace('.', ','));
    $('#especificacoes_selecionada').slideDown('slow');
}
/*-----------------------------------------------------------------------------------*/
/*  Seta o Botão específico para dar continuidade ao processo
 /*-----------------------------------------------------------------------------------*/
function SetaBtnAcao(acao) {
    $('#label_frete').fadeIn(500);
    if (acao === 'imprimir') {
        $('#btn-imprimir').css('display', 'block');
    } else if (acao === 'personalizar') {
        $('#btn-personalizar').css('display', 'block');
    } else {
        $('#btn-enviar').css('display', 'block');
    }
}

/*-----------------------------------------------------------------------------------*/
/*  IMPRIMIR ORÇAMENTO
 /*-----------------------------------------------------------------------------------*/
function ImprimirOrcamento(guest) {
    if (guest === '1') {//ESTÁ LOGADO
        $('#logar').slideUp('fast');
        var action = 'orcamento.html';
        $('#form_orcamento').attr('action', action);
        $('#form_orcamento').attr('method', 'post');
        token = $('#especificacoes_selecionada').attr('data-token');
        $('.token').val(token);
        $('#mensagem_form_orcamento').addClass('alert alert-success');
        $('#mensagem_form_orcamento').html('<p class="fg-black"><i class="icon-smiley on-left"></i> Aguarde enquanto estamos redirecionando...</p>');
        $('#mensagem_form_orcamento').fadeIn(400);
        $('#mensagem_form_orcamento').delay(4000).fadeOut(400, function() {
            $('#form_orcamento').submit();
        });
        $('#cupom_frete').slideDown('slow');
    } else {
        $('#logar').slideDown('fast');
    }
}
/*-----------------------------------------------------------------------------------*/
/*  PDF
 /*-----------------------------------------------------------------------------------*/
function PDF(guest) {

    if (guest === '1') {
        var action = 'produtos/enviarpdf.html';
        $('#form_orcamento').attr('action', action);
        $('#form_orcamento').attr('method', 'post');
        token = $('#especificacoes_selecionada').attr('data-token');
        $('.token').val(token);
        $('#mensagem_form_orcamento').addClass('alert alert-success');
        $('#mensagem_form_orcamento').html('<p class="fg-black"><i class="icon-smiley on-left"></i> Aguarde enquanto estamos redirecionando...</p>');
        $('#mensagem_form_orcamento').fadeIn(400);
        $('#mensagem_form_orcamento').delay(4000).fadeOut(400, function() {
            $('#form_orcamento').submit();
        });
        $('#cupom_frete').slideDown('slow');
    } else {
        $('#logar').slideDown('fast');
    }

}
function Encerrar() {
    $('#info_encerrar').addClass('alert alert-success');
    $('#info_encerrar').html('<p class="fg-black"><i class="icon-smiley on-left"></i> Aguarde enquanto estamos redirecionando...</p>');
    $('#info_encerrar').fadeIn(400);
    $('#info_encerrar').delay(4000).fadeOut(400, function() {
        $('#form_orcamento').submit();
    });
}
function SolicitarOrcamento() {
    $('#info_correio').html('<p class="text-warning">Aguarde enquanto redirecionamos para seu orçamento ...</p>');
    $('#info_correio').fadeIn(400);
    $('#info_correio').delay(4000).fadeOut(400, function() {
        var action = 'orcamento.html';
        $('#form_orcamento').attr('action', action);
        $('#form_orcamento').attr('method', 'post');
        $('#form_orcamento').submit();
    });
}
/*-----------------------------------------------------------------------------------*/
/*  Desconto
 /*-----------------------------------------------------------------------------------*/
function Desconto(id, cart) {
//identificar o valor do frete escolhido (38,35)
    var valor_escolhido = $('#vl_frete_escolhido').val();
    var forma_pagamento = $('#payment_id' + id).text();
    //substitui a virgula por ponto
    var frete = +valor_escolhido.replace(",", ".");
    //alert('FRETE '+frete);
    //carrinho
    var carrinho = +cart;
    $('#forma_pagamento').val(forma_pagamento);
    $('#forma_pagamento_id').val(id);
    //fixa em 2 digitos a casa decimal
    //alert('CARRINHO '+carrinho);
    //desconto
    /* var vl_discount_avista = (+vl_desconto).toFixed(2);
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
     $('#forma_pagamento').val(discount_id);*/
}

/*
 *******************************************************
 ***   script para controle da página de carrinho    ***
 *******************************************************
 */
function ValidaCarrinho(whoo, URL){
    //alert('aqui');
    var vl_frete = $('#vl_frete_escolhido').val();
    var tipo_frete = $('#tipo_frete').val();
    var forma_pagamento = $('#forma_pagamento').val();
    //overlay('on', whoo);
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
        $('#mensagem_' + whoo).addClass('alert alert-warning');
        $('#mensagem_' + whoo).html('ERRO!');
        $('#mensagem_' + whoo).delay(2000).fadeOut(800, function() {
            //$('#enviando_' + whoo).delay(1000).fadeOut(500);
            $('#info_' + whoo).addClass('alert alert-info');
            $('#info_' + whoo).html('<p class="fg-black"><i class="icon-smiley on-left"></i>Por favor! Para prosseguir é necessário o valor do frete, o tipo de frete e a forma de pagamento.</p>');
            $('#' + whoo).css({
                opacity: 1
            });
        });
        $('#info_' + whoo).delay(2000).fadeOut(800);

    } else {

        $('#' + whoo).css({
            opacity: 1
        });
        $('#mensagem_' + whoo).html('');
        $('#info_' + whoo).html('');
          $('#mensagem_' + whoo).addClass('alert alert-success');
        $('#info_' + whoo).addClass('alert alert-info');
        $('#mensagem_' + whoo).html('SUCESSO');
        $('#info_' + whoo).html('<p class="fg-black"><i class="icon-smiley on-left"></i>Redirecionando para resumo do pedido.</p>');
        $('#info_' + whoo).slideUp(600);
        $('#' + whoo).attr('action', URL);
        $('#mensagem_' + whoo).delay(2000).fadeOut(800, function() {
            $('#' + whoo).submit();
        });
    }
}
/*
 *******************************************************
 ***   script para controle de tiens do carrinho    ***
 *******************************************************
 */
function AtualizarCarrinho(product){
    var qtd = document.getElementById(product).value;
    //var formulario = document.getElementById('quantidade' + product);
    if (qtd === 0)
    {
        alert('Por favor informe uma quantidade maior que zero');
        return false;
    } else {
        $.get('basket/atualizar', {'quantity': qtd, 'product_id': product}, function(result) {
            console.log(result);
            var obj = JSON.parse(result);
            if (obj.action === true) {
                $('#info_carrinho').html('<p class="text-info">' + obj.info + '</p>');
            } else {
                $('#info_carrinho').html('<p class="text-warning">' + obj.info + '</p>');
            }
            $('#info_carrinho').delay(5000).fadeIn('slow');
        });
    }
    //formulario.submit();
}
function RemoverItem(product){
    $.get('basket/remover', {'product_id': product}, function(result) {
        console.log(result);
        var obj = JSON.parse(result);

        if (obj.reload === 'true') {
            //alert(obj.reload);
            $('#info_carrinho').html('<div class="alert alert-info" role="alert"><p class="text-warning">' + obj.info + ' <img src="images/img/loader.gif" /></p></div>');
            $('#info_carrinho').slideDown(600);
            //slideUp(600)
            $('#info_carrinho').delay(5000).slideUp(600, function() {
                document.location.href = 'basket.html'
            });
        } else {
            $('#info_carrinho').html('<div class="alert alert-warning" role="alert"><p class="text-warning">' + obj.info + ' <img src="images/img/loader.gif" /></p></div>');
            $('#info_carrinho').slideUp(700);
        }

    });

}

function ValidaCaixa(whoo){
    VerificaConcorde(whoo);
    $('#mensagem_' + whoo).html('');
    $('#info_' + whoo).html('');
    var formulario = $('#' + whoo).serializeArray();
    var url_validacao = $('#' + whoo).attr('action');//'loja/validacaixa';
    $.post(url_validacao, formulario, function(data) {
        console.log(data);
        var obj = JSON.parse(data);
        //alert(obj.loadurl);
        if (obj.status === 'fail') {
            $('#mensagem_' + whoo).addClass('alert alert-warning');
            $('#mensagem_' + whoo).html(obj.info);
            $('#info_' + whoo).addClass('alert alert-info');
            $('#info_' + whoo).html('<p class="fg-black"><i class="icon-smiley on-left"></i><strong>' + obj.erro + '</strong></p>');
            $('#info_' + whoo).delay(5000).fadeOut(800);
        }
        else {
            //$('#mensagem_' + whoo).addClass('alert alert-success');
            $('#info_' + whoo).addClass('alert alert-success');
            //$('#mensagem_' + whoo).html('<p class="fg-black"><i class="icon-smiley on-left"></i>SUCESSO</p>');
            $('#info_' + whoo).html('<p class="fg-black"><i class="icon-smiley on-left"></i>'+obj.info+'</p>');
            $('#' + whoo).attr('action', obj.loadurl);
            $('#mensagem_' + whoo).delay(2000).fadeOut(800, function() {
                $('#' + whoo).submit();
            });
        }
    });
}

/*******************************************************
 ***     script para controle da página de resumo    ***
 *******************************************************
 */
function VerificaConcorde(whoo) {
    if (!$("#agree").is(':checked')) {
        $('#mensagem_' + whoo).addClass('alert alert-warning');
        $('#mensagem_' + whoo).html('ERRO!');
        $('#info_' + whoo).addClass('alert alert-info');
        $('#info_' + whoo).html('<p class="fg-black"><i class="icon-smiley on-left"></i>Por favor! <strong>É necessário o concorde dos dados apresentados.</strong></p>');
        $('#mensagem_' + whoo).delay(3000).fadeOut(400);
        $('#info_' + whoo).delay(5000).fadeOut(800);
        return false;
    }
}
/*-----------------------------------------------------------------------------------*/
/*  Carregar os dados para fazer upload
 /*-----------------------------------------------------------------------------------*/
function ValidarFormEdicao() {
    var envia = false;
    var $formulario = $('#form_edicao').serializeArray();
    $.post('editor/validar', $formulario, function(data) {
        //console.log(data);
        var obj = JSON.parse(data);
        //console.log(data);
        if (obj.status === 'ok') {
            alert('eu agora vou chamar a ;função que faz uploads');
            var envia = true;
        }
    });
    //if(envia){
    PreparaUpload('img3');
    //}
    //$formulario.attr('action', 'editor/carregar');
    //$formulario.submit();
}

function PreparaUpload(midia) {
    var $fileupload = $('#' + midia);
    $upload_success = $('#upload-success');
    $fileupload.fileupload({
        url: 'editor/upload',
        formData: {_token: $fileupload.data('token'), arquivo: midia},
        progressall: function(e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#progress .progress-bar').css(
                'width',
                progress + '%'
            );
        },
        done: function(e, data) {
            console.log(data);
            $upload_success.removeClass('hide').hide().slideDown('fast');
            setTimeout(function() {
                location.reload();
            }, 2000);
        }
    });
}
/*
 *******************************************************
 ***   script para controle da cupom    ***
 *******************************************************
 */
function ValidaCupom(whoo, URL, check){
    if(check === '0'){
        $('#especificacoes_envio').slideUp('low');
        $('#logar').slideDown('fast');
        return false;
    }

    $('#btn-validar').attr('disabled', 'false');
//$('#btn_cupom_confirmar').css('display', 'none');
    $('#mensagem_' + whoo).html('');
    $('#info_' + whoo).html('');
    $('#mensagem_' + whoo).removeClass('alert alert-warning');
    $('#info_' + whoo).removeClass('alert alert-info');

    var formulario = $('#' + whoo).serializeArray();
    console.log(formulario);
    $.post(URL, formulario, function(data) {
        var obj = JSON.parse(data);
        console.log(data);
        if (obj.status === 'fail') {
            $('#info_' + whoo).html('');
            //overlay('on', whoo);
            $('#mensagem_' + whoo).addClass('alert alert-warning');
            $('#mensagem_' + whoo).html('ERRO!');
            $('#mensagem_' + whoo).delay(2000).fadeOut(500);
            $('#enviando_' + whoo).delay(1000).fadeOut(500);
            $('#info_' + whoo).addClass('alert alert-info');
            var li = '';
            obj.erro.forEach(function(entry) {
                li += '<li>' + entry + '</li>';
            });
            $('#info_' + whoo).html('<ul>' + li + '</ul>');
            $('#' + whoo).css({
                opacity: 1
            });

            $('#discount_code').focus();
            $('#info_' + whoo).delay(2000).fadeOut(800);

        } else {

            $('#mensagem_' + whoo).removeClass('alert alert-warning');

            $('#info_' + whoo).addClass('alert alert-info');
            $('#info_' + whoo).html('<p class="fg-black"><i class="icon-smiley on-left"></i>'+obj.info+'</p>');
            //$('#extra_' + whoo).html(obj.extra);
            $('#btn-validar').attr('disabled', 'true');
            var vl_discount_cupom = obj.config[1].discount_values;
            $('#perc_desconto').val(vl_discount_cupom);

            $('#mensagem_' + whoo).delay(4000).fadeOut(600, function() {
                $('#info_' + whoo).fadeOut(400);
            });
        }
    });
}
/*
 **********************************************************
 ***script para controle da confirmação do uso do cupom ***
 **********************************************************
 */
function UsaCupom(cupom){
    //var vl_frete = +($("#vl_frete").val());
    //var vl_discount_avista = $("#vl_discount_avista").val();
    //var vl_discount_cupom = cupom.vl_desconto_cupom;
    //var total_geral = cupom.total_compra - vl_discount_avista - vl_discount_cupom + vl_frete;
    //atualiza o form
    // $('#vl_discount_cupom').val(vl_discount_cupom);
    // $('#str_vl_discount_cupom').html('R$ ' + vl_discount_cupom);
    // $('#total_geral').html('R$ ' + total_geral);
    // $('#ModalCupom').modal('hide');

    return false;
}

/*
 *******************************************************
 ***     script para controle da página de Checkout    ***
 *******************************************************
 */
function chamar_gateway() {
    GerarPedido('formpedido');
}
/*-----------------------------------------------------------------------------------*/
/*  controla A GERAÇÃO DE UM NOVO PEDIDO
 /*-----------------------------------------------------------------------------------*/
function GerarPedido(whoo) {
   // orc_desconto_valor = $('#orc_desconto_valor').val();
    //$('#discount_cupom').val(orc_desconto_valor);
    var url = $('#' + whoo).attr('action');
    var formulario = $('#' + whoo).serializeArray();
    $.post(url, formulario, function(data) {
        var obj = JSON.parse(data);
        if (obj.status === 'fail') {
            CheckOutFail(obj, whoo);
        } else {
            CheckOutSucess(obj, whoo);
        }

    });
}
/*
 **  Erros do checkout **
 */
function CheckOutFail(obj, whoo) {
    $('#mensagem_' + whoo).html('');
    $('#info_' + whoo).html('');
    $('#mensagem_' + whoo).addClass('alert alert-danger');
    $('#mensagem_' + whoo).html('ERRO!');
    $('#mensagem_' + whoo).delay(8000).fadeOut(600, function() {
        $('#info_' + whoo).addClass('alert alert-info');
        $('#info_' + whoo).html('<p class="fg-black"><i class="icon-smiley on-left"></i>Por favor! Não foi possivel fazer o requerimento.</p>');
        $('#info_' + whoo).fadeOut('800');
        $('#info_' + whoo).fadeOut('800');
    });
}
function CheckOutSucess(obj, whoo) {
    console.log(obj);
    var submeter = obj.submeter;

    $('#fase1_' + whoo).fadeIn(600);
    $('#fase2_' + whoo).delay(3000).fadeIn(600);
    $('#fase3_' + whoo).delay(6000).fadeIn(600);
    $('#fase1_' + whoo).delay(9000).fadeOut(400, function() {
        if(submeter){
            CheckoutSubmeter(obj, 'formcheckout');
        }else {
            alert('sdsdjjs');
        }
    });

}

/*
 **  Acessa checkout externo **
 */
function CheckoutSubmeter(obj, form_interno) {
    var neworder_Id = obj.neworder_Id;
    //$('#order_id').val(neworder_Id);
    $('#id_pedido').val(neworder_Id);
    $('#processamento_info').slideUp('slow',function(){
        $('#processamento_finalizado').slideDown('fast');
        $('#'+form_interno).attr('method', obj.metodo);
        $('#'+form_interno).attr('action', obj.url_externa);
        $('#neworder_Id').html(neworder_Id);
    });
    setTimeout(function(){
        $('#'+form_interno).submit()
    },10000);

}

/*
 ******************************************************
 *********** script para controle de email ************
 ******************************************************
 */
function EmailEnviar(whoo, URL){
    var formulario = $('#' + whoo).serializeArray();

    $('#' + whoo).css({
        opacity: 0.2
    });
    $.post(URL, formulario, function(data) {
        console.log(data);
        $('#enviando_' + whoo).delay(4000).fadeOut(200);
        var obj = JSON.parse(data);
        if (obj.status === 'fail') {
            $('#mensagem_' + whoo).html('');
            $('#info_' + whoo).html('');
            $('#mensagem_' + whoo).addClass('alert alert-warning');
            $('#mensagem_' + whoo).html('ERRO! Verifique abaixo');
            $('#mensagem_' + whoo).delay(3000).fadeOut(500);
            //$('#info_' + whoo).addClass('infomsg alert');
            var li = '';
            obj.erro.forEach(function(entry) {
                li += '<li><small>' + entry + '</small></li>';
            });

            $('#info_' + whoo).html('<ul>' + li + '</ul>');
            $('#info_' + whoo).delay(8000).fadeOut(200);
            $('#' + whoo).css({
                opacity: 1
            });
        } else {
            $('#' + whoo).css({
                opacity: 1
            });
            $('#mensagem_' + whoo).removeClass('alert alert-warning');
            $('#mensagem_' + whoo).addClass('alert alert-success');
            $('#mensagem_' + whoo).html('<p class="fg-black"><i class="icon-smiley on-left"></i>SUCESSO! Email encaminhado.</p>');
            $('#mensagem_' + whoo).show();
            console.log(data);
            var obj = JSON.parse(data);
            $('#mensagem_' + whoo).delay(3000).fadeOut(200, function() {

                $.each(obj, function(k, v) {
                    if (k == 'info') {
                        alert(v);
                    }
                });
            });
        }
        console.log(data);
    });
}

/*
 ******************************************************
 ********* fim script para controle de email **********
 ******************************************************
 */