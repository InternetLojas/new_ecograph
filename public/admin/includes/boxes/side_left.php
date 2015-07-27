<?php
/*
  $Id: side_left.php,v 1.21 2003/07/09 01:18:53 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
 */
?>
<!-- side_left //-->
<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="side-menu">
            <li>
                <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Configuraç?o<span class="fa arrow"></span></a>
                <?php
                $cfg_groups = '';
                $configuration_groups_query = tep_db_query("select configuration_group_id as cgID, configuration_group_title as cgTitle from " . TABLE_CONFIGURATION_GROUP . " where visible = '1' order by sort_order");
                while ($configuration_groups = tep_db_fetch_array($configuration_groups_query)) {
                    $cfg_groups .= '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=' . $configuration_groups['cgID'], 'NONSSL') . '">' . $configuration_groups['cgTitle'] . '</a></li>';
                }
                ?>
                <ul class="nav nav-second-level">
                    <?php echo $cfg_groups; ?>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Módulos<span class="fa arrow"></span></a>
                <?php
                $cfg_groups_m = '<li><a href="' . tep_href_link(FILENAME_MODULES, 'set=payment', 'NONSSL') . '" >' . BOX_MODULES_PAYMENT . '</a></li>' .
                        '<li><a href="' . tep_href_link(FILENAME_MODULES, 'set=shipping', 'NONSSL') . '" >' . BOX_MODULES_SHIPPING . '</a></li>' .
                        '<li><a href="' . tep_href_link(FILENAME_MODULES, 'set=ordertotal', 'NONSSL') . '" >' . BOX_MODULES_ORDER_TOTAL . '</a></li>';
                ?>
                <ul class="nav nav-second-level">
                    <?php echo $cfg_groups_m; ?>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Clientes<span class="fa arrow"></span></a>
                <?php
                $cfg_groups_c = '<li><a href="' . tep_href_link(FILENAME_CUSTOMERS, '', 'NONSSL') . '">' . BOX_CUSTOMERS_CUSTOMERS . '</a></li>' .
                        '<li><a href="' . tep_href_link('orcamentos.php', '', 'NONSSL') . '" >Orçamentos</a></li>' .
                        '<li><a href="' . tep_href_link(FILENAME_ORDERS, '', 'NONSSL') . '" >' . BOX_CUSTOMERS_ORDERS . '</a></li>';
                ?>
                <ul class="nav nav-second-level">
                    <?php echo $cfg_groups_c; ?>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Estatísticas<span class="fa arrow"></span></a>
                <?php
                $cfg_groups_e = '<li><a href="' . tep_href_link(FILENAME_STATS_PRODUCTS_VIEWED, '', 'NONSSL') . '" >' . BOX_REPORTS_PRODUCTS_VIEWED . '</a></li>' .
                        '<li><a href="' . tep_href_link(FILENAME_STATS_PRODUCTS_PURCHASED, '', 'NONSSL') . '" >' . BOX_REPORTS_PRODUCTS_PURCHASED . '</a></li>' .
                        '<li><a href="' . tep_href_link(FILENAME_STATS_CUSTOMERS, '', 'NONSSL') . '">' . BOX_REPORTS_ORDERS_TOTAL . '</a></li>';
                ?>
                <ul class="nav nav-second-level">
                    <?php echo $cfg_groups_e; ?>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Ferramentas<span class="fa arrow"></span></a>
                <?php
                $cfg_groups_tools = '<li><a href="' . tep_href_link('banner_manager.php', '', 'NONSSL') . '" >Gerenciador de Banners</a></li>';
                ?>
                <ul class="nav nav-second-level">
                    <?php echo $cfg_groups_tools; ?>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Edocbuilder<span class="fa arrow"></span></a>
                <?php
                $cfg_groups_edoc = '<li><a href="index.php"><i class="fa fa-dashboard fa-fw"></i> Consultar</a></li>' .
                        '<li><a href="index.php"><i class="fa fa-dashboard fa-fw"></i> Gerenciar</a></li>';
                ?> 
                <ul class="nav nav-second-level">
                    <?php echo $cfg_groups_edoc; ?>
                </ul>
                <!-- /.nav-second-level -->
            </li>
        </ul>
        <!-- /#side-menu -->
    </div>
    <!-- /.sidebar-collapse -->
</nav>


