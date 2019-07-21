<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\MessageBag;
use App\Pizza;
use App\Order;
use App\OrderPizza;

class PizzasController extends Controller
{


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function list(Request $request)
    {
        return  Pizza::all();
    }

    public function create_order(Request $request)
    {
        $pizzas=$request->input('pizzas');
        $id_user=(Auth::user()->id);
        DB::transaction(function () use ($pizzas,$id_user) {
            $order=new Order();
            $order->id_user=$id_user;
            $order->save();
            foreach ($pizzas as $key => $value) {
                $orderPizza=new OrderPizza();
                $orderPizza->id_pizza=$value['id'];
                $orderPizza->id_order=$order->id;
                $orderPizza->quantity=$value['cantidad'];
                $orderPizza->save();
            }
        });
        return 'ok';
    }
}
