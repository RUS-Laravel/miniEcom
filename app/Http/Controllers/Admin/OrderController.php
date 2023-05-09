<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\OrderDetail;


class OrderController extends BaseController
{
    public function index()
    {
        return view('admin.orders.index');
    }

    public function data()
    {
        $data = Order::with('details')->get();
        return response()->json([
            'data' => $data,
            'table' => view('admin.orders.table', compact('data'))->render(),
        ]);
    }

    public function detail($id)
    {
        $order = Order::with('user:id,name')->where('id',$id)->first();
        $order_details = OrderDetail::with('product:id,title')->where('order_id',$id)->get();
        return view('admin.orders.detail',compact('order','order_details'));
    }
}
