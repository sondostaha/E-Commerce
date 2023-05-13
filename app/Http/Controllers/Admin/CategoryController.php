<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\AllData;
use App\Http\Interfaces\CrudOperation;
use App\Models\Categories;
use App\Repository\CategoryRepository;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller implements CrudOperation
{
    use AuthorizesRequests ;
    private $categories ; 
    public function __construct(CategoryRepository $categories)
    {
        $this->categories = $categories ;
      
    }
    public function index()
    {

        $categories = $this->categories->allCategories();
        return view('admin.categories.index',compact('categories'));
    }

    public function validateData(Request $request)
    {
        $request->validate([
            'name' =>'required|max:50',
            'description' => 'required',
            'image' => 'required|image'
        ]);
    }

    public function add()
    {
        return view('admin.categories.add');
    }

    public function store(Request $request)
    {
        
        $this->validateData($request);

         $this->categories->store($request);

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

        $this->validateData($request);
        
        $this->categories->update($id,$request);
        
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
        $this->categories->delete($id);
        session()->flash('Delete' ,'Category Deleted Sussfully');
        return back();
    }
}
