@extends('admin.layouts.app')
@section('title', __('Size Edit'))
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <a href="{{ route('admin.sizes.index') }}" class="btn btn-outline-success waves-effect waves-light mb-1">Sizes</a>
                <form action="{{ route('admin.sizes.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $size->id }}">
                    
                    <div class="form-group mb-3">
                        <label for="size">Size</label>
                        <input type="text" id="size" class="form-control" name="size" value="{{ $size->size }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="name">Size name</label>
                        <input type="text" id="name" class="form-control" name="size" value="{{ $size->size_name }}">
                    </div>
                   
                    <button type="submit" class="btn btn-primary waves-effect waves-light">@lang('Edit')</button>
                </form>
            </div>
        </div>
    </div>


@endsection

@push('css')
    <!-- Sweet Alert-->
    <link href="{{ url('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
@endpush
@push('js')
    <script src="{{ url('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
   
@endpush
