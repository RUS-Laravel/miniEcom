@extends('web.layouts.master')
@section('title', __('Cart'))
@section('content')
    <!-- Single Product -->
    <div class="content-wrapper oh">

        <!-- Cart -->
        <section class="section-wrap shopping-cart">
            <div class="container relative">

                <div class="row">

                    <div class="col-md-12">
                        <div class="table-wrap mb-30">
                            <table class="shop_table cart table">
                                <thead>
                                    <tr>
                                        <th class="product-name" colspan="2">Product</th>
                                        <th class="product-price">Price</th>
                                        <th class="product-quantity">Quantity</th>
                                        <th class="product-subtotal" colspan="2">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (Cart::content() as $content)
                                        <tr class="cart_item">
                                            <td class="product-thumbnail">
                                                <a href="#">
                                                    <img src="{{ url('img/shop/shop_item_3.jpg') }}" alt="">
                                                </a>
                                            </td>
                                            <td class="product-name">
                                                <a href="#">{{ $content->name }}</a>
                                                {{-- <ul>
                                                    <li>Size: XL</li>
                                                    <li>Color: White</li>
                                                </ul> --}}
                                            </td>
                                            <td class="product-price">
                                                <span class="amount">{{ $content->price }}</span>
                                            </td>
                                            <td class="product-quantity">
                                                <div class="quantity buttons_added">
                                                    <input type="number" step="1" min="0" value="{{ $content->qty }}" title="Qty" class="input-text qty text">
                                                    <div class="quantity-adjust">
                                                        <a href="#" class="plus">
                                                            <i class="fa fa-angle-up"></i>
                                                        </a>
                                                        <a href="#" class="minus">
                                                            <i class="fa fa-angle-down"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="product-subtotal">
                                                <span class="amount">{{ $content->subtotal }}</span>
                                            </td>
                                            <td class="product-remove">
                                                <a href="{{ route('cart.remove', $content->rowId) }}" class="remove" title="Remove this item">
                                                    <i class="ui-close"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{-- 
                        <div class="row mb-50">
                            <div class="col-md-5 col-sm-12">
                                <div class="coupon">
                                    <input type="text" name="coupon_code" id="coupon_code" class="input-text form-control" value placeholder="Coupon code">
                                    <input type="submit" name="apply_coupon" class="btn btn-lg btn-stroke" value="Apply">
                                </div>
                            </div>

                            <div class="col-md-7">
                                <div class="actions">
                                    <input type="submit" name="update_cart" value="Update Cart" class="btn btn-lg btn-stroke">
                                    <div class="wc-proceed-to-checkout">
                                        <a href="checkout.html" class="btn btn-lg btn-dark"><span>proceed to checkout</span></a>
                                    </div>
                                </div>
                            </div>
                        </div> --}}


                    </div> <!-- end row -->


                </div> <!-- end container -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="cart_totals">
                            <h2 class="heading relative bottom-line full-grey uppercase mb-30">Cart Totals</h2>

                            <table class="table shop_table">
                                <tbody>
                                    <tr class="cart-subtotal">
                                        <th>Cart Subtotal</th>
                                        <td>
                                            <span class="amount">{{ Cart::subtotal() }}</span>
                                        </td>
                                    </tr>
                                    <tr class="shipping">
                                        <th>Shipping</th>
                                        <td>
                                            <span>Free Shipping</span>
                                        </td>
                                    </tr>
                                    <tr class="order-total">
                                        <th>Order Total</th>
                                        <td>
                                            <strong><span class="amount">{{ Cart::total() }}</span></strong>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div> <!-- end col cart totals -->
                </div>
        </section> <!-- end cart -->
    </div> <!-- end container -->


@endsection
