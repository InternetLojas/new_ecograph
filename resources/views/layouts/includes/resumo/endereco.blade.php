<div class="row">
    <div class="example endereco" class="text-center">
        <address>
            <blockquote>
                <b class="shipping">Nome:</b> {!! $default_address['customers_firstname'] !!} {!! $default_address['customers_lastname'] !!}<br /> 
                <b class="shipping">Av/Rua:</b> {!! $default_address['entry_street_address'] !!}<br /> 
                <b class="shipping">Nº:</b> {!! $default_address['entry_nr_rua'] !!} <br />
                <b class="shipping">Complemento:</b> {!! $default_address['entry_comp_ref'] !!}<br /> 
                <b class="shipping">Bairro:</b> {!! $default_address['entry_suburb'] !!}<br /> 
                <b class="shipping">Cidade:</b> {!! $default_address['entry_city'] !!}, 
                <b class="shipping">CEP:</b> {!! $default_address['entry_postcode'] !!}<br /> 
                <b class="shipping">Estado:</b> {!! $default_address['entry_state'] !!}<br> 
                <b class="shipping">País:</b> Brasil
            </blockquote>
        </address>
    </div>
</div>