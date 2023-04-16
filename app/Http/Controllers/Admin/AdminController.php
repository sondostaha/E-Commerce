<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\SubCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }
    public function adminCategry()
    {
        $categories = Categories::all();
        return view('admin.categories.index',compact('categories'));
    }

    public function addCategory()
    {
        return view('admin.categories.add');
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

        
        Categories::create([
            'admin_id' => Auth::id(),
            'name' => $request->name,
            'description' => $request->description,
            'image' => $image_name,

           
        ]);

        session()->flash('Add' ,'Category Added Sussfully');
        return back();
    }   

    public function edite($id)
    {
        $category = Categories::findOrFail($id);
        return view('admin.categories.edite',compact('category'));
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
        

       
        session()->flash('Edite' ,'Category Edite Sussfully');
        return back();
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

        session()->flash('Delete' ,'Category Deleted Sussfully');
        return back();
    }
   
    public function addSubCategory()
    {
        $categories = Categories::all();
        return view('admin.sub_category.add',compact('categories'));
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

        SubCategories::create([
            'admin_id' => Auth::id(),
            'category_id' => $request->category,
            'name' => $request->name,
            'description' => $request->description,
            'image' => $image_name
        ]);

        session()->flash('Add' ,'Sub Category Added Sussfully');
        return back();
    }

    public function subCategories()
    {
        $sub_categories = SubCategories::with('category')->get();

        return view('admin.sub_category.index',compact('sub_categories'));
    }

    public function edit_subCategories($id)
    {
        $sub_categories = SubCategories::with('category')->findOrFail($id);
        $categories = Categories::all();
        return view('admin.sub_category.edite',compact('sub_categories','categories'));
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

            session()->flash('Edite' ,'Sub Category Edite Sussfully');
            return back();

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
        session()->flash('Delete', 'Sub_Category Deleted Successfully');
        return back();
    }

    public function orders()
    {
     $orders = Order::all();
     return view('admin.orders.index',compact('orders'));
    }

    public function showOrder($id)
    {
     $orders = Order::with('order_detail')->where('id',$id)->first();
     $orders['orderdetail'] = OrderDetails::with('products')->where('order_id',$id)->get();
    // dd($orders);
     return view('admin.orders.show',compact('orders'));
    }
}
