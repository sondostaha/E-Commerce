<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Favourite;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishListController extends Controller
{

    public function index()
    {
        $wishs = Favourite::with('user','product')->where('user_id',Auth::id())->get();
      
        return view('front-end.wishlist',compact('wishs'));
    }
    
    public function add($id)
    {
        
        if(Auth::check()){
            $product_check = Product::where('id',$id)->first();
            if($product_check)
            {
                $cart_check = Favourite::where('product_id',$id)->where('user_id',Auth::id())->first();
                if($cart_check){

                  session()->flash('exist','this product already exists in your withlist');
                    return back();
                }
                else
                {

                    Favourite::create([
                        'product_id' => $id,
                        'user_id' => Auth::id(),

                    ]);
                    session()->flash('Add',' product added to your wishlist successfully');
                    return back();
                }
            }
        }else {
            session()->flash('login','you need to login first');
            return route('login');
        }
    }

  
  



    public function delete($id)
    {
        $wish = Favourite::FindOrFail($id);

        $wish->delete($id);
        session()->flash('Delete','Deleted successfully');
        return back();
    }
}
