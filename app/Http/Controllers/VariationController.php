<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Color;
use App\Models\Size;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VariationController extends Controller
{
    function variation()
    {
        $categories = Category::all();
        $colors = Color::all();
        $sizes = Size::all();
        return view('admin.variation.variation', compact('categories','colors','sizes'));
    }

    function color_store(Request $request)
    {
        $request->validate([
            'color_name' => 'required',
        ]);

        Color::insert([
            'color_name' => $request->color_name,
            'color_code' => $request->color_code,
            'created_at' => Carbon::now(),
        ]);

        return back()->with('color_success', 'New Color Added Successfull!');
    }

    function color_delete($color_id)
    {
        Color::find($color_id)->delete();
        return back()->with('color_delete','Color Deleted!');
    }

    function size_store(Request $request)
    {
        $request->validate([
            'size_name' => 'required',
        ]);

        Size::insert([
            'category_id' => $request->category_id,
            'size_name' => $request->size_name,
            'created_at' => Carbon::now(),
        ]);

        return back()->with('size_success', 'New Size Added Successfull!');
    }

    function size_delete($size_id)
    {
        Size::find($size_id)->delete();
        return back()->with('size_delete', 'Size Deleted!');
    }
}
