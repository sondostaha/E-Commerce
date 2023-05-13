<?php 
namespace App\Repository\RepoInterface;

use Illuminate\Http\Request;

interface CategoryRepoInterface{
    function allCategories()  ;

    function store( Request $request);
    
    function  delete($id);

    function update($id ,Request $request);

    function validateData(Request $request);
    
}