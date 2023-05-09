@extends('admin.layouts.app')
@section('title', __('Product Size Edit'))
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">

                <form action="{{ route('admin.products.sizes.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $p_size->id }}">
                    <div class="form-group">
                        <label>Product<span class="text-danger">*</span></label> <br />
                        <select id="selectize-select-product" name="product_id">
                            <option data-display="Select" value="">Choose Product</option>
                            
                                @foreach ($products_color as $product_color)
                                    <option value="{{ $product_color->id }}" {{ $p_size->product_color_id == $product_color->id ? 'selected' : '' }}>{{ $product_color->product->title }}--{{ $product_color->color->color_name }}</option>
                                @endforeach
                         
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Size<span class="text-danger">*</span></label> <br />
                        <select id="selectize-select-size" name="size_id">
                            <option data-display="Select" value="">Choose Size</option>
                            
                                @foreach ($sizes as $size)
                                    <option value="{{ $size->id }}" {{ $p_size->size_id == $size->id ? 'selected' : '' }}>{{ $size->size }}--{{ $size->size_name }}</option>
                                @endforeach
                         
                        </select>
                    </div>
                   
                    <button type="submit" class="btn btn-primary waves-effect waves-light">@lang('Edit')</button>
                </form>
            </div>
        </div>
    </div>


@endsection
@push('css-lib')
    <link href="{{ url('assets/libs/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" type="text/css" />
@endpush
@push('css')
    <!-- Sweet Alert-->
    <link href="{{ url('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
@endpush
@push('js')
    <script src="{{ url('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ url('assets/libs/selectize/js/standalone/selectize.min.js') }}"></script>
    <script>
        $("#selectize-select-product").selectize();
        $("#selectize-select-size").selectize();
    </script>
@endpush
