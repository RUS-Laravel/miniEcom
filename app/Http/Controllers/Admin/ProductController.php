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

    public function store_image(ProductStoreRequest $request)
    {
        $image = $request->file('file');
        $imageName = time() . rand(1, 100) . '.' . $image->extension();
        $image->move(public_path('images'), $imageName);
        return response()->json([
            'success' => $imageName ?? null,
            '$image' => $image
        ]);
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
        //return self::json_response(data: $request->all());
        dd($_FILES);
        dd($request->file('file'));
        /*$imageName = time().rand(1,100).'.'.$image->getClientOriginalExtension();
        $image->move(public_path('/images/products'),$imageName);
        $res = Product::create($request->all());
         $res->image()->create([
            'name' => $imageName,
            'path' => 'images/products/'
         ]);
        return redirect()->route('admin.products.index');*/
    }

    public function edit($id)
    {
        // $cats = Category::whereNull('parent_id')->with('categories')->get();
        $product = Product::find($id);
        $parents = Category::whereNull('parent_id')->with('categories.categories')->get();

        return view('admin.products.edit', compact('parents', 'product'));
    }

    public function update(ProductStoreRequest $request)
    {
        Product::where('id', $request->id)->update($request->only(app(Product::class)->getFillable()));
        return redirect()->route('admin.products.index');
    }

    public function delete($id)
    {
        Product::find($id)->delete();
        return redirect()->route('admin.products.index');
    }
}
