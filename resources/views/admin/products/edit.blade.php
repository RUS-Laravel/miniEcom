@extends('admin.layouts.app')
@section('title', __('Product Edit'))
@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="card-box">
                <form action="{{ route('admin.products.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $product->id }}">
                    <div class="form-group">
                        <label>Category</label> <br />
                        <select id="selectize-select-edit" name="category_id">
                            <option data-display="Select" value="">Choose Category</option>
                            @isset($parents)
                                @foreach ($parents as $parent)
                                    <option value="{{ $parent->id }}" {{ $parent->id == $product->category_id ? 'selected' : '' }}>{{ $parent->name }}</option>
                                    @foreach ($parent->categories as $cat)
                                        <option value="{{ $cat->id }}" {{ $cat->id == $product->category_id ? 'selected' : '' }}>---{{ $cat->name }}</option>
                                        @foreach ($cat->categories as $child)
                                            <option value="{{ $child->id }}" {{ $child->id == $product->category_id ? 'selected' : '' }}>---{{ $child->name }}</option>
                                        @endforeach
                                    @endforeach
                                @endforeach
                            @endisset
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="title">Product title</label>
                        <input type="text" id="title" class="form-control" name="title" value="{{ $product->title }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="code">Product code</label>
                        <input type="text" id="code" class="form-control" name="code" value="{{ $product->code }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="recevied">Product recevied price<span class="text-danger">*</span></label>
                        <input type="number" id="recevied" class="form-control" name="product_recevied" value="{{ $product->product_recevied }}" min="0">
                    </div>
                    <div class="form-group mb-3">
                        <label for="stock">Product stock</label>
                        <input type="number" id="stock" class="form-control" name="stock" value="{{ $product->stock }}" min="0">
                    </div>
                    <div class="form-group mb-3">
                        <label for="discount">Product discount</label>
                        <input type="number" id="discount" class="form-control" name="discount" value="{{ $product->discount }}" min="0">
                    </div>
                    <div class="form-group mb-3">
                        <label for="price">Product price</label>
                        <input type="number" id="price" class="form-control" name="price" value="{{ $product->price }}" min="0">
                    </div>
                    <div class="form-group mb-3">
                        <label for="tags">Product tags<span class="text-danger">*</span></label>
                        <input type="text" id="tags" class="form-control" name="tags" value="{{ $product->tags }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="product-description">Product description</label>
                        <textarea class="form-control" id="product-description" name="description" rows="5">{!! $product->description ?? '' !!}</textarea>
                    </div>
                    <div class="form-group mb-3">

                        <div class="custom-control custom-radio">
                            <input type="radio" id="customRadioEdit1" name="status" {{ $product->status == 1 ? 'checked' : '' }} value="1" class="custom-control-input">
                            <label class="custom-control-label" for="customRadioEdit1">Active</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="customRadioEdit2" name="status" {{ $product->status == 2 ? 'checked' : '' }} value="2" class="custom-control-input">
                            <label class="custom-control-label" for="customRadioEdit2">Passive</label>
                        </div>

                    </div>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">@lang('Edit')</button>
                </form>
            </div>
        </div>

        <div class="col-lg-6">

            <div class="card-box">
                <h5 class="text-uppercase mt-0 mb-3 bg-light p-2">Product Images</h5>
                <form action="{{ route('admin.products.store.image') }}" method="POST" class="dropzone" id="productDropzone" data-plugin="dropzone" data-previews-container="#file-previews"
                      data-upload-preview-template="#uploadPreviewTemplate" enctype="multipart/form-data">
                      <input type="hidden" name="product_id" data-product="productId" value="{{$product->id}}">
                    @csrf
                    
                    <div class="fallback">
                        <input name="file" type="file" multiple />
                    </div>

                    <div class="dz-message needsclick">
                        <i class="h1 text-muted dripicons-cloud-upload"></i>
                        <h3>Drop files here or click to upload.</h3>

                    </div>

                    <!-- Preview -->
                    <div class="dropzone-previews mt-3" id="file-previews"></div><br>
                </form>    
            </div>

            <div class="card mt-1 mb-0 shadow-none border">
                @if ($product->images->count())
                @foreach ($product->images as $image)                   
                <div class="p-2">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <img src="{{ url($image->path . $image->name) }}" class="avatar-sm rounded bg-light" alt="{{$image->name}}">
                        </div>
                        <div class="col pl-0">
                            <a href="javascript:void(0);" class="text-muted font-weight-bold"></a>
                        </div>
                        <div class="col-auto">
                            <!-- Button -->
                            <a href="{{route('admin.products.delete.image', $image->id)}}" class="btn btn-link btn-lg text-muted">
                                <i class="dripicons-cross"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>

<!-- file preview template -->
<div class="d-none" id="uploadPreviewTemplate">
    <div class="card mt-1 mb-0 shadow-none border">
        <div class="p-2">
            <div class="row align-items-center">
                <div class="col-auto">
                    <img data-dz-thumbnail src="#" class="avatar-sm rounded bg-light" alt="">
                </div>
                <div class="col pl-0">
                    <a href="javascript:void(0);" class="text-muted font-weight-bold" data-dz-name></a>
                    <p class="mb-0" data-dz-size></p>
                </div>
                <div class="col-auto">
                    <!-- Button -->
                    <a href="" class="btn btn-link btn-lg text-muted" data-dz-remove>
                        <i class="dripicons-cross"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('css-dropzone')
    <!-- Dropzone-->
    <link href="{{ url('assets/libs/dropzone/min/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
@endpush
@push('css-lib')
    <link href="{{ url('assets/libs/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/libs/summernote/summernote-bs4.min.css') }}" rel="stylesheet" type="text/css" />
@endpush
@push('css')
    <!-- Sweet Alert-->
    <link href="{{ url('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
@endpush
@push('js-dropzone')
    <script src="{{ url('assets/libs/dropzone/min/dropzone.min.js') }}"></script>

    <script type="text/javascript">
         Dropzone.options.productDropzone = {
            autoProcessQueue: true,
            clickable: true,
            paramName: "file", // The name that will be used to transfer the file
            maxFilesize: 2, // MB
            /*
            dictFileTooBig: '@lang('dropzone.error.max_size', ['size' => 2])',
            dictDefaultMessage: '@lang('dropzone.message.drop_upload')',
            dictRemoveFile: '@lang('dropzone.message.remove')',
            dictCancelUpload: '@lang('dropzone.message.cancel')',
            dictInvalidFileType: '@lang('dropzone.message.dictInvalidFileType')',
            dictMaxFilesExceeded: '@lang('dropzone.message.dictMaxFilesExceeded', ['param' => 6])',
            */
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            addRemoveLinks: false,
            parallelUploads: 6,
            maxFiles: 6,
            cache: false,

            success: function(file, response) {
                //if (response.status === false) {
                    console.log(response);
                    //$(".dz-preview").remove();
                //}
            },
            error: function(file, response) {
                return false;
            },
            removedfile: function(file) {
                //let name = file.previewElement.id;
                console.log(file.name);
                //     let _ref;
                //     return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
            },

            init: function() {

                // var submitButton = document.querySelector(".js-button-product-submit");
                // myDropzone = this;
                // submitButton.addEventListener("click", function () {
                //
                // });
            }
        };
    </script>
    <!-- Summernote js -->
    <script src="{{ url('assets/libs/summernote/summernote-bs4.min.js') }}"></script>
    <!-- Init js-->
    <script src="{{ url('assets/js/pages/form-fileuploads.init.js') }}"></script>
@endpush

@push('js')
    <script src="{{ url('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ url('assets/libs/selectize/js/standalone/selectize.min.js') }}"></script>
    <script>
        $("#selectize-select-edit").selectize();
        $('#product-description').summernote();
    </script>
@endpush
