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
        return view('diretoria.clientes.index')
            ->with(compact('customers'))
            ->with('page','listclientes');
    }
    /**
     * quando o cliente deseja editar sua conta.
     *
     * @param  info  $id
     * @return view
     */
    public function ContaEdit($id) {

        $address = array();
        $customers = Customer::find($id);
// get the customer
        /*if ($info == 'dados') {
            $page = 'editarconta';
            $conta = '';
        }
        if ($info == 'endereco') {
            $page = 'editarendereco';
            $conta = ' - Meus endereços';
            $address_book = Addressbook::where('customer_id', $id)->get();
            $address = $address_book->toarray(); //print_r($address);exit;
        }
        if ($info == 'pedido') {
            $page = 'editarpedido';
            $conta = ' - Meus pedidos';
        }*/

// show the view and pass the nerd to it
        return view('diretoria.clientes.index')
            ->with('title', STORE_NAME . ' Minha conta - Meus Dados')
            ->with('page', 'editarconta')
            ->with('ativo', 'Minha Conta - Meus dados' )
            ->with('rota', 'clientes/index')
            ->with('customers', $customers)
            ->with('address', $address);
    }

}
