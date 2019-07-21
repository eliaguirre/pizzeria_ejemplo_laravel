<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\MessageBag;
use App\User;
use App\Order;

class OrdersController extends Controller
{


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('check_admin');
    }


    public function index(Request $request)
    {
        return view('admin/orders');
    }
    public function add(Request $request)
    {
        return view('admin/orders_add');
    }

    public function list(Request $request)
    {
        return DB::table('orders')
            ->join('users', 'users.id', '=', 'orders.id_user')
            ->join('order_pizzas', 'order_pizzas.id_order', '=', 'orders.id')
            ->join('pizzas', 'pizzas.id', '=', 'order_pizzas.id_pizza')
            ->select(DB::raw('orders.*,GROUP_CONCAT("(",order_pizzas.quantity,") ",pizzas.name,"") as pizzas ,users.name,sum(pizzas.price*order_pizzas.quantity) as total'))
             ->groupBy('orders.id')
            ->get();
    }
}
