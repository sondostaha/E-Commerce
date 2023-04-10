<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Product;
use App\Models\SubCategories;
use Illuminate\Http\Request;

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
}
