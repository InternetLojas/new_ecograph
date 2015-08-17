<?php namespace Ecograph\Http\Controllers;

use Ecograph\Acabamento;
use Ecograph\Category;
use Ecograph\CategoryAcabamento;
use Ecograph\CategoryCor;
use Ecograph\CategoryDescription;
use Ecograph\CategoryFormato;
use Ecograph\CategoryPapel;
use Ecograph\CategoryProduct;
use Ecograph\Cor;
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
    private $categoryAcabamento;
    private $formatoModel;
    private $papelModel;
    private $corModel;
    private $acabamentoModel;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Category $categoryModel,
                                CategoryFormato $categoryFormato,
                                CategoryPapel $categoryPapel,
                                CategoryCor $categoryCor,
                                CategoryAcabamento $categoryAcabamento,
                                Formato $formatoModel,
                                Papel $papelModel,
                                Cor $corModel,
                                Acabamento $acabamentoModel){
        //$this->middleware('auth');
        $this->categoryModel = $categoryModel;
        $this->categoryFormato = $categoryFormato;
        $this->categoryPapel = $categoryPapel;
        $this->categoryCor = $categoryCor;
        $this->categoryAcabamento = $categoryAcabamento;
        $this->formatoModel = $formatoModel;
        $this->papelModel = $papelModel;
        $this->corModel = $corModel;
        $this->acabamentoModel = $acabamentoModel;
    }

    public function index(CategoryDescription $category_description) {
        $description = $category_description->all();
        $categories = $this->categoryModel->paginate(15);
        return view('diretoria.category.category')
            ->with(compact('categories'))
            ->with('description',$description)
            ->with('page','category');
    }
    public function Detalhes($id, CategoryDescription $category_description, Product $product_id) {
        $category = $this->categoryModel->find($id);
        $this->MudaImage($id, $category_description, $product_id, $category);
        $CategoryProduct = $category->CategoryProduct()->paginate(45);
        return view('diretoria.category.listprodutos')
            ->with('category',$category)
            ->with('CategoryProduct',$CategoryProduct)
            ->with('page','category');
    }

    /**
     * @param $id
     * @param CategoryDescription $category_description
     * @param Product $product_id
     * @param $category
     */
    public function MudaImage($id, CategoryDescription $category_description, Product $product_id, $category)
    {
        $perfil = [];
        $info_category = $category_description->find($id)->toArray();
        $newimg = \URLAmigaveis::Slug($info_category['categories_name'], '-', true);
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
                        $product_img->update(['products_image' => 'produtos/' . $perfil[$perfil_id][$i][1] . $digito . $num . '-frente.png']);
                    }
                }
            }
        }
    }

    public function atributos($id){
        $cat = $this->categoryModel->find($id);
        //formatos
        $catformatos = $cat->CategoryFormato->lists('id');
        $formatos = $this->formatoModel->all();

        //papeis
        $catpapeis = $cat->CategoryPapel->lists('id');
        $papeis = $this->papelModel->all();

        //cores
        $catcores = $cat->CategoryCor->lists('id');
        $cores = $this->corModel->all();

        //acabamentos
        $catacabamentos = $cat->CategoryAcabamento->lists('id');
        $acabamentos = $this->acabamentoModel->all();

        return view('diretoria.atributos.category_atributos')
            ->with(compact('formatos', 'papeis', 'cores', 'acabamentos'))
            ->with('catformatos',$catformatos)
            ->with('catpapeis',$catpapeis)
            ->with('catcores',$catcores)
            ->with('catacabamentos',$catacabamentos)
            ->with('cat',$cat)
            ->with('page','atributos');
    }

    /*public function pacotes($id,Pacote $pacote){
        $cat = $this->categoryModel->find($id);
        //formatos
        $quantity = $pacote->lists('quantity','id');
        $catformatos = $cat->CategoryFormato;

        foreach($catformatos as $collection){
            $formato_id = $collection->formato_id;
            foreach($collection->Pacformatos as $itemformatos){
                $formato = $this->formatoModel->find($formato_id)->valor;
                $pacote_id = $itemformatos->pacote_id;

                foreach($itemformatos->Pacpapeis as $itempapeis){
                    $category_papel_id = $itempapeis->category_papel_id;
                    $category_papel = $this->papelModel->find($category_papel_id)->valor;
                    $conf_papel[$category_papel_id][$category_papel] = [
                        'weight' => $itempapeis->weight
                    ];
                }
                $conf_formato[$pacote_id]= $conf_papel;
            }
            $pacotes[$formato_id][$formato] = $conf_formato;
        }
        //exit;
        dd($pacotes);

        return view('diretoria.pacotes.category_pacotes',compact('catformatos'))
            ->with('cat',$cat)
            ->with('pacotes',$pacotes)
            ->with('page','pacotes');
    }*/
    public function edit($id, CategoryDescription $category_description) {
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
    /*public function ListaAtributos($cat,$pacote)
    {
        $catFormato_id = $cat->CategoryFormato->lists('formato_id','id');
        $catPapeis_id = $cat->CategoryPapel->lists('papel_id','id');
        $catAcabamentos_id = $cat->CategoryAcabamento->lists('acabamento_id','id');
        foreach ($catFormato_id as $category_formato_id => $formato) {
            $list_formato[$category_formato_id][] = [
                'formato_id' => $formato,
                'formato_nome' => $this->formatoModel->find($formato)->valor
            ];
            $conf_formato['formato'] = $list_formato;
            $conf_formato['pacote'] = $pacote;
            $collection_f[$formato] = $this->categoryFormato->find($category_formato_id)->Pacformatos;
            foreach ($collection_f[$formato] as $items) {
                //$qtd = $pacote->find($items->pacote_id)->quantity;
                $weight[$formato][] = $items->Pacpapeis;
            }
            //dd($collection_f);
            foreach ($catPapeis_id as $category_papel_id => $papel) {
                $list_papel[$category_formato_id][$category_papel_id][] = [
                    'papel_id' => $papel,
                    'papel_nome' => $this->papelModel->find($papel)->valor
                ];
                $pacote_f[] = $collection_f[$f];
                $f++;
                $conf_papel['papel']= $list_papel;
                foreach ($catAcabamentos_id as $category_acabamento_id => $acabamento) {
                    $list_acabamento[$category_formato_id][$category_papel_id][$category_acabamento_id][] = [
                        'acabamento_id' => $acabamento,
                        'acabamento_nome' => $this->acabamentoModel->find($acabamento)->valor
                    ];
                    $conf_acabamento['acabamento']= $list_acabamento;
                }
            }
            $conf_papel['pacote'] = $pacote_f;
            $pacote_f = [];
        }
    }*/

    /****geração dos formatos *****/
    public function CatformatosEdit($id,CategoryDescription $category_description, Pacformato $pacformato){
        /*****formatos*********/
        $cat = $this->categoryModel->find($id);
        $catformatos = $cat->categoryFormato->lists('id','formato_id');
        $cat_f = $cat->categoryFormato;
        if(empty($cat_f)){
            return redirect()->route('formatos.create');
        }
        $list_pacotes = $cat->Pacotes->lists('quantity','id');
        $cat_name = $category_description->find($id)->categories_name;

        $formato = [];
        if(count($cat->categoryFormato->find($id)->first()->PacFormatos->toArray())==0){
            //chama a função
            $array_f = $this->ArrayFormatoCreate($cat,$cat_f,$pacformato,$list_pacotes);
        }else {
            $array_f = $this->ArrayFormato($cat,$cat_f,$pacformato,$list_pacotes);
        }

        foreach($cat_f as $item_f){
            $formato[$item_f->id] = [
                'formato_id' => $item_f->id,
                'formato_nome' => $this->formatoModel->find($item_f->id)->valor,
                'pacotes' => $array_f
            ];
        }
        /*****formatos*********/
        return view('diretoria.atributos.category_formato',compact('formato','list_formatos'))
            ->with('catformatos',$catformatos)
            ->with('pacotes',$list_pacotes)
            ->with('cat_name',$cat_name)
            ->with('cat_id',$id)
            ->with('page','atributos');
    }
    public function ArrayFormatoCreate($category,$cat_f,$pacFormato,$pacote)
    {
        //dd($pacote);
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
    public function ArrayFormato($category,$cat_f,$pacFormato,$pacote)
    {
        foreach ($cat_f->toArray() as $key => $id) {
            foreach ($pacote as $pacote_id => $quantity) {
                $formatos[$id['id']] = [
                    'category_id' => $category->id,
                    'category_formato_id' => $id['id']
                ];
                $item[$pacote_id] =  $quantity;
            }
            $formatos[$id['id']]['pacote_id'] = $item;
            $item = [];
        }
        return $formatos;
    }

    /****geração dos papeis *****/
    public function CatpapeisEdit($id,
                                  CategoryDescription $category_description,
                                  Pacformato $pacformato,
                                  Pacpapel $pacpapel){

        $cat = $this->categoryModel->find($id);
        $list_pacotes = $cat->Pacotes->lists('quantity','id');
        $cat_name = $category_description->find($id)->categories_name;

        /*****formatos*****/
        $cat_f = $cat->categoryFormato;
        if(empty($cat_f)){
            return redirect()->route('formatos.create');
        }
        $formato = [];
        if(count($cat->categoryFormato()->where('category_id',$id)->first()->PacFormatos->toArray())==0){
            //chama a função
            $array_f = $this->ArrayFormatoCreate($cat,$cat_f,$pacformato,$list_pacotes);
        }else {
            $array_f = $this->ArrayFormato($cat,$cat_f,$pacformato,$list_pacotes);
        }
        foreach($cat_f as $item_f){
            $formato[$item_f->id] = [
                'formato_id' => $item_f->id,
                'formato_nome' => $this->formatoModel->find($item_f->id)->valor,
                'pacotes' => $array_f
            ];
        }
        /*****formatos*********/

        $catpapeis = $cat->categoryPapel->lists('id','papel_id');
        if(empty($catpapeis)){
            return redirect()->route('papeis.create');
        }
        //papeis
        $papel= [];
        $cat_p = $cat->categoryPapel;
        $autoriza_p = $this->AutorizaAtributos($id, $cat_p,'papel');
        if(count($cat->categoryPapel()->where('category_id',$id)->first()->PacPapeis->toArray())==0){
            //chama função
            $array_p = $this->ArrayPapelCreate($cat,$list_pacotes,$pacpapel,$autoriza_p[0]);
        }else {
            $array_p = $this->ArrayPapel($cat,$cat_p,$list_pacotes,$pacformato,$pacpapel, $autoriza_p[1]);
        }
        foreach($cat_p as $item_p){
            $papel[$item_p->id] = [
                'papel_id' => $item_p->id,
                'papel_nome' => $this->papelModel->find($item_p->id)->valor,
                'pacotes' => $array_p
            ];
        }
        //dd($papel);
        $list_papeis = $this->papelModel->all();
        return view('diretoria.atributos.category_papel',compact('formato', 'papel','list_papeis'))
            ->with('catpapeis',$catpapeis)
            ->with('cat_name',$cat_name)
            ->with('cat_id',$id)
            ->with('page','atributos');
    }

    public function ArrayPapelCreate($category,$pacote,$pacPapel,$autoriza)
    {
        $cat_f = $category->CategoryFormato;
        $cat_p = $category->CategoryPapel;

        foreach ($cat_p->toArray() as $key => $papel) {
            foreach ($cat_f->toArray() as $formato) {
                if (in_array($formato['formato_id'], $autoriza[$papel['papel_id']])) {
                    $pacF_id = $cat_f->find($formato['id'])->PacFormatos()->first()->id;
                    foreach ($pacote as $pacote_id => $quantity) {
                        $papeis[$formato['formato_id']][$papel['papel_id']] = [
                            'category_id' => $category->id,
                            'pacformato_id' => $pacF_id,
                            'category_papel_id' => $papel['id']
                        ];
                        $item[$pacote_id] = $quantity;
                        $pacPapel->firstOrCreate([
                            'category_id' => $category->id,
                            'pacformato_id' => $pacF_id,
                            'category_papel_id' => $papel['id'],
                            'pacote_id' => $pacote_id,
                            'weight' => 0
                        ]);
                        $weights[$pacote_id] = 0;
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

        //dd($papeis);
        return $papeis;
    }
    public function ArrayPapel($category,$cat_p,$pacote,$pacFormato, $pacPapel,$n_autoriza)
    {
        $cat_papeis =  $cat_p->lists('papel_id','id');
        $response = $pacPapel->where('category_id',$category->id)->get()->groupby('pacformato_id')->toArray();
        //dd($response);
        foreach($response as $pacFormatoId => $pacotes){
            $category_formato_id = $pacFormato->find($pacFormatoId);
            $formato_id = $category_formato_id->CategoryFormato->formato_id;
            foreach ($pacotes as $key => $item) {
                $papeis[$formato_id][$cat_papeis[$item->category_papel_id]] = [
                    'category_id' => $category->id,
                    'pacformato_id' => $item->pacformato_id,
                    'category_papel_id' => $item->category_papel_id
                ];
                $quantity[$item->pacote_id] = $pacote[$item->pacote_id];
                $weights[$formato_id][$cat_papeis[$item->category_papel_id]][$item->id] = $item->weight;
                $papeis[$formato_id][$cat_papeis[$item->category_papel_id]]['weight'] = $weights[$formato_id][$cat_papeis[$item->category_papel_id]];
                //$weights = [];
                $papeis[$formato_id][$cat_papeis[$item->category_papel_id]]['pacote_id'] = $quantity;
                foreach ($n_autoriza[$cat_papeis[$item->category_papel_id]] as $k => $value) {
                    $papeis[$value][$cat_papeis[$item->category_papel_id]] = 'empty';
                }
            }
            $weights = [];
        }
        //dd($papeis);
        return $papeis;
    }
    /****geração das cores *****/
    public function CatcoresEdit($id,CategoryDescription $category_description,Pacformato $pacformato,Pacpapel $pacpapel, Paccor $paccor){
        $cat = $this->categoryModel->find($id);
        $catformatos = $cat->categoryFormato->lists('id','formato_id');
        //exit;
        if(empty($catformatos)){
            return redirect()->route('formatos.create');
        }
        $list_pacotes = $cat->Pacotes->lists('quantity','id');
        $cat_name = $category_description->find($id)->categories_name;
        $cat_f = $this->categoryFormato->where('category_id',$id)->get();

        $formato = [];
        if(count($this->categoryFormato->where('category_id',$id)->first()->PacFormatos->toArray())==0){
            //chama a função
            $array_f = $this->ArrayFormatoCreate($cat,$cat_f,$pacformato,$list_pacotes);
        }else {
            $array_f = $this->ArrayFormato($cat,$cat_f,$pacformato,$list_pacotes);
        }
        foreach($cat_f as $item_f){
            $formato[$item_f->id] = [
                'formato_id' => $item_f->id,
                'formato_nome' => $this->formatoModel->find($item_f->id)->valor,
                'pacotes' => $array_f
            ];
        }
        $list_pacotes = $cat->Pacotes->lists('quantity','id');
        $catpapeis = $cat->categoryPapel->lists('id','papel_id');
        if(empty($catpapeis)){
            return redirect()->route('papeis.create');
        }
        //papeis
        $papel= [];
        $cat_p = $this->categoryPapel->where('category_id',$id)->get();
        $autoriza_p = $this->AutorizaAtributos($id, $cat_p,'papel');
        if(count($this->categoryPapel->where('category_id',$id)->first()->PacPapeis->toArray())==0){
            //chama função
            $array_p = $this->ArrayPapelCreate($cat,$cat_f,$cat_p,$list_pacotes,$pacpapel,$autoriza_p[0]);
        }else {
            $array_p = $this->ArrayPapel($cat,$cat_p,$list_pacotes,$pacformato,$pacpapel, $autoriza_p[1]);
        }
        foreach($cat_p as $item_p){
            $papel[$item_p->id] = [
                'papel_id' => $item_p->id,
                'papel_nome' => $this->papelModel->find($item_p->id)->valor,
                'pacotes' => $array_p
            ];
        }
        //cores
        $cores = [];
        $cat_c = $this->categoryCor->where('category_id',$id)->get();
        if(count($this->categoryCor->where('category_id',$id)->first()->PacCor->toArray())==0){
            //chama função
            $array_c = $this->ArrayCorCreate($cat,$cat_f,$cat_p,$cat_c,$list_pacotes,$paccor,$autoriza_p[0]);
        }else {
            $array_c = $this->ArrayCor($cat,$cat_f,$cat_p,$cat_c,$list_pacotes);
        }
        foreach($cat_c as $item_c){
            $cores[$item_c->id] = [
                'cor_id' => $item_c->id,
                'cor_nome' => $this->corModel->find($item_c->id)->valor,
                'pacotes' => $array_c
            ];
        }
        $catcores = $cat->categoryCor->lists('id','cor_id');
        $list_cores = $this->corModel->all();
        return view('diretoria.atributos.category_cor',compact('formato','papel','cores','list_cores'))
            ->with('catcores',$catcores)
            ->with('cat_name',$cat_name)
            ->with('cat_id',$id)
            ->with('page','atributos');
    }

    public function ArrayCorCreate($category,$cat_f,$cat_p,$cat_c,$pacote,$pacCor,$autoriza){
        $cat_f = $category->CategoryFormato;
        $cat_p = $category->CategoryPapel;
        //foreach ($pacote as $pacote_id => $quantity) {
        //    $item[$pacote_id] = $quantity;
       // }
        foreach ($cat_p->toArray() as $key => $papel) {

                foreach ($cat_f->toArray() as $formato) {

                    if (in_array($formato['formato_id'], $autoriza[$papel['papel_id']])) {
                        //echo $formato['formato_id'];exit;
                        $categoryPapel = $category->CategoryPapel->find($papel['id']);
                        //dd($categoryPapel);
                        $pacPapel = $categoryPapel->PacPapeis()->get();
                        foreach ($pacPapel as $items) {
                            //dd($items);
                            foreach ($cat_c->toArray() as $key => $id) {
                                //foreach ($pacote as $pacote_id => $quantity) {
                                $cores[$formato['formato_id']][$papel['id']][$id['id']] = [
                                    'category_id' => $category->id,
                                    'pacpapel_id' => $items->id,
                                    'pacote_id' => $items->pacote_id,
                                    'category_cor_id' => $id['id']
                                ];

                                $pacCor->firstOrCreate([
                                    'category_id' => $category->id,
                                    'pacpapel_id' => $items->id,
                                    'category_cor_id' => $id['id'],
                                    'pacote_id' => $items->pacote_id
                                ]);
                                //}
                                $cores[$formato['formato_id']][$papel['id']][$id['id']]['pacote_id'] = $pacote;

                            }
                        };


                    } else {
                        //$categoryPapel = $category->CategoryPapel->find($papel['id']);
                        // $pacPapelId = $categoryPapel->PacPapeis()->first()->id;
                        foreach ($cat_c->toArray() as $key => $id) {
                            foreach ($pacote as $pacote_id => $quantity) {
                                $cores[$formato['formato_id']][$papel['id']][$id['id']] = [
                                    'category_id' => '',
                                    'pacpapel_id' => '',
                                    'category_cor_id' => ''
                                ];
                                //$item[$pacote_id] =  $quantity;
                            }
                            $cores[$formato['formato_id']][$papel['id']][$id['id']]['pacote_id'] = 'empty';
                            // $item = [];
                        }
                    }
                }
            }

        //dd($cores);
        return $cores;
    }
    public function ArrayCor($category,$cat_f,$cat_p,$cat_c,$pacote){
        foreach($cat_f->toArray() as $formato){
            foreach ($cat_p->toArray() as $papel) {
                foreach($cat_c->toArray() as $key => $id){
                    foreach ($pacote as $pacote_id => $quantity) {
                        $cores[$formato['formato_id']][$papel['id']][$id['id']] = [
                            'category_id' => $category->id,
                            'pacpapel_id' => $papel['id'],
                            'category_cor_id' => $id['id']
                        ];
                        $item[$pacote_id] =  $quantity;
                    }
                    $cores[$formato['formato_id']][$papel['id']][$id['id']]['pacote_id'] = $item;
                    $item = [];
                }
            }
        }
        return $cores;
    }
    /****geração dos acabamentos *****/
    public function CatacabamentosEdit($id,CategoryDescription $category_description,Pacformato $pacformato,Pacpapel $pacpapel,Paccor $paccor,Pacacabamento $pacacabamento){
        //$list_formatos = $this->formatoModel->all();
        $cat = $this->categoryModel->find($id);
        $catformatos = $cat->categoryFormato->lists('id','formato_id');
        //exit;
        if(empty($catformatos)){
            return redirect()->route('formatos.create');
        }
        $list_pacotes = $cat->Pacotes->lists('quantity','id');
        $cat_name = $category_description->find($id)->categories_name;
        $cat_f = $this->categoryFormato->where('category_id',$id)->get();

        $formato = [];
        if(count($this->categoryFormato->where('category_id',$id)->first()->PacFormatos->toArray())==0){
            //chama a função
            $array_f = $this->ArrayFormatoCreate($cat,$cat_f,$pacformato,$list_pacotes);
        }else {
            $array_f = $this->ArrayFormato($cat,$cat_f,$pacformato,$list_pacotes);
        }
        foreach($cat_f as $item_f){
            $formato[$item_f->id] = [
                'formato_id' => $item_f->id,
                'formato_nome' => $this->formatoModel->find($item_f->id)->valor,
                'pacotes' => $array_f
            ];
        }
        $list_pacotes = $cat->Pacotes->lists('quantity','id');
        $catpapeis = $cat->categoryPapel->lists('id','papel_id');
        if(empty($catpapeis)){
            return redirect()->route('papeis.create');
        }
        //papeis
        $papel= [];
        $cat_p = $this->categoryPapel->where('category_id',$id)->get();
        $autoriza_f = $this->AutorizaAtributos($id, $cat_p,'papel');
        if(count($this->categoryPapel->where('category_id',$id)->first()->PacPapeis->toArray())==0){
            //chama função
            $array_p = $this->ArrayPapelCreate($cat,$cat_f,$cat_p,$list_pacotes,$pacpapel,$autoriza_f[0]);
        }else {
            $array_p = $this->ArrayPapel($cat,$cat_p,$list_pacotes,$pacformato,$pacpapel, $autoriza_f[1]);
        }
        foreach($cat_p as $item_p){
            $papel[$item_p->id] = [
                'papel_id' => $item_p->id,
                'papel_nome' => $this->papelModel->find($item_p->id)->valor,
                'pacotes' => $array_p
            ];
        }
        //dd($papel);
        //cores
        $cores = [];
        $cat_c = $this->categoryCor->where('category_id',$id)->get();
        if(count($this->categoryCor->where('category_id',$id)->first()->PacCor->toArray())==0){
            //chama função
            $array_c = $this->ArrayCorCreate($cat,$cat_f,$cat_p,$cat_c,$list_pacotes,$paccor);
        }else {
            $array_c = $this->ArrayCor($cat,$cat_f,$cat_p,$cat_c,$list_pacotes);
        }
        foreach($cat_c as $item_c){
            $cores[$item_c->id] = [
                'cor_id' => $item_c->id,
                'cor_nome' => $this->corModel->find($item_c->id)->valor,
                'pacotes' => $array_c
            ];
        }
        $autoriza_a = $this->AutorizaAtributos($id, $cat_p,'acabamento');

        if(count($pacacabamento->where('category_id',$id)->get()->toArray())==0){
            //chama função
             $acabamentos = $this->ArrayAcabamentoCreate($cat,$pacacabamento,$autoriza_f[0],$autoriza_a[0]);
        }else {
            //exit;
            $acabamentos = $this->ArrayAcabamento($cat,$pacacabamento);
        }

        /*foreach($cat_a as $item_a){
            $acabamentos[$item_a->id] = [
                'acabamento_id' => $item_a->id,
                'acabamento_nome' => $this->acabamentoModel->find($item_a->id)->valor,
                'pacotes' => $array_a
            ];
        }*/
        //dd($acabamentos);
        $catacabamentos = $cat->categoryAcabamento->lists('id','acabamento_id');
        $list_acabamentos = $this->acabamentoModel->all();
        return view('diretoria.atributos.category_acabamento',compact('formato','papel','cores','acabamentos','list_acabamentos'))
            ->with('catacabamentos',$catacabamentos)
            ->with('cat_name',$cat_name)
            ->with('autoriza_f',$autoriza_f[0])
            ->with('autoriza_a',$autoriza_a[0])
            ->with('cat_id',$id)
            ->with('page','atributos');
    }

    public function ArrayAcabamentoCreate($category,$pacAcabamento,$autoriza,$autoriza_a){
        $cat_f = $category->CategoryFormato;
        $cat_p = $category->CategoryPapel;
        $cat_a = $category->CategoryAcabamento;
        foreach ($cat_p->toArray() as $key => $papel) {

                foreach ($cat_f->toArray() as $formato) {
                    if (in_array($formato['formato_id'], $autoriza[$papel['papel_id']])) {
                        //valores para papeis
                        //identifica o category_papel_id autorizado
                        $category_papel_id = $this->categoryPapel->where('papel_id',$papel['papel_id'])->first()->id;
                        $PacPapeis = $category->CategoryFormato->find($formato['id'])
                            ->PacFormatos()
                            ->first()->PacPapeis
                            ->where('category_papel_id',$category_papel_id);
                        foreach ($PacPapeis as $PacPapel) {
                            //dd($PacPapel);
                            $PacCores = $PacPapel->PacCor;
                            if ($PacCores) {
                                foreach ($PacCores as $category_cor_id => $Paccor) {
                                    foreach ($cat_a->toArray() as $CategoryAcabamento) {
                                        if (in_array($CategoryAcabamento['acabamento_id'], $autoriza_a[$papel['papel_id']])) {
                                            $categoryCor = $category->CategoryCor->find($Paccor->category_cor_id);
                                            if (!is_null($categoryCor)) {
                                                $acabamentos[$formato['formato_id']][$papel['papel_id']][$categoryCor['cor_id']][$CategoryAcabamento['acabamento_id']] = [
                                                    'category_id' => $category->id,
                                                    'paccor_id' => $Paccor->id,
                                                    'category_acabamento_id' => $CategoryAcabamento['id'],
                                                    'pacote_id' => $Paccor->pacote_id,
                                                    'price' => 0
                                                ];
                                                $rows[] = [
                                                    'category_id' => $category->id,
                                                    'paccor_id' => $Paccor->id,
                                                    'category_acabamento_id' => $CategoryAcabamento['id'],
                                                    'pacote_id' => $Paccor->pacote_id,
                                                    'price' => 0
                                                ];
                                            }

                                        }
                                    }

                                }

                            }

                        }
                    }
                }

        }
        //dd($acabamentos);
        ini_set('max_execution_time', 90);
        foreach($rows as $row){
            $pacAcabamento->firstOrCreate($row);
        }
        return $acabamentos;
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