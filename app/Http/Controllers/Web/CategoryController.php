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
    public function category()
    {
        $id = request()->id;
        $amount = request('amount');
        $color = request()->color;
        $size = request()->size;
        $sort = request('sort');
        $range = (object)request('range');
        $tag = request()->tag;

        $products = Product::where('category_id', $id)
            ->where('status', '1')
            ->with('category:id,name', 'colors', 'colors.sizes', 'review_rating');

        if (!empty($tag)) {
            $products = $products->where(function ($q) use ($tag) {
                $q->where('title', 'like', '%' . $tag . '%');
            });
        }

        if (request()->has('color') and !empty($color)) {
            $products = $products->whereHas('colors', function ($q) use ($color) {
                $q->whereIn('color_id', $color);
            });
            // $products = $products->where(function ($q) use ($color) {
            //     $q->whereIn('colors.color_id', $color);
            // });
        }
        if (request()->has('range') and !empty($range)) {
            $products = $products->whereBetween('price', [(int)$range->low, (int)$range->hight]);
            // $products = $products->where(function ($q) use ($color) {
            //     $q->whereIn('colors.color_id', $color);
            // });
        }

        if (!empty($size)) {
            $products = $products->whereHas('colors.sizes', function ($q) use ($size) {
                $q->whereIn('size_id', $size);
            });
            // $products = $products->where(function ($q) use ($size) {
            //     $q->whereIn('colors.sizes.size_id', $size);
            // });
        }

        if (!empty($sort)) {
            $products = match ($sort) {
                'price-high-to-low' => $products->orderBy('price', 'asc'),
                'price-low-to-high' => $products->orderBy('price', 'desc'),
                default => $products
            };
        }

        return response()->json([
            'data' => $products,
            'table' => view('web.category.category', ['products' => $products->get()])->render(),
            'req' => request()->all()
        ]);


        // ->sortByDesc('details_sum_quantity')->split(2);
        // $products = Product::where('category_id', $id)->with('category:id,name')->get();

        // return response()->json([
        //     'table' => view('web.category.category', compact('products'))->render()
        // ]);
    }

    public function catalog($id)
    {
        $best_ids = Order::with('details')->withSum('details', 'quantity')->get()
            ->sortByDesc('details_sum_quantity')
            ->split(2)
            ->first()
            ->pluck('details.*.product_id')
            ->flatten()
            ->unique()
            ->values();
        $bests = Product::whereIn('id', $best_ids)->get();

        $colors = Color::all();
        $sizes = Size::all();
        $category = Category::where('id', $id)->first();
        $max_price =Product::where('status','1')->max('price');
        return view('web.category.catalog', compact('id', 'colors', 'sizes', 'category','max_price','bests'));
        //return view('web.category.catalog', compact('products', 'product_colors', 'product_sizes', 'category'));
    }
}
