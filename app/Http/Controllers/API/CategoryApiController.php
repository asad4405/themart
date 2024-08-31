<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryApiController extends Controller
{
    function get_category()
    {
        $categories = Category::select('category_name','icon')->get();
        return response()->json($categories);
    }
}
