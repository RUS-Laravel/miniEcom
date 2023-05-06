<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return view('client.orders.index');
    }

    public function data()
    {
        $data = Order::with('details')->where('user_id', auth('client')->id())->get();
        return response()->json([
            'data' => $data,
            'table' => view('client.orders.table', compact('data'))->render(),
        ]);
    }
}
