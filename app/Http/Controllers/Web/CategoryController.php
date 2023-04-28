<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class CategoryController extends Controller
{
    public function __construct()
    {
        view()->share('categories', Product::with('category:id,name')->get());
        view()->share('cats', Category::with('categories')->get());
    }
    public function catalog($id){
        $products = Product::where('category_id',$id)->with('category:id,name')->get();
        return view('web.products.catalog', compact('products'));
    }
}
