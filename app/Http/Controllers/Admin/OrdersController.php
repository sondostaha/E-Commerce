<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetails;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index()
    {
     $orders = Order::all();
     return view('admin.orders.index',compact('orders'));
    }

    public function show($id)
    {
     $orders = Order::with('order_detail')->where('id',$id)->first();
     $orders['orderdetail'] = OrderDetails::with('products')->where('order_id',$id)->get();
    // dd($orders);
     return view('admin.orders.show',compact('orders'));
    }
}
