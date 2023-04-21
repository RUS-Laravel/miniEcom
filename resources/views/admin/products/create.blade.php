@extends('admin.layouts.app')
@section('title', __('Product Create'))
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <form action="" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Category</label> <br />
                        <select id="selectize-select" name="category_id">
                            <option data-display="Select" value="">Choose Category</option>
                            @foreach ($parents as $parent)
                                <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                                @foreach ($parent->categories as $cat)
                                    <option value="{{ $cat->id }}">---{{ $cat->name }}</option>
                                @endforeach
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="title">Product title</label>
                        <input type="text" id="title" class="form-control" name="title" placeholder="Product Title">
                    </div>
                    <div class="form-group mb-3">
                        <label for="code">Product code</label>
                        <input type="text" id="code" class="form-control" name="code" placeholder="Product Code">
                    </div>
                    <div class="form-group mb-3">
                        <label for="stock">Product stock</label>
                        <input type="number" id="stock" class="form-control" name="stock" placeholder="Product stock" min=0>
                    </div>
                    <div class="form-group mb-3">
                        <label for="discount">Product discount</label>
                        <input type="number" id="discount" class="form-control" name="discount" placeholder="Product discount" min=0>
                    </div>
                    <div class="form-group mb-3">
                        <label for="price">Product price</label>
                        <input type="number" id="price" class="form-control" name="price" placeholder="Product Price" min=0>
                    </div>
                    <div class="form-group mb-3">
                        <label for="description">Product description</label>
                        <textarea class="form-control" id="description" name="description" rows="5"></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="customRadio1" name="status" value="1" checked class="custom-control-input">
                            <label class="custom-control-label" for="customRadio1">Active</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="customRadio2" name="status" value="2" class="custom-control-input">
                            <label class="custom-control-label" for="customRadio2">Passive</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Create</button>
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
        $("#selectize-select").selectize();
    </script>
@endpush
