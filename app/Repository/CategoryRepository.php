<?php 
namespace App\Repository;

use App\Repository\RepoInterface\CategoryRepoInterface;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\ImageUploader;

class CategoryRepository implements CategoryRepoInterface
{
    use ImageUploader;

    public $user;
   public function __construct()
   {

     $this->user = Auth::user();
   }
    public function allCategories()
    {
        return Categories::latest()->paginate(10);
    }

    public function store( Request $request)
    {
       
           


        $destenation = public_path("category/images/");

           // dd($this->user);
        
        Categories::create([
            'admin_id' => Auth::id(),
            'name' => $request->name,
            'description' => $request->description,
            'image' => $this->uploadImage($request ,$destenation),

           
        ]);
       
        
    }

    public function update($id ,Request $request)
    {

        $category = Categories::findOrFai($id);
        $image = $request->file('image');

        $extension = $image->getClientOriginalExtension();
        $image_name = uniqid().'.'.$extension;
        
        $image->move(public_path("category/images/"),"$image_name");

        $category->updated([
            'admin_id' => $this->user,
            'name' => $request->name,
            'description' => $request->description,
            'image' => $image_name
        ]);
    
    }

    public function delete($id)
    {
        $category = Categories::findOrFail($id);  
        $category->delete($id);

    }

    public function validateData(Request $request)
    {
        $request->validate([
            'name' =>'required|max:50',
            'description' => 'required',
            'image' => 'required|image'
        ]);

    }
}