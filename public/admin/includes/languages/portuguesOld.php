<?php
/*
  $Id: espanol.php,v 1.67 2002/01/11 05:03:25 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce
  Released under the GNU General Public License
*/

//NOVAS TRADUÇÕES
define('TEXT_PRODUCTS_PRICE_CUSTO', 'PREÇO CUSTO PRODUTO');

define('WARNING_NO_FILE_UPLOADED', 'Nenhum Envio de Arquivo realizado!');

define('TEXT_PRODUCTS_PRICE_NET', 'PREÇO DE VENDA DO PRODUTO');
define('TEXT_PRODUCTS_PRICE_GROSS', 'Preço com Imposto');
define('BOX_REPORTS_PRODUCTS','Lista de Produtos');
define('BOX_REPORTS_INVENTORY', 'Estatísticas do Inventário');

//página inicial LOGIN
define('ERROR_INVALID_ADMINISTRATOR', 'LOGIN INVÁLIDO');
define('TEXT_PRODUCTS_COD_BARRA', 'Código de Barra do Produto');
define('HEADING_TITLE', 'LOGIN DE ÁREA ADMINISTRATIVA');
define('TEXT_PASSWORD', 'Digite sua senha: ');
define('TEXT_USERNAME', 'Digite seu usuário');
define('HEADING_TITLE', 'Entre com suas informações abaixo:');
define('BUTTON_LOGIN', 'ACESSAR ÁREA ADMINISTRATIVA');
define('TEXT_MODULE_DIRECTORY', 'Diretório');
define('TABLE_HEADING_SORT_ORDER', 'Ativado(0) e Desativado');
define('TABLE_HEADING_MODULES', 'Formas Disponíveis');
define('TEXT_NONE', 'Não Definido');
define('ENTRY_SHIPPING_ADDRESS', 'ENDEREÇO DE ENVIO');
define('TABLE_HEADING_PRICE_EXCLUDING_TAX', 'Preço sem Imposto');  	
define('TABLE_HEADING_PRICE_INCLUDING_TAX', 'Preço com Imposto');
define('TABLE_HEADING_TOTAL_EXCLUDING_TAX', 'Preço total sem Imposto');
define('TABLE_HEADING_TOTAL_INCLUDING_TAX', 'Preço total com Imposto');
define('TEXT_ALL_ORDERS', 'Todos os Pedidos');
define('TEXT_DATE_ORDER_CREATED', 'Data em que o pedido foi criado');
define('TEXT_INFO_PAYMENT_METHOD', 'Forma de Pagamento');
define('ENTRY_BILLING_ADDRESS', 'ENDEREÇO DE COBRANÇA');
define('TABLE_HEADING_CUSTOMER_NOTIFIED', 'Notificado');
define('TABLE_HEADING_DATE_ADDED', 'Data');
define('ENTRY_NOTIFY_CUSTOMER', 'Notificar Cliente');
define('ENTRY_NOTIFY_COMMENTS', 'Notificar Comentários');
define('IMAGE_ORDERS_INVOICE', 'Recibo');

//pagina /index.php
define('ADMIN_INDEX_CUSTOMERS_TITLE', 'Clientes');
define('ADMIN_INDEX_CUSTOMERS_DATE', 'Horário de Acesso');
define('ADMIN_INDEX_ORDERS_TITLE', 'Pedidos');
define('ADMIN_INDEX_ORDERS_TOTAL', 'Total do Pedido');
define('ADMIN_INDEX_ORDERS_DATE', 'Data do Pedido');
define('ADMIN_INDEX_ORDERS_STATUS', 'Status do Pedido');

define('TABLE_HEADING_ADMINISTRATORS', 'Nome de Usuário');
define('TABLE_HEADING_ACTION', 'AÇÃO');
define('TEXT_INFO_EDIT_INTRO', 'Editar informações');
define('TEXT_INFO_USERNAME', 'Nome de Usuário');
define('TEXT_INFO_NEW_PASSWORD', 'Senha');
define('TEXT_INFO_ORDERS_STATUS_NAME', 'Nome do Status');

define('TEXT_INFO_HEADING_EDIT_ORDERS_STATUS', 'Alterar nome do status');
define('HEADING_TITLE_STATUS', 'LISTAR PEDIDOS POR STATUS');
define('TEXT_INFO_NUMBER_ZONES', 'Numero de Zona');
define('TEXT_INFO_HEADING_EDIT_ZONE', 'Editar Zona');
define('TEXT_INFO_EDIT_ZONE_INTRO', 'Edite a zona');
define('TEXT_INFO_ZONE_NAME', 'Nome da Zona');
define('TEXT_INFO_ZONE_DESCRIPTION', 'Descrição da Zona');
define('TABLE_HEADING_TAX_ZONES', 'Imposto por Zonas');
define('TEXT_INFO_HEADING_EDIT_COUNTRY', 'Editando País');
define('TEXT_INFO_HEADING_EDIT_TAX_RATE', 'Editando Taxa');
define('TEXT_INFO_HEADING_NEW_TAX_RATE', 'Nova Taxa');

define('BOX_TOOLS_BANNER_MANAGER', 'Gerenciar Banners');
define('BOX_TOOLS_CACHE', 'Gerenciar Cache');
define('BOX_TOOLS_FILE_MANAGER', 'Gerenciar Arquivos');
define('BOX_TOOLS_NEWSLETTER_MANAGER', 'Gerenciar NewsLetter');
define('TEXT_DISPLAY_NUMBER_OF_NEWSLETTERS', 'Número de NewsLetters');
define('BOX_TOOLS_SERVER_INFO', 'Informação PHP');
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
define('TITLE', 'osCommerce administração - Pafemar Ferramentas');

// header text in includes/header.php
define('HEADER_TITLE_TOP', 'Administração');
define('HEADER_TITLE_SUPPORT_SITE', 'Suporte da Loja');
define('HEADER_TITLE_ONLINE_CATALOG', 'Catálogo Online');
define('HEADER_TITLE_ADMINISTRATION', 'Administração');

define('TEXT_INFO_HEADING_NEW_ADMINISTRATOR','Novo Administrador');
define('TEXT_INFO_INSERT_INTRO','Inserir Novo Administrador');
define('TEXT_INFO_PASSWORD','Senha');
define('TEXT_INFO_DELETE_INTRO','Deletar');
define('TEXT_PRODUCTS_PRICE_NET','Preço:');
define('TEXT_PRODUCTS_PRICE_GROSS','Preço:');
// text for gender
define('MALE', 'Masculino');
define('FEMALE', 'Feminino');

// text para pf pj
define('PF', 'Pessoa Física');
define('PJ', 'Pessoa Jurídica');

// text for date of birth example
define('DOB_FORMAT_STRING', 'dd/mm/yyyy');

// configuration box text in includes/boxes/configuration.php
define('BOX_HEADING_CONFIGURATION', 'Configurações');
define('BOX_CONFIGURATION_MYSTORE', 'MINHA LOJA');
define('BOX_CONFIGURATION_LOGGING', 'Log');
define('BOX_CONFIGURATION_CACHE', 'Cache');
define('BOX_CONFIGURATION_ADMINISTRATORS', 'Administrador');

// modules box text in includes/boxes/modules.php
define('BOX_HEADING_MODULES', 'Módulos');
define('BOX_MODULES_PAYMENT', 'Pagamento');
define('BOX_MODULES_SHIPPING', 'Frete');
define('BOX_MODULES_ORDER_TOTAL', 'Total de Pedidos');

// categories box text in includes/boxes/catalog.php
define('BOX_HEADING_CATALOG', 'Produtos');
define('BOX_CATALOG_CATEGORIES_PRODUCTS', 'Categorias / Produtos');
define('BOX_CATALOG_CATEGORIES_PRODUCTS_ATTRIBUTES', 'Atributos');
define('BOX_CATALOG_MANUFACTURERS', 'Fabricantes');
define('BOX_CATALOG_REVIEWS', 'Comentários');
define('BOX_CATALOG_SPECIALS', 'Ofertas');
define('BOX_CATALOG_PRODUCTS_EXPECTED', 'Lançamentos');

// customers box text in includes/boxes/customers.php
define('BOX_HEADING_CUSTOMERS', 'Clientes');
define('BOX_CUSTOMERS_CUSTOMERS', 'Clientes');
define('BOX_CUSTOMERS_ORDERS', 'Pedidos');
define('BOX_CUSTOMERS_CHANGE_PASSWORD', 'Modificar Senha');

// taxes box text in includes/boxes/taxes.php
define('BOX_HEADING_LOCATION_AND_TAXES', 'Localização/Impostos');
define('BOX_TAXES_COUNTRIES', 'Países');
define('BOX_TAXES_ZONES', 'Estados');
define('BOX_TAXES_GEO_ZONES', 'Taxas de Estados');
define('BOX_TAXES_TAX_CLASSES', 'Tipos de Imposto');
define('BOX_TAXES_TAX_RATES', 'Porcentagens');

// reports box text in includes/boxes/reports.php
define('BOX_HEADING_REPORTS', 'Estatísticas');
define('BOX_REPORTS_PRODUCTS_VIEWED', 'Produtos Mais Vistos');
define('BOX_REPORTS_PRODUCTS_PURCHASED', 'Produtos Mais Comprados');
define('BOX_REPORTS_ORDERS_TOTAL', 'Total de Pedidos por Cliente');

// tools text in includes/boxes/tools.php
define('BOX_HEADING_TOOLS', 'Ferramentas');
define('BOX_TOOLS_BACKUP', 'Cópia do banco de dados');
define('BOX_TOOLS_BANNER_MANAGER', 'Gerenciador de Banners');
define('BOX_TOOLS_CACHE', 'Controle de Cache');
define('BOX_TOOLS_DEFINE_LANGUAGE', 'Definir Línguas');
define('BOX_TOOLS_FILE_MANAGER', 'Gerenciador de Arquivos');
define('BOX_TOOLS_MAIL', 'Enviar Email');
define('BOX_TOOLS_NEWSLETTER_MANAGER', 'Gerenciador de Newsletter');
define('BOX_TOOLS_SERVER_INFO', 'Informações de Servidor');
define('BOX_TOOLS_WHOS_ONLINE', 'Quem está online?');

// localizaion box text in includes/boxes/localization.php
define('BOX_HEADING_LOCALIZATION', 'Localização');
define('BOX_LOCALIZATION_CURRENCIES', 'Moedas');
define('BOX_LOCALIZATION_LANGUAGES', 'Idiomas');
define('BOX_LOCALIZATION_ORDERS_STATUS', 'Status dos Pedidos');

// javascript messages
define('JS_ERROR', 'Houve alguns erros no processamento do formulário!\nPor favor, faça as seguintes modificações:\n\n');

define('JS_OPTIONS_VALUE_PRICE', '* O atributo precisa de um preço\n');
define('JS_OPTIONS_VALUE_PRICE_PREFIX', '* O atributo precisa de um prefixo para o preço\n');

define('JS_PRODUCTS_NAME', '* O produto precisa de um nome\n');
define('JS_PRODUCTS_DESCRIPTION', '* Você deve inserir a descrição do produto\n');
define('JS_PRODUCTS_PRICE', '* O produto precisa de um preço\n');
define('JS_PRODUCTS_WEIGHT', '* Você deve especificar o peso do produto\n');
define('JS_PRODUCTS_QUANTITY', '* Deve especificar a quantidade\n');
define('JS_PRODUCTS_MODEL', '* Deve especificar o modelo\n');
define('JS_PRODUCTS_IMAGE', '* Deve inserir uma imagem\n');

define('JS_PRODUCTS_EXPECTED_NAME', '* O campo \'Produto\' deve ter um valor\n');
define('JS_PRODUCTS_EXPECTED_DATE', '* A data deve estar em formato: xx/xx/xxxx (dia/mes/año).\n');

define('JS_GENDER', '* O \'Sexo\' deve ser escolhido.\n');
define('JS_FIRST_NAME', '* O \'Nome\' deve ter no mínimo ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' caracteres.\n');
define('JS_LAST_NAME', '* O \'Sobrenome\' deve ter no mínimo ' . ENTRY_LAST_NAME_MIN_LENGTH . ' caracteres.\n');
define('JS_PF_PJ', '* O \'Tipo de Cliente\' deve ser escolhido.\n');
define('JS_DOB', '* A \'Data de Nascimento\' deve estar no formato: xx/xx/xxxx (dia/mês/ano).\n');
define('JS_EMAIL_ADDRESS', '* O \'E-Mail\' deve ter no mínimo ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' caracteres.\n');
define('JS_ADDRESS', '* O \'Endereço\' deve ter no mínimo ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' caracteres.\n');
define('JS_ADDRESS2', '* O \'CPF\' deve ter no mínimo' . ENTRY_STREET_ADDRESS2_MIN_LENGTH . ' caracteres.\n');
define('JS_ADDRESS3', '* O \'RG\' deve ter no mínimo' . ENTRY_STREET_ADDRESS3_MIN_LENGTH . ' caracteres.\n');
define('JS_POST_CODE', '* O \'CEP\' deve ter no mínimo ' . ENTRY_POSTCODE_MIN_LENGTH . ' caracteres.\n');
define('JS_CITY', '* A \'Cidade\' deve ter no mínimo ' . ENTRY_CITY_MIN_LENGTH . ' caracteres.\n');
define('JS_STATE', '* O \'Estado\' deve ser selecionado.\n');
define('JS_STATE_SELECT', '-- Selecione Acima --');
define('JS_ZONE', '* O \'Estado\' deve ser selecionado através da lista para este País.');
define('JS_COUNTRY', '* O \'País\' deve ser escolhido.\n');
define('JS_TELEPHONE', '* O \'Fone\' deve ter no mínimo ' . ENTRY_TELEPHONE_MIN_LENGTH . ' caracteres.\n');
define('JS_DDD', '* O \'DDD\' deve ter no mínimo ' . ENTRY_DDD_MIN_LENGTH . ' caracteres.\n');
define('JS_NR_RUA', '* A \'Rua ou Av\' deve ter no mínimo ' . ENTRY_NR_RUA_MIN_LENGTH . ' caracteres.\n');
define('JS_COMP_REF', '* O \'complemento ou referência\' deve ter no mínimo ' . ENTRY_COMP_REF_MIN_LENGTH . ' caracteres.\n');
define('JS_PASSWORD', '* A \'Senha\' e \'Confirmação\' devem combinar e ter no mínimo ' . ENTRY_PASSWORD_MIN_LENGTH . ' caracteres.\n');

define('JS_ORDER_DOES_NOT_EXIST', 'O pedido número %s não existe!');

define('CATEGORY_PERSONAL', 'Pessoal');
define('CATEGORY_ADDRESS', 'Endereço');
define('CATEGORY_CONTACT', 'Contato');
define('CATEGORY_PASSWORD', 'Senha');
define('CATEGORY_COMPANY', 'Empresa');
define('CATEGORY_OPTIONS', 'Opções');
define('ENTRY_GENDER', 'Sexo:');
define('ENTRY_GENDER_ERROR', '&nbsp;<small><font color="#AABBDD">obrigatório</font></small>');
define('ENTRY_GENDER_TEXT', '&nbsp;<small><font color="#AABBDD">obrigatório</font></small>');
define('ENTRY_FIRST_NAME', 'Nome:');
define('ENTRY_FIRST_NAME_TEXT', '&nbsp;<small><font color="#AABBDD">obrigatório</font></small>');
define('ENTRY_LAST_NAME', 'Sobrenome:');
define('ENTRY_LAST_NAME_TEXT', '&nbsp;<small><font color="#AABBDD">obrigatório</font></small>');
define('ENTRY_DATE_OF_BIRTH', 'Data de nascimento:');
define('ENTRY_DATE_OF_BIRTH_TEXT', '&nbsp;<small>(ej. 21/05/1970) <font color="#AABBDD">obrigatório</font></small>');
define('ENTRY_EMAIL_ADDRESS', 'E-Mail:');
define('ENTRY_EMAIL_ADDRESS_TEXT', '&nbsp;<small><font color="#AABBDD">obrigatório</font></small>');
define('ENTRY_COMPANY', 'Empresa:');
define('ENTRY_COMPANY_TEXT', '');
define('ENTRY_STREET_ADDRESS', 'Endereço:');
define('ENTRY_STREET_ADDRESS_TEXT', '&nbsp;<small><font color="#AABBDD">obrigatório</font></small>');
define('ENTRY_SUBURB', 'Bairro:');
define('ENTRY_SUBURB_TEXT', '');
define('ENTRY_POST_CODE', 'CEP:');
define('ENTRY_POST_CODE_TEXT', '&nbsp;<small><font color="#AABBDD">obrigatório</font></small>');
define('ENTRY_CITY', 'Cidade:');
define('ENTRY_CITY_TEXT', '&nbsp;<small><font color="#AABBDD">obrigatório</font></small>');
define('ENTRY_STATE', 'Estado:');
define('ENTRY_STATE_TEXT', '');
define('ENTRY_COUNTRY', 'País:');
define('ENTRY_COUNTRY_TEXT', '&nbsp;<small><font color="#AABBDD">obrigatório</font></small>');
define('ENTRY_TELEPHONE_NUMBER', 'Telefone:');
define('ENTRY_TELEPHONE_NUMBER_TEXT', '&nbsp;<small><font color="#AABBDD">obrigatório</font></small>');
define('ENTRY_FAX_NUMBER', 'FAX:');
define('ENTRY_FAX_NUMBER_TEXT', 'necessário para emissão de Nota Fiscal');
define('ENTRY_NEWSLETTER', 'Receber ofertas e promoções:');
define('ENTRY_NEWSLETTER_YES', 'sim');
define('ENTRY_NEWSLETTER_NO', 'não');
define('ENTRY_PASSWORD', 'Senha:');
define('ENTRY_PASSWORD_CONFIRMATION', 'Confirmação:');
define('ENTRY_PASSWORD_CONFIRMATION_TEXT', '&nbsp;<small><font color="#AABBDD">obrigatório</font></small>');
define('ENTRY_PASSWORD_TEXT', '&nbsp;<small><font color="#AABBDD">obrigatório</font></small>');
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
define('IMAGE_MODULE_INSTALL', 'Instalar Módulo');
define('IMAGE_MODULE_REMOVE', 'Remover Módulo');
define('IMAGE_MOVE', 'Mover');
define('IMAGE_NEW_BANNER', 'Novo Banner');
define('IMAGE_NEW_CATEGORY', 'Nova Categoria');
define('IMAGE_NEW_COUNTRY', 'Novo País');
define('IMAGE_NEW_CURRENCY', 'Nova Moeda');
define('IMAGE_NEW_FILE', 'Novo Arquivo');
define('IMAGE_NEW_FOLDER', 'Novo Diretório');
define('IMAGE_NEW_LANGUAGE', 'Novo Idioma');
define('IMAGE_NEW_NEWSLETTER', 'Novo Newsletter');
define('IMAGE_NEW_PRODUCT', 'Novo Produto');
define('IMAGE_NEW_TAX_CLASS', 'Novo Tipo de Imposto');
define('IMAGE_NEW_TAX_RATE', 'Nova Taxa');
define('IMAGE_NEW_ZONE', 'Novo Estado');
define('IMAGE_NEW_GEO_ZONE', 'Nova Zona Geográfica');
define('IMAGE_ORDERS', 'Pedidos');
define('IMAGE_PREVIEW', 'Ver');
define('IMAGE_RESTORE', 'Restaurar');
define('IMAGE_SAVE', 'Gravar');
define('IMAGE_SEARCH', 'Buscar');
define('IMAGE_SELECT', 'Selecionar');
define('IMAGE_UPDATE', 'Atualizar');
define('IMAGE_UPDATE_CURRENCIES', 'Atualizar Cambio da Moeda');
define('IMAGE_UPLOAD', 'Upload');

define('ICON_CURRENT_FOLDER', 'Diretório Corrente');
define('ICON_DELETE', 'Apagar');
define('ICON_ERROR', 'Erro');
define('ICON_FILE', 'Arquivo');
define('ICON_FILE_DOWNLOAD', 'Download');
define('ICON_FOLDER', 'Diretório');
define('ICON_PREVIOUS_LEVEL', 'Previous Level');
define('ICON_WARNING', 'Warning');
define('ICON_PREVIEW', 'Prévia');
define('ICON_STATISTICS', 'Estatísticas');
define('ICON_SUCCESS', 'Sucesso');
define('ICON_TICK', 'Verdade');
define('ICON_UNLOCKED', 'Destravado');
define('ICON_WARNING', 'Atenção');

// constants for use in tep_prev_next_display function
define('TEXT_RESULT_PAGE', 'Páginas:');
define('TEXT_DISPLAY_NUMBER_OF_BANNERS', 'Exibindo de <b>%d</b> a <b>%d</b> (de <b>%d</b> banners)');
define('TEXT_DISPLAY_NUMBER_OF_COUNTRIES', 'Exibindo de <b>%d</b> a <b>%d</b> (de <b>%d</b> países)');
define('TEXT_DISPLAY_NUMBER_OF_CUSTOMERS', 'Exibindo de <b>%d</b> a <b>%d</b> (de <b>%d</b> clientes)');
define('TEXT_DISPLAY_NUMBER_OF_CURRENCIES', 'Exibindo de <b>%d</b> a <b>%d</b> (de <b>%d</b> moedas)');
define('TEXT_DISPLAY_NUMBER_OF_LANGUAGES', 'Exibindo de <b>%d</b> a<b>%d</b> (de <b>%d</b> idiomas)');
define('TEXT_DISPLAY_NUMBER_OF_MANUFACTURERS', 'Exibindo de <b>%d</b> a <b>%d</b> (de <b>%d</b> fabricantes)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS', 'Exibindo de <b>%d</b> a <b>%d</b> (de <b>%d</b> pedidos)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS_STATUS', 'Exibindo de <b>%d</b> a <b>%d</b> (de <b>%d</b> status do pedido)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS', 'Exibindo de <b>%d</b> a <b>%d</b> (de <b>%d</b> produtos)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_EXPECTED', 'Exibindo de <b>%d</b> a <b>%d</b> (de <b>%d</b> productos esperados)');
define('TEXT_DISPLAY_NUMBER_OF_REVIEWS', 'Exibindo de <b>%d</b> a <b>%d</b> (de <b>%d</b> comentários)');
define('TEXT_DISPLAY_NUMBER_OF_SPECIALS', 'Exibindo de <b>%d</b> a <b>%d</b> (de <b>%d</b> ofertas)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_ZONES', 'Exibindo de <b>%d</b> a <b>%d</b> (de <b>%d</b> zonas de impostos)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_RATES', 'Exibindo de <b>%d</b> a <b>%d</b> (de <b>%d</b> porcentagens de impostos)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_CLASSES', 'Exibindo de <b>%d</b> a <b>%d</b> (de <b>%d</b> tipos de imposto)');
define('TEXT_DISPLAY_NUMBER_OF_ZONES', 'Exibindo de <b>%d</b> a <b>%d</b> (de <b>%d</b> estados)');

define('PREVNEXT_TITLE_FIRST_PAGE', 'Inicio');
define('PREVNEXT_TITLE_PREVIOUS_PAGE', 'Anterior');
define('PREVNEXT_TITLE_NEXT_PAGE', 'Próxima');
define('PREVNEXT_TITLE_LAST_PAGE', 'Final');
define('PREVNEXT_TITLE_PAGE_NO', 'Página %d');
define('PREVNEXT_TITLE_PREV_SET_OF_NO_PAGE', 'Anteriores %d Páginas');
define('PREVNEXT_TITLE_NEXT_SET_OF_NO_PAGE', 'Próximas %d Páginas');
define('PREVNEXT_BUTTON_FIRST', '&lt;&lt;INÍCIO');
define('PREVNEXT_BUTTON_PREV', '[&lt;&lt;&nbsp;Anterior]');
define('PREVNEXT_BUTTON_NEXT', '[Próxima&nbsp;&gt;&gt;]');
define('PREVNEXT_BUTTON_LAST', 'FINAL&gt;&gt;');
define('HEADING_TITLE_SEARCH', 'BUSCAR PRODUTOS OU CATEGORIAS');

define('TEXT_DEFAULT', 'padrão');
define('TEXT_SET_DEFAULT', 'Estabelecer como padrão');
define('TEXT_FIELD_REQUIRED', '&nbsp;<span class="fieldRequired">* Requerido</span>');
define('TEXT_TOP', 'TOPO');
define('TEXT_INFO_HEADING_DELETE_CUSTOMER', 'Deletar Cliente');
define('TEXT_INFO_HEADING_DELETE_ORDER', 'Deletar Pedido');
define('TEXT_INFO_RESTOCK_PRODUCT_QUANTITY', 'Repor Estoque');

define('ERROR_BANNER_TITLE', 'Erro: Título do Banner é necessário');
define('ERROR_BANNER_GROUP', 'Erro: Grupo de Banner é necessário');
define('ERROR_NO_DEFAULT_CURRENCY_DEFINED', 'Erro: Não existe uma moeda definida po padrão. Por favor defina uma em: Ferramentas Administrativas->Localização->Moedas');

define('TEXT_CACHE_CATEGORIES', 'Categorias');
define('TEXT_CACHE_MANUFACTURERS', 'Fabricantes');
define('TEXT_CACHE_ALSO_PURCHASED', 'Também Compraram');

define('WARNING_NO_FILE_UPLOADED','Arquivo Não foi enviado:');
define('BOX_REPORTS_MARGIN_REPORT','Estatísticas Vendas e Margens');
define('BOX_CATALOG_DISCOUNT_COUPONS', 'Cupom de Desconto');
define('BOX_REPORTS_DISCOUNT_COUPONS', 'Cupom de Desconto');
define('TEXT_DATE_ORDER_LAST_MODIFIED', 'Última ALteração');
define('TEXT_NO_ORDER_HISTORY', 'Sem Histórico');
define('BOX_BILL_TO_PAY', 'Contas a Pagar');


   define('BOX_TOOLS_EXTRA_FIELDS_MANAGER','Gerenciamento de Campos Extras');
   define('ENTRY_EXTRA_FIELDS_ERROR','Campo %s deverá conter no minimo de %d caracteres');
   define('TEXT_DISPLAY_NUMBER_OF_FIELDS', 'Mostrando <b>%d</b> de <b>%d</b> (de <b>%d</b> Campos)');
//Defaults Specials End
define('BOX_CUSTOMERS_PARABENS', 'Enviar Felicitações');
define('BOX_REPORTS_STOCK_LEVEL', 'Relatório de Estoque Baixo');
define('BOX_CATALOG_CATEGORIES_PRODUCTS_EXTRA_IMAGES','Imagens Extras'); //Added for Extra Images Contribution
?>
