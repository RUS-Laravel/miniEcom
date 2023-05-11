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
                            @if ($product->images->count())
                                @foreach ($product->images as $image)
                                    <a href="{{ url($image->path . $image->name) }}" class="lightbox-img">
                                        <img src="{{ url($image->path . $image->name) }}" alt="" />
                                        <i class="ui-zoom zoom-icon"></i>
                                    </a>
                                @endforeach
                            @else
                                <div class="gallery-cell ">
                                    <a href="{{ url('img/empty.png') }}" class="lightbox-img">
                                        <img src="{{ url('img/empty.png') }}" alt="" />
                                        <i class="ui-zoom zoom-icon"></i>
                                    </a>
                                </div>
                            @endif


                        </div> <!-- end gallery main -->

                        <div class="gallery-thumbs">
                            @foreach ($product->images as $image)
                                <div class="gallery-cell">
                                    <img src="{{ url($image->path . $image->name) }}" alt="" />
                                </div>
                            @endforeach

                        </div> <!-- end gallery thumbs -->

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

                            @foreach ($colors as $color)
                                @if ($product->id == $color->product_id)
                                    <a href="#" class="swatch-{{ $color->color->color_name }}">{{ $color->color->color_name }}</a>
                                @endif
                            @endforeach
                        </div>

                        <div class="size-options clearfix">
                            <span>Size:</span>
                            @foreach ($colors as $color)
                                @if ($product->id == $color->product_id)
                                    @foreach ($sizes as $size)
                                        @if ($color->id == $size->product_color_id)
                                            <a href="#" class="size-{{ $size->size->size }} selected">{{ $size->size->size }}</a>
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach

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
                            <span class="posted_in">Tags:
                                @php
                                    $explode_tags = explode(',', $product->tags);
                                @endphp
                                @foreach ($explode_tags as $tag)
                                    <a href="{{ route('product.tag', $tag) }}">{{ $tag }} </a>,
                                @endforeach
                            </span>
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
                                                    <td>
                                                        @foreach ($colors as $color)
                                                            @if ($product->id == $color->product_id)
                                                                @foreach ($sizes as $size)
                                                                    @if ($color->id == $size->product_color_id)
                                                                        {{ $size->size->size_name }},
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Colors:</th>
                                                    <td>
                                                        @foreach ($colors as $color)
                                                            @if ($product->id == $color->product_id)
                                                                {{ $color->color->color_name }},
                                                            @endif
                                                        @endforeach
                                                    </td>
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
