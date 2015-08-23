<?php

namespace Ecograph\Http\Controllers;

use Ecograph\Acabamento;
use Ecograph\Category;
use Ecograph\CategoryAcabamento;
use Ecograph\CategoryDescription;
use Ecograph\CategoryEnoblecimento;
use Ecograph\CategoryFormato;
use Ecograph\CategoryPapel;
use Ecograph\Cor;
use Ecograph\Enoblecimento;
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
    private $enobrecimentoModel;
    private $acabamentoModel;
    private $corModel;
    private $pacoteModel;
    private $categoryFormato;
    private $categoryPapel;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Category $categoryModel,
                                Formato $formatoModel,
                                Papel $papelModel,
                                Enoblecimento $enobrecimentoModel,
                                Cor $corModel,
                                Acabamento $acabamentoModel,
                                Pacote $pacoteModel,
                                CategoryFormato $categoryFormato,
                                CategoryPapel $categoryPapel) {
        //$this->middleware('auth');
        $this->categoryModel = $categoryModel;
        $this->formatoModel = $formatoModel;
        $this->papelModel = $papelModel;
        $this->enobrecimentoModel = $enobrecimentoModel;
        $this->corModel = $corModel;
        $this->acabamentoModel = $acabamentoModel;
        $this->pacoteModel = $pacoteModel;
        $this->categoryFormato = $categoryFormato;
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
    public function enobrecimentos() {
        $enobrecimentos = $this->enobrecimentoModel->paginate(12);
        return view('diretoria.atributos.enobrecimento')
            ->with(compact('enobrecimentos'))
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
        $papel = $this->papelModel->all()->lists('valor','id');
        $qtd_inputs = 10;
        return view('diretoria.atributos.papeis_create')
            ->with(compact('category','papel'))
            ->with('qtd_inputs', $qtd_inputs)
            ->with('page', 'atributos');
    }
    public function PapeisStore(Request $request) {
        $input = $request->except('_token');
        $category_id = $input['category_id'];
        $cat = $this->categoryModel->find($category_id);
        foreach($input['valor'] as $key =>$valor) {
            $papel = $this->papelModel->firstOrCreate(array('valor' => $valor));
            //$cat->Papel()->attach($valor);
            $collection = $cat->categoryPapel()->where('papel_id',$papel->id)->get()->first();
            //if (!empty($valor)) {
           //     $papeis[] = $valor;
           // }
        }

        if(is_null($collection)){
            return redirect()->route('categories.atributo.update',['id'=>$category_id,'atributo' =>'papel']);
        }
        /*dd($papeis);
        for ($i = 0; $i < count($papeis); $i ++)
        {
            $papel = $this->papelModel->firstOrCreate(array('valor' => $papeis[$i]));
            $cat->Papel()->attach($papel->id);
        }*/
        return redirect()->route('atributos.papeis');
    }
    /*
     * Enobrecimento
     */
    public function EnobrecimentosCreate(CategoryDescription $categoryDescription) {
        //para popular o select
        $category = $categoryDescription->all()->lists('categories_name','id');
        $qtd_inputs = 10;
        return view('diretoria.atributos.enobrecimentos_create')
            ->with(compact('category'))
            ->with('qtd_inputs', $qtd_inputs)
            ->with('page', 'atributos');
    }
    public function EnobrecimentosStore(Request $request) {
        $input = $request->except('_token');
        $category_id = $input['category_id'];
        $cat = $this->categoryModel->find($category_id);
        foreach($input['valor'] as $key =>$valor) {
            if (!empty($valor)) {
                $enobrecimento = $this->enobrecimentoModel->firstOrCreate(['valor'=>$valor,'category_id'=>$category_id]);
                $cat->Enoblecimento()->attach($enobrecimento->id);
            }
        }
        /*
         * dd($enobrecimentos);
        for ($i = 0; $i < count($enobrecimentos); $i ++)
        {
            //$enobrecimento = $this->enobrecimentoModel->firstOrCreate(array('valor' => $enobrecimentos[$i]));
            //$cat->Enoblecimento()->attach($enobrecimento->id);
        }
         */
        return redirect()->route('atributos.enobrecimento');
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

        if(count($erros)== 0) {
            foreach ($input['price'] as $pac_acabamento_id => $price) {
                $pacacabamento->find($pac_acabamento_id)->update(['price' => $price]);
            }
        }

        return redirect()->route('categorie.acabamentos.edit', ['id'=> $id ]);
    }


    public function updateAtributos($id, $atributo,Request $request) {
        $input = $request->except('_token');
        $cat = $this->categoryModel->find($id);

        $atributos = [
            'pacote' =>'pacote',
            'formato' =>'formato',
            'papel' => 'papel',
            'cor' => 'cor',
            'enobrecimento' => 'enobrecimento',
            'acabamento' => 'acabamento'
        ];
        if(!in_array($atributo,$atributos)){
            exit;
        }
        switch($atributo){
            case 'pacote':
                foreach($input[$atributo] as $key =>$valor) {
                    if (!empty($valor)) {
                        $row = [
                            'quantity' => $valor,
                            'category_id' => $id
                        ];
                        $cat->Pacotes()->firstOrCreate($row);
                    }
                }
                break;
            case 'formato':
                foreach($input[$atributo] as $key =>$valor) {
                    if (!empty($valor)) {
                        $row = [
                            'formato_id' => $key,
                            'category_id' => $id
                        ];
                        $newcat = $cat->categoryFormato()->firstOrCreate($row);
                        $collection = $this->categoryFormato->find($newcat->id);
                        if(is_null($collection->PacFormatos()->first())){
                            $CategoryFormato = $cat->CategoryFormato()->where('category_id',$id)->get();
                            $pacotes_id = $cat->Pacotes()->lists('id');
                            foreach($pacotes_id as $pacote_id){
                                foreach($CategoryFormato as $CatFormato){
                                    $row_pac = [
                                        'category_id' => $id,
                                        'category_formato_id' => $CatFormato->id,
                                        'pacote_id' => $pacote_id
                                    ];
                                    $collection->PacFormatos()->firstOrCreate($row_pac);
                                }
                            }

                        }
                    }
                }
                break;
            case 'papel':
                foreach($input[$atributo] as $key =>$valor) {
                    if (!empty($valor)) {
                        $row = [
                            'papel_id' => $key,
                            'category_id' => $id
                        ];
                        $newcat = $cat->categoryPapel()->firstOrCreate($row);
                        $collection = $this->categoryPapel->find($newcat->id);
                        if(is_null($collection->PacPapeis()->first())){
                            $CategoryFormato = $cat->CategoryFormato()->where('category_id',$id)->get()->first();
                            //dd($CategoryFormato->PacFormatos);
                            foreach($CategoryFormato->PacFormatos as $CatFormato){
                                $row_pac = [
                                    'category_id' => $id,
                                    'pacformato_id' => $CatFormato->id,
                                    'category_papel_id' => $newcat->id,
                                    'pacote_id' => $CatFormato->pacote_id,
                                    'weight' =>  0
                                ];
                                $collection->PacPapeis()->firstOrCreate($row_pac);
                            }
                        }
                    }
                }

                break;
            case 'cor':
                foreach($input[$atributo] as $key =>$valor) {

                    if (!empty($valor)) {
                        $row = [
                            'cor_id' => $key,
                            'category_id' => $id
                        ];

                       $cat->categoryCor()->firstOrCreate($row);

                    }
                }
                break;
            case 'enobrecimento':

                foreach($input[$atributo] as $key =>$valor) {
                    if (!empty($valor)) {
                        $catenobrecimentos = $cat->CategoryEnoblecimento()->first();
                        if(is_null($catenobrecimentos)){
                            $row = [
                                'enoblecimento_id' => $key,
                                'category_id' => $id
                            ];
                            CategoryEnoblecimento::firstOrCreate($row);
                        }else{
                            $cat->categoryEnoblecimento()->attach($key);
                        }

                    }
                }

                break;
            case 'acabamento':
                foreach($input[$atributo] as $key =>$valor) {
                    if (!empty($valor)) {
                        $row = [
                            'acabamento_id' => $key,
                            'category_id' => $id
                        ];
                        $cat->categoryAcabamento()->firstOrCreate($row);
                    }
                }
                break;
        }

        return redirect()->route('categories.atributos',['id' =>$id]);
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
