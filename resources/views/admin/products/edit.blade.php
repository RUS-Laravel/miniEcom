@extends('admin.layouts.app')
@section('title', __('Product Edit'))
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <form action="{{ route('admin.products.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{$product->id}}">
                    <div class="form-group">
                        <label>Category</label> <br />
                        <select id="selectize-select-edit" name="category_id">
                            
                            @foreach ($parents as $parent)
                                @if ($parent->id == $product->category_id)
                                    <option value="{{ $parent->id }}" selected>{{ $parent->name }}</option>
                                    <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                                    @foreach ($parent->categories as $cat)
                                    <option value="{{ $cat->id }}">---{{ $cat->name }}</option>
                                    @endforeach
                                @endif
                            
                        </select>
                        
                    </div>
                    <div class="form-group mb-3">
                        <label for="title">Product title</label>
                        <input type="text" id="title" class="form-control" name="title" value="{{$product->title}}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="code">Product code</label>
                        <input type="text" id="code" class="form-control" name="code" value="{{$product->code}}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="stock">Product stock</label>
                        <input type="number" id="stock" class="form-control" name="stock" value="{{$product->stock}}" min=0>
                    </div>
                    <div class="form-group mb-3">
                        <label for="discount">Product discount</label>
                        <input type="number" id="discount" class="form-control" name="discount" value="{{$product->discount}}" min=0>
                    </div>
                    <div class="form-group mb-3">
                        <label for="price">Product price</label>
                        <input type="number" id="price" class="form-control" name="price" value="{{$product->price}}"min=0>
                    </div>
                    <div class="form-group mb-3">
                        <label for="description">Product description</label>
                        <textarea class="form-control" id="description" name="description" rows="5">{{$product->description ?? ''}}</textarea>
                    </div>
                    <div class="form-group mb-3">
                        
                            @if ({{$product->id}} == 1)
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadioEdit1" name="status" checked value="1" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadioEdit1">Active</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadioEdit2" name="status" value="2" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadioEdit2">Passive</label>
                                </div>
                            @else
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadioEdit1" name="status" value="1" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadioEdit1">Active</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadioEdit2" name="status" checked value="2" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadioEdit2">Passive</label>
                                </div>
                            @endif

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


