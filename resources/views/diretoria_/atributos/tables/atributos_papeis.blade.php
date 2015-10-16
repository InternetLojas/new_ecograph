<table class="table table-bordered table-condensed">
    <thead>
    <tr>
        <th>Cores</th>
        <th>
            Acabamentos
        </th>
    </tr>
    </thead>
    <tbody>
    @forelse($cores as $cor_id => $items_c)
        <tr>
            <td>
                {{$items_c['cor_nome']}}
            </td>
            <td>
                @include('diretoria.atributos.tables.atributos_cores')
            </td>
        </tr>
    @empty
    @endforelse
    </tbody>
</table>