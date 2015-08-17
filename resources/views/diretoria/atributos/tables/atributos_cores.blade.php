{!! Form::open(['route' =>['prices.update',$cat_id],'method'=>'put', 'class' => 'form-horizontal']) !!}
<table class="table table-bordered table-condensed">
    <thead>
    <tr>
        <th>#</th>
        <th>
            <table class="table  table-condensed">
                <tbody>
                <tr>
                    @forelse($items['pacotes'][$formato_id]['pacote_id'] as $id =>$quantity)
                        <td>{{$quantity}}</td>
                    @empty
                        <td></td>
                    @endforelse
                </tr>
                </tbody>
            </table>
        </th>
        <th></th>
    </tr>
    </thead>
    <tbody>

    @forelse($acabamentos as $acabamento_id => $items_a)
        <?php echo '<pre>';print_r($items_a['pacotes'][$formato_id]);exit;?>

        @if(is_array($items_a['pacotes'][$formato_id][$papel_id][$cor_id]))
            continue
            @else
            vazio
        @endif

    @empty
    @endforelse

    {!! Form::close() !!}
    </tbody>
</table>
<div class="form-group">
    {!! Form::submit('Atualizar', ['class'=>'btn btn-success']) !!}
</div>
{!! Form::close() !!}