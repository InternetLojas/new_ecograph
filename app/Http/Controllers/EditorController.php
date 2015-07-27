<?php

namespace Ecograph\Http\Controllers;

use Ecograph\Http\Requests;
use Ecograph\Http\Controllers\Controller;
use Ecograph\Libs\Layout;
use Ecograph\Customer;
use Ecograph\AddressBook;
use Ecograph\File;
use Ecograph\FileTexto;
use Ecograph\FileMidia;
use Ecograph\Category;
use Cart;
use Illuminate\Http\Request;

class EditorController extends Controller {

    private $layout;
    private $fileModel;
    private $fileTextoModel;
    private $fileMidiaModel;
    private $orcamentoModel;
    private $orcamentoProdutoModel;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Layout $layout,\Ecograph\File $fileModel,
                                \Ecograph\FileTexto $fileTextoModel,
                                \Ecograph\FileMidia $fileMidiaModel,
                                \Ecograph\Orcamento $orcamentoModel,
                                \Ecograph\OrcamentoProduto $orcamentoProdutoModel) {
        $this->middleware('auth');
        $this->layout = $layout;
        $this->fileModel = $fileModel;
        $this->fileTextoModel = $fileTextoModel;
        $this->fileMidiaModel = $fileMidiaModel;
        $this->orcamentoModel = $orcamentoModel;
        $this->orcamentoProdutoModel = $orcamentoProdutoModel;
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request) {
        $post_inputs = $request->all();
        $layout = $this->layout->classes(\Fichas::parentCategoria($post_inputs['orc_subcategoria_id']));
        return view('editor.index')
            ->with('title', STORE_NAME . ' Editar ' . $produto)
            ->with('page', 'editor')
            ->with('ativo', 'Edicao')
            ->with(compact('customer'))
            ->with('form_orcamento', $post_inputs)
            ->with('textos', $textos[0])
            ->with('img', $img[0])
            ->with('perfil', $post_inputs['nome_perfil'])
            ->with('rota', 'editor.index')
            ->with('layout', $layout);
    }

    public function Personalizar(Request $request) {
        $post_inputs = $request->all();
        $img_categoria = Category::find($post_inputs['orc_subcategoria_id'])->categories_image;
        $contents = \Cart::content();
        $userId = \Auth::user()->id;
        $customers = Customer::find($userId);
        //dd($customers);
        //levanta o endereço do cliente
        $default_address = AddressBook::find($customers->customers_default_address_id);
        $layout = $this->layout->classes($post_inputs['orc_categoria_id']);

        return view('editor.index',compact('customers'))
            ->with('title', STORE_NAME . ' Editar ' . $post_inputs['orc_subcategoria_nome'])
            ->with('page', 'editor')
            ->with('ativo', $post_inputs['orc_subcategoria_nome'])
            ->with('parent', $post_inputs['orc_categoria_id'])
            ->with('post_inputs', $post_inputs)
            ->with('perfil', $post_inputs['orc_nome_perfil'])
            ->with('contents', $contents->toarray())
            ->with('cart_total', Cart::total())
            ->with('default_address', $default_address)
            ->with('img_categoria', $img_categoria)
            ->with('rota', 'editor.personalizar')
            ->with('layout', $layout);
    }

    /* função e chamada pela função carregar() do javascript */

    public function Validar(Request $request) {

        $post_inputs = $request->all();
        $erros = [];
        $inputs_files = [];
        //local onde se armazena fisicamente os arquivos enviados dos clientes
        $storagePath = storage_path() . '/documentos/' . \Auth::user()->id;
        foreach($post_inputs as $key => $input){
            if($key !=='files'){
                $find_orc   = 'orc_';
                $find_id   = '_id';
                $pos = strpos($key, $find_orc);
                $pos1 = strpos($key, $find_id);
                if ($pos === false) {
                    $inputs[$key] = $input;
                } else if($pos1 === false){
                    $inputs_orc[$key] = $input;
                }
            }
        }

        $data = array('status' => 'success',
            'inputs' => $inputs,
            'inputs_orc'=>$inputs_orc,
            'loadurl'=>route('files.upload')
        );
        return json_encode($data);

    }

    public function Upload(Request $request) {
        $post_inputs = $request->all();
        $erros = [];
        $inputs_files = [];
        //local onde se armazena fisicamente os arquivos enviados dos clientes
        $storagePath = storage_path() . '/documentos/' . \Auth::user()->id;
        foreach($post_inputs as $key => $input){
            if($key !=='files'){
                $find_orc   = 'orc_';
                $find_id   = '_id';
                $pos = strpos($key, $find_orc);
                $pos1 = strpos($key, $find_id);
                if ($pos === false) {
                    $inputs[$key] = $input;
                } else if($pos1 === false){
                    $inputs_orc[$key] = $input;
                }
            }
        }

        foreach($post_inputs['files'] as $key => $files){
            if($files){
                $logos[$key] = $files->getClientOriginalName();
                //$files->move($storagePath,  $logos[$key]);
                $erros[] =$files->isValid();
            }
        }
        //dd($post_inputs['files']);
        $user_id = \Auth::user()->id;

        //preparando os arquivos para upload
        $file = $this->fileModel->fill(['customer_id'=>$user_id]);
        $file->save();
        $inputs['file_id'] = $file->id;
        $filetexto = $this->fileTextoModel->fill($inputs);
        $filetexto->save();
        $logos['file_id'] =  $inputs['file_id'];
        $filemidia = $this->fileMidiaModel->fill($logos);
        $filemidia->save();
        //armazenando os dados para o orçamento
        $orc = [
            'customer_id'=>$user_id,
            'file_id' => $inputs['file_id'],
            'orcamento_status'=>1
        ];
        $orcamento = $this->orcamentoModel->fill($orc);
        $orcamento->save();
        $inputs_orc['orcamento_id'] = $orcamento->id;
        $orcamento_produto = $this->orcamentoProdutoModel->fill($inputs_orc);
        $orcamento_produto->save();
        $customer = Customer::find($user_id);
        $customer_basket = $customer->basket->toArray();
        //dd($customer_basket);

        $contents = Cart::content();
        $layout = $this->layout->classes($post_inputs['orc_categoria_id']);

        //levanta o endereço do cliente
        $default_address = AddressBook::find($customer->customers_default_address_id);
        return view('loja.index')
            ->with('title', STORE_NAME)
            ->with('page', 'resumo_orc')
            ->with('ativo', 'Resumo')
            ->with('rota', 'files.upload')
            ->with('customer_name',$customer->customer_firstname)
            ->with('inputs', $inputs)
            ->with('storagePath',$storagePath)
            ->with('logos', $logos)
            ->with('orcamento_id', $orcamento->id)
            ->with('inputs_orc', $inputs_orc)
            ->with('post_inputs', $post_inputs)
            ->with('contents', $contents->toarray())
            ->with('cart_total', Cart::total())
            ->with('default_address', $default_address)
            ->with('erros', $erros)
            ->with('layout', $layout);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        //
    }

}
