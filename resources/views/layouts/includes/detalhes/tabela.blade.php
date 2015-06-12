<div class="section" id="tabela">
    <!--============================== content =================================-->
    <div class="destaque_home">
        <div id="info_erro"></div>
        <div class="listview">
            <a href="#" class="list fg-white" style="width:100%">
                <div class="list-content">
                    <div class="data">
                    </div>
                </div>
            </a>
        </div>
        <table class="table table-bordered ">
            <thead class="head-itens">
                <tr>
                    <th class="text-center">Formato</th>
                    <th class="text-center">Cores</th>
                    <th class="text-center">Papel/Material</th>
                    <th class="text-center">Acabamento</th>
                    <th class="text-center">Enoblecimento</th>
                    <th class="text-center">
                        Qtd/Valor                                   
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr class="bg-very-smallgray">
                    <td id="lista_formato"></td>
                    <td id="lista_cores"></td>
                    <td id="lista_papel"></td>
                    <td id="lista_acabamento"></td>
                    <td id="lista_enoblecimento"></td>
                    <td id="lista_preco"></td>
                    <!--<td>
                        <ul class="list-group">
                <li class="list-group-item">Cras justo odio</li>
                <li class="list-group-item">Dapibus ac facilisis in</li>
                <li class="list-group-item">Morbi leo risus</li>
                <li class="list-group-item">Porta ac consectetur ac</li>
                <li class="list-group-item">Vestibulum at eros</li>
            </ul>-->
                    </td>
                </tr>
            </tbody>
        </table>
        <form id="calculadora" name="calculadora" method="POST" action="{!!URL::to('calcula_preco')!!}">
            <div id="peso_selecionado"></div>
            <input type="hidden" name="categoria" id="categ_selecionada" value="" />
            <input type="hidden" name="cor_nome" id="cor_nome" value="" />
            <input type="hidden" name="cor" id="cor_id" value="" />
            <input type="hidden" name="formato" id="formato_id" value="" />
            <input type="hidden" name="formato_nome" id="formato_nome" value="" />
            <input type="hidden" name="papel_nome" id="papel_nome" value="" />
            <input type="hidden" name="papel" id="papel_id" value="" />
            <input type="hidden" name="acabamento_nome" id="acabamento_nome" value="" />
            <input type="hidden" name="acabamento" id="acabamento_id" value="" />
            <input type="hidden" name="enoblecimento_nome" id="enoblecimento_nome" value="" />
            <input type="hidden" name="enoblecimento" id="enoblecimento_id" value="" />
            <input type="hidden" name="_token" value="{!!csrf_token()!!}"/>
        </form>
        @if(is_array($solicitado))
        <!--mostra o formulario com os dados postados para recuperar o resultado-->
        <form id="calc" name="calc" method="POST" action="{!!URL::to('calculadora')!!}">
            <input type="hidden" name="escolhido" id="escolhido" value="{!!$solicitado['filho']!!}">
            <input type="hidden" name="categoria" id="nome_categoria" value="{!!Fichas::nomeCategoria($solicitado['filho'])!!}">
            <input type="hidden" name="_token" value="{!!csrf_token()!!}"/>
        </form>
        @else
        <form id="calc" name="calc" method="POST" action="{!!URL::to('calculadora')!!}">
            <input type="hidden" name="escolhido" id="escolhido" value="">
            <input type="hidden" name="categoria" id="nome_categoria" value="">
            <input type="hidden" name="_token" value="{!!csrf_token()!!}"/>
        </form>
        @endif
    </div>
</div>
