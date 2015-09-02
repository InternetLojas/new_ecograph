<!-- DETALHES-->
<div class="title_content">
    <p class="uppercase bold">
        <img src="images/icons/calculadora.png" width="35" alt="calculadora.png" />
        Calculadora Online - Cartão Grátis
        <span id="nome_escolhido"></span><br>
    </p>
    <span style="font-size:90%">Selecione as opções:</span>
</div>
<div class="row">
    <div class="destaque_home">
        <!--============================== content =================================-->
        <div class="col-md-12">

            <div class="">
                <div id="info_erro"></div>
                <div class="listview">
                    <a style="width:100%" class="list bg-gray fg-white btn-detalhes" href="#">
                        <div class="list-content">
                            <div class="data"></div>
                        </div>
                    </a>
                </div>
                <table class="table table-bordered ">
                    <thead class="bg-very-smallgray text-center text-medio">
                    <tr>
                        <th class="text-center">Formato</th>
                        <th class="text-center">Cores</th>
                        <th class="text-center">Papel/Material</th>
                        <th class="text-center">Enobrecimento</th>
                        <th class="text-center">Acabamento</th>
                        <th class="text-center">
                            Qtd/Valor
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="bg-fracogray text-medio">
                        <td id="lista_formato">
                            <ul class="list-unstyled" id="list_formato">
                                <li>
                                    <input type="radio" value="1" onclick="TrocaCheked('formato',0,'29');" id="formato_0" name="formato">
                                    <span id="param_formato_0" class="afasta">4 x 5 cm</span>
                                </li>
                                <!--<li>
                                    <input type="radio" value="2" onclick="TrocaCheked('formato',1,'29');" id="formato_1" name="formato">

                                    <span id="param_formato_1" class="afasta">5 x 5 cm</span>
                                </li>
                                <li>
                                    <input type="radio" value="3" onclick="TrocaCheked('formato',2,'29');" id="formato_2" name="formato">

                                    <span id="param_formato_2" class="afasta">8 x 5 cm</span>
                                </li>
                                <li>
                                    <input type="radio" value="4" onclick="TrocaCheked('formato',3,'29');" id="formato_3" name="formato">

                                    <span id="param_formato_3" class="afasta">9 x 5 cm</span>
                                </li>
                                <li>
                                    <input type="radio" value="5" onclick="TrocaCheked('formato',4,'29');" id="formato_4" name="formato">

                                    <span id="param_formato_4" class="afasta">8,5 x 5,4 cm</span>
                                </li>-->

                            </ul>
                        </td>
                        <td id="lista_cores">
                            <ul class="list-unstyled" id="list_cores">
                                <li>
                                    <input type="radio" value="1" onclick="TrocaCheked('cores',0,'29');" id="cores_0" name="cores">

                                    <span id="param_cores_0" class="afasta">4x0 cores</span>
                                </li>
                                <!--<li>
                                    <input type="radio" value="2" onclick="TrocaCheked('cores',1,'29');" id="cores_1" name="cores">

                                    <span id="param_cores_1" class="afasta">4x4 cores</span>
                                </li>-->

                            </ul>
                        </td>
                        <td id="lista_papel">
                            <ul class="list-unstyled" id="list_papel">
                                <li>
                                    <input type="radio" value="1" onclick="TrocaCheked('papel',0,'29');" id="papel_0" name="papel">
                                    <span id="param_papel_0" class="afasta">couche 300g</span>
                                </li>
                                <!-- <li>
                                     <input type="radio" value="2" onclick="TrocaCheked('papel',1,'29');" id="papel_1" name="papel">

                                     <span id="param_papel_1" class="afasta">reciclado 300g</span>
                                 </li>
                                 <li>
                                     <input type="radio" value="3" onclick="TrocaCheked('papel',2,'29');" id="papel_2" name="papel">

                                     <span id="param_papel_2" class="afasta">pvc 0,30</span>
                                 </li>-->

                            </ul>
                        </td>
                        <td id="lista_enoblecimento">
                            <ul class="list-unstyled" id="list_enoblecimento">
                                <!-- <li>
                                     <input type="radio" value="1" onclick="TrocaCheked('enoblecimento',0,'29');" id="enoblecimento_0" name="enoblecimento">
                                     <span id="param_enoblecimento_0" class="afasta">Cantos Arredondados</span>
                                 </li>
                                 <li>
                                     <input type="radio" value="2" onclick="TrocaCheked('enoblecimento',1,'29');" id="enoblecimento_1" name="enoblecimento">
                                     <span id="param_enoblecimento_1" class="afasta">Corte Especial</span>
                                 </li>-->
                                <li>
                                    <input type="radio" value="3" onclick="TrocaCheked('enoblecimento',2,'29');" id="enoblecimento_2" name="enoblecimento">
                                    <span id="param_enoblecimento_2" class="afasta">Corte Reto</span>
                                </li>

                            </ul>
                        </td>
                        <td id="lista_acabamento">
                            <ul class="list-unstyled" id="list_acabamento">
                                <li>
                                     <input type="radio" disabled="" value="1" onclick="CalculaPreco('29',0);" id="acabamento_0" name="acabamento">

                                     <span id="param_acabamento_0" class="afasta">Laminação brilho</span>
                                 </li>
                                 <li>
                                     <input type="radio" disabled="" value="2" onclick="CalculaPreco('29',1);" id="acabamento_1" name="acabamento">

                                     <span id="param_acabamento_1" class="afasta">Sem acabamento</span>
                                 </li>
                                 <li>
                                     <input type="radio" disabled="" value="3" onclick="CalculaPreco('29',2);" id="acabamento_2" name="acabamento">

                                     <span id="param_acabamento_2" class="afasta">Lam. Fosca + verniz localizado</span>
                                 </li>
                                 <li>
                                     <input type="radio" disabled="" value="4" onclick="CalculaPreco('29',3);" id="acabamento_3" name="acabamento">
                                     <span id="param_acabamento_3" class="afasta">Laminação  fosca</span>
                                 </li>
                                 <li>
                                     <input type="radio" disabled="" value="5" onclick="CalculaPreco('29',4);" id="acabamento_4" name="acabamento">

                                     <span id="param_acabamento_4" class="afasta">Laminação brilho</span>
                                 </li>
                                 <li>
                                     <input type="radio" disabled="" value="6" onclick="CalculaPreco('29',5);" id="acabamento_5" name="acabamento">

                                     <span id="param_acabamento_5" class="afasta">Sem enobrecimento</span>
                                 </li>
                                 <li>
                                     <input type="radio" disabled="" value="7" onclick="CalculaPreco('29',6);" id="acabamento_6" name="acabamento">
                                     <span id="param_acabamento_6" class="afasta">Laminação brilho</span>
                                 </li>
                                <li>
                                    <input type="radio" disabled="" value="8" onclick="CalculaPreco('29',7);" id="acabamento_7" name="acabamento">
                                    <span id="param_acabamento_7" class="afasta">Laminação  fosca</span>
                                </li>
                                <li>
                                    <input type="radio" disabled="" value="9" onclick="CalculaPreco('29',8);" id="acabamento_8" name="acabamento">
                                    <span id="param_acabamento_8" class="afasta">Lam. Fosca + verniz localizado</span>
                                </li>

                            </ul>
                        </td>
                        <td id="lista_preco">
                            <ul class="list-unstyled" id="list_preco">
                                <li>
                                    <!--<input type="radio" value="0.00" onclick="SetaEscolhas('0','images/categorias/cartaovisita.png')" id="pacote_0" name="pacote" >-->
                                    <span id="qtd_0" class="afasta">150 un</span>
                                    <span id="preco_0" class="right afasta">R$ 0,00</span>
                                </li>
                            </ul>
                        </td>
                    </tr>
                    </tbody>
                </table>

                <div id="cupom_frete" style="" data-acao="imprimir">
                    <!--<div class="col-md-6">
                        <div class="well well-md">
                            <p class="text-medio" style="min-height:60px">
                                Ganhe descontos na sua compra.<br>
                                Se você possue código de desconto informe no campo abaixo e clique para validá-lo.
                            </p>
                            <div id="info_cupom"></div>
                            <div id="mensagem_cupom"></div>
                            <span style="display:block;float:left">
                                <img id="wait-cupom" style="display:none" src="images/img/loader.gif" class="img-responsive" alt="Image" width="16">
                            </span>
                            <form class="form-horizontal" role="form" id="cupom" name="cupom">
                                <div class="form-group">
                                    <div class="col-md-3 col-md-push-1">
                                        <label for="discount_code">
                                            <span class="btn text-medio  bg-smallgray btn-block no-radius">Cupom</span>
                                        </label>
                                    </div>
                                    <div class="col-md-5">
                                        <input id="discount_code" name="discount_code" class="form-control no-radius" placeholder="Informe Codigo" required="" type="text">
                                    </div>
                                    <div class="col-md-pull-1 col-md-2">
                                        <a href="javascript:void(0)" id="btn-validar" class="btn bg-yellow fg-black no-radius" onclick="javascript:ValidaCupom('cupom', 'desconto');" title="Valide seu cupom">
                                            <span style="float:left">Validar</span>
                                        </a>
                                        --<button type="button" id="btn_cupom_confirmar" class="btn bg-gray fg-black no-radius" style="display:none">Confirmar</button>--
                                    </div>
                                </div>
                                <input name="_token" value="jEewd1LSU9rpKshAz06QMub59Kc0CpZqaZ0bigc9" class="token" type="hidden">
                                <input id="perc_desconto" name="perc_desconto" type="hidden">
                            </form>
                        </div>
                    </div>-->
                    <div class="col-md-12">
                        <div class="well well-md">
                            <p class="text-medio" style="min-height:60px">
                                Informe o CEP para pesquisar o valor do frete:<br>
                            </p>

                            <span style="display:block;float:left" >
                                <img id="wait" style="display:none" src="images/img/loader.gif" class="img-responsive" alt="Image" width="16">
                            </span>
                            <form class="form-horizontal" role="form" id="correio" name="correio">
                                <div class="form-group">
                                    <div class="col-md-3 col-md-push-1">
                                        <label for="orc_cep">
                                            <span class="btn text-medio bg-smallgray btn-block no-radius" >Frete</span>
                                        </label>
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" class="form-control no-radius" placeholder="Informe o cep" id="orc_cep" name="orc_cep" >
                                    </div>
                                    <div class="col-md-pull-1 col-md-2">
                                        <a href="javascript:void(0)" class="btn bg-yellow fg-black no-radius" onclick="javascript:FreteOrcamento();">
                                            <span style="float:left">Calcular</span>
                                        </a>
                                    </div>
                                </div>
                                <input id="perc_desconto" name="perc_desconto" type="hidden" value="0">
                                <input type="hidden" id="pdf" name="pdf" value="0"/>
                                <input type="hidden" id="vl_declarado" name="vl_declarado" value="0.00"/>
                                <input type="hidden" name="_token" value="{!!csrf_token()!!}" class="token"/>
                                <input type="hidden" id="orc_peso_frete" name="orc_peso" value="0.30">
                            </form>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <hr>
                <div id="mensagens" style="display:none">
                    <div class="col-md-12">
                        <div id="info_correio"></div>
                        <div id="mensagem_correio"></div>
                    </div>
                </div>
                <div id="resultado" style="display:none;">
                    <div class="text-center">
                        <p class="text-medio text-center"><strong>Escolha uma forma de envio para continuar.</strong></p>
                        <!-- RESULTADO DO FRETE-->

                        <div class="col-md-12 text-center">
                            <form class="form-inline">
                                <div class="form-group">
                                    <ul class="list-group list-inline text-medio">
                                        <li class="list-group-item">
                                            <label for="vl_frete"> SEDEX: <span id="vl_sedex"></span> </label>
                                            <input id="frete_sedex" class="form-control" value="" name="vl_frete" onclick="SetaFrete('SEDEX', 'frete_sedex')" type="radio">
                                        </li>
                                        <li class="list-group-item">
                                            <label for="vl_frete">TRANSPORTADORA (<small class="fg-red">o cliente escolhe sua transportadora</small>) </label>
                                            <input id="frete_transportadora" class="form-control" value="0.00" name="vl_frete" onclick="SetaFrete('TRANSPORTADORA', 'frete_transportadora')" type="radio">
                                        </li>
                                        <li class="list-group-item">
                                            <label for="vl_frete">RETIRAR NA LOJA (<small class="fg-red">sem custo para envio</small>)</label>
                                            <input id="frete_retirar_loja" class="form-control" value="0.00" name="vl_frete" onclick="SetaFrete('RETIRAR NA LOJA', 'frete_retirar_loja')" type="radio">
                                        </li>
                                    </ul>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div id="label_frete" style="display:none;padding:10px 0">
                        <table class="table table-hover text-medio text-center">
                            <tbody>
                            <tr>
                                <td>
                                    Resumo: Valor - <span id="vl_final"></span>
                                </td>
                                <td>
                                    Desconto: - <span id="vl_desc_final"></span>
                                </td>
                                <td>
                                    Frete: - <span id="escolha_frete"></span>
                                </td>
                                <td>
                                    Valor Total: - <span id="vl_total_final"></span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="especificacoes_selecionada" style="display:none;" data-token="{!!csrf_token()!!}">
                    <!--============================== content =================================-->
                    <div class="col-md-2 ">
                        <div class="thumbnail bg-fracogray text-center">
                            <span class="badge fg-black position-top" id="img_escolhida_thumb">Cartão de visita Grátis</span>
                            <img id="image_escolhida" src="images/categorias/cartaovisita.png" alt="" title="" class="img-responsive img-thumbnail">
                        </div>
                    </div>
                    <div class="col-md-3 text-medio">
                        <p><b>Especificações Selecionadas</b></p>
                        <ul class="list-unstyled" id="lista_especificacao">
                            <li>Produto: Cartão de visita Grátis</li>
                            <li>Formato: 4 x 5 cm</li>
                            <li>Cores: 4x0 cores</li>
                            <li>Material: couche 300g</li>
                            <li>Acabamento: Laminação  fosca</li>
                            <li>Qtd: 150 un</li>
                            <li>Valor: R$ 0,00</li>
                        </ul>
                    </div>
                    <div class="col-md-2">
                        <div class="text-center text-medio">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="col-sm-4">
                            <img src="images/icons/logo_info_desenho.jpg" alt="printer.jpg" class="img-responsive">
                        </div>
                        <div class="col-sm-8">
                            <button type="button" class="btn bg-smallgray btn-lg no-radius text-center" title="Deixe que criamos sua arte" onclick="PersonalizarDesenho( '1' );">
                                <small>Escolha um template</small>
                            </button>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                    <div class="destaque_home" id="btn-opcoes" style="display:none">
                        <div id="info_encerrar"></div>
                        <div class="well well-md">
                            <button style="margin:auto" type="button" class="btn bg-smallgray fg-black no-radius text-medio" id="btn-encerrar" onclick="Encerrar()">
                                CONTINUAR
                            </button>
                        </div>
                    </div>
                    <div id="mensagem_form_orcamento"></div>
                    <form id="form_orcamento" name="form_orcamento" method="POST">
                        <input id="orc_peso" value="0.2" name="orc_peso" type="hidden">
                        <input id="orc_vl_frete" value="52" name="orc_vl_frete" type="hidden">
                        <input id="orc_tipo_frete" value="SEDEX" name="orc_tipo_frete" type="hidden">
                        <input id="orc_categoria_id" value="28" name="orc_categoria_id" type="hidden">
                        <input id="orc_categoria_nome" value="Comercial" name="orc_categoria_nome" type="hidden">
                        <input id="orc_subcategoria_id" value="29" name="orc_subcategoria_id" type="hidden">
                        <input id="orc_subcategoria_nome" value="Cartão de visita Grátis" name="orc_subcategoria_nome" type="hidden">
                        <input id="orc_formato_id" value="1" name="orc_formato_id" type="hidden">
                        <input id="orc_formato_nome" value="4 x 5 cm" name="orc_formato_nome" type="hidden">
                        <input id="orc_cores_id" value="1" name="orc_cores_id" type="hidden">
                        <input id="orc_cores_nome" value="4x0 cores" name="orc_cores_nome" type="hidden">
                        <input id="orc_papel_id" value="1" name="orc_papel_id" type="hidden">
                        <input id="orc_papel_nome" value="couche 300g" name="orc_papel_nome" type="hidden">
                        <input id="orc_acabamento_id" value="4" name="orc_acabamento_id" type="hidden">
                        <input id="orc_acabamento_nome" value="Laminação  fosca" name="orc_acabamento_nome" type="hidden">
                        <input id="orc_pacote_qtd" value="150 un" name="orc_pacote_qtd" type="hidden">
                        <input id="orc_pacote_valor" value="R$ 0,00" name="orc_pacote_valor" type="hidden">
                        <input id="orc_desconto_valor" value="0" name="orc_desconto_valor" type="hidden">
                        <!-- parte referente ao portifólio -->
                        <input id="orc_id_perfil" value="" name="orc_id_perfil" type="hidden">
                        <input id="orc_nome_perfil" value="" name="orc_nome_perfil" type="hidden">
                        <input name="_token" value="{!!csrf_token()!!}" type="hidden">
                    </form>
                    <!--mostra o formulario com os dados postados para recuperar o resultado-->
                    <form action="http://www.ecograph.bez/calculadora" method="POST" name="calc" id="calc">
                        <input type="hidden" value="5" id="escolhido" name="escolhido">
                        <input type="hidden" value="Cartão de visita Grátis" id="nome_categoria" name="categoria">
                        <input type="hidden" value="28" id="categ_pai" name="categoria_pai">
                        <input type="hidden" value="Comercial" id="categ_nome_pai" name="categoria_nome_pai">
                        <input type="hidden" value="{!!csrf_token()!!}" name="_token">
                    </form>
                    <form action="http://www.ecograph.bez/calcula_preco" method="POST" name="calculadora" id="calculadora">
                        <div id="peso_selecionado"></div>
                        <input type="hidden" value="Cartão de visita Grátis" id="categ_selecionada" name="categoria">
                        <input type="hidden" value="" id="cor_nome" name="cor_nome">
                        <input type="hidden" value="" id="cor_id" name="cor">
                        <input type="hidden" value="" id="formato_id" name="formato">
                        <input type="hidden" value="" id="formato_nome" name="formato_nome">
                        <input type="hidden" value="" id="papel_nome" name="papel_nome">
                        <input type="hidden" value="" id="papel_id" name="papel">
                        <input type="hidden" value="" id="enobrecimento_nome" name="enobrecimento_nome">
                        <input type="hidden" value="" id="enobrecimento_id" name="enobrecimento">
                        <input type="hidden" value="" id="acabamento_nome" name="acabamento_nome">
                        <input type="hidden" value="" id="acabamento_id" name="acabamento">
                        <input type="hidden" value="{!!csrf_token()!!}" name="_token">
                    </form>
                </div>
                @include('layouts.includes.modais.modal_perfil')

            </div>
        </div>
    </div>
</div>