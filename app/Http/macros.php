<?php

use Ecograph\Category;

HTML::macro('flash_message', function() {
    $alerts = array();
    $alert_type = array('error', 'success', 'warning', 'info', 'danger');
    $alert_bg = array('red', 'lightBlue', 'amber', 'cyan', 'crimson');
    foreach ($alert_type as $key => $type) {
        if (Session::has($type)) {
            $div = '<div class="flash_message notice marker-on-bottom bg-' . $alert_bg[$key] . ' fg-white">';
            //array_push($alerts, '<div class="alert alert-' . $type . '">');
            array_push($alerts, $div);
            array_push($alerts, Session::get($type));
            array_push($alerts, '</div>');
        }
    }
    return implode('', $alerts);
});

HTML::macro('oferta', function() {
    $html = '';
    for ($i = 0; $i < 5; $i++) {
        $html .="<i class=\"icon-star\"></i>";
    }
    $html .=' OFERTA! ';
    for ($i = 0; $i < 5; $i++) {
        $html .="<i class=\"icon-star\"></i>";
    }
    return $html;
});


HTML::macro('extras_images', function($extras_images, $html = '') {
    foreach ($extras_images as $id_produto => $images) {
        $html .= "<a href=\"" . URL::to('images/produtos/' . $images) . "\" title=\"" . $images . "\" > 
               <img style=\"width:29%\" src=\"" . URL::to('images/produtos/' . $images) . "\" alt=\"\"/></a>";
    }
    return $html;
});

HTML::macro('testemunhos', function($qtd ) {
    $html = "<ul id=\"navmenu-v\" class=\"nav nav-list\">" .
            Utilidades::testemunhos($qtd) .
            "</ul>";
    $html .="<div class=\"clearfix\"></div>";
    $html .= "<br><a href=\"" . URL::to('testemunhos/') . "\" title=\"Saiba mais...\" >Saiba mais...</a>";
    return $html;
});



HTML::macro('transportadora', function($frete_transportadora, $logado) {
//valor para transportadora
    $html = '';
    $row = '<div class="col-lg-2 col-md-2 col-xs-4 col-sm-4 span2">';
    $row .= '<input type="radio" name="vl_frete" id="frete_transportadora" value="' . $frete_transportadora . '_transportadora" class="radio_ajax" onclick="atualizarfrete(\'' . utf8_encode($frete_transportadora) . '\',\'Transportadora\',\'' . $logado . '\')"/>';
    $row .= '</div>';
    $row .= '<div class="col-lg-4 col-md-4 col-xs-4 col-sm-4 span4"><span class="span_ajax">Transportadora</span></div>';
    $row .= '<div class="col-lg-3 col-md-3 col-xs-4 col-sm-4 span3"><span class="span_ajax_vl">R$ <b>' . $frete_transportadora . '</b></span></div>';
    $html .= '<div class="row row-fretes">' . $row . '</div>';
    return $html;
});

HTML::macro('correios', function($servico, $request, $logado) {
//valor para os servicos do correio
    $html = '';
    $row = '<div class="col-lg-2 col-md-2 col-xs-4 col-sm-4 span2">';
    $row .= '<input type="radio" name="vl_frete" id="frete_' . $servico . '" value="' . utf8_encode($request) . '_' . $servico . '" class="radio_ajax" onclick="atualizarfrete(\'' . utf8_encode($request) . '\',\'' . utf8_encode($servico) . '\',\'' . $logado . '\')"/>';
    $row .= '</div>';
    $row .= '<div class="col-lg-4 col-md-4 col-xs-4 col-sm-4 span4"><span class="span_ajax">' . $servico . '</span></div>';
    $row .= '<div class="col-lg-3 col-md-3 col-xs-4 col-sm-4 span3"><span class="span_ajax_vl">R$ <b>' . $request . '</b></span></div>';
    $html .= '<div class="row row-fretes">' . $row . '</div>';
    return $html;
});

HTML::macro('frete_zero', function($logado) {
//valor para servico de frete zero
    $html = '';
    $row = '<div class="col-lg-2 col-md-2 col-xs-4 col-sm-4 span2">';
    $row .= '<input type="radio" name="vl_frete" id="frete_gratis" value="0_gratis" class="radio_ajax" onclick="atualizarfrete(\'0\',\'grátis\',\'' . $logado . '\')"/>';
    $row .= '</div>';
    $row .= '<div class="col-lg-4 col-md-4 col-xs-4 col-sm-4 span4"><span class="span_ajax">';
    $row .= '<small><i class="icon-star"></i><strong>FRETE GRÁTIS</strong><i class="icon-star"></i></small>';
    $row .= '</span></div>';
    $row .= '<div class="col-lg-3 col-md-3 col-xs-4 col-sm-4 span3"><span class="span_ajax_vl">R$ <b>0,00</b></span></div>';
    $html .= '<div class="row row-fretes">' . $row . '</div>';
    return $html;
});

HTML::macro('customers_state', function($customers_state, $total_clientes) {
    $html = '';
    $entry_state = '';
    foreach ($customers_state as $key => $estatistica) {
        if ($estatistica['entry_state'] == '') {
            $entry_state = 'N/D';
        } else {
            $entry_state = $estatistica['entry_state'];
        }
        $html .= "<div class=\"singleBar\">\n                                    
                <div class=\"bar\">\n                                    
                    <div class=\"value\">\n
                        <span>" . (int) ($estatistica['qtd'] * 100 / $total_clientes) . "%</span>\n
                    </div>\n                                       
                </div>\n                                        
                <div class=\"title\">" . $entry_state . "</div>\n                                   
                </div>\n";
    }
    return $html;
});


HTML::macro('tag_clouds', function() {
    $html = "<ul class=\"unstyled\">" .
            Utilidades::tagsclouds() .
            "</ul>";
    return $html;
});

HTML::macro('html_gateway', function($html) {
    return $html;
});

HTML::macro('twitter', function() {
    $html = "<a class=\"twitter-timeline\" href=\"https://twitter.com/" . USER_TWEET . "\"  data-widget-id=\"" . WIDGET_ID . "\" data-tweet-limit=\"" . FEEDS_TWEET . "\" data-screen-name=\"" . FOLLOWING . "\" data-show-replies=\"false\">
            Postado recentemente</a>";
    return $html;
});

HTML::macro('hidden_payment', function($k, $vl, $gateway_desconto, $valor_desconto) {

    if (in_array($vl->id, $gateway_desconto) && $valor_desconto > 0) {
        echo "<input type=\"radio\" name=\"payment\" id=\"payment" . $k . "\" value=\"" . $vl->id . "\"  onclick=\"Desconto('" . number_format(Cart::total(), 2) . "','" . $vl->id . "','" . $valor_desconto . "')\" />\n";
    } else {
        echo "<input type=\"radio\" name=\"payment\" id=\"payment" . $k . "\" value=\"" . $vl->id . "\" onclick=\"Desconto('" . number_format(Cart::total(), 2) . "','" . $vl->id . "',0)\" />\n";
    }
});

HTML::macro('radio_payment', function($k, $vl_frete, $vl, $id_desconto) {
    $html = '';
    $classes = Confdesconto::where('descontoacrescimo_id', $id_desconto)
                    ->where('desconto_key', 'classe_autorizada')->first();
    $classes_autorizadas = $classes->toarray();
    $autorizadas = explode(";", $classes_autorizadas['desconto_value']);
    if (in_array($vl->class, $autorizadas)) {
        $params_valor_minimo = Confdesconto::where('descontoacrescimo_id', $id_desconto)
                        ->where('desconto_key', 'valor_minimo')->first();
        $params_valor_desconto = Confdesconto::where('descontoacrescimo_id', $id_desconto)
                        ->where('desconto_key', 'valor_desconto')->first();
        $valor_minimo = $params_valor_minimo->desconto_value;
        $valor_desconto = $params_valor_desconto->desconto_value;

        if (Cart::total() >= $valor_minimo) {
            $html .= "<input type=\"radio\" name=\"payment\" id=\"payment" . $k . "\" value=\"" . $vl->id . "\" onclick=\"desconto('" . Cart::total() * $valor_desconto . "','" . $vl_frete . "','" . Cart::total() . "')\" />\n";
        } else {
            $html .= "<input type=\"radio\" name=\"payment\" id=\"payment" . $k . "\" value=\"" . $vl->id . "\" onclick=\"desconto('0','" . $vl_frete . "','" . Cart::total() . "')\" />\n";
        }
    } else {
        $html .= "<input type=\"radio\" name=\"payment\" id=\"payment" . $k . "\" value=\"" . $vl->id . "\" onclick=\"desconto('0','" . $vl_frete . "','" . Cart::total() . "')\" />\n";
    }
    return $html;
});



Form::macro('google_map', function($geolocation, $attributes = array()) {
    $coord_type = array_get($attributes, 'locationType', 'address');
    $render_to_div = array_get($attributes, 'divName', '');
    $map_type = array_get($attributes, 'mapTypeId', 'ROADMAP');
    $zoom_level = array_get($attributes, 'zoom', '12');

    $key = 'AIzaSyAvU8ZtFaP_ZxoMNuU9LxPAN02dPAn6Hlc'; //Config::get("app.google_maps_apiv3_key");

    if ($render_to_div == '') {
// $html = '<div id="map" style="height:400px; width: 600px;"></div>'."\n";
        $html = '';
        $render_to_div = "map";
        $map_type = 'ROADMAP';
        $zoom_level = '12';
    } else {
        $html = '';
    }

    $html .= "<script type=\"text/javascript\" src=\"https://maps.googleapis.com/maps/api/js?key=$key&sensor=false\"></script>\n";
    $html .= "<script type=\"text/javascript\">\n";

    switch ($coord_type) {
        case "LatLng" : {
                $html .= "function initialize() {
                                var coords = new google.maps.LatLng($geolocation);
                                var mapOptions = {
                                    mapTypeId: google.maps.MapTypeId.$map_type,
                                    center: coords,
                                    zoom: $zoom_level
                                };

                                var map = new google.maps.Map(document.getElementById(\"$render_to_div\"), mapOptions);
                          }";
            }
        default: {
                $html .= "function initialize() {
                            var map = new google.maps.Map(document.getElementById(\"$render_to_div\"), {
                                                      mapTypeId: google.maps.MapTypeId.$map_type,
                                                      zoom: $zoom_level
                                                      });

                            var geocoder = new google.maps.Geocoder();
                            geocoder.geocode({'address': '$geolocation'},
                                             function(results, status) {
                                                if(status == google.maps.GeocoderStatus.OK) {
                                                    new google.maps.Marker({
                                                        position: results[0].geometry.location,
                                                        map: map
                                                    });
                                                    map.setCenter(results[0].geometry.location);
                                                 }
                                              });
                         }";
            }
    }

//$html .= "google.maps.event.addDomListener(window, \"load\", initialize);";
    $html .= "$(document).ready(function(e) {
                    initialize()
                });";
    $html .= "</script>\n";

    return $html;
});

HTML::macro('youtube', function($videos, $html = '') {

    foreach ($videos as $key => $video) {
        $html .= "<li class=\"fichainfo\" style=\"padding:5px 1px\">
        <div class=\"product\">
        <a href=\"#\" class=\"info\" onclick=\"return false;\">
                <span class=\"holder\">
                <a href=\"{$video['url']}\" title=\"{$video['titulo']}\" target=\"_blank\"><img src=\"{$video['thumbnail']}\" alt=\"{$video['titulo']}\" /></a>
                </span></a></div></li>";
    }
    return $html;
});

HTML::macro('comentario', function($comentarios, $html = '') {
    $html = "<h4>Comentários sobre esse produto:</h4>";
    $html .= "<div class=\"clearfix\"></div>";
    foreach ($comentarios as $info) {
        $html .= "<p style=\"text-align:left;line-height:1em;padding:3px\">";
        for ($i = 0; $i < $info->reviews_rating; $i++) {
            $html .= "<span class=\"glyphicon glyphicon-star\"></span> ";
        }
        $html .= $info->texto . "</p>";
    }
    return $html;
    /*

      [customer_id] => 1 [reviews_rating] => 3 [created_at] => 2014-02-22 00:00:00 [updated_at] => [texto] => Este é um super produto dessa loja. Eu recomendo. ) [original:protected] => Array ( [id] => 1 [product_id] => 5794 [customer_id] => 1 [reviews_rating] => 3 [created_at] => 2014-02-22 00:00:00 [updated_at] => [texto] => Este é um super produto dessa loja. Eu recomendo. )
     */
});
HTML::macro('MegaMenu', function($product, $html = '') {
    $html .= '<li class="span8">';
    $html .='<div class="row-fluid">';
    $html .='<h5><a class="last-chield">';
    $html .= Utilidades::truncate(ProductDescription::find($product)->products_name);
    $html .='</a></h5>';
    $html .= '<p>Informações adicionais<br><br>';
    $html .= 'Preço e botões para compra.</p><hr>';
    $html .='</li>';
    $html .= '<li class="span4">';
    $html .= '<a class="img-ficha" href="' . URL::to('produtos/') . '/' . $product . '" title="Saiba mais sobre o produtos ' . URLAmigaveis::Slug(ProductDescription::find($product)->products_name) . '" >' . HTML::image('images/' . Product::find($product)->products_image, Product::find($product)->cod, array('width' => '100%')) . '</a>';
    $html .= '</li>';
    return $html;
});

HTML::macro('painelcategoria', function($ordem, $classe, $html = '') {
    $first_category = Category::where('parent_id', '=', '0')->first();
    if ($classe == 'open') {
        if ($first_category->id == $ordem) {
            echo 'open';
        }
    }
// return implode('',$alerts);
});

HTML::macro('lista_categorias', function($id) {

    $html = '';
    $filhos = Category::filhos($id);
    foreach (Utilidades::Agrupa($filhos->toarray(), '3', 'busca') as $row) {
        $html .= '<p>';
        $html .= '<ol class="inline fg-white text-left ">';
        foreach ($row as $key => $items) {
            $html .= '<li class="">';
            $html .= '<i class="icon-arrow-right-5  on-left"></i>';
            $html .= '<a class="fg-white" id="' . $items['id'] . '" href="' . URL::to('produtos/detalhes') . '/' . $id . '/' . $items['id'] . '/' . URLAmigaveis::Slug(Fichas::nomeCategoria($items['id']), '-', true) . '.html">' . Fichas::nomeCategoria($items['id']) . '</a>';
            $html .= '</li>';
        }
        $html .= '</ol></p>';
    }
    return $html;
});

HTML::macro('orcamento_categorias', function() {
    $categorias = Category::all()->where('id', '<>', '1')->lists('id');

    $html = '';
    //dd($array_categ);
    foreach (Utilidades::Agrupa($categorias, '6', 'busca') as $row) {
        $html .= '<div class="row">';
        $html .= '<ul class="list-unstyled list-inline text-left text-medio">';
        foreach ($row as $key => $items) {
            $html .= '<li class="col-md-2 pd-5">';
            $html .= '<input type="radio" name="categoria" value="' . $items . '" >';

            $html .= '<span class="mg-left5">' . Fichas::nomeCategoria($items) . '</span>';
            $html .= '</li>';
        }
        $html .= '</ul>';
        $html .= '</div>';
    }
    return $html;

    /* $html = '';
      foreach ($lista as $categorias) {
      $html .= ' <ul class="list-unstyled list-inline text-center text-muted">';
      foreach ($categorias['prole']['filhos'] as $item) {
      $html .= '<li class="afasta">';
      $html .= '<a class="text-medio" title="Detalhes para a categoria ' . $item['nome_filho'] . '" id="' . $item['id'] . '" href="' . URL::to('produtos/detalhes') . '/' . $item['parent_id'] . '/' . $item['id'] . '/' . URLAmigaveis::Slug($item['nome_filho'], '-', true) . '.html">' . $item['nome_filho'] . '</a> | ';
      $html .='</li>';
      }
      $html .= '</ul>';
      }
      return $html; */
});
HTML::macro('slider', function($group) {

    $html = '';
    $sliders = Banners::Ativos($group);

    foreach ($sliders as $key => $slide) {
        $html .= "<div class=\"slide\">
            <img src=\"" . URL::to($slide['img']) . "\" class=\"cover\" />
        </div>";
    }
    return $html;
});


HTML::macro('slider_', function($group) {
    $html = '';
    $sliders = Banners::Ativos($group);

    foreach ($sliders as $key => $slide) {
        if (Fichas::checkOferta($slide['products_id'])) {
            $preco = "<p class=\"pull-left\">A vista R$" . Fichas::PrecoAVista(Product::find($slide['products_id'])->products_price, false) . "<s>" . Fichas::priceOferta($slide['products_id']) . "</s></p>";
        } else {
            $preco = "<p class=\"pull-left\">A vista R$" . Fichas::PrecoAVista(Product::find($slide['products_id'])->products_price, false) . " ou em até <b>" . Fichas::Parcelas(Product::find($slide['products_id'])->products_price) . "</b> X " . Fichas::SetValorParcelas(Fichas::Parcelas(Product::find($slide['products_id'])->products_price), Product::find($slide['products_id'])->products_price, false) . "</p>";
        }
        $html .= "<div class=\"slide cover\" style=\"background:url('images/banners/destaques/" . $slide['products_id'] . ".png')\">\n";
        $html .= "<div class=\"label-price\">\n";
        $html .= "<h4>" . ProductDescription::find($slide['products_id'])->products_name . "</h4>\n";
        $html .= $preco;
        $html .="<span class=\"pull-right\"> " . Form::open(array('url' => 'carrinho/adiciona', 'method' => 'post', 'id' => 'carrinho' . $slide['products_id'], 'name' => 'carrinho')) . "
            " . Form::hidden('id', $slide['products_id']) . "
            " . Form::hidden('from', URL::to(Request::path())) . "
            " . Form::hidden('to', URL::to('carrinho/adiciona')) . "
            " . Form::hidden('quantity', '1') . "
            <button  data-original-title=\"Carrinho\" class=\"btn btn-orange tooltip-test\" onclick=\"this.form.submit();\" title=\"Comprar " . Utilidades::truncate(ProductDescription::find($slide['products_id'])->products_name) . " \"> Comprar</button>
            " . Form::close() . "
       </span>\n";
        $html .= "</div></div>\n";
    }
    return $html;
});

HTML::macro('slider_full', function($group) {
    $html = '';
    $sliders = Banners::Ativos($group);
    $banner = 'banner-2.jpg';
    foreach ($sliders as $key => $slide) {
        if (Fichas::checkOferta($slide['products_id'])) {
            $preco = "A vista R$" . Fichas::PrecoAVista(Product::find($slide['products_id'])->products_price, false) . "<s>" . Fichas::priceOferta($slide['products_id']) . "</s>";
        } else {
            $preco = "A vista R$" . Fichas::PrecoAVista(Product::find($slide['products_id'])->products_price, false) . " ou em até <b>" . Fichas::Parcelas(Product::find($slide['products_id'])->products_price) . "</b> X " . Fichas::SetValorParcelas(Fichas::Parcelas(Product::find($slide['products_id'])->products_price), Product::find($slide['products_id'])->products_price, false);
        }
        $form = Form::open(array('url' => 'carrinho/adiciona', 'method' => 'post', 'id' => 'carrinho' . $slide['products_id'], 'name' => 'carrinho')) . "
            " . Form::hidden('id', $slide['products_id']) . "
            " . Form::hidden('from', URL::to(Request::path())) . "
            " . Form::hidden('to', URL::to('carrinho/adiciona')) . "
            " . Form::hidden('quantity', '1');
        $form .= "<button data-original-title=\"Carrinho\" class=\"btn btn-orange tooltip-test\" onclick=\"this.form.submit();\" title=\"Comprar " . Utilidades::truncate(ProductDescription::find($slide['products_id'])->products_name) . " \"> Comprar</button>
                " . Form::close();
        $html .= '<li style="border:1px solid #dcdcdd;padding:1px;">'
                . HTML::image('images/slider/' . $banner, $banner, array('width' => '100%')) . '
                        <div class="intro">
                                <h1 class="header_text">' . Utilidades::truncate(ProductDescription::find($slide['products_id'])->products_name) . '</h1>
                                <p><span>' . $preco . '</span></p>
                                <div class="pull-right">' . $form . '</div>
                        </div>
                </li>';
    }
    return $html;
});


HTML::macro('lista_sub_categorias', function($lista) {
    //echo '<pre>';
    //print_r($lista);
    $html = '';
    $html .= '<ul class="list-unstyled list-inline text-center list-categ">';
    foreach ($lista as $categorias) {
        foreach ($categorias['prole']['filhos'] as $item) {
            $html .= '<li class="afasta">';
            $html .= '<a class="text-medio" title="Detalhes para a categoria ' . $item['nome_filho'] . '" id="' . $item['id'] . '" href="' . URL::to('produtos/detalhes') . '/' . $item['parent_id'] . '/' . $item['id'] . '/' . URLAmigaveis::Slug($item['nome_filho'], '-', true) . '.html">' . $item['nome_filho'] . '</a> | ';
            $html .='</li>';
        }
    }
    $html .= '</ul>';
    return $html;
    //exit;
});

HTML::macro('thumb_perfil_enviar', function($perfis, $product, $nome) {
    $html = '';
    $thumb = '';
    foreach ($perfis as $perfil_id) {
        $perfil = Perfil::find($perfil_id);
        $thumb .= '<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">' . "\n" .
                '<div class="thumbnail">' . "\n";
        $thumb .= '<a href="' . URL::to('enviar/') . '/' . $product . '/' . $perfil_id . '/' . URLAmigaveis::Slug($nome, '-', true) . '.html" class="">' . "\n";
        $thumb .= HTML::image($perfil->logo_perfil, $perfil->logo_perfil, array('title' => $perfil->nome_perfil)) . "\n";
        $thumb .= '</a>' . "\n";
        $thumb .= '</div></div>' . "\n";
        $html .= $thumb;
        $thumb = '';
    }
    return $html;
});

HTML::macro('thumb_perfil_listar', function($categoria, $perfis, $n_categoria) {
    $agrupa_perfil = Utilidades::Agrupa($perfis, 4, 'busca');
//echo '<pre>';print_r($agrupa_perfil);exit;
    $html = '';
    $thumb = '';
    foreach ($agrupa_perfil as $row => $row_perfil) {
        $thumb .= '<div class="row">' . "\n";
        foreach ($row_perfil as $key => $perfil_id) {
            if ($perfil_id != 0) {
                $perfil = Perfil::find($perfil_id);
                $thumb .= '<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 icon_modal">' . "\n";
                $thumb .= '<a class="pull-left" href="' . URL::to('listagem/') . '/' . $categoria . '/' . $perfil_id . '/' . URLAmigaveis::Slug($n_categoria, '-', true) . '/' . URLAmigaveis::Slug($perfil->nome_perfil, '-', true) . '.html">' . "\n";
                $thumb .= HTML::image($perfil->logo_perfil, $perfil->logo_perfil, array('title' => $perfil->nome_perfil, 'class' => 'img-responsive')) . "\n";
                $thumb .= '</a>' . "\n";
                $thumb .= '<span>' . $perfil->nome_perfil . '</span>' . "\n";
                $thumb .= '</div>' . "\n";
            }
        }
        $thumb .= '</div>' . "\n";
        $html .= $thumb;
        $thumb = '';
    }
    return $html;
});

HTML::macro('thumb_perfil_listar', function($categoria, $perfis, $n_categoria) {
    $agrupa_perfil = Utilidades::Agrupa($perfis, 4, 'busca');
//echo '<pre>';print_r($agrupa_perfil);exit;
    $html = '';
    $thumb = '';
    foreach ($agrupa_perfil as $row => $row_perfil) {
        $thumb .= '<div class="row">' . "\n";
        foreach ($row_perfil as $key => $perfil_id) {
            if ($perfil_id != 0) {
                $perfil = Perfil::find($perfil_id);
                $thumb .= '<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 icon_modal">' . "\n";
                $thumb .= '<a class="pull-left" href="' . URL::to('listagem/') . '/' . $categoria . '/' . $perfil_id . '/' . URLAmigaveis::Slug($n_categoria, '-', true) . '/' . URLAmigaveis::Slug($perfil->nome_perfil, '-', true) . '.html">' . "\n";
                $thumb .= HTML::image($perfil->logo_perfil, $perfil->logo_perfil, array('title' => $perfil->nome_perfil, 'class' => 'img-responsive')) . "\n";
                $thumb .= '</a>' . "\n";
                $thumb .= '<span>' . $perfil->nome_perfil . '</span>' . "\n";
                $thumb .= '</div>' . "\n";
            }
        }
        $thumb .= '</div>' . "\n";
        $html .= $thumb;
        $thumb = '';
    }
    return $html;
});
