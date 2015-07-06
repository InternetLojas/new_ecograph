               <table cellpadding="0" cellspacing="0">
                    <tbody>
                        <tr>
                            <td class="mail-product-name" width="100%">
                                Produto: <strong>{!!$inputs_orc['orc_subcategoria_nome']!!}</strong>
                            </td>
                        </tr>
                    </tbody>   
                </table> 
                <table class="table table-bordered" cellpadding="0" cellspacing="0">
                    <thead class="text-center text-medio">
                        <tr>
                            <th class="text-center">Qtd</th>
                            <th class="text-center">Especificações Selecionadas</th>
                            <th class="text-center">Valor</th>
                            <th class="text-center">Desconto</th>
                            <th class="text-center">Frete</th>
                            <th class="text-center">
                                Valor Total                                   
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-medio">
                            <td >
                                {!!$inputs_orc['orc_pacote_qtd']!!}
                            </td>
                            <td valign="top" align="left">
                                Produto: {!!$inputs_orc['orc_subcategoria_nome']!!}<br>
                                Formato: {!!$inputs_orc['orc_formato_nome']!!}<br>
                                Cores: {!!$inputs_orc['orc_cor_nome']!!}<br>
                                Material: {!!$inputs_orc['orc_papel_nome']!!}<br>
                                Acabamento: {!!$inputs_orc['orc_acabamento_nome']!!}<br>
                                Enoblecimento: {!!$inputs_orc['orc_enoblecimento_nome']!!}<br>
                            </td>
                            <td >
                                {!!$inputs_orc['orc_pacote_valor']!!}
                            </td>
                            <td >
                                R$ 0,00
                            </td>
                            <td >
                                {!!Utilidades::toReal($inputs_orc['orc_vl_frete'])!!}
                            </td>
                            <td >
                                {!!$inputs_orc['orc_vl_frete']!!}
                            </td>
                        </tr>
                    </tbody>
                </table>