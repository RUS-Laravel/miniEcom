@extends('web.layouts.master')
@section('title', __('Product detail'))
@section('content')
    <!-- Single Product -->
    <form action="{{ route('cart.addToCart') }}" method="POST">
        @csrf
        <section class="section-wrap pb-40 single-product">
            <div class="container-fluid semi-fluid">
                <div class="row">

                    <div class="col-md-6 col-xs-12 product-slider mb-60">

                        <div class="flickity flickity-slider-wrap mfp-hover shadow-sm" id="gallery-main">

                            <div class="gallery-cell ">
                                <a href="{{ url('img/empty.png') }}" class="lightbox-img">
                                    <img src="{{ url('img/empty.png') }}" alt="" />
                                    <i class="ui-zoom zoom-icon"></i>
                                </a>
                            </div>
                            {{-- <div class="gallery-cell">
                                <a href="{{ url('img/shop/item_lg_2.jpg') }}" class="lightbox-img">
                                    <img src="{{ url('img/shop/item_lg_2.jpg') }}" alt="" />
                                    <i class="ui-zoom zoom-icon"></i>
                                </a>
                            </div>
                            <div class="gallery-cell">
                                <a href="{{ url('img/shop/item_lg_3.jpg') }}" class="lightbox-img">
                                    <img src="{{ url('img/shop/item_lg_3.jpg') }}" alt="" />
                                    <i class="ui-zoom zoom-icon"></i>
                                </a>
                            </div>
                            <div class="gallery-cell">
                                <a href="{{ url('img/shop/item_lg_4.jpg') }}" class="lightbox-img">
                                    <img src="{{ url('img/shop/item_lg_4.jpg') }}" alt="" />
                                    <i class="ui-zoom zoom-icon"></i>
                                </a>
                            </div>
                            <div class="gallery-cell">
                                <a href="{{ url('img/shop/item_lg_5.jpg') }}" class="lightbox-img">
                                    <img src="{{ url('img/shop/item_lg_5.jpg') }}" alt="" />
                                    <i class="ui-zoom zoom-icon"></i>
                                </a>
                            </div> --}}
                        </div> <!-- end gallery main -->
{{-- 
                        <div class="gallery-thumbs">
                            <div class="gallery-cell">
                                <img src="{{ url('img/shop/item_thumb_1.jpg') }}" alt="" />
                            </div>
                            <div class="gallery-cell">
                                <img src="{{ url('img/shop/item_thumb_2.jpg') }}" alt="" />
                            </div>
                            <div class="gallery-cell">
                                <img src="{{ url('img/shop/item_thumb_3.jpg') }}" alt="" />
                            </div>
                            <div class="gallery-cell">
                                <img src="{{ url('img/shop/item_thumb_4.jpg') }}" alt="" />
                            </div>
                            <div class="gallery-cell">
                                <img src="{{ url('img/shop/item_thumb_5.jpg') }}" alt="" />
                            </div>
                        </div> <!-- end gallery thumbs --> --}}

                    </div> <!-- end col img slider -->

                    <div class="col-md-6 col-xs-12 product-description-wrap">
                        <ol class="breadcrumb">
                            <li>
                                <a href="{{ route('web.index') }}">Home</a>
                            </li>

                        </ol>
                        <h1 class="product-title">{{ $product->title }}</h1>
                        <span class="price">
                            @if ($product->discount)
                                <del>
                                    <span>{{ $product->price_pretty }}</span>
                                </del>
                            @endif

                            <ins>
                                <span class="amount">{{ $product->discount_price }}</span>
                            </ins>
                        </span>
                        <span class="rating">
                            <a href="#">3 Reviews</a>
                        </span>
                        <p class="short-description">{{ $product->description }}</p>

                        <div class="color-swatches clearfix">
                            <span>Color:</span>
                            <a href="#" class="swatch-violet"></a>
                            <a href="#" class="swatch-black"></a>
                            <a href="#" class="swatch-cream"></a>
                        </div>

                        <div class="size-options clearfix">
                            <span>Size:</span>
                            <a href="#" class="size-xs selected">XS</a>
                            <a href="#" class="size-s">S</a>
                            <a href="#" class="size-m">M</a>
                            <a href="#" class="size-l">L</a>
                            <a href="#" class="size-xl">XL</a>
                        </div>

                        <div class="product-actions">
                            <span>Qty:</span>

                            <div class="quantity buttons_added">
                                <input type="number" step="1" min="0" value="1" title="Qty" name="quantity" class="input-text qty text" />
                                <div class="quantity-adjust">
                                    <a href="#" class="plus">
                                        <i class="fa fa-angle-up"></i>
                                    </a>
                                    <a href="#" class="minus">
                                        <i class="fa fa-angle-down"></i>
                                    </a>
                                </div>
                            </div>
                            <input type="hidden" name="id" value="{{ $product->id }}">
                            <button type="submit" class="btn btn-dark btn-lg add-to-cart"><span>Add to Cart</span></button>

                            <a href="#" class="product-add-to-wishlist"><i class="fa fa-heart"></i></a>
                        </div>


                        <div class="product_meta">
                            <span class="sku">SKU: <a href="">{{ $product->code }}</a></span>
                            <span class="brand_as">Category: <a href="{{ route('catalog.show', $product->category_id) }}">{{ $product->category->name }}</a></span>
                            <span class="posted_in">Tags: <a href="#">Sport, T-shirt, Blue</a></span>
                        </div>

                        <!-- Accordion -->
                        <div class="panel-group accordion mb-50" id="accordion">
                            <div class="panel">
                                <div class="panel-heading">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="minus">Description<span>&nbsp;</span>
                                    </a>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse in">
                                    <div class="panel-body">
                                        {{ $product->description }}
                                    </div>
                                </div>
                            </div>

                            <div class="panel">
                                <div class="panel-heading">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="plus">Information<span>&nbsp;</span>
                                    </a>
                                </div>
                                <div id="collapseTwo" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <table class="table shop_attributes">
                                            <tbody>
                                                <tr>
                                                    <th>Size:</th>
                                                    <td>EU 41 (US 8), EU 42 (US 9), EU 43 (US 10), EU 45 (US 12)</td>
                                                </tr>
                                                <tr>
                                                    <th>Colors:</th>
                                                    <td>Violet, Black, Blue</td>
                                                </tr>
                                                <tr>
                                                    <th>Stock:</th>
                                                    <td>{{ $product->stock }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="panel">
                                <div class="panel-heading">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" class="plus">Reviews<span>&nbsp;</span>
                                    </a>
                                </div>
                                <div id="collapseThree" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <div class="reviews">
                                            <ul class="reviews-list">
                                                <li>
                                                    <div class="review-body">
                                                        <div class="review-content">
                                                            <p class="review-author"><strong>Alexander Samokhin</strong> - May 6, 2014 at 12:48 pm</p>
                                                            <div class="rating">
                                                                <a href="#"></a>
                                                            </div>
                                                            <p>This template is so awesome. I didn’t expect so many features inside. E-commerce pages are very useful, you can launch your online store in few seconds. I will rate 5 stars.</p>
                                                        </div>
                                                    </div>
                                                </li>


                                            </ul>
                                        </div> <!--  end reviews -->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="socials-share clearfix">
                            <span>Share:</span>
                            <div class="social-icons nobase">
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-google"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                            </div>
                        </div>
                    </div> <!-- end col product description -->
                </div> <!-- end row -->

            </div> <!-- end container -->
        </section> <!-- end single product -->
    </form>
    @include('web.layouts.related')
@endsection
