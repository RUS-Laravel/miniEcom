<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        view()->share('categories', Product::with('category:id,name')->active()->get());
        view()->share('cats', Category::with('categories')->get());
    }

    public function detail($slug, $id)
    {
        $product = Product::with('category:id,name')->where([
            'id' => $id,
            'slug' => $slug,
        ])->first();

        return view('web.products.detail', compact('product'));
    }
}
