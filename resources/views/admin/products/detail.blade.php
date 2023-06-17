@extends('admin.layouts.app')
@section('title', __('Product Detail'))
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card-box">
            <div class="row">
                <div class="col-lg-5">

                    <div class="tab-content pt-0">
                        @if ($product->images->count())
                            @foreach ($product->images as $image)
                                <div class="tab-pane active show" id="product-{{$image->id}}-item">
                                    <img src="{{ url($image->path . $image->name) }}" alt="{{$image->name}}" class="img-fluid mx-auto d-block rounded">
                                </div>
                            @endforeach 
                        @endif
                        
                        <div class="tab-pane active show" id="product-1-item">
                            <img src="{{url('assets/images/products/product-9.jpg')}}" alt="" class="img-fluid mx-auto d-block rounded">
                        </div>
                        <div class="tab-pane" id="product-2-item">
                            <img src="{{url('assets/images/products/product-10.jpg')}}" alt="" class="img-fluid mx-auto d-block rounded">
                        </div>
                        <div class="tab-pane" id="product-3-item">
                            <img src="{{url('assets/images/products/product-11.jpg')}}" alt="" class="img-fluid mx-auto d-block rounded">
                        </div>
                        <div class="tab-pane" id="product-4-item">
                            <img src="{{url('assets/images/products/product-12.jpg')}}" alt="" class="img-fluid mx-auto d-block rounded">
                        </div>
                    </div>

                    <ul class="nav nav-pills nav-justified">
                        @if ($product->images->count())
                            @foreach ($product->images as $image)
                            <li class="nav-item">
                                <a href="#product-{{$image->id}}-item" data-toggle="tab" aria-expanded="false" class="nav-link product-thumb active show">
                                    <img src="{{ url($image->path . $image->name) }}" alt="{{$image->name}}" class="img-fluid mx-auto d-block rounded">
                                </a>
                            </li>
                            @endforeach
                        @endif
                        
                        <li class="nav-item">
                            <a href="#product-9-item" data-toggle="tab" aria-expanded="false" class="nav-link product-thumb active show">
                                <img src="{{url('assets/images/products/product-9.jpg')}}" alt="" class="img-fluid mx-auto d-block rounded">
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#product-2-item" data-toggle="tab" aria-expanded="true" class="nav-link product-thumb">
                                <img src="{{url('assets/images/products/product-10.jpg')}}" alt="" class="img-fluid mx-auto d-block rounded">
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#product-3-item" data-toggle="tab" aria-expanded="false" class="nav-link product-thumb">
                                <img src="{{url('assets/images/products/product-11.jpg')}}" alt="" class="img-fluid mx-auto d-block rounded">
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#product-4-item" data-toggle="tab" aria-expanded="false" class="nav-link product-thumb">
                                <img src="{{url('assets/images/products/product-12.jpg')}}" alt="" class="img-fluid mx-auto d-block rounded">
                            </a>
                        </li>
                    </ul>
                </div> <!-- end col -->
                
                    <div class="col-lg-7">
                        <div class="pl-xl-3 mt-3 mt-xl-0">
                            <a href="#" class="text-primary">Jack & Jones</a>{{-- Brand --}}
                            <h4 class="mb-3">{{$product->title}} </h4>
                            <p class="text-muted float-left mr-3">
                                @foreach ($product->review_rating as $rating)
                                    @for ($i = 1; $i <= $rating->star_rating; $i++)
                                        <span class="mdi mdi-star text-warning"></span>
                                    @endfor
                                    
                                @endforeach
                                <span class="mdi mdi-star text-warning"></span>
                                <span class="mdi mdi-star"></span>
                            </p>
                            <p class="mb-4"><a href="" class="text-muted">( 36 Customer Reviews )</a></p>
                            @if ($product->discount)
                                <h6 class="text-danger text-uppercase">{{$product->discount}} % Off</h6>
                                <h4 class="mb-4">Price : <span class="text-muted mr-2"><del>{{$product->price_pretty}}</del></span><b>{{$product->discount_price}}</b>
                                    @else
                                <h4 class="mb-4">Price : <b>{{$product->discount_price}}</b></h4>
                            @endif
                            
                            
                            <h4><span class="badge bg-soft-success text-success mb-4">Instock -> {{$product->stock}}</span></h4>
                            <p class="text-muted mb-4">{!!$product->description!!}</p>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div>
                                        <p class="text-muted"><i class="mdi mdi-checkbox-marked-circle-outline h6 text-primary mr-2"></i> Sed ut perspiciatis unde</p>
                                        
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div>
                                        <p class="text-muted"><i class="mdi mdi-checkbox-marked-circle-outline h6 text-primary mr-2"></i> Itaque earum rerum hic</p>
                                        
                                    </div>
                                </div>
                            </div>
                            <form action="{{route('cart.addToCart')}}" method="post" class="form-inline mb-4">
                                @csrf
                                <input type="hidden" name="id" value="{{ $product->id }}">
                                <label class="my-1 mr-2" for="quantityinput">Quantity</label>
                                <select class="custom-select my-1 mr-sm-3" name="quantity" id="quantityinput">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                </select>
                                
                                <label class="my-1 mr-2" for="color">Color</label>
                                <select class="custom-select my-1 mr-sm-3" id="color" name="color_id">
                                    @foreach ($product->colors ?? [] as $color)
                                        <option value="{{ $color->color->id }}" {{ $loop->first ? 'selected' : '' }}>{{ $color->color->color_name }}</option>
                                    @endforeach
                                    
                                </select>
                            
                                <label class="my-1 mr-2" for="sizeinput">Size</label>
                                <div data-control="product-size">
                                    @include('admin.products.select_size')
                                </div>
                                
                           
                            <div class="mt-3">
                                <button type="button" class="btn btn-danger mr-2" data-url="{{ route('product.add_wishlist', $product->id) }}" data-insert="wishList"><i class="mdi mdi-heart-outline"></i></button>
                                <button type="submit" class="btn btn-success waves-effect waves-light">
                                    <span class="btn-label"><i class="mdi mdi-cart"></i></span>Add to cart
                                </button>
                            </div>
                            </form>
                        </div>

                        <h4 class="header-title mt-4 mb-1">Tags</h4>
                        <ul class="list-group list-group-horizontal-sm mb-3">
                            @foreach ($product->etags as $tag)
                            <li class="list-group-item">{{$tag}}</li>
                            @endforeach
                            
                        </ul>

                    </div> <!-- end col -->
            
            </div>
            <!-- end row -->



        </div> <!-- end card-->
    </div> <!-- end col-->
</div>
<!-- end row-->
@endsection
@push('js')
    <script>
        $(document.body).on('change', '[name="color_id"]', function() {
                $.ajax({
                    url: '{{ route('admin.products.select.sizes') }}',
                    method: 'POST',
                    data: {
                        product_id: '{{ $product->id ?? '' }}',
                        color_id: $(this).val()           
                    },
                    success: function(response) {
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
    </script>
@endpush