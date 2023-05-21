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

    public function detail($slug=null, $rowId=null)
    {
        $product = Product::with('category:id,name')->with('review_rating')->where([
            'id' => $rowId,
            'slug' => $slug,
        ])->first();
        $colors = Color_Products::with('color')->get();
        $sizes = Product_Size::with('size')->get();
        $users = User::all();
        return view('web.products.detail', compact('product','colors','sizes','users'));
    }

    public function tag($tag)
    {
        $products = Product::where('title', 'like', '%' . $tag . '%')->with('category:id,name,tags')->get();
        $product_colors = Color_Products::with('color:id,color_name')->get();
        $product_sizes = Product_Size::with('size:id,size')->get();
        return view('web.products.cat_tag', compact('products','product_colors','product_sizes'));
    }

    public function review_rating(Request $request){
        dd($request->all());
    }

    public function wishlist_add($id){
        $wish = WishList::where('product_id', $id)
                            ->where('user_id', auth('client')->user()->id)
                            ->first();
        if(!isset($wish)){
            $data = [
                'user_id' => auth('client')->user()->id,
                'product_id' => $id,
                'wish'=> 1
            ];
            $res = WishList::create($data);
        }
        else{
            $data = [
                'user_id' => auth('client')->user()->id,
                'product_id' => $id,
                'wish'=> 0
            ];
            $res = WishList::where('product_id', $id)
                            ->where('user_id', auth('client')->user()->id)
                            ->where('wish', '1')
                            ->update($data);
        }
        return $res;
    }
}
