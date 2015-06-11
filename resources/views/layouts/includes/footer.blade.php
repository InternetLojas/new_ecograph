<div class="container"> 
    <!-- Footer ================================================================== -->
    <div class="container_footer text-medio fg-white">
        <div class="row"> 
            <div class="col-sm-3"> 
                <ul class="list-unstyled text-left">
                    <li>
                        <img src="images/icons/ico-facebook.png"  width="35">
                        <span><a class="link-footer" data-title="Compartilhe" href="javascript:void(0);"
                                 onclick="window.open(
                                             'https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent('{{ Request::url() }}') + '&t=' + encodeURIComponent('{{STORE_NAME}} ##{{FACEBOOK_PAGE}} #snippet'),
                                                                         'facebook-share-dialog',
                                                                         'width=626,height=436,top=' + ((screen.height - 436) / 2) + ',left=' + ((screen.width - 626) / 2)
                                                                         );
                                                                         return false;"> Curta nossa página </a> </span>
                    </li>
                    <li>
                        <img src="images/icons/ico-google.png"  width="35">
                        <span><a class="link-footer" href="#">Entre no nosso círculo</a></span>
                    </li>
                    <li>
                        <img src="images/icons/ico-home.png"  width="35">
                        <span>
                            <a class="link-footer" href="">
                                {!!STORE_ADDRESS_CONTACT!!}
                            </a>
                        </span>
                    </li>
                    <li>
                        <img src="images/icons/ico-fone.png"  width="35">
                        <span><a class="link-footer" href="">{!!STORE_FONE1!!}}. {!!STORE_FONE2!!}}. Fax: {!!STORE_FAX!!}}</a></span>
                    </li>
                    <li>
                        <img src="images/icons/ico-map.png"  width="35">
                        <span><a class="link-footer" href="">Ver mapa</a></span>
                    </li>
                </ul>
            </div>
            <div class="col-sm-3">
                <div class="row">
                    <ul class="list-unstyled text-left">
                        <li>
                            <img src="images/icons/ico-ecograph.png"  width="35">
                            <span><a class="link-footer" href="{!!url::to('missao.html')!!}" class="text-inverse">Institucional</a></span>
                        </li>
                        <li>
                            <img src="images/icons/ico-fsc.png"  width="35">
                            <span><a class="link-footer" href="{!!url::to('certificacao.html')!!}">Certificação FSC &reg;</a></span>
                        </li>
                        <li>
                            <img src="images/icons/ico-termos.png"  width="35">
                            <span><a class="link-footer" href="">Termos de uso</a></span>
                        </li>
                        <li>
                            <img src="images/icons/ico-privacity.png"  width="35">
                            <span><a class="link-footer" href="">Política de privacidade</a></span>
                        </li>
                    </ul>
                    <!--<a href="#"><i class="fa fa-3x fa-fw fa-instagram text-inverse"></i></a> 
                    <a href="#"><i class="fa fa-3x fa-fw fa-twitter text-inverse"></i></a> 
                    <a href="#"><i class="fa fa-3x fa-fw fa-facebook text-inverse"></i></a> 
                    <a href="#"><i class="fa fa-3x fa-fw fa-github text-inverse"></i></a>--> 
                </div>
            </div>
            <div class="col-sm-6"> 
                <div class="row">
                    <div class="col-md-12">
                        @if($page!='contato')
                        @include('layouts.includes.boxes.forms.form_contato')
                        @else
                        @include('layouts.includes.boxes.facebook_footer')
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="row">
        <div style="padding:5px 0;background-color:#ffffff;text-align:center">
            <img style="margin:auto;display:block" src="images/banners/pagamento.png" alt="pagamento.png" title="Inúmeras formas de pagamento">
        </div>
    </div>
</div>
<!-- javascript================================================== -->
@include('layouts.includes.scripts') 