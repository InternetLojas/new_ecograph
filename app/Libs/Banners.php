<?php namespace Ecograph\Libs;

use Ecograph\Banner;
use Ecograph\Palco;
use Ecograph\Slider;
use Ecograph\Category;
use Ecograph\CategoryDescription;

Class Banners {

    public static function Ativos($group = '1') {
       
        $categorias = array();
        $banner_ativos = Banner::ativo($group)->get();
        $id_img = 1;
        foreach ($banner_ativos as $ativos) {
            $palcos_ativos = Palco::palcos($ativos->id)->get();
            foreach ($palcos_ativos as $promocoes) {
                $slider = Slider::promo($promocoes->id)->get();
                foreach ($slider as $item) {
                    $categorias = array('category_id' => $item->categories_id,
                        'img' => $item->img
                    );
                }
                if ($group == 1 || $group == 2) {
                    $descricao = CategoryDescription::where('id', '=', $categorias['category_id'])->first();
                    $categorias['categories_name'] = $descricao->categories_name;
                    $categorias['categories_info'] = $descricao->categories_info;
                    $categorias['categories_descricao'] = $descricao->categories_descricao;
                    $categorias['categories_img'] = $categorias['img'];
                    $categorias['id'] = $categorias['category_id'];
                    $categorias['parent_id'] = Category::find($categorias['category_id'])->parent_id;
                    $categorias['id_img'] = $id_img;
                    $id_img++;
                } else{
                    $descricao = CategoryDescription::where('id', '=', $categorias['category_id'])->first();
                    $categorias['categories_name'] = $descricao->categories_name;
                    $categorias['categories_info'] = $descricao->categories_info;
                    $categorias['categories_descricao'] = $descricao->categories_descricao;
                    $categorias['categories_img'] = $categorias['img'];
                    $categorias['id'] = $categorias['category_id'];
                    $categorias['parent_id'] = Category::find($categorias['category_id'])->parent_id;
                    $categorias['id_img'] = $id_img;
                    $id_img++;
                }
                $banners[$promocoes->id] = $categorias;
                $categorias = array();
            }
        }

        return $banners;
    }

    public static function Item($id) {
        $produto = Product::find($id);
        if (!file_exists('images/' . $produto->products_imagem) || $produto->products_imagem == '') {
            $produto->products_imagem = 'theme/naodisponivel.jpg';
        }
        return $produto;
    }

    public static function Laterais($lateral = 'right') {
        $url = Request::url();
        $path = Request::path();
        $url_image = explode($path, $url);
        $dir_img_banner_lateral = "images/banners/banners_laterais/";

        $images = glob($dir_img_banner_lateral . '*.{jpg,gif,png}', GLOB_BRACE);
        //Loop que percorre a pasta das imagens e armazena o nome de todos os arquivos
        foreach ($images as $image_laterais) {
            if (!empty($image_laterais)) {
                $img = explode('.', $image_laterais);
                $idt_img = explode('_', $img[0]);
                //print_r($idt_img);exit;
                $imnfo = getimagesize($image_laterais);
                $img_w = $imnfo[0];       // largura
                $img_h = $imnfo[1];       // altura
                if ($lateral == "right") {
                    if ($idt_img[3] == 'r') {
                        $metas[] = array($image_laterais, $img_w, $img_h, $idt_img[3]);
                    }
                } else {
                    if ($idt_img[3] == 'l') {
                        $metas[] = array($image_laterais, $img_w, $img_h, $idt_img[3]);
                    }
                }
            }
        }
        shuffle($metas);

        return $metas;
    }

}
