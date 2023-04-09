<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\Models\SubCategories;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    public function index()
    {
        return view('provider.index');
    }

    public function allSubCategories()
    {
        $sub_categories = SubCategories::with('category')->get();
        return view('provider.subcategories',compact('sub_categories'));
    }
}
