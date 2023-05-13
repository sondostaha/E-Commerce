<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\CrudOperation;
use App\Models\Carts;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CradController extends Controller 
{
    public function index()
    {
        $carts = Carts::with('user','product')->where('user_id',Auth::id())->get();
      
        return view('front-end.Card',compact('carts'));
    }

    public function validateData(Request $request)
    {
        $request->validate([
            'quantity' => 'required',
        ]);
    }

    public function add($id, Request $request)
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
                   $this->validateData($request);
                   
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

    public function edtie($id)
    {
        $cart = Carts::with('product')->findOrFail($id);

        return view('front-end.editCard',compact('cart'));
    }
    public function update($id , Request $request)
    {
        $cart = Carts::findOrFail($id);

        $cart->update([
            'quantity' => $request->quantity
        ]);

        session()->flash('Edite' ,'quantity updated successfully');
        return back();
    }

    public function delete($id)
    {
        $cart = Carts::FindOrFail($id);

        $cart->delete($id);
        session()->flash('Delete','Deleted successfully');
        return back();
    }
}
