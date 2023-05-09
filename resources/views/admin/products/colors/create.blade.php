@extends('admin.layouts.app')
@section('title', __('Product Color Create'))
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                
                <form action="{{ route('admin.products.colors.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label>Product<span class="text-danger">*</span></label> <br />
                        <select id="selectize-select" name="product_id">
                            <option data-display="Select" value="">Choose Product</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}">{{ $product->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Color<span class="text-danger">*</span></label> <br />
                        <select class="form-control select2-multiple" data-toggle="select2" multiple="multiple" name="color_id[]" data-placeholder="Choose Color">
                            @foreach ($colors as $color)
                                <option value="{{$color->id}}">{{$color->color_name}}</option>
                            @endforeach
                                 
                        </select> 
                    </div>                 
                    <button type="submit" class="btn btn-primary waves-effect waves-light" id="submit_all">Create</button>
                </form>
                <br>


            </div>
        </div>
    </div>

   
@endsection

@push('css-lib')
{{--<link href="{{url('assets/libs/multiselect/css/multi-select.css')}}" rel="stylesheet" type="text/css" />--}}
<link href="{{ url('assets/libs/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" type="text/css" />
<link href="{{url('assets/libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
{{--<link href="{{url('assets/libs/bootstrap-select/css/bootstrap-select.min.css')}}" rel="stylesheet" type="text/css" /> --}}
@endpush
@push('css')
    <!-- Sweet Alert-->
    <link href="{{ url('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('js')
    <script src="{{ url('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ url('assets/libs/selectize/js/standalone/selectize.min.js') }}"></script>
    {{--<script src="{{url('/assets/libs/multiselect/js/jquery.multi-select.js')}}"></script>--}}
    <script src="{{url('assets/libs/select2/js/select2.min.js')}}"></script>
    {{--<script src="{{url('assets/libs/bootstrap-select/js/bootstrap-select.min.js')}}"></script>--}}
    <script>
        $("#selectize-select").selectize();
        $('.select2-multiple').select2();
        
    </script>

@endpush
