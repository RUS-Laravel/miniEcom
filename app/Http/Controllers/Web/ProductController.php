<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Product_Size;
use App\Models\Color_Products;
use App\Models\Category;
use App\Models\Color;
use App\Models\User;
use App\Models\WishList;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        //view()->share('categories', Product::with('category:id,name')->active()->get());
        //view()->share('cats', Category::with('categories')->get());
    }

    public function detail($slug = null, $rowId = null)
    {
        $product = Product::with('category:id,name')->with('review_rating', 'colors.sizes')->where([
            'id' => $rowId,
            'slug' => $slug,
        ])->first();
        $sizes = $product->colors->first()->sizes ?? [];

        $users = User::all();
        return view('web.products.detail', compact('product', 'sizes', 'users'));
    }

    public function tag($tag)
    {
        $products = Product::where('title', 'like', '%' . $tag . '%')->with('category:id,name,tags')->get();
        $product_colors = Color_Products::with('color:id,color_name')->get();
        $product_sizes = Product_Size::with('size:id,size')->get();
        return view('web.products.cat_tag', compact('products', 'product_colors', 'product_sizes'));
    }

    public function review_rating(Request $request)
    {
        // product rating store olacaq
        return ($request->all());
    }

    public function sizes()
    {
        $sizes = Product::find(request('product_id'))->colors()
            ->where('id', request('color_id'))->first()->sizes;
        return response()->json([
            'blade' => view('web.products.size', compact('sizes'))->render()
        ]);
    }

    public function wishlist_add($id)
    {
        if (WishList::where('product_id', $id)->where('user_id', auth('client')->user()->id)->where('wish', '1')->count()) {
            $res = WishList::where('product_id', $id)
                ->where('user_id', auth('client')->user()->id)
                ->delete();
        } else {
            $data = [
                'user_id' => auth('client')->user()->id,
                'product_id' => $id,
                'wish' => 1
            ];
            $res = WishList::create($data);
        }
        return $res;
    }
}
