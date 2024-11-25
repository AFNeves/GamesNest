<?php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\ProductKey;
use Illuminate\View\View;

class KeyController extends Controller{
    public function list(string $id) : View{

        $orders = order::All()->where('user_id', $id);

        return view('pages.keysiventory', ['orders' => $orders]);
    }
}