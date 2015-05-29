<?php

Class Metatags {

    //$pg, $url, $protocolo, $nivel = '', $cPath_array = array()
    public function __construct() {
        parent::__construct();
        $this->beforeFilter('csrf', array('on' => 'post'));
    }

    public static function Title($title, $price = '', $precision = 2) {
        if (!empty($price)) {
            if (strpos($price, '.') && (strlen(substr($price, strpos($price, '.') + 1)) > $precision)) {
                $price = substr($price, 0, strpos($price, '.') + 1 + $precision + 1);

                if (substr($price, -1) >= 5) {
                    if ($precision > 1) {
                        $price = substr($price, 0, -1) + ('0.' . str_repeat(0, $precision - 1) . '1');
                    } elseif ($precision == 1) {
                        $price = substr($price, 0, -1) + 0.1;
                    } else {
                        $price = substr($price, 0, -1) + 1;
                    }
                } else {
                    $price = substr($price, 0, -1);
                }
            }
            $price = "R$ " . str_replace('.', ',', $price);
            echo "<title>" . $title . " - " . $price . "</title>";
        } else {
            echo "<title>" . $title . "</title>";
        }
    }

    public static function Tags($nome = '') {
        Config::get('extras');
        if (!empty($nome)) {
            $meta_description = $nome;
        } else {
            $meta_description = META_DESCRIPTION;
        }
        ?>
        <!--meta tags principais-->
        <base href="<?php echo URL::to('inicio/') ?>" />
        <meta name="description" content="<?php echo $meta_description ?>" />
        <meta name="keywords" content="<?php echo META_KEYWORDS ?>" />
        <meta name="subject" content="<?php echo META_SUBJECTS ?>" />
        <meta name="rating" content="general" />
        <meta http-equiv="pragma" content="no-cache" />
        <meta http-equiv="content-language" content="pt-br" />
        <meta name="robots" content="fallow" />
        <meta name="googlebot" content="index, follow" />
        <meta name="audience" content="all" />
        <meta name="author" content="www.internetlojas.com" />
        <link rel="canonical" href="<?php echo Request::url(); ?>" />
        <?php
    }

    public static function TagsFacebook($descricao, $detalhes) {
        Config::get('extras');
        $url = Request::url();
        //$path = Request::path();
        //$url_image = Product::find($descricao->id)->products_image; 
        ?>
        <!--facebook-->
        <meta property="fb:admins" content="<?php echo FB_ADMIN ?>" />
        <meta property="fb:app_id" content="<?php echo FB_APP_ID ?>" />
        <meta property="og:title" content="<?php echo $descricao->products_name ?>" />
        <meta property="og:type" content="product" />
        <meta property="og:url" content="<?php echo $url; ?>" />
        <meta property="og:image" content="<?php echo URL::to('/') . '/images/' . $detalhes->products_image ?>" />
        <meta property="og:site_name" content="<?php echo META_DESCRIPTION ?>" />
        <meta property="og:description" content="<?php echo $descricao->products_name ?>" />
        <?php
    }

}
