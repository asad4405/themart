<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Subscribe;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class HomeController extends Controller
{
    function dashboard()
    {
        $orders = Order::where('order_date', '>', Carbon::now()->subDays(7))
            ->groupBy('order_date')
            ->selectRaw('count(*) as total, order_date')
            ->get();

        $total_order = '';
        $order_date = '';

        foreach ($orders as $order) {
            $total_order .= $order->total . ',';
            $order_date .= Carbon::parse($order->order_date)->format('d M Y') . ',';
        }

        $total_order_info = explode(',', $total_order);
        $order_date_info = explode(',', $order_date);

        array_pop($total_order_info);
        array_pop($order_date_info);


        // sales charts


        $sales = Order::where('order_date', '>', Carbon::now()->subDays(7))
            ->groupBy('order_date')
            ->selectRaw('sum(total) as sum, order_date')
            ->get();

        $total_sales = '';
        $sales_date = '';

        foreach ($sales as $sale) {
            $total_sales .= $sale->sum . ',';
            $sales_date .= Carbon::parse($sale->order_date)->format('d M Y') . ',';
        }

        $total_sales_info = explode(',', $total_sales);
        $sales_date_info = explode(',', $sales_date);

        array_pop($total_sales_info);
        array_pop($sales_date_info);

        return view('dashboard', compact('total_order_info', 'order_date_info', 'total_sales_info', 'sales_date_info'));
    }

    function user_list()
    {
        $users = User::where('id', '!=', Auth::id())->paginate(5);
        return view('admin.user.user_list', compact('users'));
    }

    function user_delete($user_id)
    {
        User::find($user_id)->delete();
        return back()->with('user_delete', 'User Deleted Successfull!');
    }

    function user_add(Request $request)
    {
        $request->validate([
            '*' => 'required',
        ]);
        if ($request->password != $request->confirm_password) {
            return back()->with('pass_match', 'Password & Confirm Password does not Match!');
        }

        User::insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return back()->with('success', 'New User Added!');
    }

    function subscribe_list()
    {
        $subscribes = Subscribe::all();
        return view('admin.subscribe.subscribe_list', compact('subscribes'));
    }

    function subscribe_delete($subscribe_id)
    {
        Subscribe::find($subscribe_id)->delete();
        return back()->with('subscribe_delete', 'Subscriber Deleted!');
    }
}
