<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Pizza;
use App\Models\Pizza_price_list;
use App\Models\Pizza_ingredients;
use App\Models\Delivery_method;
use App\Models\Delivery_driver;
use App\Models\Order;

class PizzaController extends Controller
{
    //
    public function __construct()
    {

    }

    public function orderPage(Request $request)
    {
        $pizzas = Pizza::all();
        $pizza_ingredients = Pizza_ingredients::all();
        $delivery_methods = Delivery_method::all();
        return view('order', compact('pizzas', 'pizza_ingredients', 'delivery_methods'));
    }

    public function order(Request $request)
    {
        $data = $request->all();

        $rule = array(
            'pizza_id' => 'required',
            'delivery_method_id' => 'required',
            'address' => 'required',
        );

        $validator = \Validator::make($data, $rule);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->messages());
        }

        $order = new Order;
        $order->user_id = Auth::user()->id;
        $order->pizza_id = $request->pizza_id;
        $order->pizza_ingredient_id = $request->pizza_ingredient_id;
        $order->delivery_method_id = $request->delivery_method_id;
        if(Delivery_method::where('id', $request->delivery_method_id)->value('type') == 'delivery') {
            $order->delivery_driver_id = Delivery_driver::where('employee_id', Auth::user()->id)->value('id');
            $order->address = $request->address;
        }
        $order->save();

        Session::flash('flash_message', 'Thank you for ordering pizza!');
        return redirect()->back();
    }
}
