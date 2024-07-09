<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    function category()
    {
        $categories = Category::all();
        return view('admin.category.category', compact('categories'));
    }

    function category_store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|unique:categories,category_name',
            'icon' => 'required|image',
        ]);

        $icon =  $request->icon;
        $extension = $icon->extension();
        $file_name = Str::lower(str_replace(' ', '-', $request->category_name)) . random_int(10000, 50000) . '.' . $extension;

        Image::make($icon)->save(public_path('uploads/category/' . $file_name));

        Category::insert([
            'category_name' => $request->category_name,
            'icon' => $file_name,
            'created_at' => Carbon::now(),
        ]);
        return back()->with('category_success', 'New Category Added Successfull!');
    }

    function category_edit($category_id)
    {
        $category = Category::find($category_id);
        return view('admin.category.category_edit', compact('category'));
    }

    function category_update(Request $request, $category_id)
    {
        $request->validate([
            '*' => 'required',
        ]);

        if ($request->icon == '') {
            Category::find($category_id)->update([
                'category_name' => $request->category_name,
            ]);
            return back();
        } else {
            // unlink photo
            $category = Category::find($category_id);
            $category_img = public_path('uploads/category/' . $category->icon);
            unlink($category_img);

            // insert photo
            $icon =  $request->icon;
            $extension = $icon->extension();
            $file_name = Str::lower(str_replace(' ', '-', $request->category_name)) . random_int(10000, 50000) . '.' . $extension;

            Image::make($icon)->save(public_path('uploads/category/' . $file_name));

            // update photo
            Category::find($category_id)->update([
                'category_name' => $request->category_name,
                'icon' => $file_name,
            ]);
            return back();
        }
    }

    function category_soft_delete($category_id)
    {
        Category::find($category_id)->delete();
        return back()->with('soft_delete', 'Category move to Trash!');
    }

    function category_trash()
    {
        $categories = Category::onlyTrashed()->get();
        return view('admin.category.category_trash', compact('categories'));
    }

    function category_restore($category_id)
    {
        Category::onlyTrashed()->find($category_id)->restore();
        return back()->with('restore', 'Category Restore!');
    }

    function category_permanent_delete($category_id)
    {
        $category = Category::onlyTrashed()->find($category_id);
        $category_img = public_path('uploads/category/' . $category->icon);
        unlink($category_img);

        Category::onlyTrashed()->find($category_id)->forceDelete();

        Subcategory::where('category_id',$category_id)->update([
            'category_id' => 1,
        ]);
        return back()->with('category_delete', 'Category Permant Deleted Successfull!');
    }

    function checked_delete(Request $request)
    {
        foreach ($request->category_id as $category) {
            Category::find($category)->delete();
        }
        return back()->with('soft_delete', 'Category move to Trash!');
    }

    function checked_restore(Request $request)
    {

        foreach ($request->category_id as $category) {
            Category::onlyTrashed()->find($category)->restore();
        }
        return back()->with('restore', 'Category Restore!');
    }
}
