<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;

use App\Models\Categories;
use App\Models\Favourite;
use App\Models\Product;
use App\Models\ProductDetails;
use App\Models\RatingProduct;
use App\Models\Review;
use App\Models\SubCategories;
use App\Repository\CategoryRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller  
{
    protected  $categories ;

   public function  __construct(CategoryRepository $categories)
   {
        $this->categories = $categories ;
   }
    public function index()
    {
        $products = Product::all();
       // dd($this->categories->all());
        $categories = $this->categories->allCategories();
        $sub_categories = SubCategories::with('category')->get();
        $reviews = Review::with('user')->get();
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
        $rating = RatingProduct::where('product_id' , $id)->get();
        $rating_sum  = RatingProduct::where('product_id' , $id)->sum('product_rating');
        $reviews = Review::with('user')->first();

        if($rating->count() > 0)
        {
            $rating_value = $rating_sum  /  $rating->count() ;
        }
        else
        {
            $rating_value = 0 ;
        }

        return view('front-end.view_product',compact('product','rating','rating_value','reviews'));
    }





}
