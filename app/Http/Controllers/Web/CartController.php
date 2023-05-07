<?php

namespace App\Http\Controllers\Web;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\BuyRequest;
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
        $row = Cart::add($product->id, $product->title, request('quantity'), $product->price, 0, [
            'slug' => $product->slug,
        ]);
        Cart::setDiscount($row->rowId, $product->discount);
        return redirect()->route('cart.index');
    }

    public function update_cart(Request $request)
    {
        $rowId = $request->id;
        $qty = $request->qty;

        $result = Cart::update($rowId, ['qty' => $qty]);
        return response()->json([
            'message' => $result ? 'Cart Updated' : 'Error',
            'status' => (bool)$result
        ]);
    }

    public function show_product($rowId)
    {
        $result = Cart::get($rowId);
        dd($result);
        //return view('');
    }

    public function remove($rowId)
    {
        Cart::remove($rowId);
        return redirect()->route('cart.index');
    }

    public function buy(BuyRequest $request)
    {

        try {
            DB::beginTransaction();
            $order =  Order::create($request->validatedData());

            foreach (Cart::content() as $item) {
                $order->details()->create([
                    'product_id' => $item->id,
                    'price' => $item->price,
                    'quantity' => $item->qty
                ]);
            }
            Cart::destroy();
            DB::commit();
        } catch (\Throwable $th) {
            dd($th->getMessage());
            DB::rollBack();
        }

        return redirect()->route('cart.index');
    }
}
