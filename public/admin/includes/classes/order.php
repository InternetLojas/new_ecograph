<?php
/*
  $Id: order.php,v 1.7 2003/06/20 16:23:08 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

  class order {
    var $info, $totals, $products, $customer, $delivery;

    function order($order_id) {
      $this->info = array();
      $this->totals = array();
      $this->products = array();
      $this->customer = array();
      $this->delivery = array();

      $this->query($order_id);
    }

    function query($order_id) {
      /***** Controle de CPF CNPJ RG e IE: *****	
      $order_query = tep_db_query("select customers_name, customers_company, customers_street_address, 
      customers_street_address2, customers_street_address3, customers_suburb, customers_city, customers_postcode, customers_state, customers_country, customers_telephone, customers_email_address, customers_address_format_id, delivery_name, delivery_company, 
      delivery_street_address, delivery_street_address2, delivery_street_address3, delivery_suburb, delivery_city, delivery_postcode, delivery_state, delivery_country, delivery_address_format_id, billing_name, billing_company, billing_street_address, billing_street_address2, billing_street_address3, billing_suburb, billing_city, billing_postcode, billing_state, billing_country, billing_address_format_id, payment_method, cc_type, cc_owner, cc_number, cc_expires, currency, currency_value, date_purchased, orders_status, last_modified from " . 
      TABLE_ORDERS . " where orders_id = '" . (int)$order_id . "'");
      order_query = tep_db_query("select customers_name, customers_company, customers_street_address, 
	  customers_street_address2, customers_street_address3, customers_suburb, customers_city, customers_postcode, customers_state, customers_country, customers_telephone, customers_email_address, customers_address_format_id, delivery_name, delivery_company,
	  delivery_street_address, delivery_street_address2, delivery_street_address3, delivery_suburb, delivery_city, delivery_postcode, delivery_state, delivery_country, delivery_address_format_id, billing_name, billing_company, billing_street_address, billing_street_address2, billing_street_address3, billing_suburb, billing_city, billing_postcode, billing_state, billing_country, billing_address_format_id, payment_method, cc_type, cc_owner, cc_number, cc_expires, currency, currency_value, date_purchased, orders_status, last_modified from " . 
	  TABLE_ORDERS . " where orders_id = '" . (int)$order_id . "'");
	  ***** Controle de CPF CNPJ RG e IE: *****/
	 
	  /***** Controle de CPF CNPJ RG e IE: Nr_Rua Comp_Ref e DDD *****/
      $order_query = tep_db_query("select customers_name, customers_company,customers_street_address, 
	  customers_street_address2, customers_street_address3, customers_suburb, customers_city, customers_postcode, customers_state, customers_country, customers_ddd, customers_telephone, customers_pf_pj, customers_cpf_cnpj,  customers_rg_ie, customers_email_address, customers_address_format_id, delivery_name, delivery_company, 
	  delivery_nr_rua, delivery_street_address,  delivery_comp_ref, delivery_street_address2, delivery_street_address3,	delivery_suburb, delivery_city, delivery_postcode, delivery_state, delivery_country, delivery_address_format_id, billing_name, billing_company, billing_nr_rua, billing_street_address, billing_comp_ref, billing_street_address2, billing_street_address3, billing_suburb, billing_city, billing_postcode, billing_state, billing_country, billing_address_format_id, payment_method, cc_type, cc_owner, cc_number, cc_expires, currency, currency_value, date_purchased, orders_status, last_modified from " . 
	  TABLE_ORDERS . " where orders_id = '" . (int)$order_id . "'");
	  /***** Controle de CPF CNPJ RG e IE: *****/
      $order = tep_db_fetch_array($order_query);

      $totals_query = tep_db_query("select title, text from " . TABLE_ORDERS_TOTAL . " where orders_id = '" . (int)$order_id . "' order by sort_order");
      while ($totals = tep_db_fetch_array($totals_query)) {
        $this->totals[] = array('title' => $totals['title'],
                                'text' => $totals['text']);
      }

      $this->info = array('currency' => $order['currency'],
                          'currency_value' => $order['currency_value'],
                          'payment_method' => $order['payment_method'],
                          'cc_type' => $order['cc_type'],
                          'cc_owner' => $order['cc_owner'],
                          'cc_number' => $order['cc_number'],
                          'cc_expires' => $order['cc_expires'],
                          'date_purchased' => $order['date_purchased'],
                          'orders_status' => $order['orders_status'],
                          'last_modified' => $order['last_modified']);

      $this->customer = array('name' => $order['customers_name'],
                              'company' => $order['customers_company'],
							  'street_address' => $order['customers_street_address'],
							  'street_address2' => $order['customers_street_address2'],
							  'street_address3' => $order['customers_street_address3'],
                              'suburb' => $order['customers_suburb'],
                              'city' => $order['customers_city'],
                              'postcode' => $order['customers_postcode'],
                              'state' => $order['customers_state'],
                              'country' => $order['customers_country'],
                              'format_id' => $order['customers_address_format_id'],
							  'ddd' => $order['customers_ddd'],
                              'telephone' => $order['customers_telephone'],
							  /***** Controle de CPF CNPJ RG e IE: *****/
                              'cpf_cnpj' => $order['customers_cpf_cnpj'],
                              'rg_ie' => $order['customers_rg_ie'],
							  'pf_pj' =>  $order['customers_pf_pj'],
							  
							  /***** Controle de CPF CNPJ RG e IE: *****/
                              'email_address' => $order['customers_email_address']);

      $this->delivery = array('name' => $order['delivery_name'],
                              'company' => $order['delivery_company'],
			      'nr_rua' => $order['delivery_nr_rua'],
                              'street_address' => $order['delivery_street_address'],
			      'comp_ref' => $order['delivery_comp_ref'],
			      'street_address2' => $order['delivery_street_address2'],
			      'street_address3' => $order['delivery_street_address3'],
                              'suburb' => $order['delivery_suburb'],
                              'city' => $order['delivery_city'],
                              'postcode' => $order['delivery_postcode'],
                              'state' => $order['delivery_state'],
                              'country' => $order['delivery_country'],
                              'format_id' => $order['delivery_address_format_id']);

      $this->billing = array('name' => $order['billing_name'],
                             'company' => $order['billing_company'],
			     'nr_rua' => $order['billing_nr_rua'],
                             'street_address' => $order['billing_street_address'],
			     'comp_ref' => $order['billing_comp_ref'],
							 'street_address2' => $order['billing_street_address2'],
							 'street_address3' => $order['billing_street_address3'],
                             'suburb' => $order['billing_suburb'],
                             'city' => $order['billing_city'],
                             'postcode' => $order['billing_postcode'],
                             'state' => $order['billing_state'],
                             'country' => $order['billing_country'],
                             'format_id' => $order['billing_address_format_id']);

      $index = 0;
      $orders_products_query = tep_db_query("select orders_products_id,products_id, products_name, products_model, products_price, products_tax, products_quantity, products_unidades, final_price from " . TABLE_ORDERS_PRODUCTS . " where orders_id = '" . (int)$order_id . "'");
      while ($orders_products = tep_db_fetch_array($orders_products_query)) {
        $this->products[$index] = array('qty' => $orders_products['products_quantity'],
										'unidades' => $orders_products['products_unidades'],
                                        'name' => $orders_products['products_name'],
                                        'model' => $orders_products['products_model'],
                                        'tax' => $orders_products['products_tax'],
                                        'price' => $orders_products['products_price'],
                                        'final_price' => $orders_products['final_price']);

        $subindex = 0;
        $attributes_query = tep_db_query("select products_options, products_options_values, options_values_price, price_prefix from " . TABLE_ORDERS_PRODUCTS_ATTRIBUTES . " where orders_id = '" . (int)$order_id . "' and orders_products_id = '" . (int)$orders_products['orders_products_id'] . "'");
        if (tep_db_num_rows($attributes_query)) {
          while ($attributes = tep_db_fetch_array($attributes_query)) {
            $this->products[$index]['attributes'][$subindex] = array('option' => $attributes['products_options'],
                                                                     'value' => $attributes['products_options_values'],
                                                                     'prefix' => $attributes['price_prefix'],
                                                                     'price' => $attributes['options_values_price']);

            $subindex++;
          }
        }
        $index++;
      }
    }
  }
?>
