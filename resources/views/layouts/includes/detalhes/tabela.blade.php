<section id="tabela" style="display:none">
    <div class="grid padding5">
        <div class="row">
            <div class="title_pagina">
                <div class="icone_pagina">
                    <img src="images/icons/calculadora.png" width="100%" alt="calculadora.png" />
                </div>
                <div class="title_content">
                    <h3>
                        Calculadora Online - <span id="nome_escolhido"></span>
                    </h3>
                    <span class="padding5">Selecione uma opção:</span>
                </div>
            </div>            
        </div>
        <div class="row">            
            <div id="info_erro"></div>
            <style>
                .metro .tabela:before {content: "tabela";}
            </style>           
            <div class="listview">
                <a href="#" class="list" style="width:100%">
                    <div class="list-content">
                        <!--<img id="img-escolhido" src="" class="icon">-->
                        <div class="data">
                            
                        </div>
                    </div>
                </a>
            </div>
            <div class="example tabela">
                <div id="info_tabela"></div>
                <form id="calculadora" name="calculadora" method="POST" action="{!!URL::to('calcula_preco')!!}">
                    <table class="table table-bordered">
                        <thead class="head-itens">
                            <tr>
                                <th>Formato</th>
                                <th>Cores</th>
                                <th>Papel/Material</th>
                                <th>Acabamento</th>
                                <th>Enoblecimento</th>
                                <th>
                                    Qtd/Valor                                   
                                </th>
                            </tr>
                        </thead>
                        <tbody class="striped">
                            <tr>
                                <td id="lista_formato"></td>
                                <td id="lista_cores"></td>
                                <td id="lista_papel"></td>
                                <td id="lista_acabamento"></td>
                                <td id="lista_enoblecimento"></td>
                                <td id="lista_preco"></td>
                            </tr>
                        </tbody>
                    </table>
                    <div id="peso_selecionado"></div>
                    <input type="hidden" name="categoria" id="categ_selecionada" value="" />
                    <input type="hidden" name="cor_nome" id="cor_nome" value="" />
                    <input type="hidden" name="formato_nome" id="formato_nome" value="" />
                    <input type="hidden" name="papel_nome" id="papel_nome" value="" />
                    <input type="hidden" name="acabamento_nome" id="acabamento_nome" value="" />
                    <input type="hidden" name="enoblecimento_nome" id="enoblecimento_nome" value="" />
                    <input type="hidden" name="_token" value="{!!csrf_token()!!}"/>
                </form>
            </div>
        </div>
    </div>
</section>