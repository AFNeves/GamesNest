<?php
namespace App\Http\Controllers;

use App\Models\Order;

use Illuminate\View\View;

class OrderController extends Controller{

    public function list(string $id) : View{

        $orders = order::all()->where('user_id', $id);

        return view('pages.ordershistory', ['orders' => $orders]);
    }

    public function details(string $id) : View{

        $order = Order::findOrFail($id);

        return view('pages.orderdetails', ['order' => $order]);
    }

}