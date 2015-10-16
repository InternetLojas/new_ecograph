<table cellpadding="0" cellspacing="0">
    <tbody>
    <tr>
        <td class="mail-product-name" width="100%">
            Outros <strong>detalhes</strong>
        </td>
    </tr>
    </tbody>
</table>
<table class="table table-bordered" cellpadding="0" cellspacing="0">
    <thead class="text-center text-medio">
    <tr>
        <th class="text-center">Outros Produtos</th>
        <th class="text-center">Outras Cores</th>
        <th class="text-center">Outros Acabamentos</th>
    </tr>
    </thead>
    <tbody>
    <tr class="text-medio">
        <td>
            @if (!empty($input_outros_prod))
              Outra acabamento: {{$input_outros_prod}}
            @endif
        </td>
        <td>
           @if (!empty($input_cor))
             Outra cor: {{$input_cor}}
           @endif
        </td>
        <td>
            @if(!empty($outro_acabamento))
              {{$outro_acabamento}}
            @endif
        </td>
    </tr>
    </tbody>
</table>