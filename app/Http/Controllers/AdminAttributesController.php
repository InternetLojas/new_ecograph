<?php

namespace Ecograph\Http\Controllers;

use Ecograph\Acabamento;
use Ecograph\Category;
use Ecograph\CategoryAcabamento;
use Ecograph\CategoryDescription;
use Ecograph\CategoryFormato;
use Ecograph\CategoryPapel;
use Ecograph\Cor;
use Ecograph\Formato;
use Ecograph\Http\Requests;
use Ecograph\Http\Controllers\Controller;
use Ecograph\Pacacabamento;
use Ecograph\Pacote;
use Ecograph\Pacpapel;
use Ecograph\Papel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminAttributesController extends Controller {

    private $categoryModel;
    private $formatoModel;
    private $papelModel;
    private $acabamentoModel;
    private $corModel;
    private $pacoteModel;
    private $categoryPapel;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Category $categoryModel,
                                Formato $formatoModel,
                                Papel $papelModel,
                                Cor $corModel,
                                Acabamento $acabamentoModel,
                                Pacote $pacoteModel,
                                CategoryPapel $categoryPapel) {
        //$this->middleware('auth');
        $this->categoryModel = $categoryModel;
        $this->formatoModel = $formatoModel;
        $this->papelModel = $papelModel;
        $this->corModel = $corModel;
        $this->acabamentoModel = $acabamentoModel;
        $this->pacoteModel = $pacoteModel;
        $this->categoryPapel = $categoryPapel;
    }
    public function index(CategoryDescription $category_description) {
        $description = $category_description->all();
        $categories = $this->categoryModel->where('parent_id','<>',0)->paginate(15);
        return view('diretoria.atributos.atributos')
            ->with(compact('categories'))
            ->with('description',$description)
            ->with('page','atributos');
    }

    public function pacotes() {
        $pacotes = $this->pacoteModel->paginate(12);
        return view('diretoria.atributos.pacote')
            ->with(compact('pacotes'))
            ->with('page', 'atributos');
    }
    public function formatos() {
        $formatos = $this->formatoModel->paginate(12);
        return view('diretoria.atributos.formato',compact('formatos'))
            ->with('page', 'atributos');
    }
    public function papeis() {
        $papeis = $this->papelModel->paginate(12);
        return view('diretoria.atributos.papel')
            ->with(compact('papeis'))
            ->with('page', 'atributos');
    }
    public function cores() {
        $cores = $this->corModel->paginate(12);
        return view('diretoria.atributos.cores')
            ->with(compact('cores'))
            ->with('page', 'atributos');
    }
    public function acabamentos() {
        $acabamentos = $this->acabamentoModel->paginate(12);
        return view('diretoria.atributos.acabamento')
            ->with(compact('acabamentos'))
            ->with('page', 'atributos');
    }

    /***atualizações e criaçoes de entradas de atributos***/
    public function PacotesCreate(CategoryDescription $categoryDescription) {
        //para popular o select
        $category = $categoryDescription->all()->lists('categories_name','id');
        $qtd_inputs = 10;
        return view('diretoria.pacotes.create')
            ->with(compact('category'))
            ->with('qtd_inputs', $qtd_inputs)
            ->with('page', 'pacotes');
    }
    public function PacotesStore(Request $request) {
        $input = $request->all();
        $category_id = $input['category_id'];
        foreach($input['quantity'] as $key =>$quantity){
            if(!empty($quantity)){
                $newpacote = new $this->pacoteModel;
                $newpacote->category_id = $category_id;
                $newpacote->quantity = $quantity;
                $newpacote->save();
            }
        }
        return redirect()->route('atributos.pacotes');
    }

    /***formatos***/
    public function FormatosCreate(CategoryDescription $categoryDescription) {
        //para popular o select
        $category = $categoryDescription->all()->lists('categories_name','id');
        $qtd_inputs = 10;
        return view('diretoria.atributos.formatos_create')
            ->with(compact('category'))
            ->with('qtd_inputs', $qtd_inputs)
            ->with('page', 'atributos');
    }
    public function FormatosStore(Request $request) {
        $input = $request->except('_token');
        $category_id = $input['category_id'];
        $cat = $this->categoryModel->find($category_id);
        foreach($input['valor'] as $key =>$valor) {
            if (!empty($valor)) {
                $formatos[] = $valor;
            }
        }
        for ($i = 0; $i < count($formatos); $i ++)
        {
            $formato = $this->formatoModel->firstOrCreate(array('valor' => $formatos[$i]));
            $cat->Formato()->attach($formato->id);
        }
        return redirect()->route('atributos.formatos');
    }
    /***papeis***/
    public function PapeisCreate(CategoryDescription $categoryDescription) {
        //para popular o select
        $category = $categoryDescription->all()->lists('categories_name','id');
        $qtd_inputs = 10;
        return view('diretoria.atributos.papeis_create')
            ->with(compact('category'))
            ->with('qtd_inputs', $qtd_inputs)
            ->with('page', 'atributos');
    }
    public function PapeisStore(Request $request) {
        $input = $request->except('_token');
        $category_id = $input['category_id'];
        $cat = $this->categoryModel->find($category_id);
        foreach($input['valor'] as $key =>$valor) {
            if (!empty($valor)) {
                $papeis[] = $valor;
            }
        }
        for ($i = 0; $i < count($papeis); $i ++)
        {
            $papel = $this->papelModel->firstOrCreate(array('valor' => $papeis[$i]));
            $cat->Papel()->attach($papel->id);
        }
        return redirect()->route('atributos.papeis');
    }
    /***cores***/
    public function CoresCreate(CategoryDescription $categoryDescription) {
        //para popular o select
        $category = $categoryDescription->all()->lists('categories_name','id');
        $qtd_inputs = 10;
        return view('diretoria.atributos.cores_create')
            ->with(compact('category'))
            ->with('qtd_inputs', $qtd_inputs)
            ->with('page', 'atributos');
    }
    public function CoresStore(Request $request) {
        $input = $request->except('_token');
        $category_id = $input['category_id'];
        $cat = $this->categoryModel->find($category_id);
        foreach($input['valor'] as $key =>$valor) {
            if (!empty($valor)) {
                $cores[] = $valor;
            }
        }
        for ($i = 0; $i < count($cores); $i ++)
        {
            $cor = $this->corModel->firstOrCreate(array('valor' => $cores[$i]));
            $cat->Cor()->attach($cor->id);
        }
        return redirect()->route('atributos.cores');
    }
    /***acabamento***/
    public function AcabamentosCreate(CategoryDescription $categoryDescription) {
        //para popular o select
        $category = $categoryDescription->all()->lists('categories_name','id');
        $qtd_inputs = 10;
        return view('diretoria.atributos.acabamentos_create')
            ->with(compact('category'))
            ->with('qtd_inputs', $qtd_inputs)
            ->with('page', 'atributos');
    }
    public function AcabamentosStore(Request $request, CategoryAcabamento $categoryAcabamento) {
        $input = $request->except('_token');
        $category_id = $input['category_id'];
        foreach($input['valor'] as $key =>$valor) {
            if (!empty($valor)) {
                $acabamentos[] = $valor;
            }
        }
        $acabamento_id = $this->acabamentoModel->lists('id');
        for ($i = 0; $i < count($acabamentos); $i ++)
        {
            $this->acabamentoModel->firstOrCreate(array('valor' => $acabamentos[$i]));
            foreach($acabamento_id as $key => $id){
                $categoryAcabamento->firstOrCreate([
                    'category_id' => $category_id,
                    'acabamento_id' => $id
                ]);
            }
        }
        return redirect()->route('atributos.acabamentos');
    }

    /****atualização de pesos****/
    public function WeightUpdate(Request $request,$id, Pacpapel $pacpapel){
        $input = $request->except('_token');
        //dd($input);
        $erros = [];
        foreach($input['weight'] as $pac_papel_id =>$weight) {
            $rules[$pac_papel_id] = 'required|numeric';
            $post_weight[$pac_papel_id] = $weight;
            //regras a serem validadas
            $validation = Validator::make($post_weight, $rules);
            if ($validation->fails()) {
                foreach ($validation->getMessageBag()->toArray() as $atributo => $erro) {
                    foreach ($erro as $key => $value) {
                        $erros[] = $value;
                    }
                }
            }
            $values[$pac_papel_id] = $weight;
        }
        if(count($erros)>0){
            return redirect()->route('categorie.papeis.edit', ['id'=> $id]);
        }
        //dd($post_weight);
        foreach($post_weight as $pac_papel_id => $peso) {
           $pacpapel->find($pac_papel_id)->update(['weight' => $peso]);
        }
        return redirect()->route('categorie.papeis.edit', ['id'=> $id ]);
    }
/**atualizacação de preçso**/
    public function PricesUpdate(Request $request,$id, Pacacabamento $pacacabamento){
        //dd($request->input());
        $input = $request->except('_token');
        $erros = [];
        /*foreach($input['price'] as $pac_acabamento_id =>$prices) {
            $rules[$prices] = 'required|numeric';
            $post_price[$pac_acabamento_id] = $prices;
            //regras a serem validadas
            $validation = Validator::make($post_price, $rules);
            if ($validation->fails()) {
                foreach ($validation->getMessageBag()->toArray() as $atributo => $erro) {
                    foreach ($erro as $key => $value) {
                        $erros[] = $value;
                    }
                }
            }
        firstOrCreate([
                        'category_id' => $category->id,
                        'category_formato_id' => $id['id'],
                        'pacote_id' => $pacote_id
                    ]);
        }*/
        //dd($erros);
        if(count($erros)== 0) {
            foreach ($input['price'] as $pac_acabamento_id => $price) {
                $pacacabamento->find($pac_acabamento_id)->update(['price' => $price]);
            }
        }

        return redirect()->route('categorie.acabamentos.edit', ['id'=> $id ]);
    }


    public function updateFormatos(CategoryFormato $categoryFormato) {
        //$this->categoryModel->find($id)->update($request->all());
//dd($categoryFormato);
        return redirect()->route('diretoria.categories');
//return 'aqui';
    }
    public function updatePapeis(CategoryPapel $categoryPapel) {
        //$this->categoryModel->find($id)->update($request->all());
//dd($categoryFormato);
        return redirect()->route('diretoria.categories');
//return 'aqui';
    }
    public function CatformatosEdit($id) {
        return 'Vou edita os dados do identificador da categoria '.$id;
    }
}
