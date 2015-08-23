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
        //$this->middleware('auth');
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

    public function index(CategoryDescription $category_description) {
        $description = $category_description->all();
        $categories = $this->categoryModel->paginate(15);
        return view('diretoria.category.category')
            ->with(compact('categories'))
            ->with('description',$description)
            ->with('page','category');
    }
    public function Detalhes($id, CategoryDescription $category_description, Product $product) {
        $category = $this->categoryModel->find($id);
        $CategoryProduct = $category->CategoryProduct()->paginate(45);
        $this->MudaImage($id, $category_description, $product, $category);
        return view('diretoria.category.listprodutos')
            ->with('category',$category)
            ->with('CategoryProduct',$CategoryProduct)
            ->with('page','category');
    }
    public function Atributos($id){
        $cat = $this->categoryModel->find($id);
        //formatos
        $catformatos = $cat->CategoryFormato->lists('formato_id');
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

        //acabamentos
        $catacabamentos = $cat->CategoryAcabamento->lists('acabamento_id');
        $acabamentos = $this->acabamentoModel->all();

        //pacotes
        $catpacotes = $cat->Pacotes->lists('id');
        $pacotes = $this->pacoteModel->all();

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
                $extra='';
                break;
            case 9 :
                $prefixo = '.png';
                $diretorio = 'produtos/';
                $extra='medio';
                break;
            case 29 :
                $diretorio = 'produtos/cv-gratis/';
                $prefixo = '-gratis.png';
                $extra='';
                break;
            default :
                $diretorio = 'produtos/';
                $prefixo = '.png';
                $extra='';
                break;
        }
        $perfil = [];
        $info_category = $category_description->find($id)->toArray();
        $newimg = \URLAmigaveis::Slug($info_category['categories_name'].$extra, '-', true);
        $CP = $category->CategoryProduct()->lists('product_id');
        foreach ($CP as $produto) {
            $pf = ProdutoPerfil::where('product_id', $produto)->first()->Perfil;

            if (!is_null($pf)) {
                //$flag[$pf->id][$produto] = $pf->id;
                $perfil[$pf->id][] = [$produto, $newimg . '-' . \URLAmigaveis::Slug($pf->nome_perfil) . '-'];
            } else {
                $perfil['vazio'][] = [$produto, 'images/theme/naoencontrado.png'];
            }
        }

        foreach ($perfil as $perfil_id => $array_img) {
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
                        $product_img->update(['products_image' => $diretorio . $perfil[$perfil_id][$i][1] . $digito . $num . $prefixo]);
                    }
                }
            }
        }
    }

    /****geração dos formatos *****/
    public function CatformatosEdit($id,CategoryDescription $category_description, Pacformato $pacformato){
        /*****formatos*********/
        $list_formatos = $this->formatoModel->all();
        $cat = $this->categoryModel->find($id);

        $catformatos  = $cat->categoryFormato->lists('id','formato_id');
        $cat_f = $cat->categoryFormato;
        if(empty($cat_f)){
            return redirect()->route('formatos.create');
        }
        if(!$cat->categoryFormato->toArray()){
            return redirect()->route('categories.atributos',['id' =>$id]);
        }
        $list_pacotes = $cat->Pacotes->lists('quantity','id');

        $cat_name = $category_description->find($id)->categories_name;
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

        $check_categoryFormato = $cat->categoryFormato()->where('category_id', $id)->first()->PacFormatos()->get()->toArray();

        if (count($check_categoryFormato) == 0) {
            //chama a função
            $array_f = $this->ArrayFormatoCreate($cat, $cat_f, $pacformato, $list_pacotes);
        } else {
            $array_f = $this->ArrayFormato($cat);
        }
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
    public function ArrayFormatoCreate($category,$cat_f,$pacFormato,$pacote)
    {

        foreach ($cat_f->toArray() as $key => $id) {
            foreach ($pacote as $pacote_id => $quantity) {
                $formatos[$id['id']] = [
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
    }
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
    public function CatpapeisEdit($id,
                                  CategoryDescription $category_description,
                                  Pacformato $pacformato,
                                  Pacpapel $pacpapel){
        /*****formatos*********/
        $cat = $this->categoryModel->find($id);
        $cat_f = $cat->categoryFormato;
        $list_pacotes = $cat->Pacotes->lists('quantity','id');
        if(empty($cat_f)){
            return redirect()->route('formatos.create');
        }
        if(!$cat->categoryFormato->toArray()){
            return redirect()->route('categories.atributos',['id' =>$id]);
        }
        $formato = [];
        $formato = $this->CheckFormato($id, $pacformato, $cat, $cat_f, $list_pacotes, $formato);
        /*****formatos*********/

        /*****papeis*********/
        $cat_p = $cat->categoryPapel;
        $catpapeis = $cat->categoryPapel->lists('id','papel_id');
        if(empty($catpapeis)){
            return redirect()->route('papeis.create');
        }
        if(!$cat->categoryPapel->toArray()){
            return redirect()->route('categories.atributos',['id' =>$id]);
        }
        $cat_name = $category_description->find($id)->categories_name;
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
        $papel = $this->CheckPapel($id, $pacformato, $pacpapel, $cat, $list_pacotes, $autoriza_p, $cat_p, $papel);

        $list_papeis = $this->papelModel->all();
        /*****papeis*********/


        return view('diretoria.atributos.category_papel',compact('formato', 'papel','list_papeis'))
            ->with('catpapeis',$catpapeis)
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
    public function CheckPapel($id, Pacformato $pacformato, Pacpapel $pacpapel, $cat, $list_pacotes, $autoriza_p, $cat_p, $papel)
    {
        $check_categoryPapel = $cat->categoryPapel()->where('category_id', $id)->first()->PacPapeis()->get()->toArray();
        if (count($check_categoryPapel) == 0) {
            //chama função
            $array_p = $this->ArrayPapelCreate($cat, $list_pacotes, $pacpapel, $autoriza_p[0]);
        } else {
            $array_p = $this->ArrayPapel($cat, $cat_p, $list_pacotes, $pacformato, $pacpapel, $autoriza_p[1]);
        }

        foreach ($array_p as $formato_id=>$items) {
            foreach ($cat_p as $item_p) {
                if(in_array($item_p->papel_id,array_keys($items))){
                    $papel[$formato_id][$item_p->papel_id] = [
                        'papel_id' => $item_p->papel_id,
                        'papel_nome' => $this->papelModel->find($item_p->papel_id)->valor,
                        'pacotes' => $items[$item_p->papel_id]
                    ];
                }
            }
            // $papel[$formato_id]['pacotes'] = $items;
        }

        return $papel;
    }

    public function ArrayPapel($category,$cat_p,$pacote,$pacFormato, $pacPapel,$n_autoriza)
    {
        $cat_papeis =  $cat_p->lists('papel_id','id');
        foreach($cat_papeis as $category_papel_id => $papel_id){
            $response = $pacPapel->where('category_id',$category->id)
                ->where('category_papel_id', $category_papel_id)->get()->groupby('pacformato_id')->toArray();
echo $category_papel_id. ' - '.$papel_id. '<br>';
            if(count($response)>0){
                foreach ($response as $pacformato_id => $valores) {

                    foreach($valores as $items){
                        //$formato_id = '';
                        if(!in_array($cat_papeis[$items->category_papel_id],$n_autoriza)){
                            $category_formato = $pacFormato->find($pacformato_id);
                            $formato_id = $category_formato->CategoryFormato->formato_id;
                            $papeis[$cat_papeis[$items->category_papel_id]] = [
                                'category_id' => $category->id,
                                'pacformato_id' => $pacformato_id,
                                'category_papel_id' => $items->category_papel_id
                            ];
                            $quantity[$items->pacote_id] = $pacote[$items->pacote_id];
                            $weights[$cat_papeis[$items->category_papel_id]][$items->id] = $items->weight;
                            $papeis[$cat_papeis[$items->category_papel_id]]['weight'] = $weights[$cat_papeis[$items->category_papel_id]];
                            $papeis[$cat_papeis[$items->category_papel_id]]['pacote_id'] = $quantity;
                        }
                    }
                    if($formato_id !=''){
                        $papel[$formato_id] = $papeis;

                        $weights=[];
                    }
                }
            }
        }
dd($papel);
        return $papel;
    }
    /*
     * ****geração dos papeis *****
    */

    /*
     * *****geração das cores ****
     */
    public function CatcoresEdit($id,CategoryDescription $category_description,Pacformato $pacformato,Pacpapel $pacpapel, Paccor $paccor){
        /*****formatos*********/
        $cat = $this->categoryModel->find($id);
        $cat_f = $cat->categoryFormato;
        $list_pacotes = $cat->Pacotes->lists('quantity','id');
        if(empty($cat_f)){
            return redirect()->route('formatos.create');
        }
        $formato = [];
        $formato = $this->CheckFormato($id, $pacformato, $cat, $cat_f, $list_pacotes, $formato);
        /*****formatos*********/

        /*****papeis*********/
        $cat_p = $cat->categoryPapel;
        $catpapeis = $cat->categoryPapel->lists('id','papel_id');
        if(empty($catpapeis)){
            return redirect()->route('papeis.create');
        }
        $cat_name = $category_description->find($id)->categories_name;
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
        $papel = $this->CheckPapel($id, $pacformato, $pacpapel, $cat, $list_pacotes, $autoriza_p, $cat_p, $papel);
        /*****papeis*********/

        /*****cores*********/
        $cat_c = $cat->categoryCor;
        $catcores = $cat->categoryCor->lists('id','cor_id');
        if(empty($catcores)){
            return redirect()->route('cores.create');
        }
        $cores = [];
        $cores = $this->CheckCor($id, $paccor, $cat, $cat_f, $cat_p, $cat_c, $list_pacotes, $autoriza_p, $cores);
        $list_cores = $this->corModel->all();

        return view('diretoria.atributos.category_cor',compact('formato','papel','cores','list_cores'))
            ->with('catcores',$catcores)
            ->with('cat_name',$cat_name)
            ->with('cat_id',$id)
            ->with('page','atributos');
    }

    /*
     * geração dos acabamentos
     */
    /****geração dos acabamentos *****/
    public function CatacabamentosEdit($id,CategoryDescription $category_description,Pacformato $pacformato,Pacpapel $pacpapel,Paccor $paccor,Pacacabamento $pacacabamento){
        /*****formatos*********/
        $cat = $this->categoryModel->find($id);
        $cat_f = $cat->categoryFormato;
        $list_pacotes = $cat->Pacotes->lists('quantity','id');
        if(empty($cat_f)){
            return redirect()->route('formatos.create');
        }
        $formato = [];
        $formato = $this->CheckFormato($id, $pacformato, $cat, $cat_f, $list_pacotes, $formato);
        /*****formatos*********/

        /*****papeis*********/
        $cat_p = $cat->categoryPapel;
        $catpapeis = $cat->categoryPapel->lists('id','papel_id');
        if(empty($catpapeis)){
            return redirect()->route('papeis.create');
        }
        $cat_name = $category_description->find($id)->categories_name;
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
        $papel = $this->CheckPapel($id, $pacformato, $pacpapel, $cat, $list_pacotes, $autoriza_p, $cat_p, $papel);
        /*****papeis*********/

        /*****cores*********/
        $cat_c = $cat->categoryCor;
        $catcores = $cat->categoryCor->lists('id','cor_id');
        if(empty($catcores)){
            return redirect()->route('cores.create');
        }
        $cores = [];
        $cores = $this->CheckCor($id, $paccor, $cat, $cat_f, $cat_p, $cat_c, $list_pacotes, $autoriza_p, $cores);

        /*****acabamentos****/
        if($id == 5){
            $autoriza_a = $this->AutorizaAtributos($id, $cat_p,'acabamento');
        } else {
            foreach ($cat_p->toArray() as $value) {
                $autoriza[$value['papel_id']] = $cat_f->lists('id');
            }
            $autoriza_a[0] = $autoriza;
            $autoriza_f[1] = [];
        }
        $check_categoryAcabamento = $cat->categoryAcabamento()->where('category_id',$id)->first()->PacAcabamentos()->get()->toArray();
        if(count( $check_categoryAcabamento )==0){
            //chama função
            $acabamentos = $this->ArrayAcabamentoCreate($cat,$pacacabamento,$autoriza_f[0],$autoriza_a[0]);
        }else {
            $acabamentos = $this->ArrayAcabamento($cat,$pacacabamento);
        }

        //dd($acabamentos);
        $list_acabamentos = $this->acabamentoModel->all();
        $catacabamentos = $cat->categoryAcabamento->lists('id','acabamento_id');
        return view('diretoria.atributos.category_acabamento',compact('formato','papel','cores','acabamentos','list_acabamentos'))
            ->with('catacabamentos',$catacabamentos)
            ->with('cat_name',$cat_name)
            ->with('cat_id',$id)
            ->with('page','atributos');
    }

    public function ArrayAcabamento($category,$pacAcabamento){
        $cat_a = $category->CategoryAcabamento;
        $Pac_Acabamento = $pacAcabamento->where('category_id',$category->id)->get()->groupby('category_acabamento_id')->toArray();
        foreach($Pac_Acabamento as $category_acabamento_id => $collection){
            $acabamento_id = $cat_a->find($category_acabamento_id)->acabamento_id;
            $acabamento_nome = $this->acabamentoModel->find($acabamento_id)->valor;
            foreach($collection as $items){
                $item = $items->toArray();
                //cor
                $paccor_id = $item['paccor_id'];
                $category_cor_id = Paccor::find($paccor_id)->category_cor_id;
                $cor_id = $this->categoryCor->find($category_cor_id)->cor_id;
                //papel
                $pacpapel_id= Paccor::find($paccor_id)->pacpapel_id;
                $category_papel_id = Pacpapel::find($pacpapel_id)->category_papel_id;
                $papel_id = $this->categoryPapel->find($category_papel_id)->papel_id;
                //formato
                $pacformato_id =  Pacpapel::find($pacpapel_id)->pacformato_id;
                $category_formato_id = Pacformato::find($pacformato_id)->category_formato_id;
                $formato_id = $this->categoryFormato->find($category_formato_id)->formato_id;
                $acabamentos[$formato_id][$papel_id][$cor_id][$acabamento_id][$acabamento_nome][]= [
                    'pacacabamento_id' => $item['id'],
                    'price' => $item['price'],
                    'pacote_id' => $item['pacote_id']

                ];
            }
        }
        return $acabamentos;
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
        $check_categoryCor = $cat->categoryCor()->where('category_id', $id)->first()->PacCor()->get()->toArray();
        if (count($check_categoryCor) == 0) {
            //chama função
            $array_c = $this->ArrayCorCreate($cat, $cat_f, $cat_p, $cat_c, $list_pacotes, $paccor, $autoriza_p[0]);
        } else {
            $array_c = $this->ArrayCor($cat, $cat_f, $cat_p, $cat_c, $list_pacotes,$paccor);
        }

        foreach ($cat_c as $item_c) {
            $cores[$item_c->id] = [
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
        }
        return [$autoriza,$n_autoriza];
    }
}