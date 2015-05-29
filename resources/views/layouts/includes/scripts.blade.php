<!-- Scripts -->
@if('ATIVAR_GOOGLE_ANALITYCS' == '1')
<!--======================ANALYTICS============================ --> 
<!-- Placed at the end of the document so the pages load faster --> 
<script>
    (function(i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function() {
            (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
        a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');
    ga('create', '{{ GOOGLE_ANALITYCS }}', 'auto');
    ga('send', 'pageview');</script>
@endif

<script src="{{ asset('/js/jquery/jquery.min.js')}}"></script>
<script src="{{ asset('/js/jquery/jquery.widget.min.js')}}"></script>
<script src="{{ asset('/js/jquery/jquery.mousewheel.js')}}"></script>
<script src="{{ asset('/js/prettify/prettify.js')}}"></script>
<script src="{{ asset('/js/metro/metro.min.js')}}"></script>
<script src="{{ asset('/js/metro/metro-progressbar.js')}}"></script>
<!-- Metro UI CSS JavaScript plugins -->
<script src="js/load-metro.js"></script>
<!-- Local JavaScript -->
<script src="{{ asset('/js/docs.js')}}"></script>
<!--Script exclusiva para internetlojas -->
<script src="{{ asset('/js/geolocalizacao.js') }}"></script>
<script src="{{ asset('/js/geral.js') }}"></script>

<script src="{{ asset('/uploads/js/vendor/jquery.ui.widget.js') }}"></script>
<script src="{{ asset('/uploads/js/jquery.fileupload.js') }}"></script>
<script src="{{ asset('js/jquery.maskedinput.js') }}"></script>
@if($page=='contato')
{!! HTML::script('js/jquery.ui.map.full.min.js') !!}
{!! Form::google_map(STORE_ADDRESS_GOOGLE_MAPS) !!}
<script src="https://maps.googleapis.com/maps/api/js?key={{GOOGLE_API_KEY}}&sensor=true"></script>
@endif

@if($page == 'caixa')
<!-- Javascript para abrir o gateway de pagamento ============================================= -->
{!! HTML::html_gateway($html) !!}
<!-- Fim Javascript para o gateway de pagamento =============================================== -->
@endif

@if($page =='carrinho') 
<script>
    function atualizar(product)
    {
        var qtd = document.getElementById(product).value;
        var formulario = document.getElementById('quantidade' + product);
        if (qtd === 0)
        {
            alert('Por favor informe uma quantidade maior que zero');
            exit;
        }
        formulario.submit();
    }
</script> 
@endif