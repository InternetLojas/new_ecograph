<!-- Footer ================================================================== -->
<div style="background-color:{{$layout['color_bg_footer']}}">
	<!--footer-->
	<div class="container footer-in">
		<div style="background-color:{{$layout['color_bg_in_footer']}}">
			<div class="grid fluid">
				<div class="row">
					<div class="umterco">
						<ul class="unstyled text-left fg-white">
							<li>
								<img src="images/icons/ico-facebook.png"  width="35">
								<span><a data-title="Compartilhe" href="javascript:void(0);"
									onclick="window.open(
									'https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent('{{ Request::url() }}') + '&t=' + encodeURIComponent('{{STORE_NAME}} ##{{FACEBOOK_PAGE}} #snippet'),
									'facebook-share-dialog',
									'width=626,height=436,top=' + ((screen.height - 436) / 2) + ',left=' + ((screen.width - 626) / 2)
									);
									return false;"> Curta nossa página </a> </span>
							</li>
							<li>
								<img src="images/icons/ico-google.png"  width="35">
								<span><a href="#">Entre no nosso círculo</a></span>
							</li>
							<li>
								<img src="images/icons/ico-home.png"  width="35">
								<span><a href="">Rua Alonso Vasconcelos Pacheco, 853.
									<br>
									Vila Augusto. Mauá-SP. CEP 09350-281</a></span>
							</li>
							<li>
								<img src="images/icons/ico-fone.png"  width="35">
								<span><a href="">11 4543-1514. 11 4541-8070. Fax: 11 4543-0715</a></span>
							</li>
							<li>
								<img src="images/icons/ico-map.png"  width="35">
								<span><a href="">Ver mapa</a></span>
							</li>
						</ul>
					</div>
					<div class="umterco no-phone-landscape no-phone">
						<ul class="unstyled text-left fg-white">
							<li>
								<img src="images/icons/ico-ecograph.png"  width="35">
								<span><a href="{!!url::to('missao.html')!!}">Institucional</a></span>
							</li>
							<li>
								<img src="images/icons/ico-fsc.png"  width="35">
								<span><a href="{!!url::to('certificacao.html')!!}">Certificação FSC &reg;</a></span>
							</li>
							<li>
								<img src="images/icons/ico-termos.png"  width="35">
								<span><a href="">Termos de uso</a></span>
							</li>
							<li>
								<img src="images/icons/ico-privacity.png"  width="35">
								<span><a href="">Política de privacidade</a></span>
							</li>
						</ul>
					</div>
					<div class="umterco text-left fg-white">
						@if($page!='contato')
						@include('layouts.includes.boxes.forms.form_contato')
						@else
						@include('layouts.includes.boxes.facebook_footer')
						@endif
					</div>
				</div>
				<div class="row">
					<div style="padding:5px 0;background-color:#ffffff;text-align:center">
						<img style="margin:auto;display:block" src="images/banners/pagamento.png" alt="pagamento.png" title="Inúmeras formas de pagamento">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Footer ================================================================== -->
<!-- javascript================================================== -->
@include('layouts.includes.scripts') 