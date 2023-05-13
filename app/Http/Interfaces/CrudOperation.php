<?php
namespace App\Http\Interfaces ;

use Illuminate\Http\Request;

interface CrudOperation {
    function add();
    function store(Request $request);
    function edite($id);
    function update($id ,Request $request);

    function  delete($id);
    function validateData(Request $request);
    
}