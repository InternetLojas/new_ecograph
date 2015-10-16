<table width="600" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" class="wrapper">
    <thead>
    <tr>
        <th class="head text-center">Qtd</th>
        <th class="head text-center">Formatos</th>
        <th class="head text-center">Cores</th>
        <th class="head text-center">Acabamentos</th>
        <th class="head text-center">Prova Cor</th>
        <th class="head text-center">Envio</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td  class="head text-medio">
            {{$qtd}}
        </td>
        <td  class="head text-medio">
            @if(!empty($formato_aberto[1]) && !empty($formato_aberto[2] ))
                Aberto 1: {{$formato_aberto[1] }} X {{$formato_aberto[2]}}<br>
            @endif
            @if(!empty($formato_aberto[3]) && !empty($formato_aberto[4] ))
                Aberto 2: {{$formato_aberto[3] }} X {{$formato_aberto[4]}}<br>
            @endif
            @if(!empty($formato_fechado[1]) && !empty($iformato_fechado[2] ))
                Fechado 1: {{$input_formato_fechado[1] }} X {{$formato_fechado[2]}}<br>
            @endif
            @if(!empty($formato_fechado[3]) && !empty($formato_fechado[4] ))
                Fechado 2: {{$formato_fechado[3] }} X {{$formato_fechado[4]}}
            @endif
        </td>
        <td  class="head text-medio">
            {{$cores}}
        </td>
        <td  class="head text-medio">
            @forelse($acabamentos as $acabamento)
                {{$acabamento}}<br>
            @empty
            @endforelse
        </td>
        <td  class="head text-medio">
            {{$provacor}}
        </td>
        <td  class="head text-medio">
            {{$entrega}}
        </td>
    </tr>
    </tbody>
</table>
