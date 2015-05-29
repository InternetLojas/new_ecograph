
<h3 class="title-cadastro"><b>Contato</b></h3>
<div class="grid">
    <div class="row">

        <div class="span5">
            <section id="map" class="example" style="height:430px">
                <p>Renderizando mapa...Aguarde!</p>
            </section>
        </div>
        <div class="span7 text-left">
            <h2 class="header">Fale</h2>
            <h3 class="subheader">com a gente</h3>
            <blockquote class="fg-darkBrown">
                Você está em busca de uma atividade física que lhe ajude a melhorar a sua postura, e com isso alcançar o equilíbrio necessário para as suas atividade diárias?<br>
                A Pilates Motriz talvez possa te ajudar.<br>
                Use os nossos canais de comunicão para entrar em contato com a gente ou faça-nos uma visita.
            </blockquote>
            <br>
            <address>
                <strong>Pilates Motriz</strong><br />
                Rua Saldanha Marinho, 30, Loja 201<br>
                Porto alegre - RS, Menino Deus<br>
                <abbr title="Phone">P:</abbr> (51) 3231-1661
            </address>
            <address>
                <br>
                <a href="mailto:#">ecograph@ecograph.com.br
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
                <i class="icon-globe"></i> Web: {{STORE_SITE}}
            </address>
        </div>
    </div> 
    <hr>
    <div class="row">    
        <div class="span8">
            <h3 class="item-title"><i class="icon-alarm on-left"></i> Deixe uma mensagem</h3>
            <div id="mensagem_contato"></div>
            <div id="info_contato"></div>
            <div class="example">
                @include('layouts.includes.boxes.forms.form_contato') 
                <!-- / contact form -->
            </div>  
        </div>

        <div class="span4">
            <h3 class="item-title"><i class="icon-clock on-left"></i> Nossos horários</h3>
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
