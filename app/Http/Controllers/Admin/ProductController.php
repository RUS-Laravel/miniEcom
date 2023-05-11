<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductStoreRequest;
use App\Http\Requests\Admin\ImageStoreRequest;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Image;
use App\Models\Color_Products;
use App\Models\Product_Size;

class ProductController extends BaseController
{
    public function index()
    {
        $products = Product::with('category:id,name')->get();
        return view('admin.products.index', compact('products'));
    }

    public function detail($id)
    {
        $product = Product::where('id', $id)
            ->with('category:id,name')
            //->with('color:id,color_name')
            //->with('size:id,size_name')
            ->first();
        $colors = Color_Products::with('color:id,color_name')->where('product_id',$id)->get();
        $sizes = Product_Size::with('size:id,size_name,size')->get();
        
        return view('admin.products.detail', compact('product','colors','sizes'));
    }

    public function create()
    {
        $parents = Category::whereNull('parent_id')->with('categories.categories')->get();
        return view('admin.products.create', compact('parents'));
    }

    public function store_image(ImageStoreRequest $request)
    {
        $image = $request->file('file');
        $imageName = time() . rand(1, 100) . '.' . $image->extension();
        $path = public_path('images/products/');
        $image->move($path, $imageName);
        
        $res = Product::create($request->all());
         $res->images()->create([
             'name' => $imageName,
             'path' => $path
         ]);
        return response()->json([
            'message' => $res ? 'Image inserted' : 'Error',
            'status' => (bool)$res
        ]);
        /*return response()->json([
            'success' => $imageName ?? null,
            '$image' => $image
        ]);*/
    }

    public function data(Request $request)
    {
        $search = $request->get('search');
        $select = $request->get('sort');

        $query = Product::with('category:id,name');

        if (!empty($search)) {
            $query = $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                    ->orWhere('stock', 'like', '%' . $search . '%')
                    ->orWhere('discount', 'like', '%' . $search . '%')
                    ->orWhere('price', 'like', '%' . $search . '%');
            });
        }

        if (!empty($select)) {
            $query = match ($select) {
                'low' => $query->orderBy('price', 'asc'),
                'high' => $query->orderBy('price', 'desc'),
                default => $query
            };
        }

        return response()->json([
            'data' => $query->paginate(11),
            'blade' => view('admin.products.table', ['products' => $query->paginate(11)])->render(),
            'req' => $request->all()
        ]);
    }

    public function store(ProductStoreRequest $request)
    {
        //return self::json_response(data: $request->all());
        $res = Product::create($request->all());
        /*$res->image()->create([
            'name' => $imageName,
            'path' => 'images/products/'
         ]);*/
        return redirect()->route('admin.products.index');
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
