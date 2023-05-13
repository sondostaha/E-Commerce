<?php 
namespace App\Http\Interfaces;

use Illuminate\Http\Request;

interface AllData{
    function all()  ;

    function store($id = null , Request $request);
    function  delete($id);
    function validateData(Request $request);
    
}