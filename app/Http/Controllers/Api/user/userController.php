<?php

namespace App\Http\Controllers\Api\user;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Carts;
use App\Models\Categories;
use App\Models\Favourite;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
use App\Models\RatingProduct;
use App\Models\SubCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class userController extends Controller
{
    public function orders()
    {
     $orders = Order::where('user_id',Auth::id())->get();
     return response()->json($orders);
    }
    public function showOrder($id)
    {
     $orders = Order::with('order_detail')->where('id',$id)->where('user_id',Auth::id())->first();
     $orders['orderdetail'] = OrderDetails::with('products')->where('order_id',$id)->get();
    // dd($orders);
    return response()->json($orders);
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
 
      
       return response()->json(['message' => 'Thank you for rating our product']); 
    }
 
    public function search(Request $request)
    {
       if($request->search){
          $categories =  Categories::with('sub_category')->where('name','like','%'.$request->search.'%')->get();
          $sub_categories =  SubCategories::with('category','products')->where('name','like','%'.$request->search.'%')->get();
          $products =  Product::with('sub_category')->where('name','like','%'.$request->search.'%')->get();
       
          return response()->json([$categories,$products,$sub_categories]);
         
 
       }else{
          return response()->json(['message' => 'Not Found']);
      }
 
    }

    public function addToCart($id, Request $request)
    {

            $product_check = Product::where('id',$id)->first();
            if($product_check)
            {
                $cart_check = Carts::where('product_id',$id)->where('user_id',Auth::id())->first();
                if($cart_check){

                    return response()->json(['message' => 'this product already exists']);
                }
                else
                {
                   
                    $request->validate([
                        'quantity' => 'required',
                    ]);
                    Carts::create([
                        'product_id' => $id,
                        'user_id' => Auth::id(),
                        'quantity' => $request->quantity

                    ]);
                    
                    return response()->json(['message' => 'product added to your Cart successfully']);
                    
                }
            }
        
    }

    public function add_wishlist($id)
    {
        

            $product_check = Product::where('id',$id)->first();
            if($product_check)
            {
                $cart_check = Favourite::where('product_id',$id)->where('user_id',Auth::id())->first();
                if($cart_check){

                    return response()->json(['message' => 'this product already exists']);

                }
                else
                {

                    Favourite::create([
                        'product_id' => $id,
                        'user_id' => Auth::id(),

                    ]);
    
                    return response()->json(['message' => 'product added to your wishlist successfully']);
                }
            }
       
    }

    public function cart()
    {
        $carts = Carts::with('user','product')->where('user_id',Auth::id())->get();
      
        return response()->json($carts);
    }

    public function wishlist()
    {
        $wishs = Favourite::with('user','product')->where('user_id',Auth::id())->get();
      
        return response()->json($wishs);

    }

    public function delete_cart($id)
    {
        $cart = Carts::FindOrFail($id);

        $cart->delete($id);
        return response()->json(['message' => 'product deleted from cart successfully']);
    }

    public function delete_wish($id)
    {
        $wish = Favourite::FindOrFail($id);

        $wish->delete($id);
        return response()->json(['message' => 'product deleted from wishlist successfully']);

    }

    public function update_cart($id , Request $request)
    {
        $cart = Carts::findOrFail($id);

        $cart->update([
            'quantity' => $request->quantity
        ]);

        return response()->json(['message' => 'quantity of product updated successfully']);
        
    }
 
 
}
