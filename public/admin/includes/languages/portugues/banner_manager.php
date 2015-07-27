<?php
/***************************************************************************/
/*                                                                         */
/*  osCommerce, Open Source E-Commerce Solutions                           */
/*  http://www.oscommerce.com                                              */
/*  Released under the GNU General Public License                          */
/*                                                                         */
/*  Translation Brazilian by:                                              */
/*  Tradu��o Para o Portugu�s Brasil por:                                  */
/*  Reginaldo Gomes (Envoy) envoy@phpmania.org | http://phpmania.org       */
/*  osCommerce 2.2 Milestone 2 Portugu�s-Brasil Vers�o PHPmania.org        */
/*                                                                         */
/***************************************************************************/

define('HEADING_TITLE', 'Gerenciador de Banner');

define('TABLE_HEADING_BANNERS', 'Banners');
define('TABLE_HEADING_GROUPS', 'Grupos');
define('TABLE_HEADING_STATISTICS', 'Vistos / Clicados');
define('TABLE_HEADING_STATUS', 'Status');
define('TABLE_HEADING_ACTION', 'A��o');
define('TEXT_BANNERS_TITLE', 'T�tulo do Banner:');
define('TEXT_BANNERS_URL', 'Endere�o do Banner:');
define('TEXT_BANNERS_GROUP', 'Grupo do Banner:');
define('TEXT_BANNERS_NEW_GROUP', ', ou entre com um novo grupo de banner abaixo');
define('TEXT_BANNERS_IMAGE', 'Imagem:');
define('TEXT_BANNERS_IMAGE_LOCAL', ', ou entre com o arquivo local abaixo');
define('TEXT_BANNERS_IMAGE_TARGET', 'Imagem  (Salvar como):');
define('TEXT_BANNERS_HTML_TEXT', 'Texto HTML :');
define('TEXT_BANNERS_EXPIRES_ON', 'Expira Em:');
define('TEXT_BANNERS_OR_AT', ', ou ap�s');
define('TEXT_BANNERS_IMPRESSIONS', ' impress�es/vistas.');
define('TEXT_BANNERS_SCHEDULED_AT', 'Programado para:');
define('TEXT_BANNERS_BANNER_NOTE', '<b>Nota sobre o Banner:</b><ul><li>Use uma imagem ou um texto HTML para o banner - n�o ambos.</li><li>o Texto HTML tem prioridade sobre uma imagem</li></ul>');
define('TEXT_BANNERS_INSERT_NOTE', '<b>Nota sobre a Imagem:</b><ul><li>Os diret�rios de upload(envio) devem ter as permiss�es de escrita(CHMOD) apropriadas!</li><li>N�o preencha o campo \'Salvar Como\' se voc� n�o estiver fazendo o upload de uma imagem para o servidor (ie, se estiver usando uma imagem local).</li><li>O campo \'Salvar Como\' deve ser um diret�rio existente e terminar com uma barra (ex, banners/).</li></ul>');
define('TEXT_BANNERS_EXPIRCY_NOTE', '<b>Nota sobre a expira��o:</b><ul><li>Apenas um dos dois campos deve ser preenchido</li><li>Se o banner n�o expira automaticamente, deixe ambos em branco</li></ul>');
define('TEXT_BANNERS_SCHEDULE_NOTE', '<b>Nota sobre a Programa��o:</b><ul><li>Se uma programa��o foi definida, o baner ser� ativado naquela data.</li><li>Todos os baners programados s�o marcados como desativados at� que aquela data tenha chegado, e ent�o ser�o marcados como ativos.</li></ul>');

define('TEXT_BANNERS_DATE_ADDED', 'Adicionado em :');
define('TEXT_BANNERS_SCHEDULED_AT_DATE', 'Programado para: <b>%s</b>');
define('TEXT_BANNERS_EXPIRES_AT_DATE', 'Expira em: <b>%s</b>');
define('TEXT_BANNERS_EXPIRES_AT_IMPRESSIONS', 'Expira ap�s : <b>%s</b> impress�es');
define('TEXT_BANNERS_STATUS_CHANGE', 'Status da Mudan�a: %s');

define('TEXT_BANNERS_DATA', 'D<br>A<br>T<br>A');
define('TEXT_BANNERS_LAST_3_DAYS', '�ltimos 3 Dias');
define('TEXT_BANNERS_BANNER_VIEWS', 'Banner Vistos');
define('TEXT_BANNERS_BANNER_CLICKS', 'Banner Clicados');

define('TEXT_INFO_DELETE_INTRO', 'Tem certeza que quer deletar este banner?');
define('TEXT_INFO_DELETE_IMAGE', 'Deletar a figura do banner');

define('SUCCESS_BANNER_INSERTED', 'Sucesso: O banner foi inserido.');
define('SUCCESS_BANNER_UPDATED', 'Sucesso: O banner foi atualizado.');
define('SUCCESS_BANNER_REMOVED', 'Sucesso: O banner foi removido.');
define('SUCCESS_BANNER_STATUS_UPDATED', 'Sucesso: O status do baner foi atualizado.');

define('ERROR_BANNER_TITLE_REQUIRED', 'Erro: T�tulo do Banner requerido.');
define('ERROR_BANNER_GROUP_REQUIRED', 'Erro: Grupo do Banner requerido.');
define('ERROR_IMAGE_DIRECTORY_DOES_NOT_EXIST', 'Erro: Este diret�rio n�o existe: %s');
define('ERROR_IMAGE_DIRECTORY_NOT_WRITEABLE', 'Erro: Diret�rio protegido contra escrita: %s');
define('ERROR_IMAGE_DOES_NOT_EXIST', 'Erro: Figura n�o existe.');
define('ERROR_IMAGE_IS_NOT_WRITEABLE', 'Erro: Figur�o n�o p�de ser removida.');
define('ERROR_UNKNOWN_STATUS_FLAG', 'Erro: flag de Status desconhecido.');

define('ERROR_GRAPHS_DIRECTORY_DOES_NOT_EXIST', 'Erro: Diret�rio Graphs n�o existe. Por favor crie o diret�rio \'graphs\' dentro de  \'images\'.');
define('ERROR_GRAPHS_DIRECTORY_NOT_WRITEABLE', 'Erro: Diret�rio Graphs protegido contra escrita.');
?>
