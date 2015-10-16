<table width="600" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" class="wrapper">
    <thead>
    <tr>
        <th class="head text-center">Outros Produtos</th>
        <th class="head text-center">Outras Cores</th>
        <th class="head text-center">Outros Acabamentos</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td  class="head text-medio">
            @if (!empty($outros_prod))
                Outra acabamento: {{$outros_prod}}
            @endif
        </td>
        <td  class="head text-medio">
            @if (!empty($outra_cor))
                Outra cor: {{$outra_cor}}
            @endif
        </td>
        <td  class="head text-medio">
            @if(!empty($outro_acabamento))
                {{$outro_acabamento}}
            @endif
        </td>
    </tr>
    </tbody>
</table>