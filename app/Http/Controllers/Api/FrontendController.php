<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Carts;
use App\Models\Categories;
use App\Models\Favourite;
use App\Models\Product;
use App\Models\ProductDetails;
use App\Models\RatingProduct;
use App\Models\Review;
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
        return response()->json(['products ' => $products , 'categories' => $categories ,'Sub Categories' => $sub_categories]);
    } 
    public function category()
    {
        $categories = Categories::all();
        
        return response()->json([ 'categories' => $categories ]);

    }
    public function showcategory($id)
    {
        $sub_categories = SubCategories::where('category_id',$id)->get();

        $category = Categories::findOrFail($id);

        return response()->json([ 'category' => $category ]);

    }
    public function sub_categories()
    {
        $sub_categories = SubCategories::with('category')->get();
        return response()->json([ 'Sub Categories' => $sub_categories ]);

    }

    public function showSub_category($id)
    {
       
        $sub_categories = SubCategories::with('products')->findOrFail($id);

        return response()->json([ 'Sub Categories' => $sub_categories ]);

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

        return response()->json(['products ' => $product , 'rating' => $rating_value ,'reviews' => $reviews]);
        
    }

   
}
