<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Color;
use App\Models\Size;
use App\Models\Order;


class CategoryController extends Controller
{
    public function category(){
        $id = request()->id;
        $amount = request()->amount;
        $color = request()->color; 
        $size = request()->size;
        $sort = request()->sort;
        $tag = request()->tag;

        $products = Product::where('category_id', $id)
                            ->where('status','1')
                            ->with('category:id,name','colors','colors.sizes','review_rating')
                            ->get();

        if (!empty($tag)) {       
                $products = $products->where(function ($q) use ($tag) {
                    $q->where('title', 'like', '%' . $tag . '%');
                });         
        }

        if (!empty($color)) {       
                $products = $products->where(function ($q) use ($color) {
                    $q->whereIn('colors.color_id', $color);
                });         
        }

        if (!empty($size)) {
            $products = $products->where(function ($q) use ($size) {
                $q->whereIn('colors.sizes.size_id', $size);
            });
        }

        if (!empty($sort)) {
            $products = match ($sort) {
                'price-high-to-low' => $products->ordeBy('price', 'asc'),
                'price-low-to-high' => $products->orderBy('price', 'desc'),
                default => $products
            };
        }

        return response()->json([
            'data' => $products,
            'table' => view('web.category.category', ['products' => $products])->render(),
            'req' => request()->all()
        ]);


       /* $id = request()->id;
        $bests = Order::withSum('details', 'quantity')->get()->sortByDesc('details_sum_quantity')->split(2);
        $products = Product::where('category_id', $id)->with('category:id,name')->get();
       
        return response()->json([
            'table' => view('web.category.category', compact('products'))->render()
        ]);*/
    }


    public function catalog($id)
    {
        $colors = Color::all();
        $sizes = Size::all();
        $category = Category::where('id', $id)->first();
        return view('web.category.catalog',compact('id','colors','sizes','category'));
        //return view('web.category.catalog', compact('products', 'product_colors', 'product_sizes', 'category'));
    }
}
