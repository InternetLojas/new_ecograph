<?php

namespace Ecograph\Libs;

use Ecograph\Confdesconto;
use Ecograph\Basket;
use Auth;
use Ecograph\Ordersituacao;

Class Utilidades
{

    public static function Message($string)
    {
        $json = json_decode((file_get_contents(public_path() . '/message.json')));
        return $json->$string;
    }

    public static function Estoque($qtd)
    {
        if ($qtd > 0) {
            echo "<b>Disponível</b> - total em estoque: " . $qtd;
        } else {
            echo "<b>Indisponível</b>";
        }
    }

    public static function Classe($img)
    {
        $limpa = str_replace('categorias/', '', $img);
        $classe = str_replace('.jpg', '', $limpa);
        return $classe;
    }

    public static function toView($value)
    {
        return date('d/m/Y', strtotime($value));
    }

    public static function toMysql($value)
    {
        $date = explode('/', $value);
        return $date[2] . '-' . $date[1] . '-' . $date[0];
    }

    public static function SubstituiImg($img)
    {
        if (!file_exists('images/categorias/' . $img)) {
            $img = '/theme/naodisponivel.gif';
        } else {
            $img = '/categorias/' . $img;
        }
        return $img;
    }

    public static function SubstituiImgProd($img)
    {
        //echo $img;exit;
        if (!file_exists('images/' . $img)) {
            $img = 'theme/naoencontrado.png';
        }

        return $img;
    }

    public static function modal_cupom($vl_frete)
    {
        $discount = new Discount();
        //$config_discount_cupon = Confdesconto::all();
        $config_discount_cupon = Descontoacrescimo::where('title', 'Desconto promocional')->get();

        $class_cupom = $config_discount_cupon->toarray();
        $discount_cupon = Confdesconto::where('descontoacrescimo_id', $class_cupom[0]['id'])->get();

        foreach ($discount_cupon as $key => $valores) {
            $config[$valores['desconto_key']] = $valores['desconto_value'];
        }
        //echo "<pre>";
        //print_r($config);
        //exit;
        if ($config['discount_codes_frete'] == 1) {
            $total_compra = Cart::total() + $vl_frete;
        } else {
            $total_compra = Cart::total();
        }
        //echo Cart::total();exit;
        if ($total_compra >= $config['minimum_order_amount']) {

            if (date('d-m-Y') <= $config['expires_date']) {
                $config['vl_desconto_cupom'] = ($total_compra * $config['discount_values']);
                $config['id'] = $discount->classe['Desconto']['discount_cupon']['id'];
                return $config;
            }
        }

        return false;
    }

    public static function SituacaoPedido($orders_status)
    {
        if ($orders_status > 62) {
            $orders_status = 54;
        }
        $orders_status = Ordersituacao::find($orders_status)->status_name;
        return $orders_status;
    }

    public static function ItensPedido($order)
    {
        $orders_item = OrderItem::where('order_id', $order)->get();
        $items = $orders_item->toarray();
        if (is_array($items) && count($items) > 0) {
            //echo "<pre>";print_r($items);exit;
            return $items;
        } else {
            return false;
        }
    }

    public static function setupResolucao()
    {
        if (!is_null(Cookie::get('resolucao'))) {
            if ($_COOKIE['resolucao'] <= 320) {
                $max_width = '320';
            }
            if ($_COOKIE['resolucao'] > 320 && $_COOKIE['resolucao'] <= 480) {
                $max_width = '480';
            }
            if ($_COOKIE['resolucao'] > 480 && $_COOKIE['resolucao'] <= 600) {
                $max_width = '600';
            }
            if ($_COOKIE['resolucao'] > 600 && $_COOKIE['resolucao'] <= 768) {
                $max_width = '768';
            }
            if ($_COOKIE['resolucao'] > 768 && $_COOKIE['resolucao'] <= 800) {
                $max_width = '800';
            }
            if ($_COOKIE['resolucao'] > 800 && $_COOKIE['resolucao'] <= 1024) {
                $max_width = '1024';
            }
            if ($_COOKIE['resolucao'] > 1024) {
                $max_width = $_COOKIE['resolucao'] - ($_COOKIE['resolucao'] * 0.05);
            }

            return $max_width . "px";
        } else {
            return '100%';
        }
    }

    public static function geoLocal($lat = null, $long = null)
    {
        /* Geo Localização.... */
        /* $ip_visitante = $_SERVER['REMOTE_ADDR'];
          $ip_visitante = '177.15.128.130';
          $geo_response = file_get_contents('http://www.geoplugin.net/php.gp?ip='.$ip_visitante);

          $geo_array = var_export( unserialize ( $geo_response  ), 1);
          eval( '$geo_array = '. $geo_array .';');
          $geo_data  = new stdClass();
          $geo_data->city   = $geo_array['geoplugin_city'];
          $geo_data->region = $geo_array['geoplugin_region'];
          $geo_data->country     = $geo_array['geoplugin_countryName'];
          $geo_data->countrycode = $geo_array['geoplugin_countryCode'];
          $geo_data->long        = $geo_array['geoplugin_longitude'];
          $geo_data->lat         = $geo_array['geoplugin_latitude'];
         */
        if (!is_null($lat) && !is_null($long)) {
            //echo 'http://maps.googleapis.com/maps/api/geocode/json?latlng=' . $lat . ',' . $long . '&sensor=true';exit;
            $geocode = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?latlng=' . $lat . ',' . $long . '&sensor=true');
            $output = json_decode($geocode);
            //echo "<pre>"; print_r($geocode);
            //echo $lat;
            //exit; 
            //$_COOKIE['latitude']
            return $output->results[0]->formatted_address;
        }

        return false;
    }

    public static function perfilFace($facebook_id)
    {
        $perfil = Acesso::Uid($facebook_id)->get();
        foreach ($perfil as $itens) {
            $foto = $itens->photo;
        }
        return $foto . '?type=small';
    }

    public static function toReal($price, $precision = 2, $frete = false)
    {
        $price = round($price, $precision);
        if (strpos(round($price, 2), '.') && (strlen(substr(round($price, 2), strpos(round($price, 2), '.') + 1)) < 2)) {
            $price = round($price, 2) . '0';
        } else {
            if (!strpos(round($price, 2), '.')) {
                $price = round($price, 2) . ',00';
            } else {
                $price = round($price, 2);
            }
        }

        if ($frete) {
            echo str_replace('.', ',', $price);
        } else {
            echo " R$ " . str_replace('.', ',', $price);
        }
    }

    public static function RealBusca($price, $precision = 2, $real = False)
    {
        $price = round($price, $precision);
        if (strpos(round($price, 2), '.') && (strlen(substr(round($price, 2), strpos(round($price, 2), '.') + 1)) < 2)) {
            $price = round($price, 2) . '0';
        } else {
            if (!strpos(round($price, 2), '.')) {
                $price = round($price, 2) . ',00';
            } else {
                $price = round($price, 2);
            }
        }
        if ($real) {
            return 'R$ ' . str_replace('.', ',', $price);
        } else {
            return str_replace('.', ',', $price);
        }
    }

    public static function testemunhos($max)
    {
        $linha = '';
        $testemunhos = Testemunho::all()->take($max);
        foreach ($testemunhos as $comentarios) {
            $linha .= "<li>
        $comentarios->testemunho_text<br>
        $comentarios->testemunho_nome<br>
        <b>$comentarios->testemunho_local</b><hr class=\"soften\"></li>";
        }
        return $linha;
    }

    public static function tagsclouds($max = 5)
    {
        $linha = '';
        $product = Productdescription::popular()->take($max)->orderBy('products_viewed', 'DESC')->get();
        foreach ($product as $itens) {
            $tags[$itens->id] = $itens->products_viewed;
        }
        $font_width = array('0.9em', '0.8em', '0.75em', '0.7em', '0.65em');
        $font_color = array('#aba7a7', '#d89665', '#27111d', '#152ec5', '#fe2775', '#43552a');
        //Navegando pelo array
        foreach ($tags as $key => $value) {
            shuffle($font_width);
            shuffle($font_color);
            $nome = Productdescription::find($key)->products_name;
            $img = Product::find($key)->products_image;
            $tam = $font_width[0];
            $color = $font_color[0];
            $linha .= "\n<li>\n";
            $linha .= HTML::image('images/' . $img, $alt = $img, $attributes = array('width' => '98%', 'style' => 'padding:0 1%;display:block;'));
            $linha .= "\n</li><li><a href =\"" . URL::to('produtos/') . "/" . $key . "/" . URLAmigaveis::Slug($nome, '-', true) . ".html\" style=\"color: $color; font-size: {$tam}\" title=\"Visto $value\">";
            $linha .= $nome . "\n</a>\n</li>\n";
        }
        return $linha;
    }

    public static function truncate($string, $nr_string = 70)
    {
        $string = addslashes($string);
        //$string = stripslashes ($string);
        return current(explode('\n', wordwrap($string, $nr_string, ' ...\n')));
    }

    public static function trataFeeds($string, $nr_string = 150)
    {
        //$string = html_entity_decode(strip_tags($string));
        $string = str_replace('&', '&amp;amp;', $string);
        return current(explode('\n', wordwrap($string, $nr_string, ' ...\n')));
        //return $string;
    }

    public static function Estados()
    {
        return array('AC' => 'AC',
            'AL' => 'AL',
            'AM' => 'AM',
            'AP' => 'AP',
            'BA' => 'BA',
            'CE' => 'CE',
            'DF' => 'DF',
            'ES' => 'ES',
            'GO' => 'GO',
            'MA' => 'MA',
            'MG' => 'MG',
            'MS' => 'MS',
            'MT' => 'MT',
            'PA' => 'PA',
            'PB' => 'PB',
            'PE' => 'PE',
            'PI' => 'PI',
            'PR' => 'PR',
            'RJ' => 'RJ',
            'RN' => 'RN',
            'RO' => 'RO',
            'RR' => 'RR',
            'RS' => 'RS',
            'SC' => 'SC',
            'SE' => 'SE',
            'SP' => 'SP',
            'TO' => 'TO'
        );
    }

    public static function geraDesconto($price, $desconto)
    {

        $preco_promocional = $price - ($price * (str_replace('%', '', $desconto) / 100));
        return $preco_promocional;
    }

    public static function TempBasket()
    {
        if (!Auth::check()) {
            return false;
        }
        if (count(Cart::contents(true)) == 0) {
            return false;
        } else {
            //controle a execução de exclusão do registro
            $deletado = true;
            //vamos deletar todas as entradas paro o cliente logado
            $produtosnacesta = Basket::where('customer_id', Auth::user()->id)->lists('id');
            //se existe registro anterior apaga
            if (count($produtosnacesta) > 0) {
                //percorre o array de ids
                foreach ($produtosnacesta as $key => $id) {
                    $cesta = Basket::find($id);
                    $cesta->delete();
                    // Was the blog post deleted?
                    $cesta = Basket::find($id);
                    if (!empty($cesta)) {
                        $deletado = false;
                    }
                }
            }
            //se tudo ocorreu bem
            if ($deletado) {
                //cria as novas linha utilizando o novo carrinho
                foreach (Cart::contents() as $item) {
                    $basket_new = new Basket();
                    $price = Product::find($item->id)->products_price;
                    $basket_new->customer_id = Auth::user()->id;
                    $basket_new->product_id = $item->id;
                    $basket_new->quantity = $item->quantity;
                    $basket_new->final_price = $item->quantity * $price;
                    $basket_new->save();
                }
            }
        }
        return true;
    }

    public static function VerificaItensCarrinho()
    {
        $produtosnacesta = Basket::where('customer_id', Auth::user()->id)->get();
        if (count($produtosnacesta) > 0) {
            return true;
        }
        return false;
    }

    public static function VarreArray($cat, $prole, $galho = array())
    {

        $chaves = array_keys($prole);

        if (in_array($cat, $chaves)) {
            $galho = $prole[$cat];
            //echo '<pre>';print_r($galho);exit;
            return $galho;
        } else {
            foreach ($prole as $pai => $filhos) {
                $chaves = array_keys($filhos);
                if (in_array($cat, $chaves)) {
                    $galho = $prole[$pai][$cat];
                    return $arvore;
                }
            }
            return false;
        }
    }

    public static function FormataCep($postcode)
    {
        $cep = str_replace(".", "", $postcode);
        $cep = str_replace("-", "", $cep);
        echo $cep;
    }

    public static function XML($string)
    {
        $xml = simplexml_load_string($string);
        var_dump($xml[filmes]);
        exit;
    }

    public static function modulo11($banco)
    {
        $soma = 0;
        $fator = 2;
        $base = 9;
        $r = 0;
        for ($i = strlen($banco); $i > 0; $i--) {
            $numeros[$i] = substr($banco, $i - 1, 1);
            $parcial[$i] = $numeros[$i] * $fator;
            $soma += $parcial[$i];
            if ($fator == $base) {
                $fator = 1;
            }
            $fator++;
        }
        if ($r == 0) {
            $soma *= 10;
            $digito = $soma % 11;

            //corrigido
            if ($digito == 10) {
                $digito = "X";
            }

            /*
              alterado por mim, Daniel Schultz

              Vamos explicar:

              O módulo 11 só gera os digitos verificadores do nossonumero,
              agencia, conta e digito verificador com codigo de barras (aquele que fica sozinho e triste na linha digitável)
              só que é foi um rolo...pq ele nao podia resultar em 0, e o pessoal do phpboleto se esqueceu disso...

              No BB, os dígitos verificadores podem ser X ou 0 (zero) para agencia, conta e nosso numero,
              mas nunca pode ser X ou 0 (zero) para a linha digitável, justamente por ser totalmente numérica.

              Quando passamos os dados para a função, fica assim:

              Agencia = sempre 4 digitos
              Conta = até 8 dígitos
              Nosso número = de 1 a 17 digitos

              A unica variável que passa 17 digitos é a da linha digitada, justamente por ter 43 caracteres

              Entao vamos definir ai embaixo o seguinte...

              se (strlen($num) == 43) { não deixar dar digito X ou 0 }
             */

            if (strlen($banco) == "43") {
                //então estamos checando a linha digitável
                if ($digito == "0" or $digito == "X" or $digito > 9) {
                    $digito = 1;
                }
            }
            return $digito;
        } elseif ($r == 1) {
            $digito = $soma % 11;
            return $resto;
        }
    }

    /**
     * Calcula e retorna o dígito verificador usando o algoritmo Modulo 10
     *
     * @param string $num
     * @see Documentação em http://www.febraban.org.br/Acervo1.asp?id_texto=195&id_pagina=173&palavra=
     * @return int
     */
    public static function modulo10($num)
    {
        $numtotal10 = 0;
        $fator = 2;

        //  Separacao dos numeros.
        for ($i = strlen($num); $i > 0; $i--) {
            //  Pega cada numero isoladamente.
            $numeros[$i] = substr($num, $i - 1, 1);
            //  Efetua multiplicacao do numero pelo (falor 10).
            $temp = $numeros[$i] * $fator;
            $temp0 = 0;
            foreach (preg_split('// ', $temp, -1, PREG_SPLIT_NO_EMPTY) as $v) {
                $temp0 += $v;
            }
            $parcial10[$i] = $temp0; // $numeros[$i] * $fator;
            //  Monta sequencia para soma dos digitos no (modulo 10).
            $numtotal10 += $parcial10[$i];
            if ($fator == 2) {
                $fator = 1;
            } else {
                // Intercala fator de multiplicacao (modulo 10).
                $fator = 2;
            }
        }

        $remainder = $numtotal10 % 10;
        $digito = 10 - $remainder;

        // Make it zero if check digit is 10.
        $digito = ($digito == 10) ? 0 : $digito;

        return $digito;
    }

    public static function FormataData($data)
    {
        $data = explode("-", $data);
        $ano = $data[2];
        $mes = $data[1];
        $dia = $data[0];
        return array($ano, $mes, $dia);
    }

    public static function dateToDays($year, $month, $day)
    {
        $century = substr($year, 0, 2);
        $year = substr($year, 2, 2);
        if ($month > 2) {
            $month -= 3;
        } else {
            $month += 9;
            if ($year) {
                $year--;
            } else {
                $year = 99;
                $century--;
            }
        }

        return (floor((146097 * $century) / 4) +
            floor((1461 * $year) / 4) +
            floor((153 * $month + 2) / 5) +
            $day + 1721119);
    }

    public static function formata_numero($numero, $loop, $insert, $tipo = "geral")
    {
        if ($tipo == "geral") {
            $numero = str_replace(",", "", $numero);
            while (strlen($numero) < $loop) {
                $numero = $insert . $numero;
            }
        }
        if ($tipo == "valor") {
            /*
              retira as virgulas
              formata o numero
              preenche com zeros
             */
            $numero = str_replace(",", "", $numero);
            while (strlen($numero) < $loop) {
                $numero = $insert . $numero;
            }
        }
        if ($tipo == "convenio") {
            while (strlen($numero) < $loop) {
                $numero = $numero . $insert;
            }
        }
        return $numero;
    }

    public static function zeroFill($valor, $digitos)
    {
        // TODO: Retirar isso daqui, e criar um método para validar os dados
        //$teste = '';
        if (strlen($valor) > $digitos) {
            //             $teste .= strlen($valor).' --- '. $digitos.'<br>';
            //throw new Exception("O valor {$valor} possui mais de {$digitos} dígitos!");
        }
        //echo $teste;exit;
//echo strlen($valor).' --- '. $digitos."<br>";exit;
        return str_pad($valor, $digitos, '0', STR_PAD_LEFT);
    }

    public static function Agrupa($array, $grupo, $from = '')
    {
        if ($from != 'busca') {
            $new_array = array_chunk($array->toArray(), $grupo);
        } else {
            $new_array = array_chunk($array, $grupo);
        }
        return $new_array;
    }

    public static function BuscaEndereco($CepDestino)
    {
        $url_end = "http://www.buscacep.correios.com.br/servicos/dnec/consultaEnderecoAction.do?";

        $content = http_build_query(array(
            'relaxation' => $CepDestino,
            'TipoCep' => 'ALL',
            'semelhante' => 'N',
            'Metodo' => 'listaLogradouro',
            'TipoConsulta' => 'relaxation',
            'StartRow' => '1',
            'EndRow' => '10',
            'cfm' => '1'));

        $aHTTP = array(
            'http' => // The wrapper to be used
                array(
                    'method' => 'POST', // Request Method
                    // Request Headers Below
                    'header' => 'Content-type: application/x-www-form-urlencoded',
                    'content' => $content
                )
        );
        $context = "";
        $context = stream_context_create($aHTTP);
        if (@file_get_contents($url_end, false, $context)) {
            $result = @file_get_contents($url_end, false, $context);
        } else
            return false;
        preg_match_all('/2px\">(.*?)<\/td>/', $result, $matches); //
        //<td width="140" style="padding: 2px">Vilhena</td>
        //preg_match_all('/style=\"padding: 2px\">[^=]+?<\/td>/', $result, $matches);
        return ($matches[1]);

        foreach ($matches as $key => $array) {
            if ($key == 1) {
                if (count($matches[$key]) == 5) {
                    $logradouro = str_replace(">", "", $array[0]);
                    //$bairro = utf8_decode($array[1]);
                    $bairro = $array[1];
                    //$localidade = utf8_decode($array[2]);
                    $localidade = utf8_encode($array[2]);
                    $uf = utf8_decode($array[3]);
                    $codigo = $array[4];
                    $resultado['Logradouro'] = $logradouro;
                    $resultado['Bairro'] = $bairro;
                    $resultado['Localidade'] = $localidade;
                    $resultado['UF'] = $uf;
                    $resultado['CEP'] = $codigo;
                    $output = array('resultado' => '1', 'resultado_txt' => $resultado);
                } else if (count($matches[$key]) == 3) {
                    //$logradouro = utf8_decode("Rua/Av não localizado");
                    //$bairro = utf8_decode("Bairro não localizado");
                    //$localidade = utf8_dencode($array[0]);
                    $logradouro = "Rua/Av não localizado";
                    $bairro = "Bairro não localizado";
                    $localidade = utf8_encode($array[0]);
                    $uf = utf8_decode($array[1]);
                    $codigo = $array[2];
                    $resultado['Logradouro'] = $logradouro;
                    $resultado['Bairro'] = $bairro;
                    $resultado['Localidade'] = $localidade;
                    $resultado['UF'] = $uf;
                    $resultado['CEP'] = $codigo;
                    $output = array('resultado' => '1', 'resultado_txt' => $resultado);
                }
            }
        }
        if ($output['resultado'] == 1) {
            //echo "<pre>";print_r($output['resultado_txt']);exit;
            return $output['resultado_txt'];
        }
    }

    public static function Paginador($products, $total, $mostra = '21')
    {
        $paginator = Paginator::make($products, $total, $mostra);
        print_r($paginator);
        exit;
    }

    public static function Descontos()
    {
        //if (Cart::count() > 0) {
        $classes_descontos_autorizados = Confdesconto::where('desconto_key', 'classe_autorizada')->get();
        $classes_autorizadas_desconto_cupom = $classes_descontos_autorizados->toarray();
        $classes_desconto_cupom = explode(';', $classes_autorizadas_desconto_cupom[0]['desconto_value']);
        return $classes_desconto_cupom;
        /*


          $descontoacrescimo_id = Descontoacrescimo::where('class', 'discount_avista')->first();
          $params_valor_minimo = Confdesconto::where('descontoacrescimo_id', $descontoacrescimo_id->id)
          ->where('desconto_key', 'valor_minimo')->first();
          $params_valor_desconto = Confdesconto::where('descontoacrescimo_id', $descontoacrescimo_id->id)
          ->where('desconto_key', 'valor_desconto')->first();
          $valor_minimo = $params_valor_minimo->desconto_value;
          $valor_desconto = 0;
          if (Cart::total() >= $valor_minimo) {
          $desconto = Cart::total() * $params_valor_desconto->desconto_value;
          $valor_desconto = number_format($desconto, 2);
          }
          foreach ($classes_desconto_cupom as $key => $class) {
          $gateway = Gateway::where('class', $class)->first();
          $id_gateway[] = $gateway->id;
          } */
        //}
    }

    public static function validate_email($email)
    {

//verifica se e-mail esta no formato correto de escrita
        // Substituindo a função ereg (case sensitive)
        if (preg_match("/^[a-z0-9_-]+[a-z0-9_.-]*@[a-z0-9_-]+[a-z0-9_.-]*\.[a-z]{2,5}$/", $email)) {
            //Valida o dominio
            $dominio = explode('@', $email);
            if (!checkdnsrr($dominio[1], 'A')) {
                //$mensagem = 'E-mail Inv&aacute;lido!';
                return false;
            } else {
                return true;
            } // Retorno true para indicar que o e-mail é valido
        } else {
            return false;
        }
    }

    public static function validate_cpf($cpf)
    {
        $cpf = preg_replace("@[.-]@", "", $cpf);
        $cpf = str_replace(".", "", $cpf);
        $cpf = str_replace("/", "", $cpf);
        if (!is_numeric($cpf)) {
            $status = false;
        } else {
            if (($cpf == '11111111111') || ($cpf == '22222222222') ||
                ($cpf == '33333333333') || ($cpf == '44444444444') ||
                ($cpf == '55555555555') || ($cpf == '66666666666') ||
                ($cpf == '77777777777') || ($cpf == '88888888888') ||
                ($cpf == '99999999999') || ($cpf == '00000000000')
            ) {
                $status = false;
            } else {
                //PEGA O DIGITO VERIFIACADOR
                $dv_informado = substr($cpf, 9, 2);
                for ($i = 0; $i <= 8; $i++) {
                    $digito[$i] = substr($cpf, $i, 1);
                }
                $posicao = 10;
                $soma = 0;
                for ($i = 0; $i <= 8; $i++) {
                    $soma = $soma + $digito[$i] * $posicao;
                    $posicao = $posicao - 1;
                }
                $digito[9] = $soma % 11;
                if ($digito[9] < 2) {
                    $digito[9] = 0;
                } else {
                    $digito[9] = 11 - $digito[9];
                }
                $posicao = 11;
                $soma = 0;
                for ($i = 0; $i <= 9; $i++) {
                    $soma = $soma + $digito[$i] * $posicao;
                    $posicao = $posicao - 1;
                }
                $digito[10] = $soma % 11;
                if ($digito[10] < 2) {
                    $digito[10] = 0;
                } else {
                    $digito[10] = 11 - $digito[10];
                }
                $dv = $digito[9] * 10 + $digito[10];
                if ($dv != $dv_informado) {
                    $status = false;
                } else
                    $status = true;
            }
        }
        return $status;
    }

    public static function validate_cnpj($cnpj)
    {
        $cnpj = preg_replace("@[./'-]@", "", $cnpj);
        $cnpj = str_replace(".", "", $cnpj);
        $cnpj = str_replace("/", "", $cnpj);
        $cnpj = str_replace("-", "", $cnpj);
        if (!is_numeric($cnpj)) {
            return false;
        }
        if ($cnpj == '00000000000000') {
            return false;
        }
        $k = 6;
        $soma1 = "";
        $soma2 = "";
        for ($i = 0; $i < 13; $i++) {
            $k = $k == 1 ? 9 : $k;
            $soma2 += ($cnpj{$i} * $k);
            $k--;
            if ($i < 12) {
                if ($k == 1) {
                    $k = 9;
                    $soma1 += ($cnpj{$i} * $k);
                    $k = 1;
                } else {
                    $soma1 += ($cnpj{$i} * $k);
                }
            }
        }

        $digito1 = $soma1 % 11 < 2 ? 0 : 11 - $soma1 % 11;
        $digito2 = $soma2 % 11 < 2 ? 0 : 11 - $soma2 % 11;

        return ($cnpj{12} == $digito1 and $cnpj{13} == $digito2);
    }


    public static function OrcamentoProdutos()
    {
        $produtos = [
            'Cartão de Visita',
            'Envelope Ofício',
            'Envelope Saco',
            'Papel Timbrado',
            'Receituário',
            'Pasta',
            'Adesivos',
            'Banners',
            'Woobler',
            'Folder',
            'Catálogo',
            'Flyers',
            'Revista',
            'Livros',
            'Display',
            'Totem',
            'Cadernos',
            'Agendas',
            'Calendários de Bolso',
            'Calendários de Mesa',
            'Capa de Celular',
            'Canecas Personalizadas',
            'Blocos',
            'Cartão Postal',
            'Cartaz',
            'Poster',
            'Photo Book',
            'Papel Bandeja',
            'Cardápios',
            'Apostilas',
            'Caixas',
            'Embalagens',
            'Capa de CD',
            'Capa de DVD',
            'Rótulos',
            'Sacolas'
        ];
        return $produtos;
    }
    public static function OrcamentoCores()
    {
        $cores = [
            '1x0 cores (preto e branco)',
            '1x1 cor (preto)',
            '4x0 cores (CMYK)',
            '4x4 cores (CMYK)',

        ];
        return $cores;
    }

    public static function OrcamentoAcabamentos(){
        $acabamentos = [
            'Refile',
            'Corte e Vinco',
            'Vinco',
            'Faca Especial',
            'Dobra Automática',
            'Dobra Manual',
            'Verniz e Máquina Brilho',
            'Verniz e Máquina Fosco',
            'Verniz UV Total 1 lado',
            'Verniz UV Total 2 lados',
            'Verniz Localizado 1 lado',
            'Verniz Localizado 2 lados',
            'Verniz Localizado Textura',
            'Verniz Localizado Glitter',
            'Laminação Fosca 1 lado',
            'Laminação Fosca 2 lados',
            'Laminação Brilho 1 lado',
            'Laminação Brilho 2 lados',
            'Relevo Americano',
            'Relevo Seco',
            'Hot Stamping',
            'Capa Dura',
            'Wire-o',
            'Espiral',
            'Grampo',
            'Dobra e Grampo',
            'Lombada Quebrada',
            'Furo',
            'Fita Dupla Face',
            'Colagem'
        ];
        return $acabamentos;
    }
    public static function OrcamentoProvaCor(){
        $prova_cor = [
            'Digital',
            'Virtual (email)',
            'Digital + Mock-up'
        ];
        return $prova_cor;
    }
    public static function OrcamentoEntrega(){
        $entrega = [
            'Retira na Ecograph',
            'SEDEX',
            'Transportadora retira na Ecograph. O cliente escolhe a transportadora',
            'Motoboy (Somente para o ABC e Capital SP, demais localidades: Transportadora ou SEDEX)'
        ];
        return $entrega;
    }
}