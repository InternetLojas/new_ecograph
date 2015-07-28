<?php namespace Ecograph\Http\Controllers;

use Ecograph\Acabamento;
use Ecograph\Category;
use Ecograph\CategoryAcabamento;
use Ecograph\CategoryDescription;
use Ecograph\CategoryFormato;
use Ecograph\CategoryPapel;
use Ecograph\Formato;
use Ecograph\Http\Requests;
use Ecograph\Http\Controllers\Controller;
use Ecograph\Pacformato;
use Ecograph\Pacote;
use Ecograph\Papel;
use Illuminate\Http\Request;

class AdminCategoriesController extends Controller {

    private $categoryModel;
    private $categoryFormato;
    private $categoryPapel;
    private $categoryAcabamento;
    private $formatoModel;
    private $papelModel;
    private $acabamentoModel;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Category $categoryModel,
                                CategoryFormato $categoryFormato,
                                CategoryPapel $categoryPapel,
                                CategoryAcabamento $categoryAcabamento,
                                Formato $formatoModel,
                                Papel $papelModel,
                                Acabamento $acabamentoModel){
        //$this->middleware('auth');
        $this->categoryModel = $categoryModel;
        $this->categoryFormato = $categoryFormato;
        $this->categoryPapel = $categoryPapel;
        $this->categoryAcabamento = $categoryAcabamento;
        $this->formatoModel = $formatoModel;
        $this->papelModel = $papelModel;
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

    public function CatformatosEdit($id,Pacote $pacote,CategoryDescription $category_description){
        $cat = $this->categoryModel->find($id);
        $cat_name = $category_description->find($id)->categories_name;
        //formatos
        $catformatos = $cat->CategoryFormato;
        $catformatos_id = $cat->CategoryFormato->lists('formato_id');
        $formatos = $this->formatoModel->all();
        foreach($catformatos as $collection){
            $pacformatos = $collection->Pacformatos;
            $formato_id = $collection->formato_id;
            $formato = $this->formatoModel->find($formato_id)->valor;
            foreach($pacformatos as $itemformatos){
                $pacote_id = $itemformatos->pacote_id;
                $quantity = $pacote->find($pacote_id)->quantity;
                //chave nome do formato - identificador do pacote
                $pacotes[$formato][$formato_id][$pacote_id]= $quantity;
            }
        }
//dd($pacotes);
        return view('diretoria.atributos.category_formato',compact('formatos'))
            ->with('catformatos',$catformatos_id)
            ->with('pacotes',$pacotes)
            ->with('cat_name',$cat_name)
            ->with('cat_id',$id)
            ->with('page','atributos');
    }

    public function CatpapeisEdit($id,Pacote $pacote,Pacformato $pacformato,CategoryDescription $category_description){
        $categoryFormato_id = $this->categoryFormato->where('category_id',$id)->lists('id');
        //dd($categoryFormato_id);//3 e 4
        //papeis
        $papeis = $this->papelModel->all();
        $cat = $this->categoryModel->find($id);
        $catpapeis_id = $cat->CategoryPapel->lists('papel_id');
        foreach ($catpapeis_id as $key => $value) {
            //levanta a collection
            $papeis_id[$value]= $this->papelModel->find($value)->valor;
            //$formato_id = $collection->formato_id;
        }
        //dd($catpapeis_id);//3 e 4 
        foreach($categoryFormato_id as $id){
            $array_conf = [];
            $pacote_id = [];
            $pacpapeis = [];
             $quantity = [];
            //levanta a collection
            $collection = $this->categoryFormato->find($id);
            $formato_id = $collection->formato_id;
            //$array_conf['formato'] = [];
            //todos os pacformatos
            $pacformatos = $collection->pacformatos;
            //dd($pacformatos);//retorna um array com os pacformatos vinculados a categoria - identifico qual o pacote_id
            foreach($pacformatos as $item){

                $quantity[$item->pacote_id] = $pacote->find($item->pacote_id)->quantity;
                //$pacote_id[$item->pacote_id] = $quantity ;
                //dd($item->pacpapeis);
                $pacpapeis[$item->pacote_id] = $item->pacpapeis->lists('weight','id');
                foreach($item->pacpapeis as $pac){
                     $array_conf['quantity']= $quantity;
                     $array_conf['papeis']= $papeis_id;
                    $array_conf['formato'] = [$formato_id=>$this->formatoModel->find($formato_id)->valor];
                    
                    $array_conf['pacpapeis']=$pacpapeis;

                }
            }
            $configuracao[] =$array_conf;
        }
        dd($configuracao);
        //nome da categoria
        $cat_name = $category_description->find($id)->categories_name;

        //dd($pac);
        return view('diretoria.atributos.category_papel',compact('papeis'))
            ->with('catpapeis',$catpapeis_id)
            ->with('configuracao',$configuracao)
            ->with('cat_name',$cat_name)
            ->with('cat_id',$id)
            ->with('page','atributos');
    }
    public function CatacabamentosEdit($id,Pacote $pacote,Pacformato $pacformato,CategoryDescription $category_description){
        $cat = $this->categoryModel->find($id);
        $cat_name = $category_description->find($id)->categories_name;
        //acabamentos
        $catacabamentos = $cat->CategoryAcabamento;

        $catacabamentos_id = $cat->CategoryAcabamento->lists('acabamento_id');
        $acabamentos = $this->acabamentoModel->all();
        foreach($catacabamentos as $collection){
            $pacacabamentos = $collection->PacAcabamentos;
            dd($pacacabamentos);
            $acabamento_id = $collection->acabamento_id;
            dd($acabamento_id);
            $acabamento = $this->acabamentoModel->find($acabamento_id)->valor;
            foreach($pacacabamentos as $itemacabamentos){
                dd($itemacabamentos);
                //$pacacabamento_id = $itemacabamentos->pacformato_id;
                //$pacote_id = $pacformato->find($pacformato_id)->pacote_id;
                //$quantity = $pacote->find($pacote_id)->quantity;
                //$weight = $itempapeis->weight;
                //chave nome do formato - identificador do formato - identificado do pacote
                //$pacotes[$papel][$pacformato_id][$pacote_id] = [$quantity, $weight];
            }
        }
        //dd($pacotes);
        return view('diretoria.atributos.category_papel',compact('papeis'))
            ->with('catpapeis',$catpapeis_id)
            ->with('pacotes',$pacotes)
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
        dd($pacotes);
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
}