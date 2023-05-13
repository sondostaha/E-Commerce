<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\RatingProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
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
