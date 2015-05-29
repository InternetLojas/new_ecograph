<?php

Class GoogleShopping {

    private $coin;    
    private $un;

    public $title;
    public $description;
    public $link;

    /***variaveis para o google shopping****/
    public $gid;
    public $gtitle;
    public $glink;
    public $gimage_link;
    public $gmpn;
    public $ggoogle_product_category = 'Material de escritório';
    public $gbrand;
    public $gproduct_type = 'Material de escritório > Suprimentos em geral';
    public $gcondition = 'new';
    public $gavailability;
    public $gavailability_date;
    public $ginstallment = True;    
    public $gprice;
    public $gsale_price;
    public $gmonths;
    public $gamount;
    public $gshipping_weight;
    public $gonly_online = 'y';


    public $items = array();

    public function __construct() {
        Config::get('extras');
        if (empty($this->coin)) $this->coin = 'BRL';
        if (empty($this->un)) $this->un = 'Kg';
    }

    public function getProdutos($products_id) {       
        $produtos = Product::wherein('id', $products_id)
                    ->orderby('created_at')
                    ->limit(QTD_PRODUTOS_SHOPPING)
                    ->get();
        $products = $produtos->toarray();
        return $products;
    }

    public function getDescricao($products_id) {
        $descricao_products = ProductDescription::wherein('id', $products_id)
                            ->limit(QTD_PRODUTOS_SHOPPING)
                            ->get();
        $descricao = $descricao_products->toarray();
        return $descricao;
    }

    public function getFeeds($produtos,$descricao){
        
        $feeders = array();
        foreach($produtos as $key=>$feeds){
            $categoria = CategoryProduct::where('product_id',$feeds['id'])
                            ->where('category_id','<>','40')->first();
            if(!empty($categoria)){
            $array_precos = Precos::pac_acabamento(true,$categoria->category_id);
            sort($array_precos);
            $min_preco = $array_precos[0];
            $max_preco=$array_precos[count($array_precos)-1];

            $parent = Category::find($categoria->category_id)->parent_id;
            $desc = '<span style="font-size:16px;">'.html_entity_decode((Utilidades::truncate(CategoryDescription::find($categoria->category_id)->categories_info,180))).'</span>';
            $this->gid = $feeds['id'];
            $this->gmpn = $feeds['products_model'];
            $this->gbrand = Fichas::nomefabricante($feeds['manufacturer_id'], false);           
            $this->gtitle = html_entity_decode(strip_tags(Utilidades::truncate(CategoryDescription::find($categoria->category_id)->categories_info,180)));
            $this->glink = URL::to('produtos').'/'. $parent.'/'.$categoria->category_id.'/'.URLamigaveis::Slug(Utilidades::truncate($descricao[$key]['products_name']),'-',true).'.html';
            $this->gimage_link = URL::to('images').'/'.$feeds['products_image'];
            if(Fichas::novidade($feeds['id'])){
                $this->gavailability = 'preorder';
                $this->gavailability_date = date('YYYY-MM-DD', strtotime($feed['products_date_available'])).'T0000-0300';
            } else {
                $this->gavailability = 'in stock';
                $this->gavailability_date = '';
            }
            $this->gprice = str_replace(",",".",$min_preco).' '.$this->coin; 
            $preco = Utilidades::RealBusca($min_preco,'2',true);   
            $this->gmonths = $meses = Fichas::Parcelas($min_preco);
            $this->gamount =  str_replace(",",".",Fichas::SetValorParcelas(Fichas::Parcelas($min_preco),$min_preco,false)).' '.$this->coin;
            $parcelas = Utilidades::RealBusca(Fichas::SetValorParcelas(Fichas::Parcelas($min_preco),$min_preco,false),'2',true);
 
            $this->title = '<![CDATA['.$descricao[$key]['products_name'].']]>';      
            $this->description = '<![CDATA['.$desc.'<br><p><b>Preço - a partir de: '.$preco.'</b><br><b>Até : R$ '.Utilidades::RealBusca($max_preco,'2').'</b><br><br><span style="color:#db0002 !important">Saiba mais clicando no link</span>.</p>]]>';
            $this->link = '<![CDATA['.URL::to('produtos').'/'. $parent.'/'.$categoria->category_id.'/'.URLamigaveis::Slug(Utilidades::truncate($descricao[$key]['products_name']),'-',true).'.html]]>';
            $this->gshipping_weight = $feeds['products_weight']. ' ' .$this->un;
            if(!Fichas::PrecoExcepcional($feeds['id'])){
                $items = array('title' => $this->title,                        
                        'link' => $this->link,
                        'description' => $this->description,
                        'g:id' => $this->gid,
                        'g:title' => $this->gtitle,
                        'g:link' => $this->glink,
                        'g:image_link' => $this->gimage_link,
                        'g:mpn' => $this->gmpn,
                        'g:google_product_category' => $this->ggoogle_product_category,
                        'g:brand' => $this->gbrand,
                        'g:product_type' => $this->gproduct_type,
                        'g:condition' => $this->gcondition,
                        'g:availability' => $this->gavailability,
                        'g:availability_date' => $this->gavailability_date,
                        'g:installment' => $this->ginstallment,
                        'g:price' => $this->gprice,
                        'g:sale_price' => $this->gsale_price,
                        'g:months' => $this->gmonths,
                        'g:amount' => $this->gamount,
                        'g:shipping_weight' => $this->gshipping_weight,
                        'g:only_online' => $this->gonly_online                        
                        );
                $feeders[] = $items;
            }
        }
        }
        //echo "<pre>";print_r($feeders);exit;
        return $feeders;
    }

    public function getItems($items){
        $rss = '';        
        foreach($items as $key=>$item){
            $rss .= "<item>\n";
            foreach($item as $g=>$value){
                $rss .= "<".$g.">\n".$value."</".$g.">\n";
            }
            $rss .= "</item>\n";
        }
        return $rss;
    }

function Parcelas($bruto,$id){

	}
function removeAcentos($string, $slug = false) {

	    return $string;
	}


/**
* Format datetime string, timestamp integer or carbon object in valid feed format
*
* @param string/integer $date
*
* @return string
*/
private function formatDate($date, $format="atom")
{
if ($format == "atom")
{
switch ($this->dateFormat)
{
case "carbon":
$date = date('c', strtotime($date->toDateTimeString()));
break;
case "timestamp":
$date = date('c', $date);
break;
case "datetime":
$date = date('c', strtotime($date));
break;
}
}
else
{
switch ($this->dateFormat)
{
case "carbon":
$date = date('D, d M Y H:i:s O', strtotime($date->toDateTimeString()));
break;
case "timestamp":
$date = date('D, d M Y H:i:s O', $date);
break;
case "datetime":
$date = date('D, d M Y H:i:s O', strtotime($date));
break;
}
}
return $date;
}

}