<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Carts;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $carts = Carts::with('product','user')->where('user_id',Auth::id())->get();
        return view('front-end.checkout',compact('carts'));
    }

    public function placeOrder(Request $request)
    {
       // dd($request->all());

        $carts = Carts::with('product')->where('user_id',Auth::id())->get();

        $request->validate([
           'last_name' => 'required|max:50' , 
            'phone' => 'required|numeric' ,
            'address_1' => 'required' ,
            'address_2' => 'required' ,
            'city' => 'required' ,
            'state' => 'required',
            'country' => 'required',
            'pin_code' => 'required|numeric' ,

        ]);

        $total = 0;
       
        Order::create([
            'user_id' => Auth::id(),
           'first_name' => $request->first_name ,
           'last_name' => $request->last_name,
           'email' => $request->email,
           'phone' => $request->phone,
           'address_1' => $request->address_1,
           'address_2' => $request->address_1, 
           'city' => $request->city,
           'state' => $request->state,
           'country' => $request->country,
           'pin_code' => $request->pin_code,
           'traking_number' =>'sondos'.rand(2222,8888),
        ]);

        
        
        $order_id = Order::latest()->first()->id;
        $order = Order::latest()->first();

        foreach($carts as $cart){
            $total += $cart->product->selling_price * $cart->quantity;

            $order->update([
                'total_price' => $total
            ]);

            OrderDetails::create([
                'order_id' => $order_id,
                'product_id' => $cart->product_id,
                'quantity' => $cart->quantity,
                'price' => $cart->product->selling_price,
            ]);
            $product = Product::where('id',$cart->product_id)->first();

            $product->update([
                'quantity' => $product->quantity - $cart->quantity
            ]);

        $cart->destroy($cart->id);

        }


        session()->flash('Add' ,'Place Order Successfully');

        return back();

    }
}
