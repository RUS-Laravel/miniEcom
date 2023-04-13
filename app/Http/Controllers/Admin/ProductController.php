<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductStoreRequest;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class ProductController extends BaseController
{
    public function index()
    {
        return view('admin.products.index');
    }

    public function create()
    {
        $parents = Category::whereNull('parent_id')->with('categories.categories')->get();
        return view('admin.products.create', compact('parents'));
    }


    public function data()
    {
        $data = Product::with('category:id,name')->get();
        return response()->json([
            'data' => $data,
            'table' => view('admin.products.table', compact('data'))->render(),
        ]);
    }


    public function store(ProductStoreRequest $request)
    {
        Product::create($request->all());
        return redirect()->route('admin.products.index');
    }
}
