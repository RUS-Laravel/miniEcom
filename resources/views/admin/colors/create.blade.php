@extends('admin.layouts.app')
@section('title', __('Color Create'))
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <a href="javascript:void(0)" class="btn btn-outline-success waves-effect waves-light mb-1 addRow"><i class="mdi mdi-sticker-plus-outline"></i>Add color</a>
                <form action="{{ route('admin.colors.store') }}" method="post">
                    @csrf

                    <div id="colorRow">
                        <div class="row">
                            <div class="col-md-9">
                                <div class="form-group mb-3">
                                    <label for="name">Color name<span class="text-danger">*</span></label>
                                    <input type="text" id="name" class="form-control" name="name[]" placeholder="Color name">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <a href="javascript:void(0)" class="btn btn-danger remove mt-3"><i class="mdi mdi-window-close"></i></a>
                            </div>
                        </div>
                    </div>
              
                    <button type="submit" class="btn btn-primary waves-effect waves-light" id="submit_all">Create</button>
                </form>
                <br>


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
   
    <script>
    

        $(document).ready(function(){
            $('.addRow').on('click', function(){
                addRow();
            });

            function addRow(){
                var row = '<div class="row">'+
                            '<div class="col-md-9">'+
                                '<div class="form-group mb-3">'+
                                    '<label for="name">Color name</label>'+
                                    '<input type="text" id="name" class="form-control" name="name[]" placeholder="Color name">'+
                                '</div>'+
                            '</div>'+
                            '<div class="col-md-3">'+
                                '<a href="javascript:void(0)" class="btn btn-danger remove mt-3"><i class="mdi mdi-window-close"></i></a>'+
                            '</div>'+
                        '</div>';
                    $('#colorRow').append(row);
            }
            $(document).on('click', '.remove', function(){
                    var last = $('#colorRow .form-group').length;
                    if(last==1){
                        alert("no deleted one row");
                    }else{
                        $(this).parent().parent().remove();
                    }
                    
            });
        });
        
    </script>

@endpush
