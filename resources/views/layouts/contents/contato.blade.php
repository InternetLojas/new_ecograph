<!-- CONTATO-->
<!--============================== content =================================-->
<div class="destaque_home">
    <!-- APRESENTAÇÃO-->
    <section id="map" class="example" style="height:430px">
        <p>Renderizando mapa...Aguarde!</p>
    </section>
</div>
<!--============================== content =================================-->
<div class="destaque_home">
    <div class="row">
        <div class="col-md-4">
            <h3 class="item-title"><i class="fa fa-1x fa-fw fa-map-marker on-left"></i> Endereço</h3>
            <address>
                {!!STORE_NAME!!}<br>
                {!!STORE_ADDRESS!!}
            </address>
            <address>
                <i class="fa fa-x fa-envelope fa-fw on-left"></i>
                <a href="mailto:#">{!!STORE_OWNER_EMAIL_ADDRESS!!}
                    <script type="text/javascript">
                        /* <![CDATA[ */
                        (function() {
                            try {
                                var s, a, i, j, r, c, l, b = document.getElementsByTagName("script");
                                l = b[b.length - 1].previousSibling;
                                a = l.getAttribute('data-cfemail');
                                if (a) {
                                    s = '';
                                    r = parseInt(a.substr(0, 2), 16);
                                    for (j = 2; a.length - j; j += 2) {
                                        c = parseInt(a.substr(j, 2), 16) ^ r;
                                        s += String.fromCharCode(c);
                                    }
                                    s = document.createTextNode(s);
                                    l.parentNode.replaceChild(s, l);
                                }
                            } catch (e) {
                            }
                        })();
                        /* ]]> */
                    </script>
                </a>
                <br>
                <i class="fa fa-x fa-fw fa-globe"></i> Web: {{STORE_SITE}}
            </address>
        </div>
        <div class="col-md-8">
            <h3 class="item-title"><i class="fa fa-x fa-bell fa-fw on-left"></i> Nossos horários</h3>
            <table class="table ">
                <thead>
                    <tr class="selected">
                        <th>Dia</th>
                        <th>Horário</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="success">
                        <td>Segunda</td>
                        <td>7:00 as 21:00</td>
                    </tr>
                    <tr class="success">
                        <td>Terça</td>
                        <td>7:00 as 21:00</td>
                    </tr>
                    <tr class="success">
                        <td>Quarta</td>
                        <td>7:00 as 21:00</td>
                    </tr>
                    <tr class="success">
                        <td>Quinta</td>
                        <td>7:00 as 21:00</td>
                    </tr>
                    <tr class="success">
                        <td>Sexta</td>
                        <td>7:00 as 21:00</td>
                    </tr>
                    <tr class="warning">
                        <td>Sábado</td>
                        <td>9:00 as 14:00</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!--============================== content =================================-->
<div class="destaque_home">
    <h3 class="item-title">
        <i class="fa fa-x fa-fw fa-envelope-o on-left"></i> Deixe uma mensagem
    </h3>
    @include('layouts.includes.boxes.forms.form_contato')
</div>
