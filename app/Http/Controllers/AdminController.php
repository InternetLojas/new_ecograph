<?php namespace Ecograph\Http\Controllers;

use Ecograph\Http\Requests;
use Ecograph\Http\Controllers\Controller;

use Illuminate\Http\Request;

class AdminController extends Controller {

	//
    public function index() {
        //$products = $this->productModel->paginate(15);
        return view('diretoria.index')->with('page','index');
    }

}
