<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductDetails;
use Illuminate\Http\Request;

class ProductDetailsController extends Controller
{
    public function validateData(Request $request)
    {
        $request->validate([
            'color' => 'required',
            'size' => 'required',
        ]);
    }
    public function store($id , Request $request)
    {
        $product = Product::findOrFail($id);

      $this->validateData($request);

        ProductDetails::create([
            'product_id' => $product->id,
            'color' => $request->color,
            'size' => $request->size
        ]);

        session()->flash('Add','Product Added Successfully');
        return back();
    }
    public function show($id)
    {
        $product = Product::with('product_detail')->findOrFail($id);
        $product['productdetail'] = ProductDetails::where('product_id',$id)->get();
        //$details = ProductDetails::with('products')->where('product_id',$id)->get();
        //dd($product);
        return view('provider.products.show',compact('product'));
    }

}
