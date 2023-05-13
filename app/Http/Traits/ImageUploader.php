<?php 
namespace App\Http\Traits;

use Illuminate\Http\Request;

trait ImageUploader {
    public function uploadImage(Request $request , $destination)
    {
        $image = $request->file('image');

        $extension = $image->getClientOriginalExtension();
        $image_name = uniqid().'.'.$extension;

        $image->move($destination,"$image_name");
        
        return $image_name ;
    }
}