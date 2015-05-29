<?php

namespace Ecograph\Libs;

Class Layout {

    public static function classes($id = '') {
        switch ($id) {
            case 0:
                //inicial
                $back_menu = $back_li = "#343434";
                $background = "#e6e6e6"; #CC0000";
                $background_pai = "#b2b2b2"; #950000
                $color_bg_footer = "transparent";
                $color_bg_in_footer = "#0066FF";
                $img_banner_produto = "";
                $bullet = "bullet_default";
                $style_a = "blue";
                $hoover_a = "hoverblue";
                break;
            case 1:
                //comercial
                $back_menu = $back_li = "#CC0000"; # 
                $background = "#e6e6e6"; #CC0000";
                $background_pai = "#b2b2b2"; #950000
                $color_bg_footer = "#950000";
                $color_bg_in_footer = "#CC0000";
                $img_banner_produto = "comercial";
                $bullet = "bullet_red";
                $style_a = "red";
                $hoover_a = "hoverred";
                break;
            case 2:
                //editorial
                $back_menu = $back_li = "#FFBF00";
                $background = "#e6e6e6"; #FFBF00";
                $background_pai = "#CE9B00"; /* b2b2b2 */
                $color_bg_footer = "#CE9B00";
                $color_bg_in_footer = "#FFBF00";
                $img_banner_produto = "editorial";
                $bullet = "bullet_orange";
                $style_a = "orange";
                $hoover_a = "hoverorange";
                break;
            case 3:
                //promocional
                $back_menu = $back_li = "#009900";
                $background = "#e6e6e6"; #009900";
                $background_pai = "#b2b2b2"; #006600;
                $color_bg_footer = "#006600";
                $color_bg_in_footer = "#009900";
                $img_banner_produto = "promocional";
                $bullet = "bullet_green";
                $style_a = "green";
                $hoover_a = "hovergreen";
                break;
            case 4:
                //brindes
                $back_menu = $back_li = "#663399";
                $background = "#e6e6e6"; #663399";
                $background_pai = "#b2b2b2"; #330066";
                $color_bg_footer = "#330066";
                $color_bg_in_footer = "#663399";
                $img_banner_produto = "brindes";
                $bullet = "bullet_violet";
                $style_a = "violet";
                $hoover_a = "hoverviolet";
                break;
            case 28:
                //grátis
                $back_menu = $back_li = "#CC0000";
                $background = "#e6e6e6"; #CC0000";
                $background_pai = "#b2b2b2"; #950000;
                $color_bg_footer = "#950000";
                $color_bg_in_footer = "#CC0000";
                $img_banner_produto = "comercial";
                $bullet = "bullet_red";
                $style_a = "red";
                $hoover_a = "hoverred";
                break;
            case 6:
                //produto
                $back_menu = $back_li = "#343434"; # 
                $background = "#e6e6e6"; #CC0000";
                $background_pai = "#b2b2b2"; #950000
                $color_bg_footer = "#003366";
                $color_bg_in_footer = "#0066FF";
                $img_banner_produto = "";
                $bullet = "bullet_red";
                $style_a = "red";
                $hoover_a = "hoverred";
                break;
        }
        return array(
            'back_menu' => $back_menu,
            'back_li' => $back_li,
            'background' => $background,
            'background_pai' => $background_pai,
            'color_bg_footer' => $color_bg_footer,
            'color_bg_in_footer' => $color_bg_in_footer,
            'img_banner_produto' => $img_banner_produto,
            'bullet' => $bullet,
            'style_a' => $style_a,
            'hoover_a' => $hoover_a
        );
    }

}

?>