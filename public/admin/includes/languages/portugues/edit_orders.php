<?php
/*
  $Id: edit_orders.php v5.0 08/05/2007 djmonkey1 Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com 

  Copyright (c) 2007 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Editar PEdido #%s de %s');
define('ADDING_TITLE', 'Adicionar Produto(s) no Pedido #%s');

define('ENTRY_UPDATE_TO_CC', '(Atualizar Para ' . ORDER_EDITOR_CREDIT_CARD . ' para visualizar os campos do CC.)');
define('TABLE_HEADING_COMMENTS', 'Comentários');
define('TABLE_HEADING_STATUS', 'Estatus');
define('TABLE_HEADING_NEW_STATUS', 'Novo estatus');
define('TABLE_HEADING_ACTION', 'Ação');
define('TABLE_HEADING_DELETE', 'Deletar?');
define('TABLE_HEADING_QUANTITY', 'Qtd.');
define('TABLE_HEADING_PRODUCTS_MODEL', 'Modelo');
define('TABLE_HEADING_PRODUCTS', 'Produtos');
define('TABLE_HEADING_TAX', 'Taxa');
define('TABLE_HEADING_TOTAL', 'Total');
define('TABLE_HEADING_BASE_PRICE', 'Preço<br>(base)');
define('TABLE_HEADING_UNIT_PRICE', 'Preço<br>(excl.)');
define('TABLE_HEADING_UNIT_PRICE_TAXED', 'Preço<br>(incl.)');
define('TABLE_HEADING_TOTAL_PRICE', 'Total<br>(excl.)');
define('TABLE_HEADING_TOTAL_PRICE_TAXED', 'Total<br>(incl.)');
define('TABLE_HEADING_OT_TOTALS', 'Total Pedido:');
define('TABLE_HEADING_OT_VALUES', 'Valor:');
define('TABLE_HEADING_SHIPPING_QUOTES', 'Cotação de Frete:');
define('TABLE_HEADING_NO_SHIPPING_QUOTES', 'Não existe cotação de frete para mostrar!');

define('TABLE_HEADING_CUSTOMER_NOTIFIED', 'Cliente <br>Notificado');
define('TABLE_HEADING_DATE_ADDED', 'Date Adicionada');

define('ENTRY_CUSTOMER', 'Clientes');
define('ENTRY_NAME', 'Nome:');
define('ENTRY_CITY_STATE', 'Cidade, Estado:');
define('ENTRY_SHIPPING_ADDRESS', 'Endereço de Envio');
define('ENTRY_BILLING_ADDRESS', 'Endereço de Cobrança');
define('ENTRY_PAYMENT_METHOD', 'Metodo de Pagamento');
define('ENTRY_CREDIT_CARD_TYPE', 'Tipo de Cartão:');
define('ENTRY_CREDIT_CARD_OWNER', 'Proprietário do Cartão:');
define('ENTRY_CREDIT_CARD_NUMBER', 'Número Cartão:');
define('ENTRY_CREDIT_CARD_EXPIRES', 'Cartão Expira:');
define('ENTRY_SUB_TOTAL', 'Sub-Total:');
define('ENTRY_TYPE_BELOW', 'Tipo abaixo');

//the definition of ENTRY_TAX is important when dealing with certain tax components and scenarios
define('ENTRY_TAX', 'Taxa');
//do not use a colon (:) in the defintion, ie 'VAT' is ok, but 'VAT:' is not

define('ENTRY_SHIPPING', 'Frete:');
define('ENTRY_TOTAL', 'Total:');
define('ENTRY_STATUS', 'Estatus:');
define('ENTRY_NOTIFY_CUSTOMER', 'Notificar Cliente:');
define('ENTRY_NOTIFY_COMMENTS', 'Enviar Comentários:');
define('ENTRY_CURRENCY_TYPE', 'Moeda');
define('ENTRY_CURRENCY_VALUE', 'Valor da Moeda');

define('TEXT_INFO_PAYMENT_METHOD', 'Metodo de Pagamento:');
define('TEXT_NO_ORDER_PRODUCTS', 'Este pedido não contém produtos');
define('TEXT_ADD_NEW_PRODUCT', 'Adicionar produtos');
define('TEXT_PACKAGE_WEIGHT_COUNT', 'Pacote Peso: %s  |  Produto Qtd: %s');

define('TEXT_STEP_1', '<b>Passo 1:</b>');
define('TEXT_STEP_2', '<b>Passo 2:</b>');
define('TEXT_STEP_3', '<b>Passo 3:</b>');
define('TEXT_STEP_4', '<b>Passo 4:</b>');
define('TEXT_SELECT_CATEGORY', '- Selecione uma Categoria da Lista -');
define('TEXT_PRODUCT_SEARCH', '<b>- OU pesquise no campo abaixo -</b>');
define('TEXT_ALL_CATEGORIES', 'Todas Categorias/Todos Produtos');
define('TEXT_SELECT_PRODUCT', '- Selecione um Produto -');
define('TEXT_BUTTON_SELECT_OPTIONS', 'Selecione essa Opção');
define('TEXT_BUTTON_SELECT_CATEGORY', 'Selecione essa Categoria');
define('TEXT_BUTTON_SELECT_PRODUCT', 'Selecione esse Produto');
define('TEXT_SKIP_NO_OPTIONS', '<em>Sem Opções - Pular...</em>');
define('TEXT_QUANTITY', 'Quantidade:');
define('TEXT_BUTTON_ADD_PRODUCT', 'Adicionar ao Pedido');
define('TEXT_CLOSE_POPUP', '<u>Fechar</u> [x]');
define('TEXT_ADD_PRODUCT_INSTRUCTIONS', 'Adicone produtos até finalizar.<br>Depois feche esta tab/Janela, e retorne para a tab/Janela principal, e pressione o botão Atualizar.');
define('TEXT_PRODUCT_NOT_FOUND', '<b>Produto não encontrado<b>');
define('TEXT_SHIPPING_SAME_AS_BILLING', 'Endereço de Envio é igual ao de Cobrança');
define('TEXT_BILLING_SAME_AS_CUSTOMER', 'Endereço de Cobrança é igual ao do Cliente');

define('IMAGE_ADD_NEW_OT', 'Inserir novo pedido após finalizar este');
define('IMAGE_REMOVE_NEW_OT', 'Remova este pedido total do componente');
define('IMAGE_NEW_ORDER_EMAIL', 'Enviar novo pedido de confirmação de email');

define('TEXT_NO_ORDER_HISTORY', 'Histório de Pedido Indisponível');

define('PLEASE_SELECT', 'Plor favor Selecione');

define('EMAIL_SEPARATOR', '------------------------------------------------------');
define('EMAIL_TEXT_SUBJECT', 'Seu Pedido foi atualizado');
define('EMAIL_TEXT_ORDER_NUMBER', 'Número Pedido:');
define('EMAIL_TEXT_INVOICE_URL', 'Detalhe Nota:');
define('EMAIL_TEXT_DATE_ORDERED', 'Data Adicionado:');
define('EMAIL_TEXT_STATUS_UPDATE', 'Muito Obrigado por efetuar seu pedido conosco!' . "\n\n" . 'O estatus do seu pedido foi atualizado.' . "\n\n" . 'Novo estatus: %s' . "\n\n");
define('EMAIL_TEXT_STATUS_UPDATE2', 'Se tem dúvidas, por favor responde este email.' . "\n\n" . 'Ao cuidados de ' . STORE_NAME . "\n");
define('EMAIL_TEXT_COMMENTS_UPDATE', 'Os comentários do seu pedido são' . "\n\n%s\n\n");

define('ERROR_ORDER_DOES_NOT_EXIST', 'Erro: Pedido %s não existe.');
define('ERROR_NO_ORDER_SELECTED', 'Você não selecionou um pedido para editar, ou o número do pedido não foi definido.');
define('SUCCESS_ORDER_UPDATED', 'Successo: Pedido foi atualizado com sucesso.');
define('SUCCESS_EMAIL_SENT', 'Completo: O pedido foi atualizado e um email com as novas informações foram enviadas.');

//the hints
define('HINT_UPDATE_TO_CC', 'Definir metodo de pagamento para ' . ORDER_EDITOR_CREDIT_CARD . ' e os outros campos serão mostrados automaticamente. Campos do CC são escondidos, caso outro metodo de pagamentos seja selecionado. O nome do metodo de pagamento, quando selecionado, mostrará o campo do CC configurado na seção de configuração do sistema Administrativo.');
define('HINT_UPDATE_CURRENCY', 'Alterando a moeda causará cotação do frrete e pedido total recalculados ao atualizar.');
define('HINT_SHIPPING_ADDRESS', 'Se alterar o estado do endereço de envio, cep, ou pais você terá opção de editar ou não o valor do pedido total e atualizar o valor do frete.');
define('HINT_TOTALS', 'Tenha liberdade de adicionar desconto adicionando valores negativos. Subtotal, taxa total, e o campo total não estão disponíveis para editar. Quando adicionar um componente do pedido total por AJAX tenha certeza de colocar o título primeiro ou o código não reconhecerá a informação (ie, um componente com título em branco é deletado do pedido).');
define('HINT_PRESS_UPDATE', 'Por favor clique em "Atualizar" para salvar todas alterações.');
define('HINT_BASE_PRICE', 'Preço (base) é o valor do produto antes dos atributos (ie, o preço de catalago do item)');
define('HINT_PRICE_EXCL', 'Preço (excl) é o valor mais valores de atributos caso existam');
define('HINT_PRICE_INCL', 'Preço (incl) é o valor (excl) vezes a taxa');
define('HINT_TOTAL_EXCL', 'Total (excl) é o valor (excl) vezes qtd');
define('HINT_TOTAL_INCL', 'Total (incl) é o valor (excl) vezes taxa e qtd');
//end hints

//new order confirmation email- this is a separate email from order status update
define('ENTRY_SEND_NEW_ORDER_CONFIRMATION', 'Nova confirmação de Pedido:');
define('EMAIL_TEXT_DATE_MODIFIED', 'Data de Modificação:');
define('EMAIL_TEXT_PRODUCTS', 'Produtos');
define('EMAIL_TEXT_DELIVERY_ADDRESS', 'Endereço de Entrega');
define('EMAIL_TEXT_BILLING_ADDRESS', 'Endereço de Cobrança');
define('EMAIL_TEXT_PAYMENT_METHOD', 'Metodo de Pagamento');
// If you want to include extra payment information, enter text below (use <br> for line breaks):
//define('EMAIL_TEXT_PAYMENT_INFO', ''); //why would this be useful???
// If you want to include footer text, enter text below (use <br> for line breaks):
define('EMAIL_TEXT_FOOTER', '');
//end email

//add-on for downloads
define('ENTRY_DOWNLOAD_COUNT', 'Download #');
define('ENTRY_DOWNLOAD_FILENAME', 'Nome do Arquivo');
define('ENTRY_DOWNLOAD_MAXDAYS', 'Expirar em dias');
define('ENTRY_DOWNLOAD_MAXCOUNT', 'Downloads restantes');

//add-on for Ajax
define('AJAX_CONFIRM_PRODUCT_DELETE', 'Você tem certeza que deseja deletar este produto do pedido?');
define('AJAX_CONFIRM_COMMENT_DELETE', 'Você tem certeza que deseja deletar este comentário do historico do pedido?');
define('AJAX_MESSAGE_STACK_SUCCESS', 'Successo! \' + %s + \' foi atualizado');
define('AJAX_CONFIRM_RELOAD_TOTALS', 'Você alterou algumas enformação do endereço de envio. Gostaria de recalcular o valor do pedido e o frete?');
define('AJAX_CANNOT_CREATE_XMLHTTP', 'Não foi possivel criar a instância XMLHTTP');
define('AJAX_SUBMIT_COMMENT', 'Enviar novo comentário e/ou estatus');
define('AJAX_NO_QUOTES', 'Não existe valor de frete para exibir.');
define('AJAX_SELECTED_NO_SHIPPING', 'Você selecionou um metodo de frete no pedido mas aparentemente este não é o metodo gravado em nosso banco de dados. Gostaria de adicionar um novo valor de frete no pedido?');
define('AJAX_RELOAD_TOTALS', 'O novo componente de frete foi gravado no banco de dados mas o total ainda não foi recalculado.  Clique ok agora para recalcular o pedido total. Se sua coneção for lenta aguarde todos os componentes carregarem antes de clicar em ok.');
define('AJAX_NEW_ORDER_EMAIL', 'Você tem certeza que deseja enviar um novo email com pedido de confirmação para este pedido?');
define('AJAX_INPUT_NEW_EMAIL_COMMENTS', 'Por favor adicione seu comentários aqui. Deixe área de texto em branco caso não deseje adicionar comentários.  Por favor lembre-se de pressionar a tecla "enter" para enviar os comentários. Não é possivel inserir quebras de linha.');
define('AJAX_SUCCESS_EMAIL_SENT', 'Successo!  Um novo email com pedido de confirmaçãoA foi enviado para %s');
define('AJAX_WORKING', 'Working, por favor aguarde....');


?>
