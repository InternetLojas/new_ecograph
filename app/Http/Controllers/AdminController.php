<?php namespace Ecograph\Http\Controllers;

use Ecograph\Customer;
use Ecograph\Http\Requests;
use Ecograph\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller {

    public function index(Customer $pacoteCustomer) {
        $user_id = Auth::user()->id;
        $acessos = $pacoteCustomer->find($user_id)->Acesso;
        $admin = $acessos->toArray();

        if($admin[0]['admin'] != 1){
            return redirect()->route('index')->withErrors(['errors'=>['Você não está autorizado a acessar essa página']]);
        }
        return view('diretoria.index')->with('page','index');
    }

}
