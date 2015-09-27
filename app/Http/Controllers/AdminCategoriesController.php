<?php namespace Ecograph\Http\Controllers;

use Ecograph\Acabamento;
use Ecograph\Category;
use Ecograph\CategoryDescription;
use Ecograph\CategoryAcabamento;
use Ecograph\CategoryCor;
use Ecograph\CategoryEnoblecimento;
use Ecograph\CategoryFormato;
use Ecograph\CategoryPapel;
use Ecograph\Cor;
use Ecograph\Customer;
use Ecograph\Enoblecimento;
use Ecograph\Formato;
use Ecograph\Http\Requests;
use Ecograph\Http\Controllers\Controller;
use Ecograph\Paccor;
use Ecograph\Pacformato;
use Ecograph\Pacpapel;
use Ecograph\Pacacor;
use Ecograph\Pacacabamento;
use Ecograph\Papel;
use Ecograph\Pacote;
use Ecograph\Product;
use Ecograph\ProdutoPerfil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminCategoriesController extends Controller {

    private $categoryModel;
    private $categoryFormato;
    private $categoryPapel;
    private $categoryCor;
    private $categoryEnoblecimento;
    private $categoryAcabamento;
    private $formatoModel;
    private $papelModel;
    private $corModel;
    private $enoblecimentoModel;
    private $acabamentoModel;
    private $pacoteModel;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Category $categoryModel,
                                CategoryFormato $categoryFormato,
                                CategoryPapel $categoryPapel,
                                CategoryCor $categoryCor,
                                CategoryEnoblecimento $categoryEnoblecimento,
                                CategoryAcabamento $categoryAcabamento,
                                Formato $formatoModel,
                                Papel $papelModel,
                                Cor $corModel,
                                Enoblecimento $enoblecimentoModel,
                                Acabamento $acabamentoModel,
                                Pacote $pacoteModel){

        $this->categoryModel = $categoryModel;
        $this->categoryFormato = $categoryFormato;
        $this->categoryPapel = $categoryPapel;
        $this->categoryCor = $categoryCor;
        $this->categoryEnoblecimento = $categoryEnoblecimento;
        $this->categoryAcabamento = $categoryAcabamento;
        $this->formatoModel = $formatoModel;
        $this->papelModel = $papelModel;
        $this->corModel = $corModel;
        $this->enoblecimentoModel = $enoblecimentoModel;
        $this->acabamentoModel = $acabamentoModel;
        $this->pacoteModel = $pacoteModel;

    }
    /*
     * Quando entra na área administrativa é apresentada essa página
     */
    public function index(CategoryDescription $category_description) {
        $description = $category_description->all();
        $categories = $this->categoryModel->paginate(45);
        return view('diretoria.category.category')
            ->with(compact('categories'))
            ->with('description',$description)
            ->with('page','category');
    }
    /*
     * Todos os produtos de uma determinada categoria
     */
    public function Detalhes($id, CategoryDescription $category_description, Product $product) {
        $category = $this->categoryModel->find($id);
        $CategoryProduct = $category->CategoryProduct()->paginate(45);
        $this->MudaImage($id, $category_description, $product, $category);
        return view('diretoria.category.listprodutos')
            ->with('category',$category)
            ->with('CategoryProduct',$CategoryProduct)
            ->with('page','category');
    }
    /*
     * mostra os atributos de uma categoria
     */
    public function Atributos($id){
        $cat = $this->categoryModel->find($id);
        //formatos
        $catformatos = $cat->CategoryFormato()->where('category_id',$id)->lists('formato_id');
        //dd($catformatos);
        $formatos = $this->formatoModel->all();

        //papeis
        $catpapeis = $cat->CategoryPapel->lists('papel_id');
        $papeis = $this->papelModel->all();

        //cores
        $catcores = $cat->CategoryCor->lists('cor_id');
        $cores = $this->corModel->all();

        //enobrecimentos
        $catenobrecimentos = $cat->CategoryEnoblecimento->lists('enoblecimento_id');
        $enobrecimentos = $this->enoblecimentoModel->where('category_id',$id)->get();
       // echo '<pre>'; print_r($catenobrecimentos);exit;
        //acabamentos
        $catacabamentos = $cat->CategoryAcabamento->lists('acabamento_id');
        $acabamentos = $this->acabamentoModel->all();

        //pacotes
        $catpacotes = $cat->Pacotes->lists('id');
        $pacotes = $this->pacoteModel->where('category_id',$id)->get();

        return view('diretoria.atributos.category_atributos')
            ->with(compact('formatos', 'papeis', 'cores', 'enobrecimentos','acabamentos','pacotes'))
            ->with('catformatos',$catformatos)
            ->with('catpapeis',$catpapeis)
            ->with('catcores',$catcores)
            ->with('catenobrecimentos',$catenobrecimentos)
            ->with('catacabamentos',$catacabamentos)
            ->with('catpacotes',$catpacotes)
            ->with('cat',$cat)
            ->with('page','atributos');
    }

    public function Edit($id, CategoryDescription $category_description) {
        $category = $this->categoryModel->find($id);
        $description = $category_description->find($id)->toArray();

        $category_formato = $category->formato;
        $list_formatos = [];
        $list_f = '';
        $formatos = [];
        if($category_formato->toArray()){
            foreach($category_formato as $lista){
                $list_formatos[] = $lista->valor;
            }
            $list_f = implode(',',$list_formatos);
        } else {
            $formatos = $this->formatoModel->lists('valor','id');
        }
        //dd($list_f);
        $category_papel = $category->papel;
        $list_papeis = [];
        $list_p = '';
        $papeis = [];
        if($category_papel->toArray()){
            foreach($category_papel as $lista){
                $list_papeis[] = $lista->valor;
            }
            $list_p = implode(',',$list_papeis);
        }else {
            $papeis = $this->papelModel->lists('valor','id');
        }

        return view('diretoria.category.category_edit')
            ->with(compact('category'))
            ->with('page','category')
            ->with('description',$description)
            ->with('formatos',$formatos)
            ->with('papeis',$papeis)
            ->with('list_f',$list_f)
            ->with('list_p',$list_p);
    }

    /**
     * @param $id
     * @param CategoryDescription $category_description
     * @param Product $product_id
     * @param $category
     */
    public function MudaImage($id, CategoryDescription $category_description, Product $product_id, $category)
    {
        switch($id){
            case 5 :
                $prefixo = '-frente.png';
                $diretorio = 'produtos/';
                $info_category = $category_description->find($id)->toArray();
                $extra='';
                break;
            case 9 :
                $prefixo = '.png';
                $diretorio = 'produtos/';
                $info_category = $category_description->find($id)->toArray();
                $extra='medio';
                break;
            case 10 :
                $prefixo = '.png';
                $diretorio = 'produtos/';
                $info_category['categories_name'] = 'papelcarta';
                $extra='';
                break;
            case 21 :
                $prefixo = '-frente.png';
                $diretorio = 'produtos/';
                $info_category = $category_description->find($id)->toArray();
                $extra='';
                break;
            case 29 :
                $diretorio = 'produtos/cv-gratis/';
                $prefixo = '-gratis.png';
                $info_category = $category_description->find($id)->toArray();
                $extra='';
                break;
            default :
                $diretorio = 'produtos/';
                $prefixo = '.png';
                $info_category = $category_description->find($id)->toArray();
                $extra='';
                break;
        }
        $perfil = [];
        $new_image = [];
        
        $newimg = \URLAmigaveis::Slug($info_category['categories_name'].$extra, '-', true);
        $CP = $category->CategoryProduct()->lists('product_id');
        $SQL = '';
        $update = '';
        foreach ($CP as $produto) {
            $pf = ProdutoPerfil::where('product_id', $produto)->first()->Perfil;

            if (!is_null($pf)) {
                $perfil[$pf->id][] = [$produto, $newimg . '-' . \URLAmigaveis::Slug($pf->nome_perfil) . '-'];
            } else {
                $perfil['vazio'][] = [$produto, 'images/theme/naoencontrado.png'];
            }
        }

        foreach ($perfil as $perfil_id => $array_img) {
            //dd($array_img);
            $count = count($array_img);
            $num = 0;
            if ($perfil_id != 'vazio') {

                for ($i = 0; $i < $count; $i++) {
                    if ($i <= 8) {
                        $digito = 0;
                    } else {
                        $digito = '';
                    }
                    $product_img = $product_id->find($array_img[$i][0]);
                    $num++;
                    if (!is_null($product_img)) {
                        //$new_image[] = $diretorio . $perfil[$perfil_id][$i][1] . $digito . $num . $prefixo;
                        $SQL .= 'UPDATE products SET products_image = \''.$diretorio . $perfil[$perfil_id][$i][1] . $digito . $num . $prefixo. '\' WHERE id = ' .$array_img[$i][0]. ';<br>';
                        //$product_img->update(['products_image' => $diretorio . $perfil[$perfil_id][$i][1] . $digito . $num . $prefixo]);
                    }
                }

            }
        }
        //exit;
        echo $SQL; exit;
        dd($new_image);
    }

    /****geração dos formatos *****/
    public function CatformatosEdit($id,CategoryDescription $category_description, Pacformato $pacformato){
        $cat_name = $category_description->find($id)->categories_name;
        /*****formatos*********/
        $list_formatos = $this->formatoModel->all();
        $cat = $this->categoryModel->find($id);
        //caso não tenha sido criado a categoria formato redireciona para a função que cria
        if(!$cat->categoryFormato->toArray()){
            return redirect()->route('categories.atributos',['id' =>$id]);
        }
        $catformatos  = $cat->categoryFormato->lists('id','formato_id');
        $cat_f = $cat->categoryFormato;
        if(empty($cat_f)){
            return redirect()->route('formatos.create');
        }

        $list_pacotes = $cat->Pacotes->lists('quantity','id');
        $formato = [];
        $formato = $this->CheckFormato($id, $pacformato, $cat, $cat_f, $list_pacotes, $formato);
        /*****formatos*********/
        return view('diretoria.atributos.category_formato',compact('formato','list_formatos'))
            ->with('catformatos',$catformatos)
            ->with('pacotes',$list_pacotes)
            ->with('cat_name',$cat_name)
            ->with('cat_id',$id)
            ->with('page','atributos');
    }
    /**
     * @param $id
     * @param Pacformato $pacformato
     * @param $cat
     * @param $cat_f
     * @param $list_pacotes
     * @param $formato
     * @return mixed
     */
    public function CheckFormato($id, Pacformato $pacformato, $cat, $cat_f, $list_pacotes, $formato)
    {

        //$check_categoryFormato = $cat->categoryFormato()->where('category_id', $id)->first()->PacFormatos()->get()->toArray();

       // if (count($check_categoryFormato) == 0) {
            //chama a função
         //   $array_f = $this->ArrayFormatoCreate($cat, $cat_f, $pacformato, $list_pacotes);
       // } else {
            $array_f = $this->ArrayFormato($cat);
        //}
        //dd($array_f);
        foreach ($array_f[0] as $formato_id => $items) {
            foreach($items as $key => $item){
                $formato[$formato_id] = [
                    'category_id' => $id,
                    'formato_id' => $formato_id,
                    'formato_nome' => $this->formatoModel->find($formato_id)->valor,
                    'pacotes' =>  $array_f[1][$formato_id]
                ];
            }
        }
        return $formato;
    }
   /* public function ArrayFormatoCreate($category,$cat_f,$pacFormato,$pacote)
    {

        foreach ($cat_f->toArray() as $key => $id) {
            foreach ($pacote as $pacote_id => $quantity) {
                $formatos[$id['formato_id']] = [
                    'category_id' => $category->id,
                    'category_formato_id' => $id['id']
                ];
                $item[$pacote_id] =  $quantity;
                $pacFormato->firstOrCreate([
                    'category_id' => $category->id,
                    'category_formato_id' => $id['id'],
                    'pacote_id' => $pacote_id
                ]);
            }
            $formatos[$id['id']]['pacote_id'] = $item;
            $item = [];
        }

        return $formatos;
    }*/
    public function ArrayFormato($category)
    {
        $cat = $this->categoryModel->find($category->id);
        $list_pacotes = $cat->Pacotes->lists('quantity','id');
        /*****PacFormatos*********/
        $r_CatFormato = $cat->categoryFormato()->get()->groupby('category_formato_id');
        foreach ($r_CatFormato as $CatF => $item_CatFormato) {
            foreach ($item_CatFormato as $items) {
                $pac_formato[$items->formato_id] = $items->PacFormatos;
                $pacote_id = $items->PacFormatos()->lists('pacote_id','id');
                foreach ($pacote_id as $pacformato_id => $id) {
                    $pacotes[$items->formato_id] [$pacformato_id] =$list_pacotes[$id];
                }
            }
        }
        return [$pac_formato,$pacotes];
    }
    /*
     * ****geração dos formatos *****
    */

    /****geração dos papeis *****/
    public function CatpapeisEdit($id,CategoryDescription $category_description,Pacformato $pacformato,Pacpapel $pacpapel){
        $cat_name = $category_description->find($id)->categories_name;
        /*****formatos*********/
        $cat = $this->categoryModel->find($id);
        $cat_f = $cat->categoryFormato;
        if(empty($cat_f)){
            return redirect()->route('formatos.create');
        }
        //caso não tenha sido criado a categoria formato redireciona para a função que cria
        if(!$cat->categoryFormato->toArray()){
            return redirect()->route('categories.atributos',['id' =>$id]);
        }
        $list_pacotes = $cat->Pacotes->lists('quantity','id');
        $formato = [];
        $formato = $this->CheckFormato($id, $pacformato, $cat, $cat_f, $list_pacotes, $formato);
        /*****formatos*********/

        /*****papeis*********/
        if(!$cat->categoryPapel->toArray()){
            return redirect()->route('categories.atributos',['id' =>$id]);
        }
        $cat_p = $cat->categoryPapel;
        if(empty($cat_p)){
            return redirect()->route('papeis.create');
        }
        $catpapeis = $cat->categoryPapel->lists('id','papel_id');

        if($id == 5){
            $autoriza_p = $this->AutorizaAtributos($id, $cat_p,'papel');
        } else {
            foreach ($cat_p->toArray() as $value) {
                $autoriza[$value['papel_id']] = $cat_f->lists('id');
            }
            $autoriza_p[0] = $autoriza;
            $autoriza_p[1] = [];
        }
        $papel = [];
        $papel = $this->CheckPapel($id, $pacpapel, $cat, $list_pacotes, $autoriza_p, $cat_p, $papel);
        $list_papeis = $this->papelModel->all();
        $formato_autorizado = $this->AutorizaAtributos($id, $cat_p, 'papel');
        /*****papeis*********/

        return view('diretoria.atributos.category_papel',compact('formato', 'papel','list_papeis'))
            ->with('catpapeis',$catpapeis)
            ->with('formato_autorizado',$formato_autorizado)
            ->with('cat_name',$cat_name)
            ->with('cat_id',$id)
            ->with('page','atributos');
    }
    /**
     * @param $id
     * @param Pacformato $pacformato
     * @param Pacpapel $pacpapel
     * @param $cat
     * @param $list_pacotes
     * @param $autoriza_p
     * @param $cat_p
     * @param $papel
     * @return mixed
     */
    public function CheckPapel($id, Pacpapel $pacpapel, $cat, $list_pacotes, $autoriza_p, $cat_p, $papel)
    {
        $array_p = $this->ArrayPapel($cat, $cat_p, $pacpapel);
        foreach ($array_p as $formato_id=>$items) {
            foreach ($cat_p as $key => $item_p) {
                //dd($items);
                if(in_array($item_p->papel_id,array_keys($items))){
                    $papel[$formato_id][$item_p->papel_id] = [
                        'papel_id' => $item_p->papel_id,
                        'papel_nome' => $this->papelModel->find($item_p->papel_id)->valor,
                        'pacotes' => $items[$item_p->papel_id]
                    ];
                }
            }
        }
        return $papel;
    }
    public function ArrayPapel($category,$cat_p,$pacPapel)
    {
        $pacPapeis = '';
        $cat = $this->categoryModel->find($category->id);
        $pacotes = $cat->Pacotes->lists('quantity','id');
        /*****PacFormatos*********/
        $r_CatFormato = $cat->categoryFormato()->get()->groupby('category_formato_id');

        foreach ($r_CatFormato as $CatF => $item_CatFormato) {
            foreach ($item_CatFormato as $items) {
                $formato_id =  $items->formato_id;
                $pacFormato = $items->PacFormatos;
                foreach($pacFormato as $key => $item_PacFormato){
                    if(!is_null($item_PacFormato->PacPapeis()->get()->first())){
                        $item_Pac = $item_PacFormato->PacPapeis->groupby('category_papel_id')->toArray();
                        $PacPapeis[$formato_id][] = $item_Pac;
                    }
                }
            }
        }
        if(is_Array($pacPapeis)){
            $cat_papeis =  $cat_p->lists('papel_id','id');
            foreach ($PacPapeis as $formato_id => $PacP) {
                foreach ($PacP as $k =>$PacPapel) {
                    foreach ($PacPapel as $category_papel_id => $Pac) {
                        $papeis[$formato_id][$cat_papeis[$category_papel_id]]['category_id'] = $category->id;
                        $papeis[$formato_id][$cat_papeis[$category_papel_id]]['category_papel_id'] = $category_papel_id;
                        foreach ($Pac as $key => $item) {
                            $papeis[$formato_id][$cat_papeis[$category_papel_id]]['weight'][$item->id] = $item->weight;
                            $papeis[$formato_id][$cat_papeis[$category_papel_id]]['pacote_id'][$item->pacote_id] = $pacotes[$item->pacote_id];
                        }
                    }
                }
            }

        } else {
            $papeis = $this->ArrayPapelCreate($category,$pacotes);
        }
        return $papeis;
    }
   public function ArrayPapelCreate($category,$pacote)
    {
        $cat_f = $category->CategoryFormato;
        $cat_p = $category->CategoryPapel;
        $autoriza_p = $this->AutorizaAtributos($category->id, $cat_p,'papel');
        $autoriza = $autoriza_p[0];
        foreach ($cat_p->toArray() as $papel) {
            foreach ($cat_f->toArray() as $key => $formato) {
                if (in_array($formato['formato_id'], $autoriza[$papel['papel_id']])) {
                    $pacF_id = $cat_f->find($formato['id'])->PacFormatos()->first()->id;
                    foreach ($pacote as $pacote_id => $quantity) {
                        $papeis[$formato['formato_id']][$papel['papel_id']] = [
                            'category_id' => $category->id,
                            'pacformato_id' => $pacF_id,
                            'category_papel_id' => $papel['id']
                        ];
                        $item[$pacote_id] = $quantity;
                        $weights[$pacote_id] = 0;
                        $row_pac = [
                            'category_id' => $category->id,
                            'pacformato_id' => $pacF_id,
                            'category_papel_id' => $papel['id'],
                            'pacote_id' => $pacote_id,
                            'weight' => 0
                            ];
                        $CategoryPapel = $this->categoryPapel->find($papel['id']);
                        $CategoryPapel->PacPapeis()->firstOrCreate($row_pac);


                    }
                    $papeis[$formato['formato_id']][$papel['papel_id']]['pacote_id'] = $item;
                    $papeis[$formato['formato_id']][$papel['papel_id']]['weight'] = $weights;
                    $item = [];
                    $weights = [];
                } else {
                    $papeis[$formato['formato_id']][$papel['papel_id']] = [
                        'category_id' => '',
                        'pacformato_id' => '',
                        'category_papel_id' => ''
                    ];
                    $papeis[$formato['formato_id']][$papel['papel_id']]['pacote_id'] = [];
                    $papeis[$formato['formato_id']][$papel['papel_id']]['weight'] = [];
                }
            }
        }

        return $papeis;
    }
    /*
     * *****geração das cores ****
     */
    public function CatcoresEdit($id,CategoryDescription $category_description,Pacformato $pacformato,Pacpapel $pacpapel, Paccor $paccor){
        $cat_name = $category_description->find($id)->categories_name;
        /*****formatos*********/
        $cat = $this->categoryModel->find($id);
        $cat_f = $cat->categoryFormato;
        if(empty($cat_f)){
            return redirect()->route('formatos.create');
        }
        //caso não tenha sido criado a categoria formato redireciona para a função que cria
        if(!$cat->categoryFormato->toArray()){
            return redirect()->route('categories.atributos',['id' =>$id]);
        }
        $list_pacotes = $cat->Pacotes->lists('quantity','id');
        $formato = [];
        $formato = $this->CheckFormato($id, $pacformato, $cat, $cat_f, $list_pacotes, $formato);
        /*****formatos*********/

        /*****papeis*********/
        if(!$cat->categoryPapel->toArray()){
            return redirect()->route('categories.atributos',['id' =>$id]);
        }
        $cat_p = $cat->categoryPapel;
        if(empty($cat_p)){
            return redirect()->route('papeis.create');
        }

        if($id == 5){
            $autoriza_p = $this->AutorizaAtributos($id, $cat_p,'papel');
        } else {
            foreach ($cat_p->toArray() as $value) {
                $autoriza[$value['papel_id']] = $cat_f->lists('id');
            }
            $autoriza_p[0] = $autoriza;
            $autoriza_p[1] = [];
        }
        $papel = [];
        $papel = $this->CheckPapel($id, $pacpapel, $cat, $list_pacotes, $autoriza_p, $cat_p, $papel);
        /*****papeis*********/

        /*****cores*********/
        if(!$cat->categoryCor->toArray()){
            return redirect()->route('categories.atributos',['id' =>$id]);
        }
        $cat_c = $cat->categoryCor;
        if(empty($cat_c)){
            return redirect()->route('cores.create');
        }

        $cores = [];
        $cores = $this->CheckCor($id, $paccor, $cat, $cat_f, $cat_p, $cat_c, $list_pacotes, $autoriza_p, $cores);
        $catcores = $cat->categoryCor->lists('id','cor_id');
        $list_cores = $this->corModel->all();

        return view('diretoria.atributos.category_cor',compact('formato','papel','cores','list_cores'))
            ->with('catcores',$catcores)
            ->with('cat_name',$cat_name)
            ->with('cat_id',$id)
            ->with('page','atributos');
    }

    /**
     * @param $id
     * @param Paccor $paccor
     * @param $cat
     * @param $cat_f
     * @param $cat_p
     * @param $cat_c
     * @param $list_pacotes
     * @param $autoriza_p
     * @param $cores
     * @return mixed
     */
    public function CheckCor($id, Paccor $paccor, $cat, $cat_f, $cat_p, $cat_c, $list_pacotes, $autoriza_p, $cores)
    {

            $array_c = $this->ArrayCor($cat, $cat_f, $cat_p, $cat_c, $list_pacotes,$paccor);
        foreach ($cat_c as $item_c) {
            $cores[$item_c->cor_id] = [
                'cor_id' => $item_c->cor_id,
                'cor_nome' => $this->corModel->find($item_c->cor_id)->valor,
                'pacotes' => $array_c
            ];
        }

        return $cores;
    }
    public function ArrayCor($category,$cat_f,$cat_p,$cat_c,$pacote,$pacCor){
        foreach($cat_f->toArray() as $formato){
            foreach ($cat_p->toArray() as $papel) {
                foreach($cat_c->toArray() as $key => $id){
                    foreach ($pacote as $pacote_id => $quantity) {
                        $cores[$formato['formato_id']][$papel['id']][$id['cor_id']] = [
                            'category_id' => $category->id,
                            'pacpapel_id' => $papel['id'],
                            'category_cor_id' => $id['id']
                        ];
                        $item[$pacote_id] =  $quantity;
                    }
                    $cores[$formato['formato_id']][$papel['id']][$id['cor_id']]['pacote_id'] = $item;
                    $item = [];
                }
            }
        }
        return $cores;
    }

    /*
     * geração dos acabamentos
     */
    /****geração dos acabamentos *****/
    public function CatacabamentosEdit($id,CategoryDescription $category_description,Pacformato $pacformato,Pacpapel $pacpapel,Paccor $paccor,Pacacabamento $pacacabamento){
        $cat_name = $category_description->find($id)->categories_name;
        /*****formatos*********/
        $cat = $this->categoryModel->find($id);
        $cat_f = $cat->categoryFormato;
        if(empty($cat_f)){
            return redirect()->route('formatos.create');
        }
        //caso não tenha sido criado a categoria formato redireciona para a função que cria
        if(!$cat->categoryFormato->toArray()){
            return redirect()->route('categories.atributos',['id' =>$id]);
        }
        $list_pacotes = $cat->Pacotes->lists('quantity','id');
        $formato = [];
        $formato = $this->CheckFormato($id, $pacformato, $cat, $cat_f, $list_pacotes, $formato);
        /*****formatos*********/

        /*****papeis*********/
        if(!$cat->categoryPapel->toArray()){
            return redirect()->route('categories.atributos',['id' =>$id]);
        }
        $cat_p = $cat->categoryPapel;
        if(empty($cat_p)){
            return redirect()->route('papeis.create');
        }

        if($id == 5){
            $autoriza_p = $this->AutorizaAtributos($id, $cat_p,'papel');
        } else {
            foreach ($cat_p->toArray() as $value) {
                $autoriza[$value['papel_id']] = $cat_f->lists('id');
            }
            $autoriza_p[0] = $autoriza;
            $autoriza_p[1] = [];
        }
        $papel = [];
        $papel = $this->CheckPapel($id, $pacpapel, $cat, $list_pacotes, $autoriza_p, $cat_p, $papel);
        /*****papeis*********/

        /*****cores*********/
        if(!$cat->categoryCor->toArray()){
            return redirect()->route('categories.atributos',['id' =>$id]);
        }
        $cat_c = $cat->categoryCor;
        if(empty($cat_c)){
            return redirect()->route('cores.create');
        }

        $cores = [];
        $cores = $this->CheckCor($id, $paccor, $cat, $cat_f, $cat_p, $cat_c, $list_pacotes, $autoriza_p, $cores);
        /*****acabamentos****/
        //caso não tenha sido criado a categoria acabamento redireciona para a função que cria

        if(!$cat->categoryAcabamento->toArray()){
            return redirect()->route('categories.atributos',['id' =>$id]);
        }
        $acabamentos = $this->ArrayAcabamento($cat,$pacacabamento);
        $list_acabamentos = $this->acabamentoModel->all();
        $catformatos  = $cat->categoryFormato->lists('id','formato_id');
        $catpapeis = $cat->categoryPapel->lists('id','papel_id');
        $catcores = $cat->categorycor->lists('id','cor_id');
        //dd($acabamentos);
        $catacabamentos = $cat->categoryAcabamento->lists('id','acabamento_id');
        $formato_autorizado = $this->AutorizaAtributos($id, $cat_p, 'papel');
        $acabamento_autorizado = $this->AutorizaAtributos($id, $cat_p, 'acabamento');
        return view('diretoria.atributos.category_acabamento',compact('formato','papel','cores','acabamentos','list_acabamentos'))
            ->with('catformatos',$catformatos)
            ->with('catpapeis',$catpapeis)
            ->with('catcores',$catcores)
            ->with('catacabamentos',$catacabamentos)
            ->with('formato_autorizado',$formato_autorizado)
            ->with('acabamento_autorizado',$acabamento_autorizado)
            ->with('cat_name',$cat_name)
            ->with('cat_id',$id)
            ->with('page','atributos');
    }

    public function ArrayAcabamento($category,$pacAcabamento){

        $cat_a = $category->CategoryAcabamento;
        $Pac_Acabamento = $pacAcabamento
            ->where('category_id',$category->id)
            ->get()->groupby('category_acabamento_id')->toArray();
        if(count($Pac_Acabamento)>0){
            foreach($Pac_Acabamento as $category_acabamento_id => $collection){
                foreach($collection as $items) {
                    //cor
                    $paccor_id = $items->paccor_id;
                    $Paccor = Paccor::find($paccor_id);
                    $pacpapel_id = $Paccor->pacpapel_id;
                    $CategoryCor = $Paccor->CategoryCor;
                    $cor_id = $CategoryCor->cor_id;
                    //papel
                    $category_papel_id = Pacpapel::find($pacpapel_id)->category_papel_id;
                    $papel_id = $this->categoryPapel->find($category_papel_id)->papel_id;
                    //formato
                    $pacformato_id = Pacpapel::find($pacpapel_id)->pacformato_id;
                    $category_formato_id = Pacformato::find($pacformato_id)->category_formato_id;
                    $formato_id = $this->categoryFormato->find($category_formato_id)->formato_id;
                    //acabamento
                    $acabamento_id = $cat_a->find($category_acabamento_id)->acabamento_id;
                    $enobrecimento = $this->acabamentoModel->find($acabamento_id)->enoblecimento;
                    $acabamento_nome = $this->acabamentoModel->find($acabamento_id)->valor;
                    $acabamentos[$formato_id][$papel_id][$cor_id][$acabamento_id][$enobrecimento][$acabamento_nome][] = [
                        'pacacabamento_id' => $items->id,
                        'price' => $items->price,
                        'pacote_id' => $items->pacote_id
                    ];
                }
            }
            ksort($acabamentos);
            return $acabamentos;
        } else {
            $ArrayCreateAcabamento = $this->ArrayCreateAcabamento($category,$pacAcabamento);
            if($ArrayCreateAcabamento){
                $this->ArrayAcabamento($category,$pacAcabamento);
            }
            //
        }
    }
    public function ArrayCreateAcabamento($category,$pacAcabamento){
        //começa a criar as entradas

        $CategoryFormato = $category->CategoryFormato;
        $CategoryPapel = $category->CategoryPapel;
        $CategoryCor = $category->CategoryCor;
        $CategoryAcabamento = $category->CategoryAcabamento;
        $autoriza = $this->AutorizaAtributos($category->id, $CategoryPapel,  $tipo = 'papel');
        $autoriza_f = $autoriza[0];
        $autoriza = $this->AutorizaAtributos($category->id, $CategoryPapel,  $tipo = 'acabamento');
        $autoriza_a = $autoriza[0];
        ini_set('max_execution_time', 120);
        $create = '';
        foreach ($CategoryPapel->toArray() as $cat_P) {
            foreach ($CategoryFormato->toArray() as $cat_F) {
                //verifica se o formato é autorizado para o papel corrente
                if (in_array($cat_F['formato_id'], $autoriza_f[$cat_P['papel_id']])) {

                    //levanta dados do formato
                    $Formatos = $CategoryFormato->find($cat_F['id']);
                    $PacFormato_ID = $Formatos->PacFormatos()
                        ->where('category_formato_id', $cat_F['id'])->get()->first()->id;

                    //levanta dodos dos papeis
                    $Papeis = $CategoryPapel->find($cat_P['id']);
                    $PacPapel_ID = $Papeis->Pacpapeis()
                        ->where('category_papel_id', $cat_P['id'])
                        ->where('pacformato_id', $PacFormato_ID)->get()->first()->id;
                    foreach ($CategoryCor as $itemsCategoryCor) {
                        //$category_cor_id = $itemsCategoryCor->id;
                        $PacCor = $itemsCategoryCor->PacCor;
                        //dd($PacCor);
                        //dd($PacCor);
                        foreach ($PacCor as $itemsPacCor) {
                            foreach ($CategoryAcabamento as $itemsCategoryAcabamento) {
                                if (in_array($itemsCategoryAcabamento->acabamento_id, $autoriza_a[$cat_P['papel_id']])) {
                                    $row_pac = [
                                        'category_id' => $category->id,
                                        'paccor_id' => $itemsPacCor->id,
                                        'category_acabamento_id' => $itemsCategoryAcabamento->id,
                                        'pacote_id' => $itemsPacCor->pacote_id,
                                        'price' => 0.0000
                                    ];
                                    $create = $pacAcabamento->firstOrCreate($row_pac);
                                }
                            }
                        }
                    }
                }
            }
        }
        //dd($create);
        if($create){
            return $create;
        }

    }
        public function AutorizaAtributos($id, $cat_p,  $tipo = 'papel')
    {
        if ($id == 5) {
            if($tipo == 'papel') {
                //controla as formatos
                foreach ($cat_p->toArray() as $value) {
                    switch ($value['papel_id']) {
                        case 1 :
                            //$cat_f_autorizada
                            $autoriza[1] = [1, 2, 3, 4];
                            $n_autoriza[1] = [5];
                            break;
                        case 2 :
                            $autoriza[2] = [2, 4];
                            $n_autoriza[2] = [1, 3, 5];
                            break;
                        case 3 :
                            $autoriza[3] = [5];
                            $n_autoriza[3] = [1, 2, 3, 4];
                            break;
                    }
                }
            } else if($tipo == 'acabamento'){
                //controla as acabamentos
                foreach ($cat_p->toArray() as $papel) {
                    switch ($papel['papel_id']) {
                        case 1 :
                            $autoriza[1] = [2, 3, 4, 5, 6, 7, 8,9];
                            $n_autoriza[1] = [1];
                            break;
                        case 2 :
                            $autoriza[2] = [2, 6];
                            $n_autoriza[2] = [1, 3, 4, 5, 7, 8, 9];
                            break;
                        case 3 :
                            $autoriza[3] = [1, 5];
                            $n_autoriza[3] = [2,3,4,6,7,8,9];
                            break;
                    }
                }
            }
        } else {

            $acabamentos = $this->categoryAcabamento->where('category_id',$id)->get()->lists('acabamento_id');
            $formatos = $this->categoryFormato->where('category_id',$id)->get()->lists('formato_id');
            foreach ($cat_p->toArray() as $papel) {
                $autoriza_a[$papel['papel_id']] = $acabamentos;
                $autoriza_f[$papel['papel_id']] = $formatos;
            }
            if($tipo == 'papel') {
                return [$autoriza_f,[]];
            }else if ($tipo == 'acabamento'){
                return [$autoriza_a,[]];
            }
        }
        return [$autoriza,$n_autoriza];
    }
}