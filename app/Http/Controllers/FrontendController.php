<?php

namespace App\Http\Controllers;

use App\Models\Carts;
use App\Models\Categories;
use App\Models\Favourite;
use App\Models\Product;
use App\Models\ProductDetails;
use App\Models\SubCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $categories = Categories::all();
        $sub_categories = SubCategories::with('category')->get();
        return view('front-end.index',compact('products','categories','sub_categories'));
    } 
    public function category()
    {
        $categories = Categories::all();
        
        return view('front-end.category',compact('categories'));
    }
    public function showcategory($id)
    {
        $sub_categories = SubCategories::where('category_id',$id)->get();

        $category = Categories::findOrFail($id);

        return view('front-end.show_categories',compact('sub_categories','category'));
    }
    public function sub_categories()
    {
        $sub_categories = SubCategories::with('category')->get();
        return view('front-end.sub_categories',compact('sub_categories'));
    }

    public function showSub_category($id)
    {
        $products = Product::where('sub_category_id',$id)->get();

        $sub_categories = SubCategories::findOrFail($id);

        return view('front-end.show_sub_categories',compact('sub_categories','products'));
    }

    public function show_product($id)
    {
        $product = Product::findOrFail($id);
        $product['productdetail'] = ProductDetails::where('product_id',$id)->get();

        return view('front-end.view_product',compact('product'));
    }

    public function addToCart($id, Request $request)
    {
       

        if(Auth::check()){
            $product_check = Product::where('id',$id)->first();
            if($product_check)
            {
                $cart_check = Carts::where('product_id',$id)->where('user_id',Auth::id())->first();
                if($cart_check){

                  session()->flash('exist','this product already exists');
                    return back();
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
                    session()->flash('Add',' product added to your cart successfully');
                    return back();
                }
            }
        }else {
            session()->flash('login','you need to login first');
            return route('login');
        }
    }

    public function add_wishlist($id)
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

    public function cart()
    {
        $carts = Carts::with('user','product')->where('user_id',Auth::id())->get();
      
        return view('front-end.Card',compact('carts'));
    }

    public function wishlist()
    {
        $wishs = Favourite::with('user','product')->where('user_id',Auth::id())->get();
      
        return view('front-end.wishlist',compact('wishs'));
    }

    public function delete_cart($id)
    {
        $cart = Carts::FindOrFail($id);

        $cart->delete($id);
        session()->flash('Delete','Deleted successfully');
        return back();
    }

    public function delete_wish($id)
    {
        $wish = Favourite::FindOrFail($id);

        $wish->delete($id);
        session()->flash('Delete','Deleted successfully');
        return back();
    }

    public function edite_cart($id)
    {
        $cart = Carts::with('product')->findOrFail($id);

        return view('front-end.editCard',compact('cart'));
    }
    public function update_cart($id , Request $request)
    {
        $cart = Carts::findOrFail($id);

        $cart->update([
            'quantity' => $request->quantity
        ]);

        session()->flash('Edite' ,'quantity updated successfully');
        return back();
    }
}
