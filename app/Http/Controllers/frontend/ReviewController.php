<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function add($product_id)
    {
        $product = Product::findOrFail($product_id);
        //$orders = Order::where('user_id',Auth::id())->get();
        $orders = OrderDetails::where('product_id',$product_id);
      //  dd($orders);

        return view('front-end.review.add',compact('orders','product'));
    }
    public function store($product_id, Request $request)
    {
        $product = Product::findOrFail($product_id);
        $request->validate([
            'user_review' =>'required'
        ]);

        Review::create([
            'user_id' => Auth::id(),
            'product_id' => $product_id ,
            'user_review' => $request->user_review
        ]);
        
        session()->flash('Add', 'Thank you for your Review');
        return back();
    }
}
