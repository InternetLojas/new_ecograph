<?php

/*
  $Id: edocbuilder.php 1739 2007-12-20 00:52:16Z hpdl $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2007 osCommerce

  Released under the GNU General Public License
 */

function limpa_table_template() {
    if (tep_db_query("TRUNCATE TABLE `edoc_builder_template`")) {
        return TRUE;
    } else {
        die("Erro! Tabela edoc_builder_template n?o foi limpa.");
    }
}

function limpa_base($table) {
//limpa a tabela
    if (tep_db_query("TRUNCATE TABLE " . $table)) {
        return true;
    } else {
        die("Erro! Tabela $table n?o foi limpa.");
        ;
    }
}

function check_atualizacao($docID) {
    $tp = tep_db_query("SELECT template_id"
            . " FROM edoc_builder_template"
            . " WHERE docid='" . $docID . "'");
    if (tep_db_num_rows($tp) > 0) {
        return TRUE;
    } else {
        return FALSE;
    }
}

function retira_acentos() {
    //retira  acentos
    tep_db_query("UPDATE products 
        SET	products_image= REPLACE (products_image,'á','a'),
        products_image= REPLACE (products_image,'?','a'), 
        products_image= REPLACE (products_image,'?','a'),  
        products_image= REPLACE (products_image,'â','a'),  
        products_image= REPLACE (products_image,'é','e'),  
        products_image= REPLACE (products_image,'?','e'),  
        products_image= REPLACE (products_image,'?','e'),  
        products_image= REPLACE (products_image,'í','i'),  
        products_image= REPLACE (products_image,'?','i'),  
        products_image= REPLACE (products_image,'î','i'),  
        products_image= REPLACE (products_image,'ó','o'),  
        products_image= REPLACE (products_image,'?','o'),  
        products_image= REPLACE (products_image,'ô','o'),  
        products_image= REPLACE (products_image,'?','o'),  
        products_image= REPLACE (products_image,'ú','u'),  
        products_image= REPLACE (products_image,'?','u'),  
        products_image= REPLACE (products_image,'?','u'),  
        products_image= REPLACE (products_image,'ç','c')");
}

function atualiza_pedido() {
    /*     * *atualização de tabelas *** */
    $order_old = tep_db_query("SELECT orders_id, products_id, products_model "
            . "FROM `orders_products`");
    if (tep_db_num_rows($order_old) > 0) {
        while ($order_products = tep_db_fetch_array($order_old)) {
            $products_idnew = tep_db_query("SELECT products_id 
                    FROM `products` 
                    WHERE products_model='" . $order_products[products_model] . "'");
            if (tep_db_num_rows($products_idnew) > 0) {
                while ($new_products = tep_db_fetch_array($products_idnew)) {
//atualiza
                    tep_db_query("UPDATE orders_products 
					SET products_id = '" . $new_products[products_id] . "'
					WHERE products_model ='" . $order_products[products_model] . "'");
                    tep_db_query("UPDATE edoc_builder_document 
					SET products_id = '" . $new_products[products_id] . "'
					WHERE orders_id = '" . $order_products[orders_id] . "'");
                }
            }
        }
    }
    return true;
}

function check_nome_perfil($nome_perfil) {

    $sql_nome_perfil = tep_db_query("SELECT *
FROM `products_perfis`
WHERE `nome_perfil` = '" . $nome_perfil . "'");
    if (tep_db_num_rows($sql_nome_perfil) > 0) {
        $name = tep_db_fetch_array($sql_nome_perfil);
        return $name[products_perfis_id];
    } else
        return false;
}

function le_carrinho() {
    $cart_products = tep_db_query("SELECT distinct(`products_id`) "
            . "FROM  customers_basket");
//grava todos os produtos com seus ids antigos
    while ($products_cart = tep_db_fetch_array($cart_products)) {
        $cart_olds = tep_db_query("SELECT `products_model`
                                FROM  `products` 
                                WHERE  `products_id` = '" . $products_cart[products_id] . "'");
        while ($olds_cart = tep_db_fetch_array($cart_olds)) {
            $produtos_cart_alterar[] = array($products_cart[products_id],
                $olds_cart[products_model]);
        }
    }
    return $produtos_cart_alterar;
}

function atualiza_carrinho($produtos_cart_alterar) {
    foreach ($produtos_cart_alterar as $c => $parans) {
        $alt_cart = tep_db_query("SELECT products_id 
                    FROM `products` 
                    WHERE products_model='" . $parans[1] . "'");
        if (tep_db_num_rows($alt_cart) > 0) {
            while ($carrinho_products = tep_db_fetch_array($alt_cart)) {
                tep_db_query("UPDATE customers_basket 
						SET products_id = '" . $carrinho_products[products_id] . "'
						WHERE products_id='" . $parans[0] . "'");
                tep_db_query("UPDATE customers_basket_attributes 
						SET products_id = '" . $carrinho_products[products_id] . "'
						WHERE products_id='" . $parans[0] . "'");
            }
        }
    }
}

function query_categories_id($categoria) {
    $info_categ = tep_db_query("SELECT `categories_id` 
                    FROM `categories_description` 
                    WHERE `categories_name` = '" . $categoria . "'");
    $nome_c = tep_db_fetch_array($info_categ);
    return $nome_c['categories_id'];
}

function query_template($categoria) {
    $info_categ = tep_db_query("SELECT categories_id, `categories_name`, categories_info 
				FROM `categories_description` 
				WHERE `prefixo` like '" . $categoria . "'");
    $nome_c = tep_db_fetch_array($info_categ);
    return $nome_c['categories_name'];
}

function query_qtd_template() {
    $sql_todos = tep_db_query("SELECT count(template_id) as total "
            . "FROM `edoc_builder_template` ");
    $todos_templates = tep_db_fetch_array($sql_todos);
    return $todos_templates[total];
}

function query_category_name($id_categoria) {
    $info_categ = tep_db_query("SELECT `categories_name` 
				FROM `categories_description` 
				WHERE `categories_id` = '" . $id_categoria . "'");
    $nome_c = tep_db_fetch_array($info_categ);
    return $nome_c['categories_name'];
}

function query_category_id($prefixo) {

    $info_categ = tep_db_query("SELECT `categories_id` 
				FROM `categories_description` 
				WHERE `categories_name` = '" . $prefixo . "'");
    $id_c = tep_db_fetch_array($info_categ);
    return $id_c['categories_id'];
}

function gerarows_table($template, $nome_c) {
    $data_templates = array();
    foreach ($template as $k => $lista) {
        $n_caracteres = strlen($lista[0]);
        for ($i = 0; $i < $n_caracteres; $i++) {
            if ((preg_match("/^(-){0,1}([0-9]+)(,[0-9][0-9][0-9])*([.][0-9]){0,1}([0-9]*)$/", $lista[0][$i]) != 1))
                $nome .= $lista[0][$i];
        }
        $img_sem_acento = replace_accents($lista[4]);
        $data_templates[] = array('docid' => $lista[1],
            'docpass' => $lista[2],
            'docname' => ucfirst(strtolower($nome)),
            'doccat' => $nome_c,
            'docdes' => $lista[3],
            'docimg' => replace_accents($img_sem_acento),
            'created_at' => 'now()',
            'updated_at' => 'now()');
        $nome = "";
    }
    return $data_templates;
}

function replace_accents($str) {
    // = str_replace(" ", "", $str);
    $var = strtolower($str);
    $var = preg_replace("/[áàâãª]/", "a", $var);
    $var = preg_replace("/[éèê]/", "e", $var);
    $var = preg_replace("/[óòôõº]/", "o", $var);
    $var = preg_replace("/[úùû]/", "u", $var);
    $var = str_replace("ç", "c", $var);
    return $var;
}

function pega_dica_opcao($option) {
    switch ($option) {
        case '1':
            return 'FORMATO';
        case '2':
            return 'PAPEL';
        case '3':
            return 'ACABAMENTO';
    }
}

function pega_dica_atributo($option_value) {
    $sql_dica_formato = tep_db_query("SELECT  `products_options_values_name` 
                                    FROM  `products_options_values` 
                                    WHERE  `products_options_values_id` ='" . $option_value . "'");
    $dica_formato = tep_db_fetch_array($sql_dica_formato);
    $hint = $dica_formato[products_options_values_name];
    return $hint;
}

function pega_dica_option($monstro){
    $sql_dica = tep_db_query("SELECT `products_options_values_name` 
        FROM `products_options_values` 
        WHERE `products_options_values_id` in 
        (SELECT `products_options_values_id` 
            FROM `products_options_values_to_products_options` 
            WHERE `products_options_values_to_products_options_id` = '".$monstro."')");
    $dica = tep_db_fetch_array($sql_dica);
    $hint = $dica[products_options_values_name];
    return $hint;
}

function pega_dica_papel($papel) {
    if (!empty($papel)) {
        $dicas_p = tep_db_query("SELECT `products_options_values_to_products_options_id`, pacote_formato_id "
                . "FROM `pacote_papel` WHERE `pacote_papel_id`=$papel");
        while ($label_dicas_p = tep_db_fetch_array($dicas_p)) {
            $sql_dica_papel = tep_db_query("SELECT po.`products_options_values_name` 
                FROM `products_options_values` po, `products_options_values_to_products_options` pov 
                WHERE pov.`products_options_values_to_products_options_id` =" . $label_dicas_p[products_options_values_to_products_options_id] . " and po.`products_options_values_id`=pov.`products_options_values_id`");
            while ($dica_papel = tep_db_fetch_array($sql_dica_papel)) {
                $hint = $dica_papel[products_options_values_name];
                $formato_id = $label_dicas_p[pacote_formato_id];
            }
        }
    }
    return $hint;
}

function carrega_perfil($array_perfil) {
//prepara a tabela products_perfis para armazenar os perfis
    tep_db_query("TRUNCATE TABLE `products_perfis`");
    foreach ($array_perfil as $nr => $lista) {
        if (tep_db_perform('products_perfis', $lista)) {
            $situacao = 'OK';
        } else {
            $situacao = false;
        }
    }
    return $situacao;
}

function carrega_pacote($categ, $array_qtd_pacote) {
//prepara a tabela products_perfis para armazenar os perfis
    $ult_reg = tep_db_query("SELECT `products_pacotes_id` "
            . "FROM `products_pacotes`");
    while ($registros = tep_db_fetch_array($ult_reg)) {
        $nr_reg = $registros[products_pacotes_id];
    }
    foreach ($array_qtd_pacote as $ch => $qtd) {
        $nr_reg++;
        $array_configuracao_pacote = array('products_pacotes_id' => $nr_reg,
            'categories_id' => $categ,
            'products_pacotes_quantity' => $qtd);

        if (tep_db_perform('products_pacotes', $array_configuracao_pacote)) {
            $situacao = 'OK';
        } else {
            $situacao = false;
        }
    }
    return $situacao;
}

function carrega_templates($datas) {

    if (tep_db_perform('edoc_builder_template', $datas)) {
        return 'OK';
    } else {
        return false;
    }
}

function insert_templates($datas) {

    if (tep_db_perform('edoc_builder_template', $datas)) {
        return 'OK';
    } else {
        return false;
    }
}

function grava_dados($array, $table) {
    //limpa_base($table);
    if (tep_db_perform($table, $array)) {
        return 'OK';
    } else {
        return false;
    }
}

function grava_atributos($array, $table = 'products_attributes') {
    foreach ($array as $rows) {
        if (tep_db_perform($table, $rows)) {
            $situacao = 'OK';
        } else {
            $situacao = false;
        }
    }
    return $situacao;
}

function verifica_cadastro_cat($nome_c) {
    $sql_todas_categ = tep_db_query("SELECT count(template_id) as total "
            . "FROM `edoc_builder_template` "
            . "WHERE doccat = '" . $nome_c . "'");
    $todos_templates = tep_db_fetch_array($sql_todas_categ);
    return $todos_templates[total];
}

function AtributosInserir($option_id, $action, $categories_id = '') {
    $listagem = array();
    if ($action == 'inserir') {
        $sql_todos_atributos = tep_db_query("SELECT * "
                . "FROM `products_options_values_to_products_options` "
                . "WHERE products_options_id = $option_id  "
                . "ORDER BY `products_options_id`");
        while ($todos_atributos = tep_db_fetch_array($sql_todos_atributos)) {
            $nome_opc = tep_db_query("SELECT `products_options_values_name`
				     FROM `products_options_values`
				     WHERE `products_options_values_id` = $todos_atributos[products_options_values_id]");
            $opcao = tep_db_fetch_array($nome_opc);
            $listagem[] = array('options_values_id' => $todos_atributos[products_options_values_id],
                'opcao' => $opcao[products_options_values_name]);
        }
    }
    return $listagem;
}

/* * *funç?o utilizada para gerenciar os atributos ** */

function Atributos($option_id, $action = '', $categories_id = '') {
    $listagem = array();
    $sql_todos_atributos = tep_db_query("SELECT * "
            . "FROM `products_options_values_to_products_options` "
            . "WHERE products_options_id = $option_id  "
            . "ORDER BY `products_options_id`");
    if (tep_db_num_rows($sql_todos_atributos) > 0) {
        while ($todos_atributos = tep_db_fetch_array($sql_todos_atributos)) {
            $nome_opc = tep_db_query("SELECT `products_options_values_name`
				     FROM `products_options_values`
				     WHERE `products_options_values_id` = $todos_atributos[products_options_values_id]");
            $opcao = tep_db_fetch_array($nome_opc);
            $listagem[] = array('options_values_id' => $todos_atributos[products_options_values_id],
                'opcao' => $opcao[products_options_values_name]);
        }
    }
// echo "<pre>"; print_r($listagem); echo "</pre>";exit;
    return $listagem;
}

function busca_attributes($CatId) {
    $array_atributos = array();
    $products_attributes_query = tep_db_query("select count(*) as total "
            . "from " . TABLE_PRODUCTS_OPTIONS . " popt, " . TABLE_PRODUCTS_ATTRIBUTES . " patrib "
            . "where patrib.categories_id='" . (int) $CatId . "' and patrib.options_id = popt.products_options_id and popt.language_id = '1'");
    $products_attributes = tep_db_fetch_array($products_attributes_query);
    if ($products_attributes['total'] > 0) {
        $sql_products_attributes = tep_db_query("SELECT options_id,`options_values_id` "
                . "FROM `products_attributes` "
                . "WHERE `categories_id` = '". $CatId . "'");
        while ($list_products_attributes = tep_db_fetch_array($sql_products_attributes)) {
            $attributes[$list_products_attributes['options_id']][] = $list_products_attributes['options_values_id'];
        }
        return $attributes;
    } else
        return false;
}

function busca_monstro($options_id, $array_options_values_id) {
    if (is_array($array_options_values_id)) {
        foreach ($array_options_values_id as $ch => $options_values_id) {
          $sql_id_monstro = tep_db_query("SELECT `products_options_values_to_products_options_id` "
                    . "FROM `products_options_values_to_products_options` "
                    . "WHERE `products_options_id` = $options_id and `products_options_values_id` ='" . $options_values_id . "'");
            while ($id_monstro = tep_db_fetch_array($sql_id_monstro)) {
                $id[] = $id_monstro['products_options_values_to_products_options_id'];
            }
        }
        return $id;
    } else
       return false;
}

function config_pacotes_f($categories_id, $id_monstro) {
    $sql_pacote_formato = tep_db_query("SELECT `pacote_formato_id`, products_pacotes_id
                                            FROM `pacote_formato`
                                            WHERE `products_options_values_to_products_options_id` = '" . $id_monstro . "'
                                            AND `categories_id` = '" . $categories_id . "'");
    while ($pacote_formato = tep_db_fetch_array($sql_pacote_formato)) {
        $configuracao_pacotes[$id_monstro][] = array('pacote_formato_id' => $pacote_formato['pacote_formato_id'],
            'products_pacotes_id' => $pacote_formato['products_pacotes_id'],
            'products_pacotes_quantity' => qtd_pacote($pacote_formato['products_pacotes_id']),
        );
    }
    return $configuracao_pacotes;
}

function config_pacotes_p($categories_id, $monstro = array()) {
    $configuracao = array();
    foreach ($monstro as $ch => $id_monstro) {
        $sql_pacote_papel = tep_db_query("SELECT pacote_papel_id, pacote_formato_id, `pacote_papel_weight`
                                            FROM `pacote_papel`
                                            WHERE `products_options_values_to_products_options_id` = '" . $id_monstro . "'
                                            AND `categories_id` = '" . $categories_id . "'");
        $count_cols = 0;
        $cols = 0;
        while ($pacote_papel = tep_db_fetch_array($sql_pacote_papel)) {
            $sql_monstro_f = tep_db_query("SELECT products_options_values_to_products_options_id "
                    . "FROM pacote_formato "
                    . "WHERE pacote_formato_id = $pacote_papel[pacote_formato_id]");
            $monstro_f = tep_db_fetch_array($sql_monstro_f);
            $count_cols++;
            if ($count_cols == 5) {
                $configuracao[$count_cols] = array('pacote_papel_id' => $pacote_papel['pacote_papel_id'],
                    'pacote_papel_weight' => $pacote_papel['pacote_papel_weight'],
                    'monstro_f' => $monstro_f[products_options_values_to_products_options_id]);
                $cols = 0;
                $count_cols = 0;
                $configuracao_pacotes[$id_monstro][] = $configuracao;
            } else {
                $cols++;
                $configuracao[$cols] = array('pacote_papel_id' => $pacote_papel['pacote_papel_id'],
                    'pacote_papel_weight' => $pacote_papel['pacote_papel_weight'],
                    'monstro_f' => $monstro_f[products_options_values_to_products_options_id]);
            }
        }
    }

    return $configuracao_pacotes;
}

function config_pacotes_a($categories_id, $monstro = array(), $f_i = array()) {
    $configuracao = array();
    $limite_array = count($f_i) - 1;
    $lim_inf = ($f_i[0][pacote_formato_id] - 1);
    $lim_sup = $f_i[$limite_array][pacote_formato_id] + 1;
    foreach ($monstro as $ch => $id_monstro) {
        $sql_pacote_acabamento = tep_db_query("SELECT pacote_acabamento_id, pacote_papel_id, pacote_formato_id, `pacote_acabamento_price`
                                            FROM `pacote_acabamento`
                                            WHERE `products_options_values_to_products_options_id` = '" . $id_monstro . "' 
                                            AND pacote_formato_id > '" . $lim_inf . "' 
                                                AND pacote_formato_id < '" . $lim_sup . "'
                                            AND `categories_id` = '" . $categories_id . "'");
        $count_cols = 0;
        $cols = 0;
        while ($pacote_acabamento = tep_db_fetch_array($sql_pacote_acabamento)) {
            $sql_monstro_p = tep_db_query("SELECT products_options_values_to_products_options_id "
                    . "FROM pacote_papel "
                    . "WHERE pacote_papel_id = $pacote_acabamento[pacote_papel_id]");
            $monstro_p = tep_db_fetch_array($sql_monstro_p);
            $count_cols++;
            if ($count_cols == 5) {
                $configuracao[$count_cols] = array('pacote_acabamento_id' => $pacote_acabamento['pacote_acabamento_id'],
                    'pacote_acabamento_price' => $pacote_acabamento['pacote_acabamento_price'],
                    'monstro_p' => $monstro_p[products_options_values_to_products_options_id]);
                $cols = 0;
                $count_cols = 0;
                $configuracao_pacotes[$id_monstro][] = $configuracao;
            } else {
                $cols++;
                $configuracao[$cols] = array('pacote_acabamento_id' => $pacote_acabamento['pacote_acabamento_id'],
                    'pacote_acabamento_price' => $pacote_acabamento['pacote_acabamento_price'],
                    'monstro_p' => $monstro_p[products_options_values_to_products_options_id]);
            }
        }
    }
    //}
    return $configuracao_pacotes;
}

/* * * funç?o usada no gerenciamento de quantidades para formato ** */

function configuracao_pacotes($option_id, $action = '', $categories_id = '', $monstros = '') {
    $listagem = array();
    $sql_atributos = tep_db_query("SELECT * "
            . "FROM `products_attributes` "
            . "WHERE `options_id` = $option_id and `categories_id` = $categories_id");
    if (tep_db_num_rows($sql_atributos) > 0) {
        while ($atributos = tep_db_fetch_array($sql_atributos)) {
            $pacotes = id_monstro($categories_id, $atributos[options_id], $atributos[options_values_id], $monstros);
            if ($action == "") {
                $listagem[] = array('products_attributes_id' => $atributos[products_attributes_id],
                    'options_values_id' => $atributos[options_values_id],
                    'configuracao_pacotes' => $pacotes);
            } else if ($action == "light") {
//print_r($pacotes);
                foreach ($pacotes as $c => $datas) {
                    $monstros_f[] = $datas[products_options_values_to_products_options_id];
                }
                $listagem = array_unique($monstros_f);
            }
        }
    }
//if($categories_id==7){ print_r($listagem) ; echo "<hr>";}
    return $listagem;
}

/* * * funç?o usada junto com a funç?o configuraçao pacote ** */

function id_monstro($categories_id, $option_id, $options_values_id) {
    $sql_id_monstro = tep_db_query("SELECT `products_options_values_to_products_options_id` "
            . "FROM `products_options_values_to_products_options` "
            . "WHERE `products_options_id` = $option_id and `products_options_values_id` =" . $options_values_id . "");

    while ($id_monstro = tep_db_fetch_array($sql_id_monstro)) {
        $id = $id_monstro[products_options_values_to_products_options_id];
        switch ($option_id) {
            case 1 :
                $pacotes = pacotes_f($id, $categories_id);
                break;
            case 2 :
                $pacotes = pacotes_p($id, $categories_id);
                break;
            case 3 :
                $pacotes = pacotes_a($id, $categories_id);
                break;
        }
    }
    return $pacotes;
}

/* * * funç?o usada junto com a funç?o id_monstro ** */

function pacotes_f($id_monstro, $categories_id) {
    $sql_pacote_formato = tep_db_query("SELECT `pacote_formato_id`, products_pacotes_id, pacote_formato_price
FROM `pacote_formato`
WHERE `products_options_values_to_products_options_id` = '" . $id_monstro . "'
AND `categories_id` = '" . $categories_id . "'");
    while ($pacote_formato = tep_db_fetch_array($sql_pacote_formato)) {
        $configuracao_pacotes[] = array('pacote_formato_id' => $pacote_formato['pacote_formato_id'],
            'products_pacotes_id' => $pacote_formato['products_pacotes_id'],
            'products_pacotes_quantity' => qtd_pacote($pacote_formato['products_pacotes_id']),
            'pacote_formato_price' => $pacote_formato['pacote_formato_price']);
    }
    return $configuracao_pacotes;
}

function pacotes_p($id_monstro, $categories_id) {
    $sql_pacote_papel = tep_db_query("SELECT `pacote_papel_id`,`pacote_formato_id`, products_pacotes_id, pacote_papel_weight
                                    FROM `pacote_papel`
                                    WHERE `products_options_values_to_products_options_id` = '" . $id_monstro . "'
                                    AND `categories_id` = '" . $categories_id . "'");
    while ($pacote_papel = tep_db_fetch_array($sql_pacote_papel)) {
        $configuracao_pacotes[] = array('pacote_papel_id' => $pacote_papel['pacote_papel_id'],
            'pacote_formato_id' => $pacote_papel['pacote_formato_id'],
            'products_pacotes_id' => $pacote_papel['products_pacotes_id'],
            'products_pacotes_quantity' => qtd_pacote($pacote_papel['products_pacotes_id']),
            'pacote_papel_weight' => $pacote_papel['pacote_papel_weight']);
    }
    return $configuracao_pacotes;
}

function pacotes_a($id_monstro, $categories_id) {
    $sql_pacote_acabamento = tep_db_query("SELECT pacote_acabamento_id, `pacote_papel_id`,`pacote_formato_id`, products_pacotes_id, pacote_acabamento_price
                                    FROM `pacote_acabamento`
                                    WHERE `products_options_values_to_products_options_id` = '" . $id_monstro . "'
                                    AND `categories_id` = '" . $categories_id . "'");
    while ($pacote_acabamento = tep_db_fetch_array($sql_pacote_acabamento)) {
        $configuracao_pacotes[] = array('pacote_acabamento_id' => $pacote_acabamento['pacote_acabamento_id'],
            'pacote_papel_id' => $pacote_acabamento['pacote_papel_id'],
            'pacote_formato_id' => $pacote_acabamento['pacote_formato_id'],
            'products_pacotes_id' => $pacote_acabamento['products_pacotes_id'],
            'products_pacotes_quantity' => qtd_pacote($pacote_acabamento['products_pacotes_id']),
            'pacote_acabamento_price' => $pacote_acabamento['pacote_acabamento_price']);
    }
    return $configuracao_pacotes;
}

function qtd_pacote($pacotes_id) {
    $sql_products_qtd_id = tep_db_query("SELECT p.`products_pacotes_quantity`
FROM `products_pacotes` p
WHERE p.`products_pacotes_id`= '" . (int) $pacotes_id . "'");
    $products_pacotes_quantity = tep_db_fetch_array($sql_products_qtd_id);
    return($products_pacotes_quantity[products_pacotes_quantity]);
}

function check($tb) {
    $sql_check = tep_db_query("SELECT * FROM " . $tb);
    if (tep_db_num_rows($sql_check) > 0)
        return TRUE;
    else
        return FALSE;
}

function gera_update($id, $price) {
    $query .= "UPDATE pacote_acabamento "
            . "set  pacote_acabamento_price = '$price' "
            . "WHERE pacote_acabamento_id = '$id';";
    $response = tep_db_query($query);
    //$response = true;
    if ($response) {
        //return 'OK';
        return true;
    } else {
        return false;
    }
}

?>