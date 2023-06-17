<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductStoreRequest;
use App\Http\Requests\Admin\ImageStoreRequest;
use App\Http\Requests\Admin\ProductUpdateRequest;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Image;
/*use App\Models\Color_Products;
use App\Models\Product_Size;*/

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
            ->with('review_rating.user', 'colors.sizes')
            ->first();
        $sizes = $product->colors->first()->sizes ?? [];
        //$allsizes = $product->colors->sizes ?? [];
        return view('admin.products.detail', compact('product', 'sizes'));
    }

    public function sizes()
    {
        $sizes = Product::find(request('product_id'))->colors()
            ->where('id', request('color_id'))->first()->sizes;
        return response()->json([
            'blade' => view('admin.products.select_size', compact('sizes'))->render()
        ]);
    }

    public function create()
    {
        $parents = Category::whereNull('parent_id')->with('categories.categories')->get();
        return view('admin.products.create', compact('parents'));
    }

    public function store_image(ImageStoreRequest $request)
    {
        $result = Product::find($request->product_id);

        if ($result) {
            $image = $request->file('file');
            $imageName = time() . rand(1, 100) . '.' . $image->extension();
            $path = public_path('images/products/');
            $image->move($path, $imageName);
            //return $result;die;
            $result->images()->create([
                'name' => $imageName,
                'path' => $path
            ]);

            return response()->json([
                'message' => $result ? 'Image inserted' : 'Error',
                'status' => (bool)$result
            ]);
        } else {
            return response()->json([
                'message' => "Please Create Product",
                'status' => false
            ]);
        }
    }


    public function delete_image($id)
    {
        $res = Image::find($id);
        if (file_exists(public_path('images/products/' . $res->name))) {
            $filedeleted = unlink(public_path('images/products/' . $res->name));
            if ($filedeleted) {
                $res->delete();
                return redirect()->back();
            }
        } else {
            echo 'Unable to delete the given file';
        }
    }

    /* public function productId()
    {
        $res = Product::orderBy('id','desc')->limit(1);
        return response()->json(['data'=>$res]);
     
    }*/

    public function data(Request $request)
    {
        $search = $request->get('search');
        $select = $request->get('sort');

        $query = Product::with('category:id,name');

        // if (!empty($search)) {
        //     $query = $query->where(function ($q) use ($search) {
        //         $q->where('title', 'like', '%' . $search . '%')
        //             ->orWhere('stock', 'like', '%' . $search . '%')
        //             ->orWhere('discount', 'like', '%' . $search . '%')
        //             ->orWhere('price', 'like', '%' . $search . '%');
        //     });
        // }

        // if (!empty($select)) {
        //     $query = match ($select) {
        //         'low' => $query->orderBy('price', 'asc'),
        //         'high' => $query->orderBy('price', 'desc'),
        //         default => $query
        //     };
        // }
        $recordsTotal = $query->get()->count();
        $countDatum = $recordsTotal;
        $countDatum = $query->get()->count();
        if (request()->get('length'))
            $length = request()->get('length');
        else
            $length = 1;
        if ($length != -1)
            $query->skip(request()->get('start'))->take($length);

        return response()->json([
            'data' => $query->get(),
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $countDatum,
            'draw' => $request->get('draw'),
            'draws' => $request->all(),
        ]);
    }

    public function store(ProductStoreRequest $request)
    {
        //return self::json_response(data: $request->all());
        $response = Product::create($request->all());
        /*$res->image()->create([
            'name' => $imageName,
            'path' => 'images/products/'
         ]);*/
        //return redirect()->route('admin.products.index');
        if ($response) {
            $res = Product::orderBy('id', 'desc')->limit(1)->first();
            return response()->json([
                'message' => $response ? 'Product inserted' : 'Error',
                'status' => (bool)$response,
                'product' => $res
            ]);
        }
    }

    public function edit($id)
    {
        // $cats = Category::whereNull('parent_id')->with('categories')->get();
        $product = Product::find($id);
        $parents = Category::whereNull('parent_id')->with('categories.categories')->get();

        return view('admin.products.edit', compact('parents', 'product'));
    }

    public function update(ProductUpdateRequest $request)
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
