<?php

namespace Ecograph\Http\Controllers;

use Ecograph\Acabamento;
use Ecograph\Category;
use Ecograph\CategoryDescription;
use Ecograph\CategoryFormato;
use Ecograph\CategoryPapel;
use Ecograph\Formato;
use Ecograph\Http\Requests;
use Ecograph\Http\Controllers\Controller;
use Ecograph\Pacote;
use Ecograph\Papel;
use Illuminate\Http\Request;

class AdminAttributesController extends Controller {

    private $categoryModel;
    private $formatoModel;
    private $papelModel;
    private $acabamentoModel;
    private $pacoteModel;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Category $categoryModel,
                                Formato $formatoModel,
                                Papel $papelModel,
                                Acabamento $acabamentoModel,Pacote $pacoteModel) {
        //$this->middleware('auth');
        $this->categoryModel = $categoryModel;
        $this->formatoModel = $formatoModel;
        $this->papelModel = $papelModel;
        $this->acabamentoModel = $acabamentoModel;
        $this->pacoteModel = $pacoteModel;
    }
    public function pacotes() {
        $pacotes = $this->pacoteModel->paginate(12);
        return view('diretoria.atributos.pacote')
            ->with(compact('pacotes'))
            ->with('page', 'atributos');
    }
    public function formatos() {
        $formatos = $this->formatoModel->groupby('category_id')->paginate(12);
        return view('diretoria.atributos.formato',compact('formatos'))
                        ->with('page', 'atributos');
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
    public function papeis() {
        $papeis = $this->papelModel->paginate(12);
        return view('diretoria.atributos.papel')
            ->with(compact('papeis'))
            ->with('page', 'atributos');
    }

    public function acabamentos() {
        $acabamentos = $this->acabamentoModel->paginate(12);
        return view('diretoria.atributos.acabamento')
            ->with(compact('acabamentos'))
            ->with('page', 'atributos');
    }

}
