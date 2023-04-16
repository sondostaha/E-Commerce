<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
use App\Models\ProductDetails;
use App\Models\SubCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProviderController extends Controller
{
    public function index()
    {
        $products = Product::with('sub_category')->where('provider_id',Auth::id())->get();
        
        return view('provider.index',compact('products'));
    }

    public function allSubCategories()
    {
        $sub_categories = SubCategories::with('category')->get();
        return view('provider.subcategories',compact('sub_categories'));
    }

    public function add_products()
    {
        $sub_categories = SubCategories::all();
        return view('provider.products.add',compact('sub_categories'));
    }

    public function store_products(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50',
             'description' => 'required',
             'image' => 'required|image',
             'original_price' => 'required|numeric',
             'selling_price' => 'required|numeric',
             'quantity' => 'required|numeric',
        ]);

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

    public function edit_product($id)
    {
        $product = Product::findOrFail($id);
        $sub_categories = SubCategories::all();

        return view('provider.products.edite',compact('product','sub_categories'));
    }

    public function update_product($id , Request $request)
    {
        $request->validate([
            'name' => 'required|max:50',
             'description' => 'required',
             'original_price' => 'required|numeric',
             'selling_price' => 'required|numeric',
             'quantity' => 'required|numeric',
        ]);
        $product = Product::findOrFail($id);

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

    public function delete_product($id)
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

    public function product_details($id)
    {
        $product = Product::findOrFail($id);
        
        return view('provider.products.add_products_details',compact('product'));
    }

    public function store_details($id , Request $request)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'color' => 'required',
            'size' => 'required',
        ]);

        ProductDetails::create([
            'product_id' => $product->id,
            'color' => $request->color,
            'size' => $request->size
        ]);

        session()->flash('Add','Product Added Successfully');
        return back();
    }
    public function show_details($id)
    {
        $product = Product::with('product_detail')->findOrFail($id);
        $product['productdetail'] = ProductDetails::where('product_id',$id)->get();
        //$details = ProductDetails::with('products')->where('product_id',$id)->get();
        //dd($product);
        return view('provider.products.show',compact('product'));
    }

    public function orders()
    {
     $orders = Order::all();
     return view('provider.orders.index',compact('orders'));
    }

    public function showOrder($id)
    {
     $orders = Order::with('order_detail')->where('id',$id)->first();
     $orders['orderdetail'] = OrderDetails::with('products')->where('order_id',$id)->get();
    // dd($orders);
     return view('provider.orders.show',compact('orders'));
    }

}
