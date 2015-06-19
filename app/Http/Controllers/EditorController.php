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
//use Auth;
use Illuminate\Http\Request;

class EditorController extends Controller {

    private $layout;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Layout $layout) {
        $this->layout = $layout;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($produto, Request $request) {
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
                        ->with('rota', 'editor/' . $produto)
                        ->with('layout', $layout);
    }

    public function Personalizar(Request $request) {
        $post_inputs = $request->all();
        $img_categoria = Category::find($post_inputs['orc_subcategoria_id'])->categories_image;
        $parent = Category::find($post_inputs['orc_subcategoria_id'])->parent_id;
        $layout = $this->layout->classes(\Fichas::parentCategoria($post_inputs['orc_subcategoria_id']));
        $customers = Customer::where('id', \Auth::user()->id)->get();
        $customer = $customers->toarray();
        //dd($customer[0]);
        //levanta o endereço do cliente
        //$customers_default_address_id = Customer::find(\Auth::user()->customers_default_address_id);
        //$default_address = AddressBook::where('customers_default_address_id',$customers_default_address_id->customers_default_address_id)->get();
        $address = Customer::with('AddressBook')->find(\Auth::user()->id)->AddressBook;
        $default_address = $address->toarray();
        //dd($default_address [0]);
        /* $customer = Customer::with('files')->find($userId);
          /*         * *o itens de texto**** *
          $file_id = $customer->files->toarray();
          $file_texto = File::with('filetextos')->find($file_id[0]['id']);
          $textos = $file_texto->filetextos->toarray();
          /*         * **os itens de imagens e logos** *
          // $file_id = $customer->files->toarray();
          $file_img = File::with('filemidias')->find($file_id[0]['id']);
          $img = $file_img->filemidias->toarray(); */
        //dd($post_inputs );
        return view('editor.index')
                        ->with('title', STORE_NAME . ' Editar ' . $post_inputs['orc_subcategoria_nome'])
                        ->with('page', 'editor')
                        ->with('ativo', $post_inputs['orc_subcategoria_nome'])
                        ->with('parent', $parent)
                        ->with('form_orcamento', $post_inputs)
                        ->with('perfil', $post_inputs['orc_nome_perfil'])
                        ->with('customer',$customer[0])
                        ->with('default_address', $default_address[0])
                        ->with('img_categoria', $img_categoria)
                        ->with('rota', 'editor/personalizar.html')
                        ->with('layout', $layout);
    }

    /* função e chamada pela função carregar() do javascript */

    public function Validar(Request $request) {

        $post_inputs = $request->all();
        $data = array('status' => 'ok',
            'valores' => $post_inputs
        );
        //$this->Upload($posts_files);
        return json_encode($data);
        /* 1---verifica se todos o campos foram preenchidos */
        /* 2---veridicar quais os campos de log e img foram enviados */
        /* 3---se tudo ok devolve o resultado para o javascript com tudo ok */
        /* retorna json */
    }

    public function Upload() {
        $midia = \Request::get('arquivo');
        return 'aqui';
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
