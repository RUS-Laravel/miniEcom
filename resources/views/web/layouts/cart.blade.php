<ul>
    <li class="nav-register">
        <a href="#">My Account</a>
    </li>
    <li class="nav-search-wrap style-2 hidden-sm hidden-xs">
        <a href="#" class="nav-search search-trigger">
            <i class="fa fa-search"></i>
        </a>
    </li>
    <!-- Card  -->
    <li class="nav-cart">
        <div class="nav-cart-outer">
            <div class="nav-cart-inner">
                <a href="#" class="nav-cart-icon">
                    {{ Cart::content()->count() }}
                </a>
            </div>
        </div>
        <div class="nav-cart-container">
            @foreach (Cart::content() as $row)
                <div class="nav-cart-items">

                    <div class="nav-cart-item clearfix">
                        <div class="nav-cart-img">
                            <a href="{{ route('cart.show.product', $row->rowId) }}">
                                <img src="{{ url('img/empty.png') }}" alt="">
                            </a>
                        </div>
                        <div class="nav-cart-title">
                            <a href="{{ route('product.detail', [
                                'slug' => $row->options->slug ?? '',
                                'id' => $row->id,
                            ]) }}">
                                {{ $row->name }}
                            </a>
                            <div class="nav-cart-price">
                                <span>{{ $row->qty }} x</span>
                                <span>{{ $row->price }}</span>
                            </div>
                        </div>
                        <div class="nav-cart-remove">
                            <a href="{{ route('cart.remove', $row->rowId) }}" class="remove"><i class="ui-close"></i></a>
                        </div>
                    </div>

                </div> <!-- end cart items -->
            @endforeach
            <div class="nav-cart-summary">
                <span>Cart Subtotal</span>
                <span class="total-price">{{ Cart::total() }}</span>
            </div>

            <div class="nav-cart-actions mt-20">
                <a href="{{ route('cart.index') }}" class="btn btn-md btn-dark"><span>View Cart</span></a>
                <a href="shop-checkout.html" class="btn btn-md btn-color mt-10"><span>Proceed to Checkout</span></a>
            </div>
        </div>
    </li>
</ul>
