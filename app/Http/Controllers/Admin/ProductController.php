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
        $parents = Category::whereNull('parent_id')->with('categories')->get();
        return view('admin.products.create',compact('parents'));
    }

    public function store(ProductStoreRequest $request)
    {
        return self::json_response(data: $request->all());
    }
}
