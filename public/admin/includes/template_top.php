<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2010 osCommerce

  Released under the GNU General Public License
*/
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<meta name="robots" content="noindex,nofollow">
<title><?php echo TITLE; ?></title>
<base href="<?php echo HTTP_SERVER . DIR_WS_ADMIN; ?>" />
<!--[if IE]><script type="text/javascript" src="<?php echo tep_catalog_href_link('ext/flot/excanvas.min.js'); ?>"></script><![endif]-->
<link rel="stylesheet" type="text/css" href="<?php echo tep_catalog_href_link('ext/jquery/ui/redmond/jquery-ui-1.8.6.css'); ?>">
<script type="text/javascript" src="<?php echo tep_catalog_href_link('ext/jquery/jquery-1.4.2.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo tep_catalog_href_link('ext/jquery/ui/jquery-ui-1.8.6.min.js'); ?>"></script>

<?php
  if (tep_not_null(JQUERY_DATEPICKER_I18N_CODE)) {
?>
<script type="text/javascript" src="<?php echo tep_catalog_href_link('ext/jquery/ui/i18n/jquery.ui.datepicker-' . JQUERY_DATEPICKER_I18N_CODE . '.js'); ?>"></script>
<script type="text/javascript">
$.datepicker.setDefaults($.datepicker.regional['<?php echo JQUERY_DATEPICKER_I18N_CODE; ?>']);
</script>
<?php
  }
?>

<script type="text/javascript" src="<?php echo tep_catalog_href_link('ext/flot/jquery.flot.js'); ?>"></script>
<link rel="stylesheet" type="text/css" href="includes/stylesheet_cupom.css">
<script type="text/javascript" src="includes/general.js"></script>
<link rel="stylesheet" type="text/css" href="includes/javascript/calendar.css">
<script type="text/javascript" src="includes/javascript/calendarcode.js"></script>
<script language="javascript">
function confirm_delete(a, b) { if (confirm(a)) window.location = b }
function applies_to_onclick() {
  var a = document.new_discount_code.applies_to, b = document.getElementById("excluded_products_id"), c = document.getElementById("number_of_products");
  for (var i = 0, n = a.length; i < n; i++) {
      if (a[i].checked) {
                    c.value = (a[i].value == 5 ? 0 : 1);
          //d.value = (a[i].value == 5 ? 0 : 1);
          b.disabled = (a[i].value == 2 || a[i].value == 4 || a[i].value == 5 ? false : true);
          c.disabled = (a[i].value == 3  || a[i].value == 5 ? true : false);
         // d.disabled = (a[i].value == 5 ? true : false) ;
      }
  }
}
</script>
</head>
<body>

<?php require(DIR_WS_INCLUDES . 'header.php'); ?>

<?php
  if (tep_session_is_registered('admin')) {
  ?>
      <table border="0" width="100%" cellspacing="2" cellpadding="2">
  <tr>
    <td width="<?php echo BOX_WIDTH; ?>" valign="top">
        <table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="1" cellpadding="1" class="columnLeft">
            <?php
                include(DIR_WS_INCLUDES . 'column_left.php');
             ?>
      </table>
    </td>
  </tr>
      </table>
<!-- body_text //-->
   <!-- <td width="100%" valign="top">-->
        <?php
  } else {
?>

<style>
#contentText {
  margin-left: 0;
}
</style>

<?php
  }
?>
   <!-- <div id="contentText">-->

