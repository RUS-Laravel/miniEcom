@extends('admin.layouts.app')
@section('title', __('Product Detail'))
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card-box">
            <div class="row">
                <div class="col-lg-5">

                    <div class="tab-content pt-0">
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
                        <li class="nav-item">
                            <a href="#product-1-item" data-toggle="tab" aria-expanded="false" class="nav-link product-thumb active show">
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
                            <span class="mdi mdi-star text-warning"></span>
                            <span class="mdi mdi-star text-warning"></span>
                            <span class="mdi mdi-star text-warning"></span>
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
                        <p class="text-muted mb-4">{{$product->description}}</p>
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
                        <form class="form-inline mb-4">
                            <label class="my-1 mr-2" for="quantityinput">Quantity</label>
                            <select class="custom-select my-1 mr-sm-3" id="quantityinput">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                            </select>
                            <label class="my-1 mr-2" for="color">Color</label>
                            <select class="custom-select my-1 mr-sm-3" id="color">
                                @foreach ($product->color as $color)
                                    <option value="{{$color->id}}">{{$color->color_name}}</option>
                                @endforeach
                                
                            </select>
                        
                            <label class="my-1 mr-2" for="sizeinput">Size</label>
                            <select class="custom-select my-1 mr-sm-3" id="sizeinput">
                                @foreach ($product->size as $size)
                                    <option value="{{$size->id}}">{{$size->size}}</option>
                                @endforeach
                                
                                
                            </select>
                        </form>

                        <div>
                            <button type="button" class="btn btn-danger mr-2"><i class="mdi mdi-heart-outline"></i></button>
                            <button type="button" class="btn btn-success waves-effect waves-light">
                                <span class="btn-label"><i class="mdi mdi-cart"></i></span>Add to cart
                            </button>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
            <!-- end row -->


            <div class="table-responsive mt-4">
                <table class="table table-bordered table-centered mb-0">
                    <thead class="thead-light">
                        <tr>
                            <th>Size</th>
                            <th>Color</th>
                            <th>Stock</th>
                            <th>Revenue</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($product->size as $size)
                        <tr>
                            <td>{{$size->size}}</td>
                            @foreach ($product->color as $color)
                            <td>{{$color->color_name}}</td>
                            @endforeach
                            <td>
                                <div class="row align-items-center no-gutters">
                                    <div class="col-auto">
                                      <span class="mr-2">{{$product->stock}}</span>
                                    </div>
                                   
                                </div>
                            </td>
                            <td>$1,89,547</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div> <!-- end card-->
    </div> <!-- end col-->
</div>
<!-- end row-->
@endsection