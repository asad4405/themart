<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class SubCategoryController extends Controller
{
    function sub_category()
    {
        $categories = Category::all();
        return view('admin.subcategory.index', [
            'categories' => $categories,
        ]);
    }

    function sub_category_store(Request $request)
    {
        $request->validate([
            '*' => 'required',
        ]);

        if (Subcategory::where('category_id', $request->category_id)->where('sub_category_name', $request->sub_category_name)->exists()) {
            return back()->with('exists','Subcategory Name Already Exists in this Category');
        } else {

            Subcategory::insert([
                'category_id' => $request->category_id,
                'sub_category_name' => $request->sub_category_name,
                'created_at' => Carbon::now(),
            ]);
            return back()->with('sub_category_success', 'New Sub Category Added Successfull!');
        }
    }

    function sub_category_edit($subcategory_id)
    {
        $categories = Category::all();
        $subcategory = Subcategory::find($subcategory_id);
        return view('admin.subcategory.edit', compact('categories', 'subcategory'));
    }

    function sub_category_update(Request $request, $subcategory_id)
    {
        $request->validate([
            '*' => 'required',
        ]);
        Subcategory::find($subcategory_id)->update([
            'category_id' => $request->category_id,
            'sub_category_name' => $request->sub_category_name,
        ]);
        return back()->with('subcategory_success', 'Sub Category Updated Successfull!');
    }

    function sub_category_delete($subcategory_id)
    {
        Subcategory::find($subcategory_id)->delete();
        return back()->with('subcategory_delete', 'Sub Category Deleted Successfull!');
    }
}
