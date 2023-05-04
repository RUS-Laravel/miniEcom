@extends('admin.layouts.app')
@section('title', __('Product Color Edit'))
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <a href="{{ route('admin.colors.index') }}" class="btn btn-outline-success waves-effect waves-light mb-1">Colors</a>
                <form action="{{ route('admin.products.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $color->id }}">
                    <div class="form-group">
                        <label>Product</label> <br />
                        <select id="selectize-select-edit" name="product_id">
                            <option data-display="Select" value="">Choose Product</option>
                            
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}" {{ $color->product_id == $product->id ? 'selected' : '' }}>{{ $product->title }}</option>
                                @endforeach
                         
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="title">Color name</label>
                        <input type="text" id="name" class="form-control" name="name" value="{{ $color->color_name }}">
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
        $("#selectize-select-edit").selectize();
    </script>
@endpush
