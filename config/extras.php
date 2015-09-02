<?php

/*
  =======================================================================
  Informa�oes extras para a loja...
  =======================================================================
 */
// DEVE SER USADO COMO REFER�NCIA PARA O LAYOUT
// META TAGS PRINCIPAIS
define('META_DESCRIPTION', 'Gráfica e impressos em geral, cartões, flyer, folder, revistas e catálogos por temas e profissão.');
define('META_KEYWORDS', 'cartões de visita por tema, cartão de visita por profissão, Kit de Natal por tema, Calendários por tema, Cartazes por tema, Cartões Duplos por tema, Adesivos, Encartes Supermercados, Filipetas, Folhinhas, Folders e Flyers, Marcadores, Mini Cartões, Papéis Timbrados, Pastas, Postais, Receituários, Tags, atualcard, givonline, cartões pvc, impressos políticos');
define('META_SUBJECTS', 'Gráfica e impressos em geral');

// INFORMAÇÕES SOBRE O VENDEDOR
define('STORE_NAME', 'Gráfica Ecograph'); /* usado no banner oferta */
define('STORE_OWNER', 'Márcio'); /* usado no banner oferta */
define('STORE_OWNER_EMAIL_ADDRESS', 'vendas@ecograph.com.br'); /* usado no banner oferta */
define('STORE_EMAIL_TESTE', 'newsite@ecograph.com.br');
define('STORE_ADDRESS', 'Rua Alonso Vasconcelos Pacheco, 853.<br>Vila Augusto. Mauá-SP. CEP 09350-281'); /* usado no banner oferta */
define('STORE_ADDRESS_EMAIL', 'Rua Alonso Vasconcelos Pacheco, 853.<br>Vila Augusto. Mauá-SP. CEP 09350-281');
define('STORE_BAIRRO', 'Vila Augusto'); /* usado no banner oferta */
define('STORE_CIDADE', 'Mauá'); /* usado no banner oferta */
define('STORE_ESTADO', 'SP'); /* usado no banner oferta */
define('STORE_CEP', '09350-281'); /* usado no banner oferta */
define('STORE_FONE1', '(11) 4543-1514.'); /* usado no banner oferta */
define('STORE_FONE2', ' (11) 4541-8070'); /* usado no banner oferta */
define('STORE_FAX', ' (11) 4543-0715'); /* usado no banner oferta */
define('STORE_SITE', 'http::/www.ecograph.com.br'); /* usado no banner oferta */
define('STORE_CNPJ', '33.733.296/0001-09'); /* usado no banner oferta */
define('STORE_ADDRESS_CONTACT', 'Rua Alonso Vasconcelos Pacheco, 853.<br>Vila Augusto. Mauá-SP. CEP 09350-281'); //Av. Brigadeiro Faria Lima 394, Guarulhos, SP
define('LOGOTIPO', 'images/theme/logotipo.png'); /* usado no banner oferta */

// CONFIGURA��O PARA O BANNER NA P�GINA INDEX
define('LIMITE_BANNER', '8'); /* usado no banner oferta */
define('LIMITE_POR_VEZ', '4'); /* usado no banner oferta */
define('LOOP_BANNER', '1'); /* usado no banner oferta */

// CONFIGURA��O DAS REDES SOCIAIS E APLICATIVOS DO GOOGLE
//define('USER_TWEET','internetlojas');
//define('FEEDS_TWEET','4');
//define('FEEDS_TWEET_FOOTER','1');
define('WIDGET_ID', '486461400970051584');
define('FOLLOWING', 'internetlojas');
define('FACEBOOK_PAGE', 'graficaecograph');
define('FAN_PAGE', 'graficaecograph'); //pages/InternetLojas/409568669072267//https://www.facebook.com/pages/Pafemarcombr/212467444575
define('USER_FACEBOOK', '<div class="fb-like" data-href="https://www.facebook.com/' . FAN_PAGE . '" data-send="true" data-width="450" data-show-faces="true" style="margin:auto;height:70px"></div>');
define('USER_SKYPE', '');
//define('USER_YOUTUBE','marciobreis');
define('OG_TITLE', 'Gráfica Ecograph');
define('OG_DESCRIPTION', META_DESCRIPTION);
define('OG_IMAGE', 'empresa/fotos.jpg');
define('FB_ADMIN', '1684171122,246071642181107');
define('FB_APP_ID', '272119259562358');
define('FB_APP_SECRET', '35134f86205e3cb24d99c46e81426546');
define('ATIVAR_GOOGLE_ANALITYCS', '0');
define('GOOGLE_ANALITYCS', 'UA-1558901-14');
define('GOOGLE_ADWORDS_CONTA', '648-310-1488');
define('GOOGLE_CLIENT_ID', '275003179769');
define('GOOGLE_CLIENT_SECRET', 'XAUSjglVW7b-9uodKIymRH2H');
define('GOOGLE_API_KEY', 'AIzaSyAvU8ZtFaP_ZxoMNuU9LxPAN02dPAn6Hlc');

// CONFIGURA��O DO GOOGLE SHOPPING
define('QTD_PRODUTOS_SHOPPING', '200');
// DEFINI��O TAMANHO DA TELA, PARA BANNERS E COLUNAS LATERAIS
define('LAYOUT', 'color4'); //color1//color2//....situado em /public/css/colors
//POLÍTICA DE FRETE
define('VALOR_TRANSPORTE_GRATIS', '1');
define('ESTADO_FRETE_GRATIS', '1');
define('PESO_LIMITE_TRANSPORTE_GRATIS', '30');
define('VALOR_LIMITE_TRANSPORTE_GRATIS', '200');

// FORMAS DE PAGAMENTOS
define('PARCELA_OFERTA', 1);
define('PARCELAS_PERMITIDAS', '12');
define('PARCELA_MINIMA_AUTORIZADA', '5');
define('BOLETO_PARCELADO_JUROS', 1);
define('CHEQUE_PARCELADO_JUROS', 5);
define('DESCONTO_CONCEDIDO', 0.10);
//NR DE PRODUTOS POR PÁGINAS
//NR DE PRODUTOS POR PÁGINAS
define('NR_PRODUTOS_POR_PAGINA', '12'); //0 PARA NÃO MOSTRA
define('NR_STRING_NOME_PRODUTO', '250');

// DISPOSIÇÃO DOS BLOCOS
define('MOSTRA_ESTOQUE_ZERO', '1'); //0 PARA NÃO MOSTRAR
define('MOSTRA_SLIDERS', '1'); //0 PARA NÃO MOSTRAR
define('MOSTRA_DESTAQUE', '0'); //0 PARA NÃO MOSTRAR
define('MOSTRA_VITRINE', '1'); //0 PARA NÃO MOSTRAR
define('MOSTRA_AVISO_HOME', '0'); //0 PARA NÃO MOSTRAR
define('PRODUTOS_NOVOS', '12'); //QUANTIDADE DE DIAS CONSIDERADO PRODUTOS NOVOS
define('STORE_ADDRESS_GOOGLE_MAPS', 'Rua Alonso Vasconcelos Pacheco, 853.Vila Augusto. Mauá-SP. CEP 09350-281');
