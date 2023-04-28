@extends('web.layouts.app')
@section('web-content')
    <div class="products-grid-wrap clearfix">
        <div id="products-grid">

            @foreach ($products as $product)
                <div class="product-item hover-trigger">
                    <div class="product-img">
                        <a href="#">
                            <img src="{{ url('img/shop/shop_item_1.jpg') }}" alt="">
                        </a>
                        @if ($product->discount)
                            <div class="product-label">
                                <span class="sale">sale</span>
                            </div>
                        @endif

                        <div class="hover-overlay">
                            <div class="product-actions">
                                <a href="#" class="product-add-to-wishlist">
                                    <i class="fa fa-heart"></i>
                                </a>
                            </div>
                            <div class="product-details valign">
                                <span class="category">
                                    <a href="{{route('catalog.show',$product->category_id)}}">{{ $product->category->name }}</a>
                                </span>
                                <h3 class="product-title">
                                    <a href="{{ route('product.detail', [
                                        'slug' => $product->slug,
                                        'id' => $product->id,
                                    ]) }}">{{ $product->title }}</a>
                                </h3>

                                @if ($product->discount)
                                    <span class="price">
                                        <del>
                                            <span>{{ $product->price_pretty }}</span>
                                        </del>
                                        <ins>
                                            <span class="amount">{{ $product->discount_price }}</span>
                                        </ins>
                                    </span>
                                @else
                                    <span class="price">
                                        <ins>
                                            <span class="amount">{{ $product->price_pretty }}</span>
                                        </ins>
                                    </span>
                                @endif
                                <div class="btn-quickview">
                                    <a href="{{route('product.detail', ['slug'=>$product->slug,'id'=>$product->id])}}" class="btn btn-md btn-color">
                                        <span>Quickview</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div> <!-- end products grid -->
    </div> <!-- end product grid wrap -->
@endsection
