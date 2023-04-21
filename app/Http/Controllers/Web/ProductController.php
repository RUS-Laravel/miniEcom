<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function detail($slug, $id)
    {
        $product = Product::where([
            'id' => $id,
            'slug' => $slug,
        ])->first();

        return view('web.products.detail', compact('product'));
    }
}
