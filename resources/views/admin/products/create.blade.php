@extends('admin.layouts.app')
@section('title', __('Product Create'))
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                 
                <form action="{{route('admin.products.store')}}" method="post" class="dropzone" id="mydropzone" data-plugin="dropzone" data-previews-container="#file-previews"
                data-upload-preview-template="#uploadPreviewTemplate" enctype="multipart/form-data">
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
                
                    <div class="form-group">
                        <label>Category</label> <br />
                        <select id="selectize-select" name="category_id">
                            <option data-display="Select" value="">Choose Category</option>
                            @foreach ($parents as $parent)
                                <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                                @foreach ($parent->categories as $cat)
                                    <option value="{{ $cat->id }}">--{{ $cat->name }}</option>
                                    @foreach ($cat->categories as $c)
                                     <option value="{{ $c->id }}">----{{ $c->name }}</option>
                                    @endforeach
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

                    <button type="submit" class="btn btn-primary waves-effect waves-light" id="submit_all">Create</button>
                </form>
                <br>
             
              
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
@endpush
@push('css')
    <!-- Sweet Alert-->
    <link href="{{ url('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
@endpush
@push('js-dropzone')
    
    <script src="{{ url('assets/libs/dropzone/min/dropzone.min.js') }}"></script>
    
    <script type="text/javascript">
        Dropzone.autoDiscover = false;
        Dropzone.options.mydropzone ={
            /*paramName: "file",
            uploadMultiple: true,*/
            autoProcessQueue: false,
            maxFilesize: 8,
            //addRemoveLinks: false,
            //previewsContainer: "div#file-previews",
            timeout: 5000,
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            success: function(file, response) 
            {
                console.log(response);
            },
            error: function(file, response)
            {
               return false;
            }
               /* init:function(){
                    var submitButton = document.querySelector('#submit_all');
                    var myDropzone = this;
                    submitButton.addEventListener('click', function(){
                        myDropzone.processQueue();
                    });
                   
                }*/
        }
           
    </script>
    <!-- Init js-->
    <script src="{{ url('assets/js/pages/form-fileuploads.init.js') }}"></script>
@endpush
@push('js')
    <script src="{{ url('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ url('assets/libs/selectize/js/standalone/selectize.min.js') }}"></script>
    <script>
        $("#selectize-select").selectize();

    </script>
@endpush
