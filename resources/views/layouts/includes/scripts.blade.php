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
<!-- Local JavaScript -->
<!--Script exclusiva para internetlojas -->
<script src="{{ asset('//code.jquery.com/jquery.js')}}"></script>
<script src="{{ asset('//netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js')}}"></script>
<script src="asset(elixir('js/custom.js'))"></script>
<!--<script src="{asset('build/js/custom-031e2d63.js')}"></script>-->
<script src="{{asset('js/jquery.maskedinput.js')}}"></script>
@if($page=='contato')
    <script src="{{ asset(elixir('js/alljs.js')) }}"></script>
{!! HTML::script(asset(elixir('js/alljs.js'))) !!}
{!! Form::google_map(STORE_ADDRESS_GOOGLE_MAPS) !!}
<script src="https://maps.googleapis.com/maps/api/js?key={{GOOGLE_API_KEY}}&sensor=true"></script>
@endif

@if($page == 'caixa')
<!-- Javascript para abrir o gateway de pagamento ============================================= -->
{!! HTML::html_gateway($html) !!}
<!-- Fim Javascript para o gateway de pagamento =============================================== -->
@endif
