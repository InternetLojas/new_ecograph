<?php namespace Ecograph\Http\Controllers;

use Ecograph\Http\Requests;
use Ecograph\Http\Controllers\Controller;

use Ecograph\Order;
use Illuminate\Http\Request;

class AdminPedidosController extends Controller {
    private $pacoteOrder;

    public function __construct(Order $pacoteOrder){
        $this->pacoteOrder = $pacoteOrder;
    }
    /*
 * Quando entra na área administrativa é apresentada essa página
 */
    public function index() {

        $orders = $this->pacoteOrder->paginate(25);
        return view('diretoria.pedidos.listpedidos')
            ->with(compact('orders'))
            ->with('page','listpedidos');
    }

}
