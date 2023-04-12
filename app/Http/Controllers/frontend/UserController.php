<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
   public function index()
   {
    $orders = Order::where('user_id',Auth::id())->get();
    return view('front-end.orders',compact('orders'));
   }
   public function showOrder($id)
   {
    $orders = Order::with('order_detail')->where('id',$id)->where('user_id',Auth::id())->first();
    $orders['orderdetail'] = OrderDetails::with('products')->where('order_id',$id)->get();
   // dd($orders);
    return view('front-end.show_order',compact('orders'));
   }
}
