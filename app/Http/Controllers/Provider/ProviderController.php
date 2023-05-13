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



}
