<?php

Class URLAmigaveis {

    public static function Slug($string, $slug = false, $full = false) {

        $string = preg_replace('/[`^~\'"]/', null, iconv('UTF-8', 'ASCII//TRANSLIT', $string));
        // Código ASCII das vogais
        $ascii['a'] = range(224, 230);
        $ascii['e'] = range(232, 235);
        $ascii['i'] = range(236, 239);
        $ascii['o'] = array_merge(range(242, 246), array(240, 248));
        $ascii['u'] = range(249, 252);

        // Código ASCII dos outros caracteres
        $ascii['b'] = array(223);
        $ascii['c'] = array(231);
        $ascii['d'] = array(208);
        $ascii['n'] = array(241);
        $ascii['y'] = array(253, 255);

        foreach ($ascii as $key => $item) {
            $acentos = '';
            foreach ($item AS $codigo) {
                $acentos .= chr($codigo);
            }
            $troca[$key] = '/[' . $acentos . ']/i';
        }
        $string = strtolower($string);
        // $string = preg_replace(array_values($troca), array_keys($troca), strtolower($string));
        //$string_acentos = 'ÁÍÓÚÉÄÏÖÜËÀÌÒÙÈÃÕÂÎÔÛÊáíóúéäïöüëàìòùèãõâîôûêÇç';
        //$string = preg_replace( '/[`^~\'"]/', null, iconv( 'UTF-8', 'ASCII//TRANSLIT', $string_acentos ) );
        if ($slug) {
            // Troca tudo que não for letra ou número por um caractere ($slug)
            $string = preg_replace('/[^a-z0-9]/i', $slug, $string);
            // Tira os caracteres ($slug) repetidos
            $string = preg_replace('/' . $slug . '{2,}/i', $slug, $string);
            //verifica se o último caractere é um caracter $stung;
            $size = strlen($string);
            if (substr($string, $size - 1) == $slug) {
                //$string = str_replace(substr($string, $size - 1), '', substr($string, $size - 1));
                $string = substr($string, 0, -1) . '';
            }
            $string = str_replace('1', $slug, $string);
            $string = trim($string, $slug);
            $pattern = "/([^[:alnum:]])+/i";
            $string = preg_replace($pattern, $slug, mb_convert_case($string, MB_CASE_LOWER, "utf-8"));
            $pattern = "/([[:punct:]])+/i";
            $string = preg_replace($pattern, $slug, mb_convert_case($string, MB_CASE_LOWER, "utf-8"));
            $pattern = "/([[:space:]]|[[:blank:]])+/i";
            $string = preg_replace($pattern, $slug, $string);
            if (!$full) {
                $string = substr($string, 0, 25);
            }
        }

        return $string;
    }

}
