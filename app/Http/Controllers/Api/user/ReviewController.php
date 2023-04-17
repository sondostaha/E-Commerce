<?php

namespace App\Http\Controllers\Api\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderDetails;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{

    public function store($product_id, Request $request)
    {
        $orders = OrderDetails::where('product_id',$product_id)->first();
        if($orders)
        {
            $product = Product::findOrFail($product_id);
            $request->validate([
                'user_review' =>'required'
            ]);

            Review::create([
                'user_id' => Auth::id(),
                'product_id' => $product_id ,
                'user_review' => $request->user_review
            ]);
            
        return response()->json(['message' => 'Thank you for your Review']);
        }else
        {
            return response()->json(['message' => 'sorry only  customers are allowed to review products']);
            
        }
    }
}
