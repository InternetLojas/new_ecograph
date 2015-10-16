<!-- CONTATO-->

<!--============================== content =================================-->

<div class="col-md-12">
    <div class="col-md-5">
        <div class="well no-radius">
            <h3 class="item-title"><i class="fa fa-1x fa-fw fa-map-marker on-left"></i> Endereço</h3>
            <address style="padding-bottom:9px">
                {!!STORE_NAME!!}<br>
                {!!STORE_ADDRESS!!}<br>
                {!!STORE_FONE1!!} {!!STORE_FONE2!!}<br>
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
    </div>
    <div class="col-md-7">
        <div class="well  no-radius">
            <h3 class="item-title"><i class="fa fa-x fa-bell fa-fw on-left"></i> Nossos horários</h3>
            <table class="table table-condensed table-striped text-smallmedio">
                <thead>
                <tr class="">
                    <th>Dia</th>
                    <th>Horário</th>
                </tr>
                </thead>
                <tbody>
                <tr class="">
                    <td>Segunda</td>
                    <td>8:00 as 18:00</td>
                </tr>
                <tr class="">
                    <td>Terça</td>
                    <td>8:00 as 18:00</td>
                </tr>
                <tr class="">
                    <td>Quarta</td>
                    <td>8:00 as 18:00</td>
                </tr>
                <tr class="">
                    <td>Quinta</td>
                    <td>8:00 as 18:00</td>
                </tr>
                <tr class="">
                    <td>Sexta</td>
                    <td>8:00 as 18:00</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!--============================== content =================================-->
<div class="col-md-12">
    <h3 class="item-title">
        <i class="fa fa-x fa-fw fa-envelope-o on-left"></i> Deixe uma mensagem
    </h3>
    {!! Form::open(array(
    'url'=>route('email.contato'),
    'method'=>'post',
    'id' => 'contato',
    'name'=>'contato',
    'class'=>'form-horizontal',
    'role'=>'Form'
    ))
    !!}
    <div id="mensagem_contato"></div>
    <div id="info_contato"></div>
    <div class="form-group padding-top5">
        <div class="col-sm-2">
            <label for="nome" class="text-smallmedio ">Nome</label>
        </div>
        <div class="col-sm-10 fg-dark ">
            <input type="text" class="form-control no-radius" placeholder="Como gostaria de ser chamado?" id="nome" value="" name="nome" required>
        </div>
    </div>
    <div class="form-group padding-top5">
        <div class="col-sm-2">
            <label for="email" class="text-smallmedio ">Email</label>
        </div>
        <div class="col-sm-10 fg-dark">
            <input type="email" class="form-control no-radius" placeholder="Seu email para contato" id="email" value="" name="email" required>
        </div>
    </div>
    <div class="form-group padding-top5">
        <div class="col-sm-2">
            <label for="email" class="text-smallmedio ">Telefone</label>
        </div>
        <div class="col-sm-10 fg-dark">
            <input type="tel" class="form-control no-radius" placeholder="Seu telefone para contato" id="telefone" value="" name="telefone" required>
        </div>
    </div>
    <div class="form-group padding-top5">
        <div class="col-sm-2">
            <label class="text-smallmedio ">Mensagem</label>
        </div>
        <div class="col-sm-10 fg-dark">
            <textarea id="mensagem" name="mensagem" rows="3" style="width:100%" ></textarea>
        </div>
    </div>
    <div class="form-group padding-top5">
        <div class="col-sm-offset-2 col-sm-10">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <a href="javascript:void(0)" onclick="EmailEnviar('contato', '{{route('email.contato')}}');" id="btn_contato" class="btn bg-smallgray fg-dark no-radius pull-right">Enviar</a>
        </div>
    </div>
    {!!Form::close()!!}
    <div style="margin-top: 20px"> </div>

</div>
<!-- APRESENTAÇÃO-->
<div class="clearfix"></div>
<div class="col-md-12">
    <section id="map" class="example" style="z-index:10;background:transparent;height:430px;float:none;margin: 10px auto">
        <p>Renderizando mapa...Aguarde!</p>
    </section>
</div>

