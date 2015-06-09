/*-----------------------------------------------------------------------------------*/
/*  controla o formulário de busca
 /*-----------------------------------------------------------------------------------*/
function search_verifica()
{
    alert('sdjklfjdsf');
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
    if (strMensagem !== '') {
        alert(strMensagem);
        return false;
    }
    return true;
}
/*-----------------------------------------------------------------------------------*/
/*  buscar endereço do cep se existe
 /*-----------------------------------------------------------------------------------*/
function EnderecoCEP() {

    var whoo = "formtipoconta";
    //overlay('on', whoo);
    $('#mensagem_' + whoo).html('');
    $('#info_' + whoo).html('');
    if ($.trim($("#postcode").val()) !== "")
    {
        CEP = $.trim($("#postcode").val());
        $('#mensagem_' + whoo).removeClass('errormsg alert');
        $('#info_' + whoo).removeClass('infomsg alert');
        $.get("http://apps.widenet.com.br/busca-cep/api/cep.json", {code: CEP.replace("-", "")}, function(result) {
            //{

            if (result.status !== 1) {
                alert("Endereço não encontrado para o cep informado " + CEP);
                overlay('off', whoo);
                return;
            }
            var longstring = result.address;
            var street = longstring.split(" - ");
            $("#street").val(unescape(street[0]));
            $("#suburb").val(unescape(result.district));
            $("#city").val(unescape(result.city));
            $("#state").val(unescape(result.state));
            var url = $('#' + whoo).attr('action');
            ValidaTipoConta(whoo, url);
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
        //overlay('on', whoo);
        $('#mensagem_' + whoo).addClass('errormsg alert');
        $('#mensagem_' + whoo).html('ERRO!');
        $('#mensagem_' + whoo).fadeOut(800, function() {
            $('#enviando_' + whoo).delay(1000).fadeOut(500);
            $('#info_' + whoo).addClass('infomsg alert');
            $('#info_' + whoo).html('Por favor! Informe um endereço postal pertinente.');
            //overlay('off', whoo);
            $('#info_' + whoo).delay(2000).fadeOut(400);
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
                $('#mensagem_' + whoo).addClass('errormsg alert');
                $('#mensagem_' + whoo).html('ERRO!');
                $('#mensagem_' + whoo).fadeOut(800, function() {
                    $('#enviando_' + whoo).delay(1000).fadeOut(500);
                    var li = '';
                    obj.erro.forEach(function(entry) {
                        li += '<li>' + entry + '</li>';
                    });
                    $('#info_' + whoo).removeClass('infomsg alert');
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
                $('#mensagem_' + whoo).removeClass('errormsg alert');
                $('#mensagem_' + whoo).addClass('successmsg alert');
                $('#mensagem_' + whoo).html('SUCESSO! Dados validados corretamente.');
                $('#mensagem_' + whoo).delay(1200).fadeOut(800, function() {
                    $('#info_' + whoo).html(obj.info);
                });
                $('#info_' + whoo).delay(1200).fadeOut(400, function() {
                    $('#mensagem_' + whoo).html('');
                    $('#info_' + whoo).removeClass('infomsg alert');
                    $('#info_' + whoo).html('');
                    $('#info_' + whoo).addClass('infomsg alert');
                    $('#' + whoo).attr('action', obj.loadurl);
                    $('#info_' + whoo).html('Aguarde finalizando o cadastro e redirecionando ...');
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
    overlay('on', whoo);
    var formulario = $('#' + whoo).serializeArray();
    var URL = $('#' + whoo).attr('action');
    ///encaminha os dados
    $.post(URL, formulario, function(data) {
        $('#enviando_' + whoo).show();
        var obj = JSON.parse(data);
        if (obj.status === 'fail') {
///se houver falhsa
            overlay('off', whoo);
            $('#mensagem_' + whoo).addClass('errormsg alert');
            $('#mensagem_' + whoo).html('ERRO!');
            $('#enviando_' + whoo).delay(1000).fadeOut(500);
            var li = '';
            obj.erro.forEach(function(entry) {
                li += '<li>' + entry + '</li>';
            });
            $('#info_' + whoo).removeClass('infomsg alert');
            $('#info_' + whoo).html('<ul>' + li + '</ul>');
            $('#info_' + whoo).css('display', 'block');
            $('#' + whoo).css({
                opacity: 1
            });
            //mostra os erros contidos no formulário de cadastro              
            $("#modal-erros").modal('show');
            $('#info_' + whoo).delay(2000).fadeOut(400);
            return false;
        } else {
////se enviar estiver ok
            $('#' + whoo).css({
                opacity: 1
            });
            $('#enviando_' + whoo).delay(1000).fadeOut(500);
            $('#mensagem_' + whoo).removeClass('errormsg alert');
            $('#mensagem_' + whoo).addClass('successmsg alert');
            $('#mensagem_' + whoo).html('SUCESSO! Dados validados corretamente.');
            $('#mensagem_' + whoo).fadeIn(800);
            $('#mensagem_' + whoo).delay(1200).fadeOut(800, function() {
                $('#info_' + whoo).html(obj.info);
            });
            $('#info_' + whoo).delay(1200).fadeOut(400, function() {
                $('#mensagem_' + whoo).html('');
                $('#info_' + whoo).removeClass('infomsg alert');
                $('#info_' + whoo).html('');
                $('#mensagem_' + whoo).addClass('successmsg alert');
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
    var URL = $('#calc').attr('action');
    $('#categ_selecionada').val(categoria);
    var formulario = $('#calc').serializeArray();
    $.post(URL, formulario, function(data) {
        var obj = JSON.parse(data);
        console.log(obj);
        $('#lista_formato').html();
        $('#lista_cores').html();
        $('#lista_papel').html();
        $('#lista_acabamento').html();
        $('#lista_enoblecimento').html();
        $('#lista_preco').html();
        $('#orc_categoria_id').val(current_id);
        $('#orc_categoria_nome').val(categoria);
        $('#tabela').slideUp('slow');
        $('#tabela').slideDown('slow', function() {
            $('#tabela').fadeIn(800, function() {
                $('#nome_escolhido').html(categoria);
                $('#img_escolhida_thumb').html(categoria);
                var imagem = obj.imagem.image;
                if (obj.processamento.erro !== '') {
                    $('#info_calculadora').addClass('notice marker-on-bottom bg-crimson fg-white');
                    $('#info_calculadora').html(obj.informacao.info);
                    $('#info_calculadora').delay(4000).fadeOut(400);
                    $('#tabela').css('display', 'none');
                } else {
                    $('.listview .list.fg-white').each(function(i) {
                        $(this).attr('class', 'list bg-gray fg-white btn-detalhes');
                   });
                    $.each(obj, function(key, val) {
                        /*if (key === 'informacao' && val.info !== '') {
                         $('#info_calculadora').addClass('notice marker-on-bottom bg-cyan fg-white');
                         $('#info_calculadora').html(val.info);
                         erro = true;
                         } else {*/
                        $('#img-escolhido').attr('src', imagem);
                        //erro = false;
                        //}

                        if (key === 'back_menu') {
                            back_menu = val.background;
                            //$('.head-itens').css('background-color', back_menu);
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
                    });
                    // }
                    //   if (erro) {

                    //  } else
                    // {
                    $('#especificacoes_selecionada').slideUp('slow', function() {
                        $('#all_produtos').fadeIn('slow');

                    });
                    //$('#finalizacao').fadeOut(400);
                    $('#lista_perfis').slideUp('slow');
                    $('#orcamento_gerado').slideUp('slow');

                    //$('#all_produtos').fadeOut('slow', function() {
                    //  $('#all_produtos').fadeOut('fast');
                    //});
                }
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
        if (cat_id === '5') {
            $.each(parans, function(k, item) {
                on_click_troca = 'TrocaCheked(\'' + tipo + '\',' + k + ');';
                on_click_calcula = 'CalculaPreco(\'' + category_id + '\',' + k + ');';
                if (tipo !== 'enoblecimento') {
                    radio += '<li>\n<input type=\"radio\" name=\"' + tipo + '\" id=\"' + tipo + '_' + k + '\" onclick=\"' + on_click_troca + '" value=\"' + item.id + '\" />\n\n\
         <span class=\"afasta\" id=\"param_' + tipo + '_' + k + '\">' + item.nome + '</span>\n</li>\n';
                } else {
                    radio += '<li>\n<input type=\"radio\" name=\"' + tipo + '\" id=\"' + tipo + '_' + k + '\" onclick=\"' + on_click_calcula + '" value=\"' + item.id + '\" />\n\n\
         <span class=\"afasta\" id=\"param_' + tipo + '_' + k + '\">' + item.nome + '</span>\n</li>\n';
                }
            });
            $('#lista_' + tipo).html('<ul id="list_' + tipo + '" class=\"list-unstyled\">\n' + radio + '\n</ul>');

        } else {
            $.each(parans, function(k, item) {
                on_click_troca = 'TrocaCheked(\'' + tipo + '\',' + k + ');';
                on_click_calcula = 'CalculaPreco(\'' + category_id + '\',' + k + ');';
                //on_click_calcula = 'CalculaPreco(\'' + category_id + '\',' + k + ');';
                if (tipo !== 'acabamento') {
                    radio += '<li>\n<input type=\"radio\" name=\"' + tipo + '\" id=\"' + tipo + '_' + k + '\" onclick=\"' + on_click_troca + '" value=\"' + item.id + '\" />\n\n\
         <span class=\"afasta\" id=\"param_' + tipo + '_' + k + '\">' + item.nome + '</span>\n</li>\n';
                } else {
                    radio += '<li>\n<input type=\"radio\" name=\"' + tipo + '\" id=\"' + tipo + '_' + k + '\" onclick=\"' + on_click_calcula + '" value=\"' + item.id + '\" />\n\n\
         <span class=\"afasta\" id=\"param_' + tipo + '_' + k + '\">' + item.nome + '</span>\n</li>\n';
                }
            });
        }
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
        <span class=\"afasta\" id=\"preco_' + y + '\"></span>\n\
        </li>\n';
    return valor;
}
/*-----------------------------------------------------------------------------------*/
/*  TrocaCheked
 /*-----------------------------------------------------------------------------------*/
function TrocaCheked(whoo, localizador) {
    $('#especificacoes_selecionadas').slideDown('slow');
    var valor = $('#' + whoo + '_' + localizador).val();
    var param = null;
    if (whoo === 'formato') {
        param = $('#param_formato_' + localizador).text();
        $('#formato_nome').val(param);
        $('#formato_id').val(valor);
        $('#list_cores').each(function(i) {
            $('#cores_' + i).attr("checked", false);
        });
        $('#list_papel').each(function(i) {
            $('#papel_' + i).attr("checked", false);
        });
        $('#list_acabamento').each(function(i) {
            $('#acabamento_' + i).attr("checked", false);
        });
        $('#list_enoblecimento').each(function(i) {
            $('#enoblecimento_' + i).attr("checked", false);
        });
    }
    if (whoo === 'cores') {
        param = $('#param_cores_' + localizador).text();
        $('#cores_id').val(valor);
        $('#cor_nome').val(param);
        $('#list_papel').each(function(i) {
            $('#papel_' + i).attr("checked", false);
        });
        $('#list_acabamento').each(function(i) {
            $('#acabamento_' + i).attr("checked", false);
        });
        $('#list_enoblecimento').each(function(i) {
            $('#enoblecimento_' + i).attr("checked", false);
        });
    }
    if (whoo === 'papel') {
        param = $('#param_papel_' + localizador).text();
        $('#papel_id').val(valor);
        $('#papel_nome').val(param);
        $('#list_acabamento').each(function(i) {
            $('#acabamento_' + i).attr("checked", false);
        });
        $('#list_enoblecimento').each(function(i) {
            $('#enoblecimento_' + i).attr("checked", false);
        });
    }
    if (whoo === 'acabamento') {
        param = $('#param_acabamento_' + localizador).text();
        $('#acabamento_id').val(valor);
        $('#acabamento_nome').val(param);
        $('#list_enoblecimento').each(function(i) {
            $('#enoblecimento_' + i).attr("checked", false);
        });
    }
    if (whoo === 'enoblecimento') {
        param = $('#param_enoblecimento_' + localizador).text();
        $('#enoblecimento_id').val(valor);
        $('#enoblecimento_nome').val(param);
        /*$('#list_formato').each(function(i) {
         $('#formato_' + i).attr("checked", false);
         });
         $('#list_cores').each(function(i) {
         $('#cores_' + i).attr("checked", false);
         });
         $('#list_papel').each(function(i) {
         $('#papel_' + i).attr("checked", false);
         });
         $('#list_acabamento').each(function(i) {
         $('#acabamento_' + i).attr("checked", false);
         });*/
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
    //alert (categoria);
    if (categoria === '5') {
        var enoblecimento_valor = $('#enoblecimento_' + localizador).val();
        var param = $('#param_enoblecimento_' + localizador).text();
        $('#enoblecimento_nome').val(param);
        $('#orc_enoblecimento_id').val(enoblecimento_valor);
        $('#orc_enoblecimento_nome').val(param);
    } else {
        var acabamento_valor = $('#acabamento_' + localizador).val();
        var param = $('#param_acabamento_' + localizador).text();
        $('#acabamento_nome').val(param);
        $('#acabamento_id').val(acabamento_valor);
        $('#orc_acabamento_id').val(acabamento_valor);
        $('#orc_acabamento_nome').val(param);
    }
    var categoria_nome = $('#nome_escolhido').text();
    $('#orc_subcategoria_id').val(categoria);
    $('#orc_subcategoria_nome').val(categoria_nome);

    var url = $('#calculadora').attr('action');
    $('#categ_selecionada').val(categoria);
    var formulario = $('#calculadora').serializeArray();
    $.post(url, formulario, function(data) {

        var localizador = 0;
        //var valor = null;
        var peso_selecionado = '';
        console.log(data);
        data.peso.forEach(function(entry) {
            peso = parseFloat(entry);
            peso_selecionado += '<input type="hidden" name="peso_selecionado" id="peso_selecionado_' + localizador + '" value="' + peso + '" />\n';
            $('#peso_selecionado').html(peso_selecionado);
            //$('#peso_selecionado_'+locali)
            localizador = localizador + 1;
        });
        var localizador = 0;
        /*$('#list_preco').each(function(i) {
         $('#preco_' + i).html('<strong>R$ ' + data.preco[i] + '</strong>');
         $('#pacote_' + i).val(data.preco[i]);
         });*/
        data.preco.forEach(function(entry) {
            valor = parseFloat(entry);
            $('#preco_' + localizador).html('<strong>R$ ' + valor + '</strong>');
            $('#pacote_' + localizador).val(valor);
            $('#pacote_' + localizador).attr('disabled', false);
            localizador = localizador + 1;
        });
        $('#info_tabela').addClass('notice marker-on-bottom bg-amber fg-white');
        $('#info_tabela').html('Escolha a quantidade desejada na lista abaixo.');
        $('#info_tabela').delay(2000).fadeOut(400);

    });
}
/*-----------------------------------------------------------------------------------*/
/*  SetaEscolhas
 /*-----------------------------------------------------------------------------------*/
function SetaEscolhas(localizador, imagem) {
    $('#especificacoes_selecionadas').slideDown('slow');
    $('#all_produtos').fadeOut('slow');
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
    var enoblecimento = $('#enoblecimento_nome').val();
    var formato = $('#formato_nome').val();
    var papel = $('#papel_nome').val();
    var acabamento = $('#acabamento_nome').val();
    var escolhas = {
        "Formato": formato,
        "Papel": papel,
        "Acabamento": acabamento,
        "Cor": cor,
        "Enoblecimento": enoblecimento
    };
    var escolhas_finais = {
        "Produto": produto,
        "Formato": formato,
        "Cores": cor,
        "Material": papel,
        "Acabamento": acabamento,
        "Enoblecimento": enoblecimento,
        "Qtd": qtd,
        "Valor": preco
    };
    var li = '';
    $.each(escolhas_finais, function(item, valor) {
        li += '<li>' + item + ': ' + valor + '</li>';
    });
    $('#lista_especificacao').html(li);
    var th = '<th class="text-center" style="width:14%">Imagem</th>';
    var td = '<td style="width:14%"><img id="image_escolhida" src="" alt="" title="" width="100%" class="polaroid"  style="max-width:100px"  /></td>';
    $.each(escolhas, function(item, valor) {
        //console.log(item);
        th += '\n<th class="text-center" style="width:14%">\n' + item + '\n</th>\n';
        td += '\n<td class="text-center" style="width:14%">\n<b class=\"red\">' + valor + '</b>\n</td>\n';
    });
    th += '\n<th class="text-center" style="width:14%">\nQtd/Valor\n</th>\n';
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
        $('#img-escolhido').attr('src', imagem);
    });
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
    $('#orcamento_gerado').fadeOut(800);
    var categoria = $('#escolhido').val();
    var url_modal = 'lista_perfis' + '/' + categoria;
    $.getJSON(
            url_modal,
            function(data) {
                //console.log(data);
                var div = '';
                var button = '';
                if (data.info !== 'erro') {
                    $.each(data, function(key, val) {
                        div += '<div class="row fluid">';
                        $.each(val, function(k, item) {
                            //alert(item.nome_perfil);
                            button += '<div class="umquarto bg-dark">\n\
                                        <button type="button" class=" btn bg-dark fg-white no-radius" onclick="VerTemplate(\'' + item.id_perfil + '\', \'' + item.nome_perfil + '\')"  title="Escolher o template para ' + item.nome_perfil + '">\n\
                                        <img title="' + item.nome_perfil + '" src="' + item.logo_perfil + '" class="img-responsive pull-left">\n\
                                        <span class="pull-lef text-medio">' + item.nome_perfil + '</span>\n\
                                </button></div>';
                        });
                        div += button + '</div><div class="clearfix"></div>';
                        button = '';
                    });
                    $('#listview').html(div);
                    //$('#info_perfis').addClass('notice marker-on-bottom bg-orange fg-black');
                    //$('#info_perfis').html('<p class="title"><i class="icon-smiley on-left"></i> Escolha um perfil que mais se adequa as suas necessidade.</p>');
                    //$('#info_perfis').delay(3000).fadeOut(400, function() {
                    //$('#especificacoes_selecionada').slideUp('fast');
                    //});
                    //$('#lista_perfis').slideUp('slow');
                    $('#info_perfis').delay(3000).fadeOut(400);
                    $('#lista_perfis').fadeIn(800);
                    $('#ModalPerfil').modal('show');
                } else {
                    //$('#listview').html(div);
                    $('#info_perfis').addClass('notice marker-on-bottom bg-red fg-white');
                    $('#info_perfis').html('<p class="title"><i class="icon-smiley on-left"></i> Ainda não existem perfis incorporados a essa categoria.</p>');
                    $('#info_perfis').delay(3000).fadeOut(400, function() {
                        $('.example.detalhes').slideDown('fast');
                    });
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
            //amount = parseFloat(RadioFrete[i].value) + parseFloat(montante);
            //amount = amount.toFixed(2);
            //amount = amount.replace('.', ',');
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
    // alert("montagem do orcamento")
}
/*-----------------------------------------------------------------------------------*/
/*  VerTemplate
 /*-----------------------------------------------------------------------------------*/
function VerTemplate(id, nome) {
    $('#orc_id_perfil').val(id);
    $('#orc_nome_perfil').val(nome);
    var token = $('#especificacoes_selecionada').attr('data-token');
    $('.token').val(token);
    $('#cupom_frete').slideDown('slow');
    $('#ModalPerfil').modal('hide');
    //$('#lista_perfis').fadeOut(400);
    //$('#image_finalizacao').css('display', 'block');
    //$('#finalizacao').fadeIn(800);
    //$('#btns').css('display', 'block');
    //return false;
    var action = 'produtos/portfolio.html';
    $('#form_orcamento').attr('action', action);
    $('#form_orcamento').attr('method', 'post');
    //return VerPortfolio();
}
/*-----------------------------------------------------------------------------------*/
/*  Encerrar
 /*-----------------------------------------------------------------------------------*/
function Encerrar(step, logado) {
    if (logado) {
        $('#logar').css('display', 'none');
        if (step === 'orcar') {
            var action = 'produtos/orcamento.html';
            $('#form_orcamento').attr('action', action);
            $('#form_orcamento').attr('method', 'post');
            return CalcularFrete();
        } else {
            EscolhaPerfil();
        }
    } else {
        $('#logar').css('display', 'block');
    }

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
/*  VerPortfolio
 /*-----------------------------------------------------------------------------------*/
function VerPortfolio() {
    $('#orc_id_perfil').val();

    //var formulario = $('#form_orcamento').serializeArray();
    //$('#produto_id').val(produto_id);
    $('#portfolio').css('display', 'block');
    $('#info_portfolio').addClass('fg-black');
    $('#info_portfolio').html('<p class="text-warning lead"><i class="icon-smiley on-left"></i> Aguarde enquanto estamos redirecionando para o portfólio de produtos.</p>');
    $('#info_portfolio').delay(3000).fadeOut(400, function() {
        $('#form_orcamento').submit();
    });
    //$('#listagem').slideUp('slow', function() {
    //   $('#form_comprar').slideDown('fast', function() {

    //   });
    //});
}
/*-----------------------------------------------------------------------------------*/
/*  AdicionarCarrinho 
 /*-----------------------------------------------------------------------------------*/
function AdicionarCarrinho(produto_id) {
    $('#produto_id').val(produto_id);
    var URL = 'adicionar';
    var formulario = $('#basket').serializeArray();
    $.post(URL, formulario, function(data) {
        console.log(data);


        $('#modalAdicionando').modal('show');
    });
    /*$.Dialog({
     overlay: true,
     shadow: true,
     flat: false,
     icon: '<img src="images/icons/icone-box-car.jpg">',
     title: 'Seu Carrinho',
     content: '',
     padding: 10,
     onShow: function(_dialog) {
     var content = '<h2 class="subheader-secondary">Produto adicionado na cesta.</h2>\n\
     <div class="form-actions">\n\
     <button type="button" class="info fg-white small" onclick="BasketSubmeter();">\n\
     <i class="icon-basket on-left"></i>Finalizar</button>\n\
     <button class="success fg-white small" type="button" onclick="$.Dialog.close()">Continuar Comprando</button>\n\
     </div>';
     $.Dialog.title("Seu Carrinho");
     $.Dialog.content(content);
     $.Metro.initInputs();
     }
     });*/
}
/*-----------------------------------------------------------------------------------*/
/*  AdicionarEdicao
 /*-----------------------------------------------------------------------------------*/
function AdicionarEdicao(produto_id, add) {
    $('#produto_id').val(produto_id);
    $produto = $('#' + add);
    var URL = $produto.data('url');
    var formulario = $('#basket').serializeArray();
    $.post(URL, formulario, function(data) {
        console.log(data);
    });
}

/*-----------------------------------------------------------------------------------*/
/*  Editar Template
 /*-----------------------------------------------------------------------------------*/
function EditarTemplates(guest) {
    var url = 'editor/personalizar.html';
    //alert(url);
    //var $formulario = $('#form_orcamento');
    if (guest === '1') {
        $('#form_orcamento').attr('action', url);
        $('#form_orcamento').submit();
        $('#logar').slideUp('fast');
    } else {
        $('#logar').slideDown('fast');
    }

}

/*-----------------------------------------------------------------------------------*/
/*  BasketSubmeter
 /*-----------------------------------------------------------------------------------*/
function BasketSubmeter() {
//var formulario = $('#basket').serializeArray();
//$('#form_orcamento').submit();
//$('#info_basket').addClass('notice marker-on-bottom bg-orange fg-black');
//$('#info_basket').html('<p class="tertiary-text"><i class="icon-smiley on-left"></i> Verificando dados para enviar para o carinho.</p>');
//$('#info_basket').delay(2000).fadeOut(800, function() {
//     $('#basket').submit();
// });
    //$.Dialog.close();
    $('#info_basket').addClass('alert alert-success');
    $('#info_basket').html('<p class="fg-white"><i class="icon-smiley on-left"></i> Verificando dados para enviar para o carrinho. Aguarde...</p>');
    $('#info_basket').fadeOut(800, function() {
        $('#basket').submit();
    });
}
/*-----------------------------------------------------------------------------------*/
/*  FreteOrcamento
 /*-----------------------------------------------------------------------------------*/
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
        //console.log(obj);
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
            $('#desconto').css('display', 'block');
        });
    });
}
/*-----------------------------------------------------------------------------------*/
/*  SetaFrete
 /*-----------------------------------------------------------------------------------*/
function SetaFrete(tipo, id) {
    var vl_frete = $('#' + id).val();
    $('#formas_pagamento').css('display', 'block');
    $('#orc_vl_frete').val(tipo);
    $('#orc_tipo_frete').val(vl_frete);
    $('#vl_frete_escolhido').val(vl_frete);
    $('#tipo_frete').val(tipo);
    $('#tipo_escolha_frete').html(tipo);
    $('#escolha_frete').html('R$ ' + vl_frete);
    $('#vl_frete_escolhido').val(vl_frete);
    $('#tipo_frete_escolhido').val(tipo);
}
/*-----------------------------------------------------------------------------------*/
/*  SetaFreteOrcamento
 /*-----------------------------------------------------------------------------------*/
function SetaFreteOrcamento(tipo, id) {
    var vl_frete = $('#' + id).val();
    var vl_final = $('#orc_pacote_valor').val();
    $('#orc_vl_frete').val(tipo);
    $('#vl_frete_final').text(vl_frete);
    $('#vl_final').text(vl_final);
    $('#orc_tipo_frete').val(vl_frete);
    $('#vl_frete_escolhido').val(vl_frete);
    $('#tipo_frete').val(tipo);
    $('#tipo_escolha_frete').html(tipo);
    $('#escolha_frete').html('R$ ' + vl_frete);
    $('#vl_frete_escolhido').val(vl_frete);
    $('#tipo_frete_escolhido').val(tipo);
    $('#label_frete').fadeIn(400);
    $('#vl_total_final').text(parseFloat(vl_final.replace(",", ".")) + parseFloat(vl_frete));
    //$('#form_orcamento').attr('action', 'produtos/orcamento');
    //$('#form_orcamento').submit();
    $('#info_correio').html('Aguarde enquanto redirecionamos para o portfólio ...');
    $('#info_correio').fadeIn(800);
    $('#info_correio').delay(1000).fadeOut(400, function() {
        EditarTemplates('1');
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
function ValidaCarrinho(whoo, URL)
{
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
        $('#mensagem_' + whoo).addClass('errormsg alert');
        $('#mensagem_' + whoo).html('ERRO!');
        $('#mensagem_' + whoo).delay(2000).fadeOut(800, function() {
            //$('#enviando_' + whoo).delay(1000).fadeOut(500);
            $('#info_' + whoo).addClass('infomsg alert');
            $('#info_' + whoo).html('Por favor! Para prosseguir é necessário o valor do frete, o tipo de frete e a forma de pagamento.');
            $('#' + whoo).css({
                opacity: 1
            });
        });
        $('#info_' + whoo).delay(2000).fadeOut(800);
        //overlay('off', whoo);
        //$('info_calc_frete').addClass('errormsg alert');
        // $('#info_calc_frete').html(mensagem);
        //$('#info_calc_frete').delay(2000).fadeOut(800);
        //$('#info_calc_frete').html('');
    } else {
        //overlay('on', whoo);
        //$('#enviando_' + whoo).show();
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
function AtualizarCarrinho(product)
{
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
function RemoverItem(product)
{
    $.get('basket/remover', {'product_id': product}, function(result) {
        console.log(result);
        var obj = JSON.parse(result);
        if (obj.action === true) {
            $('#info_carrinho').html('<div class="alert alert-success" role="alert"><p class="text-info">' + obj.info + ' <img src="images/img/loader.gif" /></p></div>');
        } else {
            $('#info_carrinho').html('<div class="alert alert-warning" role="alert"><p class="text-warning">' + obj.info + ' <img src="images/img/loader.gif" /></p></div>');
        }
        $('#info_carrinho').delay(5000, function() {
            document.location.reload(true);
        });
    });
}
/*******************************************************
 ***     script para controle da página de resumo    ***
 *******************************************************
 */
function VerificaConcorde(whoo) {
    if (!$("#agree").is(':checked')) {
        $('#mensagem_' + whoo).addClass('alert strong');
        $('#mensagem_' + whoo).html('ERRO!');
        $('#info_' + whoo).addClass('padding5 bg-cyan fg-white strong');
        $('#info_' + whoo).html('Por favor! <strong>É necessário o concorde dos dados apresentados.</strong>');
        $('#mensagem_' + whoo).delay(3000).fadeOut(400);
        $('#info_' + whoo).delay(5000).fadeOut(800);
        return false;
    }
}
function ValidaCaixa(whoo, URL)
{
    VerificaConcorde(whoo);
    var payment = $('#payment').val();
    var discount_cupom = $('#discount_cupom').val();
    ;
    var total_compra = $('#total_compra').val();
    var vl_frete = $('#vl_frete').val();
    var tipo_frete = $('#tipo_frete').val();
    $('#mensagem_' + whoo).html('');
    $('#info_' + whoo).html('');
    if (payment === '' || discount_cupom === '' || total_compra === '' || vl_frete === '' || tipo_frete === '') {
        $('#mensagem_' + whoo).html('');
        $('#info_' + whoo).html('');
        $('#mensagem_' + whoo).addClass('errormsg alert');
        $('#mensagem_' + whoo).html('ERRO!');
        $('#mensagem_' + whoo).delay(2000).fadeOut(800, function() {
            //$('#enviando_' + whoo).delay(1000).fadeOut(500);
            $('#info_' + whoo).addClass('infomsg alert');
            $('#info_' + whoo).html('Por favor! Verifique os dados informados.');
        });
        $('#mensagem_' + whoo).delay(3000).fadeOut(400);
        $('#info_' + whoo).delay(5000).fadeOut(800);
    } else {
        var formulario = $('#' + whoo).serializeArray();
        var url_validacao = 'loja/validacaixa';
        $.post(url_validacao, formulario, function(data) {
            console.log(url_validacao);
            var obj = JSON.parse(data);
            if (obj.status === 'fail') {
                $('#mensagem_' + whoo).addClass('alert strong');
                $('#mensagem_' + whoo).html(obj.info);
                $('#info_' + whoo).addClass('padding5 bg-cyan fg-white strong');
                $('#info_' + whoo).html('<strong>' + obj.erro + '</strong>');
                $('#info_' + whoo).delay(5000).fadeOut(800);
            }
            else {
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
    return false;
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
 ***   script para controle da página de carrinho    ***
 *******************************************************
 */
function ValidaCupom(whoo, URL)
{

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
            $('#mensagem_' + whoo).addClass('notice marker-on-bottom bg-orange fg-black');
            $('#mensagem_' + whoo).html('ERRO!');
            $('#mensagem_' + whoo).delay(2000).fadeOut(500);
            $('#enviando_' + whoo).delay(1000).fadeOut(500);
            $('#info_' + whoo).addClass('notice marker-on-bottom bg-orange fg-black');
            var li = '';
            obj.erro.forEach(function(entry) {
                li += '<li>' + entry + '</li>';
            });
            $('#info_' + whoo).html('<ul>' + li + '</ul>');
            $('#' + whoo).css({
                opacity: 1
            });
            //overlay('off', whoo);
            $('#discount_code').focus();
            $('#info_' + whoo).delay(2000).fadeOut(800);
            //overlay('off', whoo);
        } else {
            //overlay('off', whoo);
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
/*
 *******************************************************
 ***   script para controle da página de carrinho    ***
 *******************************************************
 */
function CriarConta(token) {
//$("#createFlatWindow").on('click', function(){
    $.Dialog({
        overlay: true,
        shadow: true,
        flat: false,
        title: 'Criar uma conta',
        content: '',
        width: 500,
        padding: 10,
        onShow: function(_dialog) {
            var content = '<form id="formtipoconta" name="formtipoconta" method="post" action="tipoContaJson">\n' +
                    '<div id="mensagem_formtipoconta"></div>\n\
                    <div id="info_formtipoconta"></div>\n\
                    <fieldset>\n\
                        <label class="control-label"><span class="red">*</span>Tipo de conta:</label>\n\
                       <div class="input-control radio default-style inline-block" data-role="input-control">\n\
                            <label class="inline-block">\n\
                                <input type="radio" name="customers_pf_pj" value="f" checked />\n\
                                <span class="check"></span>\n\
                                Pessoa Física\n\
                            </label>\n\
                            <label class="inline-block">\n\
                                <input type="radio" value="j" name="customers_pf_pj" />\n\
                                <span class="check"></span>\n\
                                Pessoa Jurídica\n\
                            </label>\n\
                        </div>\n\
                        <label>CEP</label>\n\
                        <div class="input-control text" data-role="input-control" >\n\
                            <input type="text" placeholder="Informe o cep" id="postcode" name="entry_postcode">\n\
                            <input id="street" name="street" type="hidden" />\n\
                                <input id="suburb" name="suburb" type="hidden" />\n\
                                <input id="city" name="city" type="hidden" />\n\
                                <input id="state" name="state" type="hidden" />\n\
                            <input type="hidden" name="_token" value="' + token + '"/>\n\
                            <button type="button" class="btn-search" onclick="javascript:EnderecoCEP();"></button>\n\
                        </div>\n\
                        <label></label>\n\
                        <div class="input-control text" data-role="input-control" >\n\
                            <button type="button" class="small warning fg-white" id="btn_tipoconta">Enviar os dados</button>\n\
                        </div>\n\
                    </fieldset>\n\
                    </form>';
            $.Dialog.title("Crie sua conta");
            $.Dialog.content(content);
            $.Metro.initInputs();
        }
    });
//});
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
    var payment = $('#payment').val();
    var discount_cupom = $('#discount_cupom').val();
    var total_compra = $('#total_compra').val();
    var vl_frete = $('#vl_frete').val();
    var tipo_frete = $('#tipo_frete').val();
    if (payment === '' || discount_cupom === '' || total_compra === '' || vl_frete === '' || tipo_frete === '') {
        $('#mensagem_' + whoo).addClass('errormsg alert');
        $('#mensagem_' + whoo).html('ERRO!');
        $('#mensagem_' + whoo).delay(2000).fadeOut(600, function() {
            $('#info_' + whoo).addClass('infomsg alert');
            $('#info_' + whoo).html('Por favor! Verifique os valores para tipo de pagamento, valor para desconto a vista, valor do frete e o total da compra.');
        });
        console.log($('#info_' + whoo));
        return false;
    } else {
        var url = $('#' + whoo).attr('action');
        var formulario = $('#' + whoo).serializeArray();
        //$('#fase1_' + whoo).fadeIn(200);
        $.post(url, formulario, function(data) {
            console.log(data);
            //alert(whoo);
            var obj = JSON.parse(data);
            if (obj.status === 'fail') {
                CheckoutFail(obj, whoo);
            } else {
                //var url_externa = obj.url_externa;
                //var url_interna = obj.url_interna;
                var neworder_id = obj.neworder_id;
                var submeter = obj.submeter;
                $('#neworder_id').html('\'' + neworder_id + '\'');
                $('#mensagem_' + whoo).html('');
                $('#info_' + whoo).html('');
                $('#fase_' + whoo).fadeIn('fast');
                $('#fase0_' + whoo).delay(2000).fadeIn(400);
                $('#fase0_' + whoo).delay(4000).fadeOut(600, function() {
                    $('#fase1_' + whoo).delay(4000).fadeIn(600);
                    $('#fase1_' + whoo).delay(2000, function() {
                        $('#fase2_' + whoo).delay(4000).fadeIn(600);
                        $('#fase2_' + whoo).delay(2000, function() {
                            $('#fase3_' + whoo).delay(4000).fadeIn(600);
                            $('#fase3_' + whoo).delay(2000, function() {
                                if (submeter) {
                                    alert('submeter');
                                    //$('#formfinalizacao').attr('action', url_externa);
                                    // CheckoutSubmeter(obj, whoo, 'formfinalizacao', payment);
                                } else {
                                    //alert('oeouroeur');
                                    CheckoutNao_Submeter(obj, whoo, 'formfinalizacao', payment);
                                }
                            });
                        });
                    });
                });
            }
        });
    }
}
/*-----------------------------------------------------------------------------------*/
/*  VERIFICA SE O GATEWAY USADO NECESSITA USAR URL EXTERNA
 /*-----------------------------------------------------------------------------------*/
function CheckoutNao_Submeter(obj, whoo, form_externo, payment) {
    //var metodo = obj.metodo;
    var $btn_boleto = $('#btn_boleto');
    $btn_boleto.on('click', function() {
        window.location = url_interna;
    });
    $('#' + form_externo).serializeArray();
    $('#mensagem_' + form_externo).html('');
    $('#info_' + form_externo).html('');
    $('#fase3_' + whoo).delay(4000).fadeOut(400, function() {
        //overlay('off', whoo);
        $('#processando').slideUp('slow', function() {
            $('#processamento_finalizado').slideDown();
            $('#fase4_formfinalizacao').show();
            $('#neworder_Id').html(obj.neworder_Id);
            $('#enviando_' + form_externo).css('display', 'block');
        });
    });
}