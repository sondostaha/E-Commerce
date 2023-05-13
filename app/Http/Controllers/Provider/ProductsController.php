<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\CrudOperation;
use App\Models\Product;
use App\Models\SubCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller implements CrudOperation
{
    public function add()
    {
        $sub_categories = SubCategories::all();
        return view('provider.products.add',compact('sub_categories'));
    }

    public function validateData(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50',
             'description' => 'required',
             'image' => 'required|image',
             'original_price' => 'required|numeric',
             'selling_price' => 'required|numeric',
             'quantity' => 'required|numeric',
        ]);
    }
    public function store(Request $request)
    {
       
        $this->validateData($request);

        $image = $request->file('image');
        $extention = $image->getClientOriginalExtension();
        $image_name = uniqid().'.'.$extention;


        $provider_name = Auth::user()->name;
        $image->move(public_path('products/'),"$image_name");

        Product::create([
            'provider_id' => Auth::id(),
            'name' => $request->name,
            'sub_category_id' => $request->category,
            'description' => $request->description,
            'image' => $image_name,
            'original_price' => $request->original_price,
            'selling_price' => $request->selling_price,
            'quantity' => $request->quantity,
        ]);

        session()->flash('Add','Product Added Successfully');
        return back();

    }

    public function edite($id)
    {
        $product = Product::findOrFail($id);
        $sub_categories = SubCategories::all();

        return view('provider.products.edite',compact('product','sub_categories'));
    }

    public function update($id , Request $request)
    {
       
        $product = Product::findOrFail($id);

        $this->validateData($request);

        $product->update([
            'name' => $request->name,
            'sub_category_id' => $request->category,
            'description' => $request->description,
            'original_price' => $request->original_price,
            'selling_price' => $request->selling_price,
            'quantity' => $request->quantity,   
        ]);

        session()->flash('Edite','Product Edited Successfully');
        return back();
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);

        $path = public_path('product/'.$product->image);
        if(file_exists($path)){
            unlink($path);
        }
        $product->delete($id);
        session()->flash('Delete','Product delete Successfully');
        return back();

    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        
        return view('provider.products.add_products_details',compact('product'));
    }
}
