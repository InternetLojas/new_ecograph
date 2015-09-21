<?php namespace Ecograph\Http\Controllers;

use Ecograph\Customer;
use Ecograph\Http\Requests;
use Ecograph\Http\Controllers\Controller;

use Illuminate\Http\Request;

class AdminClientesController extends Controller {
    private $pacoteCustomer;
    public function __construct(Customer $pacoteCustomer){
        $this->pacoteCustomer = $pacoteCustomer;
    }
    /*
     * Quando entra na área administrativa é apresentada essa página
     */
    public function index() {

        $customers = $this->pacoteCustomer->paginate(15);
        return view('diretoria.clientes.listclientes')
            ->with(compact('customers'))
            ->with('page','listclientes');
    }

}
