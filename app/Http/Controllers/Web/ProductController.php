<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Product_Size;
use App\Models\Color_Products;
use App\Models\Category;
use App\Models\Color;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        //view()->share('categories', Product::with('category:id,name')->active()->get());
        //view()->share('cats', Category::with('categories')->get());
    }

    public function detail($slug=null, $rowId=null)
    {
        $product = Product::with('category:id,name')->where([
            'id' => $rowId,
            'slug' => $slug,
        ])->first();
        $colors = Color_Products::with('color')->get();
        $sizes = Product_Size::with('size')->get();
        return view('web.products.detail', compact('product','colors','sizes'));
    }

    public function tag($tag)
    {
        $products = Product::where('title', 'like', '%' . $tag . '%')->with('category:id,name,tags')->get();
        $product_colors = Color_Products::with('color:id,color_name')->get();
        $product_sizes = Product_Size::with('size:id,size')->get();
        return view('web.products.cat_tag', compact('products','product_colors','product_sizes'));
    }
}
