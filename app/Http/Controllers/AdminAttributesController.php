<?php

namespace Ecograph\Http\Controllers;

use Ecograph\Acabamento;
use Ecograph\Category;
use Ecograph\CategoryAcabamento;
use Ecograph\CategoryCor;
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
    private $categoryCor;
    private $categoryEnoblecimento;
    private $categoryAcabamento;
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
                                CategoryPapel $categoryPapel,
                                CategoryCor $categoryCor,
                                CategoryEnoblecimento $categoryEnoblecimento,
                                CategoryAcabamento $categoryAcabamento) {
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
        $this->categoryCor = $categoryCor;
        $this->categoryEnoblecimento = $categoryEnoblecimento;
        $this->categoryAcabamento = $categoryAcabamento;
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
                $formato = $this->formatoModel->firstOrCreate(array('valor' => $valor));
                $collection = $cat->categoryFormato()->where('formato_id',$formato->id)->get()->first();
                //$cat->Formato()->attach($formato->id);
                //$formatos[] = $valor;
            }
        }
        if(is_null($collection)){
            return redirect()->route('categories.atributos',['id'=>$category_id]);
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
            if(!empty($valor)){
                $papel = $this->papelModel->firstOrCreate(array('valor' => $valor));
                $collection = $cat->categoryPapel()->where('papel_id',$papel->id)->get()->first();
            }
        }
        if(is_null($collection)){
            return redirect()->route('categories.atributos',['id'=>$category_id]);
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
                $this->enobrecimentoModel->firstOrCreate(['valor'=>$valor,'category_id'=>$category_id]);
                //$cat->Enoblecimento()->attach($enobrecimento->id);
            }
        }
        return redirect()->route('atributos.enobrecimentos');
    }

    /***acabamento***/
    public function AcabamentosCreate(CategoryDescription $categoryDescription) {
        //para popular o select
        $category = $categoryDescription->all()->lists('categories_name','id');
        $enobrecimentos = $this->enobrecimentoModel->lists('valor','id');
        $qtd_inputs = 10;
        return view('diretoria.atributos.acabamentos_create')
            ->with(compact('category','enobrecimentos'))
            ->with('qtd_inputs', $qtd_inputs)
            ->with('page', 'atributos');
    }
    public function AcabamentosStore(Request $request, CategoryAcabamento $categoryAcabamento) {
        $input = $request->except('_token');
        $category_id = $input['category_id'];
        foreach($input['valor'] as $key =>$valor) {
            if (!empty($valor)) {
                $acabamentos[] = $valor;
                $enobrecimento = $this->enobrecimentoModel->find($input['enobrecimento'][$key])->valor;
                $enobrecimentos[] = $enobrecimento;
            }
        }
        //dd($enobrecimentos);
        $acabamento_id = $this->acabamentoModel->lists('id');
        for ($i = 0; $i < count($acabamentos); $i ++)
        {
            $this->acabamentoModel->firstOrCreate(array('valor' => $acabamentos[$i], 'enoblecimento' => $enobrecimentos[$i] ));
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
        $cat_p = $this->categoryPapel->where('category_id',$id)->get()->lists('papel_id','id');
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
                            $CategoryFormato = $cat->CategoryFormato()->where('category_id',$id)
                                ->where('formato_id',$key)->get();
                            $pacotes = $cat->Pacotes()->lists('quantity','id');
                            foreach ($CategoryFormato as $key => $CatFormato) {
                                foreach ($pacotes as $pacote_id => $quantity) {
                                    /*$rows_pac[] = [
                                        'category_id' => $id,
                                        'category_formato_id' => $CatFormato->id,
                                        'pacote_id' => $pacote_id
                                    ];*/
                                    $CatFormato->PacFormatos()->firstOrCreate([
                                        'category_id' => $id,
                                        'category_formato_id' => $CatFormato->id,
                                        'pacote_id' => $pacote_id
                                    ]);
                                }

                            }
                        }

                    }
                }
                //dd($rows_pac);
                break;
            case 'papel':
                foreach($input[$atributo] as $key =>$valor) {
                    $autoriza = $this->Autoriza($id, $cat_p);
                    //$autoriza_a = $autoriza[0];
                    $autoriza_f = $autoriza[1];
                    if (!empty($valor)) {
                        $row = [
                            'papel_id' => $key,
                            'category_id' => $id
                        ];
                        $newcat = $cat->categoryPapel()->firstOrCreate($row);
                        $collection = $this->categoryPapel->find($newcat->id);

                        if(is_null($collection->PacPapeis()->first())){
                            $CategoryFormatos = $cat->CategoryFormato()
                                ->where('category_id',$id)->get();
                            //$pacotes = $cat->Pacotes()->lists('quantity','id');
                            foreach ($cat_p as $category_papel_id => $papel_id) {
                                foreach ($CategoryFormatos as $k => $CategoryFormato) {
                                    if(in_array($CategoryFormato->formato_id,$autoriza_f[$papel_id]))
                                    {
                                        $CategoryPapel = $this->categoryPapel->find($category_papel_id);
                                        foreach($CategoryFormato->PacFormatos()->get() as $PacFormato){
                                            //dd($PacFormato);
                                            $row_pac = [
                                                'category_id' => $id,
                                                'pacformato_id' => $PacFormato->id,
                                                'category_papel_id' => $category_papel_id,
                                                'pacote_id' => $PacFormato->pacote_id,
                                                'weight' =>  0
                                            ];
                                            $CategoryPapel->PacPapeis()->firstOrCreate($row_pac);
                                        }
                                    }
                                }
                            }
                        }
                    }


                }
               // dd($row_pac);
                break;
            case 'cor':
                foreach($input[$atributo] as $cor_id =>$valor) {
                    $autoriza = $this->Autoriza($id, $cat_p);
                    //$autoriza_a = $autoriza[0] ;
                    $autoriza_f = $autoriza[1];
                    if (!empty($valor)) {
                        $row = [
                            'cor_id' => $cor_id,
                            'category_id' => $id
                        ];
                        $PacCores = $this->categoryCor->where('category_id',$id)->where('cor_id',$cor_id)->get()->first();
                        //dd($PacCores->PacCor);
                        $newcat = $cat->CategoryCor()->firstOrCreate($row);
                        $collection = $this->categoryCor->find($newcat->id);
                        if (is_null($collection->PacCor()->first())) {
                            $cat_f = $cat->CategoryFormato;
                            $cat_papel = $cat->CategoryPapel;
                            $categoryCor =  $this->categoryCor->where('category_id',$id)
                                ->where('cor_id',$cor_id)->get();
                            foreach ($cat_papel->toArray() as $papel) {
                                foreach ($cat_f->toArray() as $key => $formato) {
                                    if (in_array($formato['formato_id'], $autoriza_f[$papel['papel_id']])) {
                                        foreach ($categoryCor as $items) {
                                            if(!is_null($items)){
                                                //começa a criar as entradas
                                                $categoryFormato = $cat_f->find($formato['id']);
                                                $PacFormatos = $categoryFormato->PacFormatos;
                                                $CategoryCor = $this->categoryCor->where('category_id',$id)
                                                    ->where('cor_id',$cor_id)->get()->toArray();
                                                foreach ($PacFormatos as $k => $items_pacFormatos) {
                                                    $PacPapeis = $items_pacFormatos->PacPapeis;
                                                    foreach ($PacPapeis as $ch => $items_pacPapeis) {
                                                        $row_pac = [
                                                            'category_id' => $id,
                                                            'pacpapel_id' => $items_pacPapeis->id,
                                                            'category_cor_id' =>$CategoryCor[0]['id'],
                                                            'pacote_id' => $items_pacPapeis->pacote_id
                                                            ];
                                                        $PacCores->PacCor()->firstOrCreate($row_pac);
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                break;
            case 'enobrecimento':
                foreach($input[$atributo] as $key =>$valor) {
                    if (!empty($valor)) {
                          $row = [
                                'enoblecimento_id' => $key,
                                'category_id' => $id
                            ];
                            $cat->CategoryEnoblecimento()->firstOrCreate($row);

                    }
                }
                break;
            case 'acabamento':
                $autoriza = $this->Autoriza($id, $cat_p);
                $autoriza_a = $autoriza[0];
                $autoriza_f = $autoriza[1];
                $CatFormatos = $this->categoryFormato->where('category_id',$id)->get()->lists('formato_id','id');
                $CatPapeis = $this->categoryPapel->where('category_id',$id)->get()->lists('papel_id','id');
                $CatCores = $this->categoryCor->where('category_id',$id)->get()->lists('cor_id','id');
                $CatAcabamentos = $this->categoryAcabamento->where('category_id',$id)->lists('acabamento_id','id');
                $pacotes = $this->pacoteModel->where('category_id',$id)->lists('quantity','id');
                ini_set('max_execution_time', 120);

                foreach($input[$atributo] as $acabamento_id =>$valor) {
                    if (!empty($valor)) {
                        $row = [
                            'acabamento_id' => $acabamento_id,
                            'category_id' => $id
                        ];

                        $newcat = $cat->categoryAcabamento()->firstOrCreate($row);
                        $collection = $this->categoryAcabamento->find($newcat->id);
                        if(is_null($collection->PacAcabamentos()->first())) {
                            foreach ($CatPapeis as $category_papel_id => $papel_id) {
                                foreach ($CatFormatos as $category_formato_id => $formato_id) {
                                    //verifica se o formato é autorizado para o papel corrente
                                    if (in_array($formato_id, $autoriza_f[$papel_id])) {
                                        $Formatos = $this->categoryFormato->find($category_formato_id);
                                        $PacFormato_ID = $Formatos->PacFormatos()->where('category_formato_id',$category_formato_id)->get()->first()->id;
                                        $Papeis = $this->categoryPapel->find($category_papel_id);
                                        $PacPapel_ID = $Papeis->Pacpapeis()->where('category_papel_id',$category_papel_id)
                                            ->where('pacformato_id',$PacFormato_ID)->get()->first()->id;
                                        foreach ($CatCores as $category_cor_id => $cor_id) {
                                            foreach ($CatAcabamentos as $category_acabamento_id => $acab_id) {

                                               if($acabamento_id == $acab_id && (in_array($acabamento_id, $autoriza_a[$papel_id]))){

                                                   $Cores = $this->categoryCor->find($category_cor_id);
                                                   $PacCor = $Cores->PacCor()->where('category_cor_id',$category_cor_id)
                                                       ->where('pacpapel_id',$PacPapel_ID)->get();

                                                   foreach ($PacCor as $items) {
                                                       foreach ($pacotes as $pacote_id => $quantity) {
                                                           $rows_cat = [
                                                               'category_id' => $id,
                                                               'paccor_id' => $items->id,
                                                               'category_acabamento_id' => $category_acabamento_id,
                                                               'pacote_id' => $pacote_id,
                                                               'price' => 0.0000
                                                           ];
                                                           $PacAcabamentos = $this->categoryAcabamento->find($category_acabamento_id);
                                                           $PacAcabamentos->PacAcabamentos()->firstOrCreate($rows_cat);
                                                       }
                                                   }
                                                    //   }
                                                   //}
                                                   break;
                                               }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }

                break;
        }
        return redirect()->route('categories.atributos',['id' =>$id]);
    }

    /**
     * @param $id
     * @param $cat_p
     * @param $autoriza_f
     * @return mixed
     */
    public function Autoriza($id, $cat_p)
    {
        $autoriza_a = [];
        $autoriza_f = [];
        if ($id == 5) {
            foreach ($cat_p as $cat_p_id => $pap_id) {
                switch ($pap_id) {
                    case 1 :
                        $autoriza_a[1] = [2, 3, 4, 5, 6, 7, 8,9];
                        $autoriza_f[1] = [1, 2, 3, 4];
                        break;
                    case 2 :
                        $autoriza_a[2] = [2, 6];
                        $autoriza_f[2] = [2, 4];
                        break;
                    case 3 :
                        $autoriza_a[3] = [1, 5];
                        $autoriza_f[3] = [5];
                        break;
                }
            }
        } else {
            $acabamentos = $this->categoryAcabamento->where('category_id',$id)->get()->lists('acabamento_id');
            $formatos = $this->categoryFormato->where('category_id',$id)->get()->lists('formato_id');
            foreach ($cat_p as $cat_p_id => $pap_id) {
                $autoriza_a[$pap_id] = $acabamentos;
                $autoriza_f[$pap_id] = $formatos;
            }
        }
        //dd($autoriza_a,$autoriza_f);
        return [$autoriza_a,$autoriza_f];
    }
}
