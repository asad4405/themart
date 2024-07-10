<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\Size;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    function add_inventory($product_id)
    {
        $product = Product::find($product_id);
        $colors = Color::all();
        $sizes = Size::where('category_id', $product->category_id)->get();
        $inventories = Inventory::where('product_id', $product->id)->get();
        return view('admin.product.inventory', [
            'product' => $product,
            'colors' => $colors,
            'sizes' => $sizes,
            'inventories' => $inventories,
        ]);
    }

    function inventory_store(Request $request, $product_id)
    {
        $request->validate([
            '*' => 'required',
        ]);

        if (Inventory::where([
            'product_id' => $product_id,
            'color_id' => $request->color_id,
            'size_id' => $request->size_id,
        ])->exists()) {
            Inventory::where([
                'product_id' => $product_id,
                'color_id' => $request->color_id,
                'size_id' => $request->size_id,
            ])->increment('quantity',$request->quantity);
            return back()->with('inventory_success', 'Inventory Added!');
        } else {
            Inventory::insert([
                'product_id' => $product_id,
                'color_id' => $request->color_id,
                'size_id' => $request->size_id,
                'quantity' => $request->quantity,
                'created_at' => Carbon::now(),
            ]);

            return back()->with('inventory_success', 'New Inventory Added!');
        }
    }

    function inventory_delete($inventory_id)
    {
        Inventory::find($inventory_id)->delete();
        return back()->with('inventory_delete','Inventory Deleted!');
    }
}
