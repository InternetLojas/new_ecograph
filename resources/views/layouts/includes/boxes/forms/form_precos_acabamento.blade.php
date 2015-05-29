{{ Form::open(
                array('url'=>'carrinho/adiciona', 
                'method' => 'post',
                'accept-charset'=>'UTF-8' , 
                'class'=>'form-preco', 
                'id'=>'cart_quantity',
                'name'=>'cart_quantity',
                'onsubmit'=>'return verifica();'
                )
                ) }} 

<table class="table">
    <thead>
        <tr>
            <th class="col-lg-3 col-md-3 col-xs-12 col-sm-4 fg-white" style="background-color:{{$layout['color_bg_in_footer']}}">Formato</th> 
            <th class="col-lg-3 col-md-3 col-xs-12 col-sm-4 fg-white" style="background-color:{{$layout['color_bg_in_footer']}}">Material</th>
            <th class="col-lg-3 col-md-3 col-xs-12 col-sm-4 fg-white" style="background-color:{{$layout['color_bg_in_footer']}}">Acabamento</th>
            <th class="col-lg-3 col-md-3 col-xs-12 col-sm-4 fg-white" style="background-color:{{$layout['color_bg_in_footer']}}">Qtd</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="content_atributo">{{ Precos::price_formato($filho) }}</td>
            <td class="content_atributo">{{ Precos::price_papel($filho) }}</td>
            <td class="content_atributo">{{ Precos::price_acabamento($filho) }}</td>
            <td class="content_atributo">
                <div id="price-qtd">{{ Precos::qtd($filho) }}</div> 
                <div id="price-qtd-resultado"></div>                                
            </td>
        </tr>
    </tbody>
</table>
{{ Form::hidden('categ', $filho) }}
@foreach($inputs as $key=>$valor)
<input type="hidden" name="inputs[{{$key}}]" value="{{$valor}}"  />
@endforeach
{{ Form::hidden('quantity', '1') }}
<button type="submit" class="btn btn-default">Visualisar o produto</button>
</form>