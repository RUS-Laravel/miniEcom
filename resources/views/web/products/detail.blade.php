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
                            @if ($product and !is_null($product->images) and $product->images->count())
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
                            @foreach ($product->images ?? [] as $image)
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
                            <select name="color_id" id="color_id">
                                @foreach ($product->colors ?? [] as $color)
                                    <option value="{{ $color->color->id }}" {{ $loop->first ? 'selected' : '' }}>{{ $color->color->color_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="size-options clearfix">
                            <span>Size:</span>
                            <div data-control="product-size">
                                @include('web.products.size')
                            </div>
                        </div>

                        <div class="product-actions">
                            <span>Qty:</span>

                            <div class="quantity buttons_added">
                                <input type="number" step="1" min="0" value="1" title="Qty" name="quantity" class="input-text qty text" />
                            </div>
                            <input type="hidden" name="id" value="{{ $product->id }}">
                            @if ($product->stock == 0)
                                <button type="submit" class="btn btn-dark btn-lg add-to-cart" data-insert="newsletter" data-url="{{ route('product.add.newsletter', $product->id) }}"><span>Add Newsletter</span></button>
                            @else
                                <button type="submit" class="btn btn-dark btn-lg add-to-cart" class="product-add-to-wishlist"><span>Add to Cart</span></button>
                            @endif
                            <a href="javascript:void(0)" data-url="{{ route('product.add_wishlist', $product->id) }}" data-insert="wishList" class="product-add-to-wishlist"><i class="fa fa-heart"></i></a>
                        </div>


                        <div class="product_meta">
                            <span class="sku">SKU: <a href="">{{ $product->code }}</a></span>
                            <span class="brand_as">Category: <a href="{{ route('catalog.show', $product->category_id) }}">{{ $product->category->name }}</a></span>
                            <span class="posted_in">Tags:
                                {{-- @php
                                    $explode_tags = explode(',', $product->tags);
                                @endphp --}}

                                @foreach ($product->etags ?? [] as $tag)
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
                                                        @foreach ($product->colors ?? [] as $colors)
                                                            @foreach ($colors->sizes ?? [] as $size)
                                                                {{ $size->size->size_name }},
                                                            @endforeach
                                                        @endforeach
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Colors:</th>
                                                    <td>
                                                        @foreach ($product->colors ?? [] as $color)
                                                            {{ $color->color->color_name }}
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
                                                @foreach ($product->review_rating as $rating)
                                                    <li>
                                                        <div class="review-body">
                                                            <div class="review-content">
                                                                <p class="review-author"><strong> {{ $rating->user->name }} </strong> - {{ $rating->created_at }}</p>
                                                                <div class="">
                                                                    @for ($i = 1; $i <= 5; $i++)
                                                                        @if ($i <= $rating->star_rating)
                                                                            <a href="javascript:void(0)">*</a>
                                                                        @else
                                                                            <a href="javascript:void(0)">-</a>
                                                                        @endif
                                                                    @endfor
                                                                </div>
                                                                <p> {{ $rating->comments }} </p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @endforeach

                                            </ul>
                                            @if (auth('client')->user())
                                                <p class="h5">Mehsul haqqinda reyinizi bildirin...</p>
                                                <form>
                                                    @csrf
                                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                    <input type="hidden" name="user_id" value="{{ auth('client')->user()->id }}">
                                                    <input type="hidden" name="rating" value="0">
                                                    <div class="stars">
                                                        <i class="fa-solid fa-star" data-control="rating" data-value="1"></i>
                                                        <i class="fa-solid fa-star" data-control="rating" data-value="2"></i>
                                                        <i class="fa-solid fa-star" data-control="rating" data-value="3"></i>
                                                        <i class="fa-solid fa-star" data-control="rating" data-value="4"></i>
                                                        <i class="fa-solid fa-star" data-control="rating" data-value="5"></i>
                                                    </div>
                                                    <br>
                                                    <textarea id="comment" name="comment" rows="5" class="form-control" placeholder="Sizin reyiniz.."></textarea>
                                                    <br>
                                                    <button type="button" class="btn btn-primary" data-insert="comment-button">New comment</button>
                                                </form>
                                            @endif
                                            <hr>

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

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />

    @push('js')

        <script>
            // ---- ---- Const ---- ---- //
            const stars = document.querySelectorAll('.stars i');
            //const starsNone = document.querySelector('.rating-box');

            // ---- ---- Stars ---- ---- //
            stars.forEach((star, index1) => {
                star.addEventListener('click', () => {
                    stars.forEach((star, index2) => {
                        // ---- ---- Active Star ---- ---- //
                        index1 >= index2 ?
                            star.classList.add('active') :
                            star.classList.remove('active');
                    });
                });
            });

            $(document.body).on('click', '[data-control="rating"]', function() {
                $('[name="rating"]').val($(this).data('value'))
            });

            $(document.body).on('click', '[data-insert="comment-button"]', function() {
                $.ajax({
                    url: '{{ route('product.rating') }}',
                    method: 'POST',
                    data: {
                        product_id: $('[name="product_id"]').val(),
                        user_id: $('[name="user_id"]').val(),
                        comment: $('[name="comment"]').val(),
                        rating: $('[name="rating"]').val(),
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        console.log(response);
                        //window.location.reload();
                    }
                })
            })

            $(document.body).on('change', '[name="color_id"]', function() {
                $.ajax({
                    url: '{{ route('product.sizes') }}',
                    method: 'POST',
                    data: {
                        product_id: '{{ $product->id ?? '' }}',
                        color_id: $(this).val(),
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        console.log(response)
                        $('[data-control="product-size"]').html(response.blade)
                        
                    }
                })
            })

            $(document.body).on('click', '[data-insert="wishList"]', function() {
                $.ajax({
                    url: $(this).data('url'),
                    success: function(response) {
                        console.log(response);
                        window.location.reload();
                    }
                })
            })


            $(document.body).on('click', '[data-insert="newsletter"]', function() {
                $.ajax({
                    url: $(this).data('url'),
                    success: function(response) {
                        console.log(response);
                        window.location.reload();
                    }
                })
            })

            
        
        </script>
    @endpush
