<?php
/*
  $Id: products_extra_images.php,v 1.0 2003/06/11 Mikel Williams

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

	Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Imagens Extras de Produtos');
define('TABLE_HEADING_PRODUCTS_MODEL', 'Modelo');
define('TABLE_HEADING_PRODUCTS_NAME', 'Nome do Produto');

/* Added for product image*/
define('TABLE_HEADING_PRODUCTS_IMAGE', 'Produto');
define('TABLE_HEADING_PRODUCTS_IMAGE_PATH', 'Caminho(Pasta de Imagens)');
define('TABLE_HEADING_PRODUCTS_EXTRA_IMAGE', 'Imagens extras');
/* Added for product image*/

define('TABLE_HEADING_PRODUCTS_ID', 'Identificação de Produto');
define('TABLE_HEADING_ACTION', 'Ação');

define('TEXT_PAGING_FORMAT', 'Mostrar <b>%d</b> to <b>%d</b> (de <b>%d</b> Imagens Extras)');
define('TEXT_HEADING_EDIT_EXTRA_IMAGE', 'Editar Iamgem Extra');
define('TEXT_HEADING_NEW_EXTRA_IMAGE', 'Nova Imagem Extra');
define('TEXT_NEW_INTRO', 'Por favor preencha a informação seguinte para a imagem de produto extra nova');
define('TEXT_EDIT_INTRO', 'Por favor, faça as mudanças necessárias');
define('TEXT_PRODUCTS', 'Número de Produtos:');

/* Added for small improvements in upload UI */
define('TEXT_PRODUCTS_NAME', 'Nome do Produto:');
define('TEXT_PRODUCTS_IMAGE', 'Imagem do Produto:');

/* Added for fix and allows for setting customized paths to image on server*/
define('TEXT_IMAGE_NONEXISTENT', 'IMAGE INEXISTENTE');
define('TEXT_SPECIAL_IMAGE_PATH', 'Caso envie um arquivo para uma pasta diferente de /images/ <BR />informe o caminho dessa pasta - exemplo: extras/ .');
define('UPDATE_EXTRA_IMAGE_OPTION', 'Caso a imagem já tenha sido enviada para o servidor e deseja alterar o diretório,<br />altere o campo abaixo colocando o nome do diretório antes do nome da imagem - exemplo: extras/imagem.jpg.');
/* Added for fix and allows for setting customized paths to image on server*/

/** Added to place a link to insert a link to add a new image on the top of the table **/
define(ACTION_ADD_NEW_EXTRA_IMAGE, "Adicionar uma Nova Imagem");
?>
