<?php

namespace App\Http\Controllers\Web;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    public function index()
    {
        return view('web.cart.index');
    }

    public function addToCart()
    {
        $product = Product::find(request('id'));
        Cart::add($product->id, $product->title, request('quantity'), $product->price);
        return redirect()->route('cart.index');
    }

    public function update_cart(Request $request){
        $rowId = $request->id;
        $qty = $request->qty;
       
        $result = Cart::update($rowId,['qty'=>$qty]);
        return response()->json([
            'message' => $result ? 'Cart Updated' : 'Error',
            'status' => (bool)$result
        ]);
    }

    public function show_product($rowId){
       $result= Cart::get($rowId);
       dd($result);
        //return view('');
    }

    public function remove($rowId)
    {
        Cart::remove($rowId);
        return redirect()->route('cart.index');
    }
}
