<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Size;
use App\Models\Category;
use App\Models\Color;
use App\Models\User;
use App\Models\WishList;
use App\Models\ReviewRating;
use App\Models\Product_Size;
use Illuminate\Http\Request;
use App\Http\Requests\Web\ReviewRatingRequest;

class ProductController extends BaseController
{


    public function detail($slug = null, $rowId = null)
    {
        $product = Product::with('category:id,name')->with('review_rating.user', 'colors.sizes')->where([
            'id' => $rowId,
            'slug' => $slug,
        ])->first();
        $sizes = $product->colors->first()->sizes ?? [];

        //$users = User::all();
        return view('web.products.detail', compact('product', 'sizes'));
    }



    public function review_rating(ReviewRatingRequest $request)
    {
        $res = ReviewRating::create($request->all());
        return redirect()->back();
        //return $request->all();
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
        if (auth('client')->check()) {
            if (WishList::where('product_id', $id)->where('user_id', auth('client')->id())->where('wish', '1')->count()) {
                $res = WishList::where('product_id', $id)
                    ->where('user_id', auth('client')->user()->id)
                    ->delete();
            } else {
                $data = [
                    'user_id' => auth('client')->id(),
                    'product_id' => $id,
                    'wish' => 1
                ];
                $res = WishList::create($data);
            }
            return $res;
        } else {
            return redirect()->route('login.account');
        }
    }

    public function wishList()
    {
        if (auth('client')->check()) {
            $products = WishList::where('user_id', auth('client')->id())->with('product', 'product.category', 'product.review_rating')->get();
            return view('web.wishList.wishList', compact('products'));
        } else {
            return redirect()->route('login.account');
        }
    }

    public function tag($tag)
    {
        $products = Product::where('title', 'like', '%' . $tag . '%')
            ->where('status', '1')
            ->with('category:id,name')
            ->with('review_rating')
            ->get();
        return view('web.products.tag', compact('products'));
    }

    /*public function newsletter(){
        $color = request()->color;
        $size = request()->size;

        $res = Product_Size::where('size_id',$size)->where('product_color_id',$color)->first();
        return response()->json($res);
    }*/
}
