<table class="table table-bordered table-condensed">
    <thead>
    <tr>
        <th>Papel</th>
        <th>#</th>
    </tr>
    </thead>
    <tbody>
    @forelse($papel as $papel_id => $items_p)
        <tr>
            <td>
                {{$items_p['papel_nome']}}
            </td>
            <td>
                @include('diretoria.atributos.tables.atributos_papeis')
            </td>
        </tr>
    @empty
    @endforelse
    </tbody>
</table>