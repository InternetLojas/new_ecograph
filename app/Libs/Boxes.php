<?php

Class Boxes {

    public $html; //Esta variavel é usada para enumerar todos os listados
    public $subnivel = 1; //Esta variavel server para referenciar o pai dos listados em qualquer nível

    public function compose($view) {
        $manufacturers = Manufacturer::all();
        $categories = $this->ArrayCateg();
        //echo "<pre>";
        //print_r($categories);
        //exit;
        $box = array(compact('manufacturers'), compact('categories'));
        $view->with(compact('box'));
    }

    public function ArrayCateg() {
        $cat = Category::all();
        foreach (compact('cat') as $categ) {
            foreach ($categ as $desc) {
                if ($desc->id != '184' && $desc->id != '190') {
                    $cat_nome = CategoryDescription::find($desc->id);
                    $prole = $this->desceNaArvore($desc->id);
                    $pai[$desc->id] = array('parent' => $desc->parent_id, 'nome' => $cat_nome->categories_name, 'prole' => $prole);
                }
            }
            $prole = array();
        }
        return $pai;
    }

    public function desceNaArvore($id_pai) {
        $filhos = array();
        $desc = Category::descendentes($id_pai)->get();
        foreach ($desc as $prole) {
            $cat_nome = CategoryDescription::where('id',$prole->id)->get();
            foreach ($cat_nome->toarray() as $y => $item) {
                $nome = $item['categories_name'];
            }
            $geracao = $this->desceNaArvore($prole->id);
if(is_array($geracao) && count($geracao)>0){
$filhos[$prole->id] = array('nome' => $nome, 'prole' => $geracao);
}
            
            
        }
        return $filhos;
    }

}
