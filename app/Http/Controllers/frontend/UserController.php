<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
use App\Models\RatingProduct;
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

   public function rating_product($product_id , Request $request)
   {
     // dd($request->product_rating);
      $product = Product::findOrFail($product_id);
      $rating = RatingProduct::where('user_id',Auth::id())->where('product_id',$product_id)->first();

      if( $rating )
      {
        
         $rating->update([
            'product_rating' => $request->product_rating
         ]);
      }
      else
      {
          RatingProduct::create([
            'user_id' => Auth::id(),
            'product_id' => $product_id,
            'product_rating' => $request->product_rating
         ]);   

     
      }

     
      session()->flash('Add', 'Thank you for rating our product');
      return back();
   }
}
