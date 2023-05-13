<?php 

namespace App\Services ;

use App\Http\Traits\ImageUploader;
use App\Models\SubCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubCategory {
    use ImageUploader;
    public function store(Request $request)
    {
        $destenation = public_path("category/sub_categories/images/") ;
    
        SubCategories::create([
            'admin_id' => Auth::id(),
            'category_id' => $request->category,
            'name' => $request->name,
            'description' => $request->description,
            'image' => $this->uploadImage($request, $destenation),

        ]);

        session()->flash('Add' ,'Sub Category Added Sussfully');
        return back();
    }
    
}