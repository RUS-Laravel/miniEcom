@extends('admin.layouts.app')
@section('title', __('Product Color Edit'))
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                
                <form action="{{ route('admin.products.colors.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $p_color->id }}">
                    <div class="form-group">
                        <label>Product<span class="text-danger">*</span></label> <br />
                        <select id="selectize-select-product" name="product_id">
                            <option data-display="Select" value="">Choose Product</option>
                            
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}" {{ $p_color->product_id == $product->id ? 'selected' : '' }}>{{ $product->title }}</option>
                                @endforeach
                         
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Color<span class="text-danger">*</span></label> <br />
                        <select id="selectize-select-color" name="color_id">
                            <option data-display="Select" value="">Choose Color</option>
                            
                                @foreach ($colors as $color)
                                    <option value="{{ $color->id }}" {{ $p_color->color_id == $color->id ? 'selected' : '' }}>{{ $color->color_name }}</option>
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
        $("#selectize-select-color").selectize();
    </script>
@endpush
