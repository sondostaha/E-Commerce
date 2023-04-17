<?php

namespace App\Http\Controllers\Api\admins;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\SubCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class adminsController extends Controller
{
  
    public function adminCategry()
    {
        $categories = Categories::with('sub_category')->get();
        return response()->json($categories);
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' =>'required|max:50',
            'description' => 'required',
            'image' => 'required|image'
        ]);


            $image = $request->file('image');

            $extension = $image->getClientOriginalExtension();
            $image_name = uniqid().'.'.$extension;

            $image->move(public_path("category/images/"),"$image_name");

        
       $category = Categories::create([
            'admin_id' => Auth::id(),
            'name' => $request->name,
            'description' => $request->description,
            'image' => $image_name,

           
        ]);
        return response()->json(['message' => 'category added successfully', 'category' => $category ]);
    }   

    public function update($id , Request $request)
    {
        $category = Categories::findOrFail($id);

        $request->validate([
            'name' =>'required|max:50',
            'description' => 'required',
            'image' => 'required|image'
        ]);

        
            $image = $request->file('image');

            $extension = $image->getClientOriginalExtension();
            $image_name = uniqid().'.'.$extension;
            
            $image->move(public_path("category/images/"),"$image_name");

            $category->updated([
                'admin_id' => Auth::id(),
                'name' => $request->name,
                'description' => $request->description,
                'image' => $image_name
            ]);
        

       
        return response()->json(['message' => 'category updated successfully', 'category' => $category ]);

    }

    public function delete($id)
    {
        $category = Categories::findOrFail($id);
        $category_image = $category->image;
        $path = public_path('category/images/'.$category->image);
        if(file_exists($path)){
        unlink($path);
        }

        $category->delete($id);

        return response()->json(['message' => 'category deleted successfully',201]);

    }
   
    public function storeSubCategroy(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50',
            'description' => 'required',
            'image' => 'required|image'            
        ]);

         
        $image = $request->file('image');

        $extension = $image->getClientOriginalExtension();
        $image_name = uniqid().'.'.$extension;
        
        $image->move(public_path("category/sub_categories/images/"),"$image_name");

       $sub_category = SubCategories::create([
            'admin_id' => Auth::id(),
            'category_id' => $request->category,
            'name' => $request->name,
            'description' => $request->description,
            'image' => $image_name
        ]);

        return response()->json(['message' => 'sub category added successfully', 'category' => $sub_category ]);

    }


    public function update_subCategories($id , Request $request)
    {

        $sub_categories = SubCategories::findOrFail($id);
        
            $image = $request->file('image');

            $extension = $image->getClientOriginalExtension();
            $image_name = uniqid().'.'.$extension;
            
            $image->move(public_path("category/sub_categories/images/"),"$image_name");
    
            $sub_categories->create([
                'admin_id' => Auth::id(),
                'category_id' => $request->category,
                'name' => $request->name,
                'description' => $request->description,
                'image' => $image_name,
            ]);
            return response()->json(['message' => 'sub category updated successfully', 'category' => $sub_categories ]);

    }

    public function deleteSubCategories($id)
    {
        $sub_categories = SubCategories::findOrFail($id);

        $image_name = $sub_categories->image;

        $path = public_path('/category/sub_categories/images/'."$image_name");
        if(file_exists($path)){
            unlink($path);
        }
        $sub_categories->delete($id);

        return response()->json(['message' => 'aub category deleted successfully']);

    }

    public function subCategories()
    {
        $sub_categories = SubCategories::with('category','products')->get();

        return response()->json($sub_categories);
    }

    public function orders()
    {
     $orders = Order::all();
     return response()->json($orders);
     ;
    }

    public function showOrder($id)
    {
     $orders = Order::with('order_detail')->where('id',$id)->first();
     $orders['orderdetail'] = OrderDetails::with('products')->where('order_id',$id)->get();
    // dd($orders);
    return response()->json($orders);

    }
}
