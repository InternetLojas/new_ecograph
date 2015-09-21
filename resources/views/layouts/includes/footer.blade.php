<!-- Footer ================================================================== -->
<div class="container_footer ">
    <div class="row">
        <div class="col-md-4">
            <ul class="list-unstyled text-left">
                <li>
                    <img src="images/icons/ico-facebook.png"  width="32">
                        <span>
                            <a class="link-footer text-smallmedio" data-title="Compartilhe" href="javascript:void(0);"
                               onclick="window.open(
                                       'https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent('{{ Request::url() }}') + '&t=' + encodeURIComponent('{{STORE_NAME}} ##{{FACEBOOK_PAGE}} #snippet'),
                                       'facebook-share-dialog',
                                       'width=626,height=436,top=' + ((screen.height - 436) / 2) + ',left=' + ((screen.width - 626) / 2)
                                       );
                                       return false;"> Curta nossa página </a>
                        </span>
                </li>
                <li>
                    <img src="images/icons/ico-google.png"  width="32">
                    <span><a class="link-footer text-smallmedio" href="#">Entre no nosso círculo</a></span>
                </li>
                <li>
                    <img src="images/icons/ico-home.png"  width="32">
                        <span>
                            <a class="link-footer text-smallmedio" href="#">
                                {!!STORE_ADDRESS_CONTACT!!}
                            </a>
                        </span><br>
                        <span class="mg-left32">
                            <a class="link-footer text-smallmedio" href="#">
                                {!!STORE_ADDRESS_COMPLEMENTO_CONTACT!!}
                            </a>
                        </span>
                </li>
                <li>
                    <img src="images/icons/ico-fone.png"  width="32">
                    <span><a class="link-footer text-smallmedio" href="#">{!!STORE_FONE1!!}{!!STORE_FONE2!!}.</a></span>
                </li>
                <li>
                    <img src="images/icons/ico-map.png"  width="32">
                    <span><a class="link-footer text-smallmedio" href="{{ route('contato') }}">Ver mapa</a></span>
                </li>
            </ul>
        </div>
        <div class="col-md-3">
            <ul class="list-unstyled text-left">
                <li>
                    <img src="images/icons/ico-ecograph.png"  width="32">
                    <span>
                        <a class="link-footer text-smallmedio" href="{!!url::to('missao.html')!!}" class="text-inverse">Institucional</a>
                    </span>
                </li>
                <li>
                    <img src="images/icons/ico-fsc.png"  width="32">
                    <span><a class="link-footer text-smallmedio" href="{!!url::to('certificacao.html')!!}">Certificação FSC &reg;</a></span>
                </li>
                <li>
                    <img src="images/icons/ico-termos.png"  width="32">
                    <span><a class="link-footer text-smallmedio" href="">Termos de uso</a></span>
                </li>
                <li>
                    <img src="images/icons/ico-privacity.png"  width="32">
                    <span><a class="link-footer text-smallmedio" href="#">Política de privacidade</a></span>
                </li>
            </ul>
        </div>
        <div class="col-md-5">
            @if($page!='contato')
                @include('layouts.includes.boxes.forms.form_contato')
            @else
                @include('layouts.includes.boxes.facebook_footer')
            @endif
        </div>
    </div>
</div>
<!--<div class="row">
    <div style="padding:5px 0;background-color:#ffffff;text-align:center">
        <img style="margin:auto;display:block" src="images/banners/pagamento.png" alt="pagamento.png" title="Inúmeras formas de pagamento">
    </div>
</div>-->
<!-- javascript================================================== -->
