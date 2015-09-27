               <table cellpadding="0" cellspacing="0">
                    <tbody>
                        <tr>
                            <td class="mail-product-name" width="100%">
                                Produto: <strong>{{$produtos}}</strong>
                            </td>
                        </tr>
                    </tbody>   
                </table> 
                <table class="table table-bordered" cellpadding="0" cellspacing="0">
                    <thead class="text-center text-medio">
                        <tr>
                            <th class="text-center">Qtd</th>
                            <th class="text-center">Formato</th>
                            <th class="text-center">Cor</th>
                            <th class="text-center">Acabamento</th>
                            <th class="text-center">Prova cor</th>
                            <th class="text-center">Entrega </th>
                        </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="text-smallmedio">
                            @forelse($input_qtd as $qtd)
                                {{$qtd}} <br>
                            @empty
                            @endforelse
                        </td>
                         <td class="text-smallmedio">
                         @if(!empty($input_formato_aberto[1]) && !empty($input_formato_aberto[2] ))
                             Aberto 1: {{$input_formato_aberto[1] }} X {{$input_formato_aberto[2]}}<br>
                         @endif
                          @if(!empty($input_formato_aberto[3]) && !empty($input_formato_aberto[4] ))
                             Aberto 2: {{$input_formato_aberto[3] }} X {{$input_formato_aberto[4]}}<br>
                         @endif
                         @if(!empty($input_formato_fechado[1]) && !empty($input_formato_fechado[2] ))
                             Fechado 1: {{$input_formato_fechado[1] }} X {{$input_formato_fechado[2]}}<br>
                         @endif
                          @if(!empty($input_formato_fechado[3]) && !empty($input_formato_fechado[4] ))
                             Fechado 2: {{$input_formato_fechado[3] }} X {{$input_formato_fechado[4]}}
                         @endif
                         </td>
                        <td class="text-smallmedio">
                            {{$cores}}     
                        </td>
                        <td class="text-smallmedio">
                            {{$acabamentos}}                           
                        </td>
                        <td class="text-smallmedio">
                            {{$provacor}}
                        </td>
                        <td class="text-smallmedio">
                            {{$entrega}}
                        </td>
                    </tr>
                    </tbody>
                </table>