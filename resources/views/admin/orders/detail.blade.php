@extends('admin.layouts.app')
@section('title', __('Order Detail'))
@section('content')
<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-3">Track Order</h4>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-4">
                            <h5 class="mt-0">Order ID:</h5>
                            <p>{{$order->no ?? ''}}</p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-4">
                            <h5 class="mt-0">Tracking ID:</h5>
                            <p>894152012012</p>
                        </div>
                    </div>
                </div>

                <div class="track-order-list">
                    <ul class="list-unstyled">
                        <li class="completed">
                            <h5 class="mt-0 mb-1">Order Placed</h5>
                            <p class="text-muted">April 21 2019 <small class="text-muted">07:22 AM</small> </p>
                        </li>
                        <li class="completed">
                            <h5 class="mt-0 mb-1">Packed</h5>
                            <p class="text-muted">April 22 2019 <small class="text-muted">12:16 AM</small></p>
                        </li>
                        <li>
                            <span class="active-dot dot"></span>
                            <h5 class="mt-0 mb-1">Shipped</h5>
                            <p class="text-muted">April 22 2019 <small class="text-muted">05:16 PM</small></p>
                        </li>
                        <li>
                            <h5 class="mt-0 mb-1"> Delivered</h5>
                            <p class="text-muted">Estimated delivery within 3 days</p>
                        </li>
                    </ul>

                    <div class="text-center mt-4">
                        <a href="#" class="btn btn-primary">Show Details</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-3">Items from Order #VL2537</h4>

                <div class="table-responsive">
                    <table class="table table-bordered table-centered mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th>Product name</th>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Discount</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order_details as $order_detail)
                                                
                            <tr>
                                <th scope="row">{{$order_detail->product->title}}</th>
                                <td><img src="{{url('assets/images/products/product-1.png')}}" alt="product-img" height="32"></td>
                                <td>{{$order_detail->quantity}}</td>
                                <td>{{$order_detail->price}}</</td>
                                <td>{{$order->discount}}</</td>
                                <td>$39 qaldi</td>
                            </tr>
                            
                            @endforeach
                            <tr>
                                <th scope="row" colspan="4" class="text-right">Sub Total :</th>
                                <td><div class="font-weight-bold">$177</div></td>
                            </tr>
                            <tr>
                                <th scope="row" colspan="4" class="text-right">Shipping Charge :</th>
                                <td>$24</td>
                            </tr>
                            <tr>
                                <th scope="row" colspan="4" class="text-right">Estimated Tax :</th>
                                <td>$12</td>
                            </tr>
                            <tr>
                                <th scope="row" colspan="4" class="text-right">Total :</th>
                                <td><div class="font-weight-bold">$213</div></td>
                            </tr>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end row -->
<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-3">Shipping Information</h4>

                <h5 class="font-family-primary font-weight-semibold">{{$order->user->name}}</h5>
                
                <p class="mb-2"><span class="font-weight-semibold mr-2">Address:</span> 3559 Roosevelt Wilson Lane San Bernardino, CA 92405</p>
                <p class="mb-2"><span class="font-weight-semibold mr-2">Phone:</span> (123) 456-7890</p>
                <p class="mb-0"><span class="font-weight-semibold mr-2">Mobile:</span> (+01) 12345 67890</p>

            </div>
        </div>
    </div> <!-- end col -->

    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-3">Billing Information</h4>

                <ul class="list-unstyled mb-0">
                    <li>
                        <p class="mb-2"><span class="font-weight-semibold mr-2">Payment Type:</span> {{$order->payment_type}}</p>
                        <p class="mb-2"><span class="font-weight-semibold mr-2">Provider:</span> Visa ending in 2851</p>
                        <p class="mb-2"><span class="font-weight-semibold mr-2">Valid Date:</span> 02/2020</p>
                        <p class="mb-0"><span class="font-weight-semibold mr-2">CVV:</span> xxx</p>
                    </li>
                </ul>

            </div>
        </div>
    </div> <!-- end col -->
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-3">Delivery Info</h4>

                <div class="text-center">
                    <i class="mdi mdi-truck-fast h2 text-muted"></i>
                    <h5><b>UPS Delivery</b></h5>
                    <p class="mb-1"><span class="font-weight-semibold">Order ID :</span> xxxx235</p>
                    <p class="mb-0"><span class="font-weight-semibold">Payment Mode :</span> COD</p>
                </div>
            </div>
        </div>
    </div> <!-- end col -->

</div>
<!-- end row -->
@endsection