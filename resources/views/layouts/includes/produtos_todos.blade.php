<table class="table lista_produtos">
    <thead>
        <tr>
            <th class="span3 bg-crimson fg-white text-left">
                <span class="afasta">Comercial</span></th>
            <th class="span3 bg-amber fg-white text-left">
                <span class="afasta">Editorial</span></th>
            <th class="span3 bg-emerald fg-white text-left">
                <span class="afasta">Promocional</span></th>
            <th class="span3 bg-violet fg-white text-left">
                <span class="afasta">Brindes</span></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            {!!HTML::lista_sub_categorias(Fichas::CategoriasPais())!!}
        </tr>
    </tbody>
</table>