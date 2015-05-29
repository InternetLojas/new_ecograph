<!-- Search -->
{!! Form::open(array(
'url'=>url::to('loja/busca'), 
'method' => 'get', 
'name'=>'search',
'id'=>'search',
'onsubmit'=>'return search_verifica()',
'role'=>'form'))
!!}
<div class="ecograph input-control text">
    <input type="search" name="keyword" class="search" id="btn-buscar" placeholder="Código ou nome do produto" onblur="if (this.value == '') this.value = 'Código ou nome do produto';" onfocus="if (this.value == 'Código ou nome do produto') this.value = '';">
    <button class="btn-search"></button>
</div>
</form>