<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Product;
use App\Models\SubCategories;
use Illuminate\Http\Request;

class SearchController extends Controller
{
   
    public function search(Request $request)
    {
       if($request->search){
          $categories =  Categories::with('sub_category')->where('name','like','%'.$request->search.'%')->get();
          $sub_categories =  SubCategories::with('category','products')->where('name','like','%'.$request->search.'%')->get();
          $products =  Product::with('sub_category')->where('name','like','%'.$request->search.'%')->get();
       
          return view('front-end.index',compact('categories','sub_categories','products'));
         
 
       }else{
          return redirect()->back()->with('message',' Not found');
      }
 
    }
 
}
