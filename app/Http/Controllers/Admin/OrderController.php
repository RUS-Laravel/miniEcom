<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;

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
}
