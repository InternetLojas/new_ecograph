<div class="section" id="tabela">
    <!--============================== content =================================-->
    <div class="destaque_home">
        <div id="info_erro"></div>
        <div class="listview">
            <a href="#" class="list fg-white" style="width:100%">
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
                    <td id="lista_formato"></td>
                    <td id="lista_cores"></td>
                    <td id="lista_papel"></td>
                    <td id="lista_enoblecimento"></td>
                    <td id="lista_acabamento"></td>
                    <td id="lista_preco" ></td>
                </tr>
            </tbody>
        </table>        
        @include('layouts.includes.boxes.forms.form_calc')
        @include('layouts.includes.boxes.forms.form_calculadora')
    </div>
</div>
