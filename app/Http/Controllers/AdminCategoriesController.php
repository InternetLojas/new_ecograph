<?php namespace Ecograph\Http\Controllers;

use Ecograph\Acabamento;
use Ecograph\Category;
use Ecograph\CategoryAcabamento;
use Ecograph\CategoryCor;
use Ecograph\CategoryDescription;
use Ecograph\CategoryFormato;
use Ecograph\CategoryPapel;
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

    public function CatformatosEdit($id,CategoryDescription $category_description, Pacformato $pacformato){
        $list_formatos = $this->formatoModel->all();
        $cat = $this->categoryModel->find($id);
        $catformatos = $cat->categoryFormato->lists('id','formato_id');
        if(empty($catformatos)){
            return redirect()->route('formatos.create');
        }
        $list_pacotes = $cat->Pacotes->lists('quantity','id');
        $cat_name = $category_description->find($id)->categories_name;
        $cat_f = $this->categoryFormato->where('category_id',$id)->get();

        $formato = [];
        if(count($this->categoryFormato->where('category_id',$id)->first()->PacFormatos->toArray())==0){
            //chama a função
            $formato = $this->ArrayFormato($cat,$cat_f,$pacformato,$list_pacotes);
        }else {
            $array_1 = $this->ArrayFormato($cat,$cat_f,$pacformato,$list_pacotes,false);
            foreach($cat_f as $item_f){
                $formato[$item_f->id] = [
                    'formato_id' => $item_f->id,
                    'formato_nome' => $this->formatoModel->find($item_f->id)->valor,
                    'pacotes' => $array_1
                ];
            }

        }

        return view('diretoria.atributos.category_formato',compact('formato','list_formatos'))
            ->with('catformatos',$catformatos)
            ->with('pacotes',$list_pacotes)
            ->with('cat_name',$cat_name)
            ->with('cat_id',$id)
            ->with('page','atributos');
    }

    public function CatpapeisEdit($id,
                                  CategoryDescription $category_description,
                                  Pacformato $pacformato,
                                  Pacpapel $pacpapel){
        $cat = $this->categoryModel->find($id);
        $list_pacotes = $cat->Pacotes->lists('quantity','id');
        $catpapeis = $cat->categoryPapel->lists('id','papel_id');
        if(empty($catpapeis)){
            return redirect()->route('papeis.create');
        }
        $cat_name = $category_description->find($id)->categories_name;
        $cat_f = $this->categoryFormato->where('category_id',$id)->get();
        $formato = [];
        if(count($this->categoryFormato->where('category_id',$id)->first()->PacFormatos->toArray())==0){
            //chama a função
            $formato = $this->ArrayFormato($cat,$cat_f,$pacformato,$list_pacotes);
        }else {
            $array_1 = $this->ArrayFormato($cat,$cat_f,$pacformato,$list_pacotes,false);
            foreach($cat_f as $item_f){
                $formato[$item_f->id] = [
                    'formato_id' => $item_f->id,
                    'formato_nome' => $this->formatoModel->find($item_f->id)->valor,
                    'pacotes' => $array_1
                ];
            }

        }

        $papel= [];
        $cat_p = $this->categoryPapel->where('category_id',$id)->get();
        if(count($this->categoryPapel->where('category_id',$id)->first()->PacPapeis->toArray())==0){
            //chama função
            $papel = $this->ArrayPapel($cat,$cat_f,$cat_p,$list_pacotes,$pacpapel);
        }else {
            $array_2 = $this->ArrayPapel($cat,$cat_f,$cat_p,$list_pacotes,$pacpapel,false);
            foreach($cat_p as $item_p){
                $papel[$item_p->id] = [
                    'papel_id' => $item_p->id,
                    'papel_nome' => $this->papelModel->find($item_p->id)->valor,
                    'pacotes' => $array_2
                ];
            }

        }
        $list_papeis = $this->papelModel->all();
        return view('diretoria.atributos.category_papel',compact('formato', 'papel','list_papeis'))
            ->with('catpapeis',$catpapeis)
            ->with('cat_name',$cat_name)
            ->with('cat_id',$id)
            ->with('page','atributos');
    }
    public function CatcoresEdit($id,
                                       CategoryDescription $category_description,
                                       Pacformato $pacformato,
                                       Pacpapel $pacpapel,
                                       Paccor $paccor){
        $cat = $this->categoryModel->find($id);
        $list_pacotes = $cat->Pacotes->lists('quantity','id');
        $catcores = $cat->categoryCor->lists('id','cor_id');
        if(empty($catcores)){
            return redirect()->route('cores.create');
        }
        $cat_name = $category_description->find($id)->categories_name;
        $cat_f = $this->categoryFormato->where('category_id',$id)->get();
        $formato = [];
        if(count($this->categoryFormato->where('category_id',$id)->first()->PacFormatos->toArray())==0){
            //chama a função
            $formato = $this->ArrayFormato($cat,$cat_f,$pacformato,$list_pacotes);
        }else {
            $array_1 = $this->ArrayFormato($cat,$cat_f,$pacformato,$list_pacotes,false);
            foreach($cat_f as $item_f){
                $formato[$item_f->id] = [
                    'formato_id' => $item_f->id,
                    'formato_nome' => $this->formatoModel->find($item_f->id)->valor,
                    'pacotes' => $array_1
                ];
            }

        }

        $papel= [];
        $cat_p = $this->categoryPapel->where('category_id',$id)->get();
        if(count($this->categoryPapel->where('category_id',$id)->first()->PacPapeis->toArray())==0){
            //chama função
            $papel = $this->ArrayPapel($cat,$cat_f,$cat_p,$list_pacotes,$pacpapel);
        }else {
            $array_2 = $this->ArrayPapel($cat,$cat_f,$cat_p,$list_pacotes,$pacpapel,false);
            foreach($cat_p as $item_p){
                $papel[$item_p->id] = [
                    'papel_id' => $item_p->id,
                    'papel_nome' => $this->papelModel->find($item_p->id)->valor,
                    'pacotes' => $array_2
                ];
            }

        }
//dd($array_2);
        $cat_c = $this->categoryCor->where('category_id',$id)->get();
        $cores = [];
        if(count($this->categoryCor->where('category_id',$id)->first()->PacCor->toArray())==0){
            //chama função
            $cores = $this->ArrayCor($cat,$cat_f,$cat_p,$cat_c,$list_pacotes,$paccor);
        }else {
            $array_3 = $this->ArrayCor($cat,$cat_f,$cat_p,$cat_c,$list_pacotes,$paccor,false);
            foreach($cat_c as $item_c){
                $cores[$item_c->id] = [
                    'cor_id' => $item_c->id,
                    'cor_nome' => $this->corModel->find($item_c->id)->valor,
                    'pacotes' => $array_3
                ];
            }

        }

        $list_cores = $this->corModel->all();
        return view('diretoria.atributos.category_cor',compact('formato','papel','cores','list_cores'))

            ->with('catcores',$catcores)
            ->with('cat_name',$cat_name)
            ->with('cat_id',$id)
            ->with('page','atributos');
    }
    public function CatacabamentosEdit($id,
                                       CategoryDescription $category_description,
                                       Pacformato $pacformato,
                                       Pacpapel $pacpapel,
                                       Paccor $paccor,
                                       Pacacabamento $pacacabamento){
        $cat = $this->categoryModel->find($id);
        $list_pacotes = $cat->Pacotes->lists('quantity','id');
        $catacabamentos = $this->categoryAcabamento->where('category_id',$id)->lists('id','acabamento_id');
        if(empty($catacabamentos)){
            return redirect()->route('acabamentos.create');
        }
        $catpapeis = $cat->categoryPapel->lists('id','papel_id');
        $cat_name = $category_description->find($id)->categories_name;
        $cat_f = $this->categoryFormato->where('category_id',$id)->get();
        $formato = [];
        if(count($this->categoryFormato->where('category_id',$id)->first()->PacFormatos->toArray())==0){
            //chama a função
            $formato = $this->ArrayFormato($cat,$cat_f,$pacformato,$list_pacotes);
        }else {
            $array_1 = $this->ArrayFormato($cat,$cat_f,$pacformato,$list_pacotes,false);
            foreach($cat_f as $item_f){
                $formato[$item_f->id] = [
                    'formato_id' => $item_f->id,
                    'formato_nome' => $this->formatoModel->find($item_f->id)->valor,
                    'pacotes' => $array_1
                ];
            }
        }

        $papel= [];
        $cat_p = $this->categoryPapel->where('category_id',$id)->get();
        if(count($this->categoryPapel->where('category_id',$id)->first()->PacPapeis->toArray())==0){
            //chama função
            $papel = $this->ArrayPapel($cat,$cat_f,$cat_p,$list_pacotes,$pacpapel);
        }else {
            $array_2 = $this->ArrayPapel($cat,$cat_f,$cat_p,$list_pacotes,$pacpapel,false);
            foreach($cat_p as $item_p){
                $papel[$item_p->id] = [
                    'papel_id' => $item_p->id,
                    'papel_nome' => $this->papelModel->find($item_p->id)->valor,
                    'pacotes' => $array_2
                ];
            }

        }
//dd($array_2);
        $cat_c = $this->categoryCor->where('category_id',$id)->get();
        $cores = [];
        if(count($this->categoryCor->where('category_id',$id)->first()->PacCor->toArray())==0){
            //chama função
            $cores = $this->ArrayCor($cat,$cat_f,$cat_p,$cat_c,$list_pacotes,$paccor);
        }else {
            $array_3 = $this->ArrayCor($cat,$cat_f,$cat_p,$cat_c,$list_pacotes,$paccor,false);
            foreach($cat_c as $item_c){
                $cores[$item_c->id] = [
                    'cor_id' => $item_c->id,
                    'cor_nome' => $this->corModel->find($item_c->id)->valor,
                    'pacotes' => $array_3
                ];
            }

        }

        $acabamentos = [];
        $cat_a = $this->categoryAcabamento->where('category_id',$id)->get();
        if(count($this->categoryAcabamento->where('category_id',$id)->first()->PacAcabamentos->toArray())==0){
            //chama função
            $acabamentos = $this->ArrayAcabamento($cat,$cat_f,$cat_p,$cat_c,$cat_a,$list_pacotes,$pacacabamento);
        } else {
            $array_4 = $this->ArrayAcabamento($cat,$cat_f,$cat_p,$cat_c,$cat_a,$list_pacotes,$pacacabamento,false);
            foreach($cat_a as $item_a){
                $acabamentos[$item_a->id] = [
                    'acabamento_id' => $item_a->id,
                    'acabamento_nome' => $this->acabamentoModel->find($item_a->id)->valor,
                    'pacotes' => $array_4
                ];
            }

        }
        //dd($array_4);
        $list_acabamentos = $this->acabamentoModel->all();
        return view('diretoria.atributos.category_acabamento',compact('formato','papel','cores','acabamentos','list_acabamentos'))
            ->with('catacabamentos',$catacabamentos)
            ->with('catpapeis',$catpapeis)
            ->with('cat_name',$cat_name)
            ->with('cat_id',$id)
            ->with('page','atributos');
    }

    public function atributos($id){
        $cat = $this->categoryModel->find($id);
        //formatos
        $catformatos = $cat->CategoryFormato->lists('id');
        $formatos = $this->formatoModel->all();
        //papeis
        $catpapeis = $cat->CategoryPapel->lists('id');
        $papeis = $this->papelModel->all();

        //acabamentos
        $catacabamentos = $cat->CategoryAcabamento->lists('id');
        $acabamentos = $this->acabamentoModel->all();

        return view('diretoria.atributos.category_atributos')
            ->with(compact('formatos', 'papeis', 'acabamentos'))
            ->with('catformatos',$catformatos)
            ->with('catpapeis',$catpapeis)
            ->with('catacabamentos',$catacabamentos)
            ->with('cat',$cat)
            ->with('page','atributos');
    }
    public function pacotes($id,Pacote $pacote){
        $cat = $this->categoryModel->find($id);
        //formatos
        $pacotes = '';
        $catformatos = $cat->CategoryFormato;
        foreach($catformatos as $collection){
            //dd($collection->Pacformatos);
            foreach($collection->Pacformatos as $itemformatos){

                foreach($itemformatos->Pacpapeis as $itempapeis){

                    $pacote_id = $itemformatos->pacote_id;
                    $weight = $itempapeis->weight;
                    $formato_id = $collection->formato_id;
                    $formato = $this->formatoModel->find($formato_id)->valor;
                    $category_papel_id = $itempapeis->category_papel_id;
                    $category_papel = $this->papelModel->find($category_papel_id);
                    $quantity = $pacote->find($pacote_id)->quantity;
                    //chave nome do formato - nome do papel  - identificador do pacote
                    $pacotes[$formato][$category_papel->valor][$pacote_id]=[
                        'papel_id' => [$category_papel->id],
                        'formato_id' => $formato_id,
                        'quantity' => $quantity,
                        'weight' => $weight
                    ];

                }
            }
        }

        //[$category_papel->valor][$itemformatos->pacote_id]
        //dd($pacotes);
        return view('diretoria.pacotes.category_pacotes',compact('catformatos'))
            ->with('cat',$cat)
            ->with('pacotes',$pacotes)
            ->with('page','pacotes');
    }
    public function edit($id) {
        $category = $this->categoryModel->find($id);
        $category_formato = $category->formato;
        $list_formatos = [];
        if($category_formato){
            foreach($category_formato as $formatos){
                $list_formatos[] = $formatos->valor;
            }
            $list_f = implode(',',$list_formatos);
        }
        $category_papel = $category->papel;
        $list_papeis = [];
        if($category_papel){
            foreach($category_papel as $papeis){
                $list_papeis[] = $papeis->valor;
            }
            $list_p = implode(',',$list_papeis);
        }
        return view('diretoria.category.category_edit')
            ->with(compact('category'))
            ->with('page','category')
            ->with('list_f',$list_f)
            ->with('list_p',$list_p);
    }
    public function ListaAtributos($cat,$pacote)
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
        //dd($conf_formato);
        //dd($conf_papel);
        //dd($conf_acabamento);
        //dd($list_formato);
        //dd($list_papel);
        //dd($list_acabamento);
    }
    public function ArrayFormato($category,$cat_f,$pacFormato,$pacote,$create = true)
    {
        //dd($pacote);
        foreach ($cat_f->toArray() as $key => $id) {
            foreach ($pacote as $pacote_id => $quantity) {
                $formatos[$id['id']] = [
                    'category_id' => $category->id,
                    'category_formato_id' => $id['id']
                ];
                $item[$pacote_id] =  $quantity;
                if($create){
                    $pacFormato->firstOrCreate([
                        'category_id' => $category->id,
                        'category_formato_id' => $id['id'],
                        'pacote_id' => $pacote_id
                    ]);
                }
            }
            $formatos[$id['id']]['pacote_id'] = $item;
            $item = [];
        }

        return $formatos;
    }

    public function ArrayPapel($category,$cat_f,$cat_p,$pacote,$pacPapel,$create = true)
    {
        //dd($cat_f);
        foreach ($cat_f->toArray() as $formato) {
            foreach ($cat_p->toArray()  as $key => $id) {
                foreach ($pacote as $pacote_id => $quantity) {
                    $papeis[$formato['formato_id']][$id['id']] = [
                        'category_id' => $category->id,
                        'pacformato_id' => $formato['id'],
                        'category_papel_id' => $id['id']
                    ];
                    $item[$pacote_id] =  $quantity;
                    if($create){
                        $pacPapel->firstOrCreate([
                            'category_id' => $category->id,
                            'pacformato_id' => $formato['id'],
                            'category_papel_id' => $id['id'],
                            'pacote_id' => $pacote_id,
                            'weight' => 0
                        ]);
                    } else {
                        $weights[] = $pacPapel->where('category_id',$category->id)
                            ->where('pacformato_id',$formato['id'])
                            ->where('category_papel_id',$id['id'])
                            ->where('pacote_id',$pacote_id)->lists('weight');

                        $papeis[$formato['formato_id']][$id['id']]['weight'] = $weights;
                    }
                }
                $papeis[$formato['formato_id']][$id['id']]['pacote_id'] = $item;
                $item = [];
                $weights = [];
            }

        }
        return $papeis;
    }
    public function ArrayCor($category,$cat_f,$cat_p,$cat_c,$pacote,$pacCor,$create= true){
        //dd($cat_f);
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
                        if($create){
                            $pacCor->firstOrCreate([
                                'category_id' => $category->id,
                                'pacpapel_id' => $papel['id'],
                                'category_cor_id' => $id['id'],
                                'pacote_id' => $pacote_id
                            ]);
                        }
                    }
                    $cores[$formato['formato_id']][$papel['id']][$id['id']]['pacote_id'] = $item;
                    $item = [];
                }
            }
        }
        return $cores;
    }
    public function ArrayAcabamento($category,$cat_f,$cat_p,$cat_c,$cat_a,$pacote,$pacAcabamento, $create = true){
        foreach($cat_f->toArray() as $formato){
            foreach ($cat_p->toArray() as $papel) {
                foreach($cat_c->toArray() as $cor) {
                    foreach ($cat_a->toArray() as $key => $id) {
                        foreach ($pacote as $pacote_id => $quantity) {
                            $acabamentos[$formato['formato_id']][$papel['id']][$cor['id']][$id['id']] = [
                                'category_id' => $category->id,
                                'paccor_id' => $cor['id'],
                                'category_acabamento_id' => $id['id']
                            ];
                            $item[$pacote_id] =  $quantity;
                            if($create){
                                $pacAcabamento->firstOrCreate([
                                    'category_id' => $category->id,
                                    'paccor_id' => $cor['id'],
                                    'category_acabamento_id' => $id['id'],
                                    'pacote_id' => $pacote_id,
                                    'price' => 0
                                ]);
                            } else {
                                $prices = $pacAcabamento->where('category_id',$category->id)
                                    ->where('paccor_id',$cor['id'])
                                    ->where('category_acabamento_id',$id['id'])->lists('price');
                                $acabamentos[$formato['formato_id']][$papel['id']][$cor['id']][$id['id']]['price'] = $prices;
                            }
                        }
                        $acabamentos[$formato['formato_id']][$papel['id']][$cor['id']][$id['id']]['pacote_id'] = $item;
                        $item = [];
                    }
                }
            }
        }
        return $acabamentos;
    }
    public function ConfiguraPacote(Pacformato $pacformato, $categoryFormato, $list_pacotes)
    {
//chama uma função para criar a configuração
        foreach ($categoryFormato as $collection) {
            foreach ($list_pacotes as $pacote_id => $quantity) {
                $pacformato->firstOrCreate([
                    'category_formato_id' => $collection->id,
                    'pacote_id' => $pacote_id
                ]);
            }
        }
    }


}