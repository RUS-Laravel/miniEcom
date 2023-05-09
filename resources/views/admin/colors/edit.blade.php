@extends('admin.layouts.app')
@section('title', __('Color Edit'))
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                
                <form action="{{ route('admin.colors.update') }}" method="POST">
                    @csrf
                   
                    <div class="form-group mb-3">
                        <input type="hidden" name="id" value="{{$color->id}}">
                        <label for="name">Color name</label>
                        <input type="text" id="name" class="form-control" name="name" value="{{ $color->color_name }}">
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
