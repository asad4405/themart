<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderCancel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class OrderController extends Controller
{
    function orders()
    {
        $orders = Order::latest()->get();
        return view('admin.orders.order', compact('orders'));
    }

    function order_status_update(Request $request, $id)
    {
        Order::find($id)->update([
            'status' => $request->status,
        ]);
        return back();
    }

    function cancel_order($id)
    {
        $order = Order::find($id);
        return view('frontend.customer.cancel_order', compact('order'));
    }

    function cancel_order_request(Request $request, $id)
    {
        if ($request->image == '') {
            OrderCancel::insert([
                'order_id' => $id,
                'reason' => $request->reason,
                'created_at' => Carbon::now(),
            ]);
            return back()->with('req', 'Order Cancel Request Sent');
        } else {
            $image = $request->image;
            $extension = $image->extension();
            $file_name = random_int(10000, 90000) . '-' . time() . '.' . $extension;

            Image::make($image)->save(public_path('uploads/cancelorder/' . $file_name));

            OrderCancel::insert([
                'order_id' => $id,
                'reason' => $request->reason,
                'image' => $file_name,
                'created_at' => Carbon::now(),
            ]);
            return back()->with('req', 'Order Cancel Request Sent');
        }
    }

    function order_cancel_list()
    {
        $order_cancel_lists = OrderCancel::all();
        return view('admin.orders.cancel_order_list', compact('order_cancel_lists'));
    }

    function order_cancel_details($id)
    {
        $details = OrderCancel::find($id);
        return view('admin.orders.cancel_order_view', compact('details'));
    }

    function order_cancel_accept($id)
    {
        $details = OrderCancel::find($id);
        Order::find($details->order_id)->update([
            'status' => 5,
        ]);
        OrderCancel::find($id)->delete();
        return back();
    }
}
