<?php
/*
  $Id: espanol.php,v 1.67 2002/01/11 05:03:25 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce
  Released under the GNU General Public License
*/

//NOVAS TRADU��ES
define('TEXT_PRODUCTS_PRICE_CUSTO', 'PRE�O CUSTO PRODUTO');

define('WARNING_NO_FILE_UPLOADED', 'Nenhum Envio de Arquivo realizado!');

define('TEXT_PRODUCTS_PRICE_NET', 'PRE�O DE VENDA DO PRODUTO');
define('TEXT_PRODUCTS_PRICE_GROSS', 'Pre�o com Imposto');
define('BOX_REPORTS_PRODUCTS','Lista de Produtos');
define('BOX_REPORTS_INVENTORY', 'Estat�sticas do Invent�rio');

//p�gina inicial LOGIN
define('ERROR_INVALID_ADMINISTRATOR', 'LOGIN INV�LIDO');
define('TEXT_PRODUCTS_COD_BARRA', 'C�digo de Barra do Produto');
define('HEADING_TITLE', 'LOGIN DE �REA ADMINISTRATIVA');
define('TEXT_PASSWORD', 'Digite sua senha: ');
define('TEXT_USERNAME', 'Digite seu usu�rio');
define('HEADING_TITLE', 'Entre com suas informa��es abaixo:');
define('BUTTON_LOGIN', 'ACESSAR �REA ADMINISTRATIVA');
define('TEXT_MODULE_DIRECTORY', 'Diret�rio');
define('TABLE_HEADING_SORT_ORDER', 'Ativado(0) e Desativado');
define('TABLE_HEADING_MODULES', 'Formas Dispon�veis');
define('TEXT_NONE', 'N�o Definido');
define('ENTRY_SHIPPING_ADDRESS', 'ENDERE�O DE ENVIO');
define('TABLE_HEADING_PRICE_EXCLUDING_TAX', 'Pre�o sem Imposto');  	
define('TABLE_HEADING_PRICE_INCLUDING_TAX', 'Pre�o com Imposto');
define('TABLE_HEADING_TOTAL_EXCLUDING_TAX', 'Pre�o total sem Imposto');
define('TABLE_HEADING_TOTAL_INCLUDING_TAX', 'Pre�o total com Imposto');
define('TEXT_ALL_ORDERS', 'Todos os Pedidos');
define('TEXT_DATE_ORDER_CREATED', 'Data em que o pedido foi criado');
define('TEXT_INFO_PAYMENT_METHOD', 'Forma de Pagamento');
define('ENTRY_BILLING_ADDRESS', 'ENDERE�O DE COBRAN�A');
define('TABLE_HEADING_CUSTOMER_NOTIFIED', 'Notificado');
define('TABLE_HEADING_DATE_ADDED', 'Data');
define('ENTRY_NOTIFY_CUSTOMER', 'Notificar Cliente');
define('ENTRY_NOTIFY_COMMENTS', 'Notificar Coment�rios');
define('IMAGE_ORDERS_INVOICE', 'Recibo');

//pagina /index.php
define('ADMIN_INDEX_CUSTOMERS_TITLE', 'Clientes');
define('ADMIN_INDEX_CUSTOMERS_DATE', 'Hor�rio de Acesso');
define('ADMIN_INDEX_ORDERS_TITLE', 'Pedidos');
define('ADMIN_INDEX_ORDERS_TOTAL', 'Total do Pedido');
define('ADMIN_INDEX_ORDERS_DATE', 'Data do Pedido');
define('ADMIN_INDEX_ORDERS_STATUS', 'Status do Pedido');

define('TABLE_HEADING_ADMINISTRATORS', 'Nome de Usu�rio');
define('TABLE_HEADING_ACTION', 'A��O');
define('TEXT_INFO_EDIT_INTRO', 'Editar informa��es');
define('TEXT_INFO_USERNAME', 'Nome de Usu�rio');
define('TEXT_INFO_NEW_PASSWORD', 'Senha');
define('TEXT_INFO_ORDERS_STATUS_NAME', 'Nome do Status');

define('TEXT_INFO_HEADING_EDIT_ORDERS_STATUS', 'Alterar nome do status');
define('HEADING_TITLE_STATUS', 'LISTAR PEDIDOS POR STATUS');
define('TEXT_INFO_NUMBER_ZONES', 'Numero de Zona');
define('TEXT_INFO_HEADING_EDIT_ZONE', 'Editar Zona');
define('TEXT_INFO_EDIT_ZONE_INTRO', 'Edite a zona');
define('TEXT_INFO_ZONE_NAME', 'Nome da Zona');
define('TEXT_INFO_ZONE_DESCRIPTION', 'Descri��o da Zona');
define('TABLE_HEADING_TAX_ZONES', 'Imposto por Zonas');
define('TEXT_INFO_HEADING_EDIT_COUNTRY', 'Editando Pa�s');
define('TEXT_INFO_HEADING_EDIT_TAX_RATE', 'Editando Taxa');
define('TEXT_INFO_HEADING_NEW_TAX_RATE', 'Nova Taxa');

define('BOX_TOOLS_BANNER_MANAGER', 'Gerenciar Banners');
define('BOX_TOOLS_CACHE', 'Gerenciar Cache');
define('BOX_TOOLS_FILE_MANAGER', 'Gerenciar Arquivos');
define('BOX_TOOLS_NEWSLETTER_MANAGER', 'Gerenciar NewsLetter');
define('TEXT_DISPLAY_NUMBER_OF_NEWSLETTERS', 'N�mero de NewsLetters');
define('BOX_TOOLS_SERVER_INFO', 'Informa��o PHP');
// look in your $PATH_LOCALE/locale directory for available locales..
// on RedHat6.0 I used 'es_ES'
// on FreeBSD 4.0 I use 'es_ES.ISO_8859-1'
// this may not work under win32 environments..
setlocale(LC_TIME, 'pt_BR');
define('DATE_FORMAT_SHORT', '%d/%m/%Y');  // this is used for strftime()
define('DATE_FORMAT_LONG', '%A %d %B, %Y'); // this is used for strftime()
define('DATE_FORMAT', 'd/m/Y');  // this is used for date()
define('PHP_DATE_TIME_FORMAT', 'd/m/Y H:i:s'); // this is used for date()
define('DATE_TIME_FORMAT', DATE_FORMAT_SHORT . ' %H:%M:%S');

////
// Return date in raw format
// $date should be in format mm/dd/yyyy
// raw date is in format YYYYMMDD, or DDMMYYYY
function tep_date_raw($date, $reverse = false) {
  if ($reverse) {
    return substr($date, 3, 2) . substr($date, 0, 2) . substr($date, 6, 4);
  } else {
    return substr($date, 6, 4) . substr($date, 0, 2) . substr($date, 3, 2);
  }
}

// Global entries for the <html> tag
define('LANGUAGE_CURRENCY', 'BRA');
define('HTML_PARAMS','dir="ltr" lang="br"');

// charset for web pages and emails
define('CHARSET', 'iso-8859-1');

// page title
define('TITLE', 'osCommerce administra��o - Pafemar Ferramentas');

// header text in includes/header.php
define('HEADER_TITLE_TOP', 'Administra��o');
define('HEADER_TITLE_SUPPORT_SITE', 'Suporte da Loja');
define('HEADER_TITLE_ONLINE_CATALOG', 'Cat�logo Online');
define('HEADER_TITLE_ADMINISTRATION', 'Administra��o');

define('TEXT_INFO_HEADING_NEW_ADMINISTRATOR','Novo Administrador');
define('TEXT_INFO_INSERT_INTRO','Inserir Novo Administrador');
define('TEXT_INFO_PASSWORD','Senha');
define('TEXT_INFO_DELETE_INTRO','Deletar');
define('TEXT_PRODUCTS_PRICE_NET','Pre�o:');
define('TEXT_PRODUCTS_PRICE_GROSS','Pre�o:');
// text for gender
define('MALE', 'Masculino');
define('FEMALE', 'Feminino');

// text para pf pj
define('PF', 'Pessoa F�sica');
define('PJ', 'Pessoa Jur�dica');

// text for date of birth example
define('DOB_FORMAT_STRING', 'dd/mm/yyyy');

// configuration box text in includes/boxes/configuration.php
define('BOX_HEADING_CONFIGURATION', 'Configura��es');
define('BOX_CONFIGURATION_MYSTORE', 'MINHA LOJA');
define('BOX_CONFIGURATION_LOGGING', 'Log');
define('BOX_CONFIGURATION_CACHE', 'Cache');
define('BOX_CONFIGURATION_ADMINISTRATORS', 'Administrador');

// modules box text in includes/boxes/modules.php
define('BOX_HEADING_MODULES', 'M�dulos');
define('BOX_MODULES_PAYMENT', 'Pagamento');
define('BOX_MODULES_SHIPPING', 'Frete');
define('BOX_MODULES_ORDER_TOTAL', 'Total de Pedidos');

// categories box text in includes/boxes/catalog.php
define('BOX_HEADING_CATALOG', 'Produtos');
define('BOX_CATALOG_CATEGORIES_PRODUCTS', 'Categorias / Produtos');
define('BOX_CATALOG_CATEGORIES_PRODUCTS_ATTRIBUTES', 'Atributos');
define('BOX_CATALOG_MANUFACTURERS', 'Fabricantes');
define('BOX_CATALOG_REVIEWS', 'Coment�rios');
define('BOX_CATALOG_SPECIALS', 'Ofertas');
define('BOX_CATALOG_PRODUCTS_EXPECTED', 'Lan�amentos');

// customers box text in includes/boxes/customers.php
define('BOX_HEADING_CUSTOMERS', 'Clientes');
define('BOX_CUSTOMERS_CUSTOMERS', 'Clientes');
define('BOX_CUSTOMERS_ORDERS', 'Pedidos');
define('BOX_CUSTOMERS_CHANGE_PASSWORD', 'Modificar Senha');

// taxes box text in includes/boxes/taxes.php
define('BOX_HEADING_LOCATION_AND_TAXES', 'Localiza��o/Impostos');
define('BOX_TAXES_COUNTRIES', 'Pa�ses');
define('BOX_TAXES_ZONES', 'Estados');
define('BOX_TAXES_GEO_ZONES', 'Taxas de Estados');
define('BOX_TAXES_TAX_CLASSES', 'Tipos de Imposto');
define('BOX_TAXES_TAX_RATES', 'Porcentagens');

// reports box text in includes/boxes/reports.php
define('BOX_HEADING_REPORTS', 'Estat�sticas');
define('BOX_REPORTS_PRODUCTS_VIEWED', 'Produtos Mais Vistos');
define('BOX_REPORTS_PRODUCTS_PURCHASED', 'Produtos Mais Comprados');
define('BOX_REPORTS_ORDERS_TOTAL', 'Total de Pedidos por Cliente');

// tools text in includes/boxes/tools.php
define('BOX_HEADING_TOOLS', 'Ferramentas');
define('BOX_TOOLS_BACKUP', 'C�pia do banco de dados');
define('BOX_TOOLS_BANNER_MANAGER', 'Gerenciador de Banners');
define('BOX_TOOLS_CACHE', 'Controle de Cache');
define('BOX_TOOLS_DEFINE_LANGUAGE', 'Definir L�nguas');
define('BOX_TOOLS_FILE_MANAGER', 'Gerenciador de Arquivos');
define('BOX_TOOLS_MAIL', 'Enviar Email');
define('BOX_TOOLS_NEWSLETTER_MANAGER', 'Gerenciador de Newsletter');
define('BOX_TOOLS_SERVER_INFO', 'Informa��es de Servidor');
define('BOX_TOOLS_WHOS_ONLINE', 'Quem est� online?');

// localizaion box text in includes/boxes/localization.php
define('BOX_HEADING_LOCALIZATION', 'Localiza��o');
define('BOX_LOCALIZATION_CURRENCIES', 'Moedas');
define('BOX_LOCALIZATION_LANGUAGES', 'Idiomas');
define('BOX_LOCALIZATION_ORDERS_STATUS', 'Status dos Pedidos');

// javascript messages
define('JS_ERROR', 'Houve alguns erros no processamento do formul�rio!\nPor favor, fa�a as seguintes modifica��es:\n\n');

define('JS_OPTIONS_VALUE_PRICE', '* O atributo precisa de um pre�o\n');
define('JS_OPTIONS_VALUE_PRICE_PREFIX', '* O atributo precisa de um prefixo para o pre�o\n');

define('JS_PRODUCTS_NAME', '* O produto precisa de um nome\n');
define('JS_PRODUCTS_DESCRIPTION', '* Voc� deve inserir a descri��o do produto\n');
define('JS_PRODUCTS_PRICE', '* O produto precisa de um pre�o\n');
define('JS_PRODUCTS_WEIGHT', '* Voc� deve especificar o peso do produto\n');
define('JS_PRODUCTS_QUANTITY', '* Deve especificar a quantidade\n');
define('JS_PRODUCTS_MODEL', '* Deve especificar o modelo\n');
define('JS_PRODUCTS_IMAGE', '* Deve inserir uma imagem\n');

define('JS_PRODUCTS_EXPECTED_NAME', '* O campo \'Produto\' deve ter um valor\n');
define('JS_PRODUCTS_EXPECTED_DATE', '* A data deve estar em formato: xx/xx/xxxx (dia/mes/a�o).\n');

define('JS_GENDER', '* O \'Sexo\' deve ser escolhido.\n');
define('JS_FIRST_NAME', '* O \'Nome\' deve ter no m�nimo ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' caracteres.\n');
define('JS_LAST_NAME', '* O \'Sobrenome\' deve ter no m�nimo ' . ENTRY_LAST_NAME_MIN_LENGTH . ' caracteres.\n');
define('JS_PF_PJ', '* O \'Tipo de Cliente\' deve ser escolhido.\n');
define('JS_DOB', '* A \'Data de Nascimento\' deve estar no formato: xx/xx/xxxx (dia/m�s/ano).\n');
define('JS_EMAIL_ADDRESS', '* O \'E-Mail\' deve ter no m�nimo ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' caracteres.\n');
define('JS_ADDRESS', '* O \'Endere�o\' deve ter no m�nimo ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' caracteres.\n');
define('JS_ADDRESS2', '* O \'CPF\' deve ter no m�nimo' . ENTRY_STREET_ADDRESS2_MIN_LENGTH . ' caracteres.\n');
define('JS_ADDRESS3', '* O \'RG\' deve ter no m�nimo' . ENTRY_STREET_ADDRESS3_MIN_LENGTH . ' caracteres.\n');
define('JS_POST_CODE', '* O \'CEP\' deve ter no m�nimo ' . ENTRY_POSTCODE_MIN_LENGTH . ' caracteres.\n');
define('JS_CITY', '* A \'Cidade\' deve ter no m�nimo ' . ENTRY_CITY_MIN_LENGTH . ' caracteres.\n');
define('JS_STATE', '* O \'Estado\' deve ser selecionado.\n');
define('JS_STATE_SELECT', '-- Selecione Acima --');
define('JS_ZONE', '* O \'Estado\' deve ser selecionado atrav�s da lista para este Pa�s.');
define('JS_COUNTRY', '* O \'Pa�s\' deve ser escolhido.\n');
define('JS_TELEPHONE', '* O \'Fone\' deve ter no m�nimo ' . ENTRY_TELEPHONE_MIN_LENGTH . ' caracteres.\n');
define('JS_DDD', '* O \'DDD\' deve ter no m�nimo ' . ENTRY_DDD_MIN_LENGTH . ' caracteres.\n');
define('JS_NR_RUA', '* A \'Rua ou Av\' deve ter no m�nimo ' . ENTRY_NR_RUA_MIN_LENGTH . ' caracteres.\n');
define('JS_COMP_REF', '* O \'complemento ou refer�ncia\' deve ter no m�nimo ' . ENTRY_COMP_REF_MIN_LENGTH . ' caracteres.\n');
define('JS_PASSWORD', '* A \'Senha\' e \'Confirma��o\' devem combinar e ter no m�nimo ' . ENTRY_PASSWORD_MIN_LENGTH . ' caracteres.\n');

define('JS_ORDER_DOES_NOT_EXIST', 'O pedido n�mero %s n�o existe!');

define('CATEGORY_PERSONAL', 'Pessoal');
define('CATEGORY_ADDRESS', 'Endere�o');
define('CATEGORY_CONTACT', 'Contato');
define('CATEGORY_PASSWORD', 'Senha');
define('CATEGORY_COMPANY', 'Empresa');
define('CATEGORY_OPTIONS', 'Op��es');
define('ENTRY_GENDER', 'Sexo:');
define('ENTRY_GENDER_ERROR', '&nbsp;<small><font color="#AABBDD">obrigat�rio</font></small>');
define('ENTRY_GENDER_TEXT', '&nbsp;<small><font color="#AABBDD">obrigat�rio</font></small>');
define('ENTRY_FIRST_NAME', 'Nome:');
define('ENTRY_FIRST_NAME_TEXT', '&nbsp;<small><font color="#AABBDD">obrigat�rio</font></small>');
define('ENTRY_LAST_NAME', 'Sobrenome:');
define('ENTRY_LAST_NAME_TEXT', '&nbsp;<small><font color="#AABBDD">obrigat�rio</font></small>');
define('ENTRY_DATE_OF_BIRTH', 'Data de nascimento:');
define('ENTRY_DATE_OF_BIRTH_TEXT', '&nbsp;<small>(ej. 21/05/1970) <font color="#AABBDD">obrigat�rio</font></small>');
define('ENTRY_EMAIL_ADDRESS', 'E-Mail:');
define('ENTRY_EMAIL_ADDRESS_TEXT', '&nbsp;<small><font color="#AABBDD">obrigat�rio</font></small>');
define('ENTRY_COMPANY', 'Empresa:');
define('ENTRY_COMPANY_TEXT', '');
define('ENTRY_STREET_ADDRESS', 'Endere�o:');
define('ENTRY_STREET_ADDRESS_TEXT', '&nbsp;<small><font color="#AABBDD">obrigat�rio</font></small>');
define('ENTRY_SUBURB', 'Bairro:');
define('ENTRY_SUBURB_TEXT', '');
define('ENTRY_POST_CODE', 'CEP:');
define('ENTRY_POST_CODE_TEXT', '&nbsp;<small><font color="#AABBDD">obrigat�rio</font></small>');
define('ENTRY_CITY', 'Cidade:');
define('ENTRY_CITY_TEXT', '&nbsp;<small><font color="#AABBDD">obrigat�rio</font></small>');
define('ENTRY_STATE', 'Estado:');
define('ENTRY_STATE_TEXT', '');
define('ENTRY_COUNTRY', 'Pa�s:');
define('ENTRY_COUNTRY_TEXT', '&nbsp;<small><font color="#AABBDD">obrigat�rio</font></small>');
define('ENTRY_TELEPHONE_NUMBER', 'Telefone:');
define('ENTRY_TELEPHONE_NUMBER_TEXT', '&nbsp;<small><font color="#AABBDD">obrigat�rio</font></small>');
define('ENTRY_FAX_NUMBER', 'FAX:');
define('ENTRY_FAX_NUMBER_TEXT', 'necess�rio para emiss�o de Nota Fiscal');
define('ENTRY_NEWSLETTER', 'Receber ofertas e promo��es:');
define('ENTRY_NEWSLETTER_YES', 'sim');
define('ENTRY_NEWSLETTER_NO', 'n�o');
define('ENTRY_PASSWORD', 'Senha:');
define('ENTRY_PASSWORD_CONFIRMATION', 'Confirma��o:');
define('ENTRY_PASSWORD_CONFIRMATION_TEXT', '&nbsp;<small><font color="#AABBDD">obrigat�rio</font></small>');
define('ENTRY_PASSWORD_TEXT', '&nbsp;<small><font color="#AABBDD">obrigat�rio</font></small>');
define('PASSWORD_HIDDEN', '--OCULTA--');

// images
define('IMAGE_BACK', 'Voltar');
define('IMAGE_BACKUP', 'Backup');
define('IMAGE_CANCEL', 'Cancelar');
define('IMAGE_CONFIRM', 'Confirmar');
define('IMAGE_COPY', 'Copiar');
define('IMAGE_COPY_TO', 'Copiar para');
define('IMAGE_DEFINE', 'Definir');
define('IMAGE_DELETE', 'Apagar');
define('IMAGE_EDIT', 'Editar');
define('IMAGE_EMAIL', 'E-mail');
define('IMAGE_ICON_STATUS_GREEN', 'Ativo');
define('IMAGE_ICON_STATUS_GREEN_LIGHT', 'Ativar');
define('IMAGE_ICON_STATUS_RED', 'Desligado');
define('IMAGE_ICON_STATUS_RED_LIGHT', 'Ativar');
define('IMAGE_ICON_INFO', 'Info');
define('IMAGE_INSERT', 'Inserir');
define('IMAGE_MODIFY', 'Modificar');
define('IMAGE_MODULE_INSTALL', 'Instalar M�dulo');
define('IMAGE_MODULE_REMOVE', 'Remover M�dulo');
define('IMAGE_MOVE', 'Mover');
define('IMAGE_NEW_BANNER', 'Novo Banner');
define('IMAGE_NEW_CATEGORY', 'Nova Categoria');
define('IMAGE_NEW_COUNTRY', 'Novo Pa�s');
define('IMAGE_NEW_CURRENCY', 'Nova Moeda');
define('IMAGE_NEW_FILE', 'Novo Arquivo');
define('IMAGE_NEW_FOLDER', 'Novo Diret�rio');
define('IMAGE_NEW_LANGUAGE', 'Novo Idioma');
define('IMAGE_NEW_NEWSLETTER', 'Novo Newsletter');
define('IMAGE_NEW_PRODUCT', 'Novo Produto');
define('IMAGE_NEW_TAX_CLASS', 'Novo Tipo de Imposto');
define('IMAGE_NEW_TAX_RATE', 'Nova Taxa');
define('IMAGE_NEW_ZONE', 'Novo Estado');
define('IMAGE_NEW_GEO_ZONE', 'Nova Zona Geogr�fica');
define('IMAGE_ORDERS', 'Pedidos');
define('IMAGE_PREVIEW', 'Ver');
define('IMAGE_RESTORE', 'Restaurar');
define('IMAGE_SAVE', 'Gravar');
define('IMAGE_SEARCH', 'Buscar');
define('IMAGE_SELECT', 'Selecionar');
define('IMAGE_UPDATE', 'Atualizar');
define('IMAGE_UPDATE_CURRENCIES', 'Atualizar Cambio da Moeda');
define('IMAGE_UPLOAD', 'Upload');

define('ICON_CURRENT_FOLDER', 'Diret�rio Corrente');
define('ICON_DELETE', 'Apagar');
define('ICON_ERROR', 'Erro');
define('ICON_FILE', 'Arquivo');
define('ICON_FILE_DOWNLOAD', 'Download');
define('ICON_FOLDER', 'Diret�rio');
define('ICON_PREVIOUS_LEVEL', 'Previous Level');
define('ICON_WARNING', 'Warning');
define('ICON_PREVIEW', 'Pr�via');
define('ICON_STATISTICS', 'Estat�sticas');
define('ICON_SUCCESS', 'Sucesso');
define('ICON_TICK', 'Verdade');
define('ICON_UNLOCKED', 'Destravado');
define('ICON_WARNING', 'Aten��o');

// constants for use in tep_prev_next_display function
define('TEXT_RESULT_PAGE', 'P�ginas:');
define('TEXT_DISPLAY_NUMBER_OF_BANNERS', 'Exibindo de <b>%d</b> a <b>%d</b> (de <b>%d</b> banners)');
define('TEXT_DISPLAY_NUMBER_OF_COUNTRIES', 'Exibindo de <b>%d</b> a <b>%d</b> (de <b>%d</b> pa�ses)');
define('TEXT_DISPLAY_NUMBER_OF_CUSTOMERS', 'Exibindo de <b>%d</b> a <b>%d</b> (de <b>%d</b> clientes)');
define('TEXT_DISPLAY_NUMBER_OF_CURRENCIES', 'Exibindo de <b>%d</b> a <b>%d</b> (de <b>%d</b> moedas)');
define('TEXT_DISPLAY_NUMBER_OF_LANGUAGES', 'Exibindo de <b>%d</b> a<b>%d</b> (de <b>%d</b> idiomas)');
define('TEXT_DISPLAY_NUMBER_OF_MANUFACTURERS', 'Exibindo de <b>%d</b> a <b>%d</b> (de <b>%d</b> fabricantes)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS', 'Exibindo de <b>%d</b> a <b>%d</b> (de <b>%d</b> pedidos)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS_STATUS', 'Exibindo de <b>%d</b> a <b>%d</b> (de <b>%d</b> status do pedido)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS', 'Exibindo de <b>%d</b> a <b>%d</b> (de <b>%d</b> produtos)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_EXPECTED', 'Exibindo de <b>%d</b> a <b>%d</b> (de <b>%d</b> productos esperados)');
define('TEXT_DISPLAY_NUMBER_OF_REVIEWS', 'Exibindo de <b>%d</b> a <b>%d</b> (de <b>%d</b> coment�rios)');
define('TEXT_DISPLAY_NUMBER_OF_SPECIALS', 'Exibindo de <b>%d</b> a <b>%d</b> (de <b>%d</b> ofertas)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_ZONES', 'Exibindo de <b>%d</b> a <b>%d</b> (de <b>%d</b> zonas de impostos)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_RATES', 'Exibindo de <b>%d</b> a <b>%d</b> (de <b>%d</b> porcentagens de impostos)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_CLASSES', 'Exibindo de <b>%d</b> a <b>%d</b> (de <b>%d</b> tipos de imposto)');
define('TEXT_DISPLAY_NUMBER_OF_ZONES', 'Exibindo de <b>%d</b> a <b>%d</b> (de <b>%d</b> estados)');

define('PREVNEXT_TITLE_FIRST_PAGE', 'Inicio');
define('PREVNEXT_TITLE_PREVIOUS_PAGE', 'Anterior');
define('PREVNEXT_TITLE_NEXT_PAGE', 'Pr�xima');
define('PREVNEXT_TITLE_LAST_PAGE', 'Final');
define('PREVNEXT_TITLE_PAGE_NO', 'P�gina %d');
define('PREVNEXT_TITLE_PREV_SET_OF_NO_PAGE', 'Anteriores %d P�ginas');
define('PREVNEXT_TITLE_NEXT_SET_OF_NO_PAGE', 'Pr�ximas %d P�ginas');
define('PREVNEXT_BUTTON_FIRST', '&lt;&lt;IN�CIO');
define('PREVNEXT_BUTTON_PREV', '[&lt;&lt;&nbsp;Anterior]');
define('PREVNEXT_BUTTON_NEXT', '[Pr�xima&nbsp;&gt;&gt;]');
define('PREVNEXT_BUTTON_LAST', 'FINAL&gt;&gt;');
define('HEADING_TITLE_SEARCH', 'BUSCAR PRODUTOS OU CATEGORIAS');

define('TEXT_DEFAULT', 'padr�o');
define('TEXT_SET_DEFAULT', 'Estabelecer como padr�o');
define('TEXT_FIELD_REQUIRED', '&nbsp;<span class="fieldRequired">* Requerido</span>');
define('TEXT_TOP', 'TOPO');
define('TEXT_INFO_HEADING_DELETE_CUSTOMER', 'Deletar Cliente');
define('TEXT_INFO_HEADING_DELETE_ORDER', 'Deletar Pedido');
define('TEXT_INFO_RESTOCK_PRODUCT_QUANTITY', 'Repor Estoque');

define('ERROR_BANNER_TITLE', 'Erro: T�tulo do Banner � necess�rio');
define('ERROR_BANNER_GROUP', 'Erro: Grupo de Banner � necess�rio');
define('ERROR_NO_DEFAULT_CURRENCY_DEFINED', 'Erro: N�o existe uma moeda definida po padr�o. Por favor defina uma em: Ferramentas Administrativas->Localiza��o->Moedas');

define('TEXT_CACHE_CATEGORIES', 'Categorias');
define('TEXT_CACHE_MANUFACTURERS', 'Fabricantes');
define('TEXT_CACHE_ALSO_PURCHASED', 'Tamb�m Compraram');

define('WARNING_NO_FILE_UPLOADED','Arquivo N�o foi enviado:');
define('BOX_REPORTS_MARGIN_REPORT','Estat�sticas Vendas e Margens');
define('BOX_CATALOG_DISCOUNT_COUPONS', 'Cupom de Desconto');
define('BOX_REPORTS_DISCOUNT_COUPONS', 'Cupom de Desconto');
define('TEXT_DATE_ORDER_LAST_MODIFIED', '�ltima ALtera��o');
define('TEXT_NO_ORDER_HISTORY', 'Sem Hist�rico');
define('BOX_BILL_TO_PAY', 'Contas a Pagar');


   define('BOX_TOOLS_EXTRA_FIELDS_MANAGER','Gerenciamento de Campos Extras');
   define('ENTRY_EXTRA_FIELDS_ERROR','Campo %s dever� conter no minimo de %d caracteres');
   define('TEXT_DISPLAY_NUMBER_OF_FIELDS', 'Mostrando <b>%d</b> de <b>%d</b> (de <b>%d</b> Campos)');
//Defaults Specials End
define('BOX_CUSTOMERS_PARABENS', 'Enviar Felicita��es');
define('BOX_REPORTS_STOCK_LEVEL', 'Relat�rio de Estoque Baixo');
define('BOX_CATALOG_CATEGORIES_PRODUCTS_EXTRA_IMAGES','Imagens Extras'); //Added for Extra Images Contribution
?>
