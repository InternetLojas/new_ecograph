<?php namespace Ecograph\Http\Controllers;

use Ecograph\Customer;
use Ecograph\Http\Requests;
use Ecograph\Http\Controllers\Controller;

use Ecograph\Orcamento;
use Illuminate\Http\Request;

class AdminOrcamentosController extends Controller {

    private $pacoteCustomer;
    public function __construct(Customer $pacoteCustomer, Orcamento $pacoteOrcamento){
        $this->pacoteCustomer = $pacoteCustomer;
        $this->pacoteOrcamento = $pacoteOrcamento;
    }
    /*
     * Quando entra na área administrativa é apresentada essa página
     */
    public function index() {

        $orcamentos = $this->pacoteOrcamento->paginate(25);
        $customers = $this->pacoteCustomer;
        return view('diretoria.orcamentos.listorcamentos')
            ->with(compact('orcamentos', 'customers'))
            ->with('page','listorcamentos');
    }

}
