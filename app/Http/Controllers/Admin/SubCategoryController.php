<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\CrudOperation;
use App\Models\Categories;
use App\Models\SubCategories;
use App\Services\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubCategoryController extends Controller 
{
    public function index()
    {
        $sub_categories = SubCategories::with('category')->get();

        return view('admin.sub_category.index',compact('sub_categories'));
    }
    public function add()
    {
        $categories = Categories::all();
        return view('admin.sub_category.add',compact('categories'));
    }

    public function validateData(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50',
            'description' => 'required',
            'image' => 'required|image'            
        ]);
    }
    public function store(Request $request , SubCategory $sub_categories)
    {
       
        $this->validateData($request);
         
        $sub_categories->store($request);

        session()->flash('Add' ,'Sub Category Added Susccesfully');
        return back();
    }

  

    public function edite($id)
    {
        $sub_categories = SubCategories::with('category')->findOrFail($id);
        $categories = Categories::all();
        return view('admin.sub_category.edite',compact('sub_categories','categories'));
    }

    public function update($id , Request $request)
    {

        $sub_categories = SubCategories::findOrFail($id);

        $this->validateData($request);
        
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

    public function delete($id)
    {
        $sub_categories = SubCategories::findOrFail($id);

        $image_name = $sub_categories->image;

        // $path = public_path('/category/sub_categories/images/'."$image_name");
        // if(file_exists($path)){
        //     unlink($path);
        // }
        $sub_categories->delete($id);
        session()->flash('Delete', 'Sub_Category Deleted Successfully');
        return back();
    }
}
