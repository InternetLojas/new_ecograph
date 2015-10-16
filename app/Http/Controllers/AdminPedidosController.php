<?php namespace Ecograph\Http\Controllers;

use Ecograph\Http\Requests;
use Ecograph\Http\Controllers\Controller;

use Ecograph\Order;
use Ecograph\OrderIten;
use Ecograph\Product;
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
        return view('diretoria.pedidos.index')
            ->with(compact('orders'))
            ->with('page','listpedidos');
    }

    public function Items($id, OrderIten $orderIten, Product $product) {
        $order = $this->pacoteOrder->find($id);
        $orderItem = $order->OrderItem;
        //dd($orderItem);

        //$category = $this->categoryModel->find($id);
        //$description = $category_description->find($id);
        //$CategoryProduct = $category->CategoryProduct()->paginate(24);
        //$this->MudaImage($id, $category_description, $product, $category);
        return view('diretoria.pedidos.index', compact('order','orderItem'))

            ->with('page','items_pedidos');
    }

}
