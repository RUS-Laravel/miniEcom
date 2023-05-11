<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Color_Products;
use App\Models\Product_Size;

class CategoryController extends Controller
{
    public function __construct()
    {
       /* view()->share('categories', Product::with('category:id,name')->active()->get());
        view()->share('cats', Category::with('categories')->get());*/
    }
    public function catalog($id){
        $products = Product::where('category_id',$id)->with('category:id,name')->get();
        $product_colors = Color_Products::with('color:id,color_name')->get();
        $product_sizes = Product_Size::with('size:id,size')->get();
        $category = Category::where('id',$id)->first();
        return view('web.products.catalog', compact('products','product_colors','product_sizes','category'));
    }

    
}
