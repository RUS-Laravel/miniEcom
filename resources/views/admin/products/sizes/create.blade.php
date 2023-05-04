@extends('admin.layouts.app')
@section('title', __('Product Size Create'))
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <a href="{{ route('admin.sizes.index') }}" class="btn btn-outline-success waves-effect waves-light mb-1">Sizes</a>
                <form action="{{ route('admin.sizes.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label>Product</label> <br />
                        <select id="selectize-select" name="product_id">
                            <option data-display="Select" value="">Choose Product</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}">{{ $product->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Size</th>
                                <th>Size Name</th>
                               
                                <th>
                                    <a href="javascript:void(0)" class="btn btn-primary addRow"><i class="mdi mdi-sticker-plus-outline"></i>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="form-group mb-3">
                                        <label for="name">Size</label>
                                        <input type="text" id="size" class="form-control" name="size[]" placeholder="Size">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group mb-3">
                                        <label for="name">Size name</label>
                                        <input type="text" id="name" class="form-control" name="name[]" placeholder="Size name">
                                    </div>
                                </td>
                                <td>
                                    <a href="javascript:void(0)" class="btn btn-danger remove"><i class="mdi mdi-window-close"></i>
                                </td>
                            </tr>
                            
                        </tbody>
                    </table>
                    
                   
                    <button type="submit" class="btn btn-primary waves-effect waves-light" id="submit_all">Create</button>
                </form>
                <br>


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

        $(document).ready(function(){
            $('.addRow').on('click', function(){
                addRow();
            });

            function addRow(){
                    var tr = '<tr>'+
                        '<td>'+
                            '<div class="form-group mb-3">'+
                                '<label for="name">Size</label>'+
                                '<input type="text" id="size" class="form-control" name="size[]" placeholder="Size">'+
                            '</div>'+
                        '</td>'+
                        '<td>'+
                            '<div class="form-group mb-3">'+
                                '<label for="name">Size name</label>'+
                                '<input type="text" id="name" class="form-control" name="name[]" placeholder="Size name">'+
                            '</div>'+
                        '</td>'+
                        '<td><a href="javascript:void(0)" class="btn btn-danger remove"><i class="mdi mdi-window-close"></i></a></td>'+
                    '</tr>';
                    $('tbody').append(tr);
            }
            $(document).on('click', '.remove', function(){
                    var last = $('tbody tr').length;
                    if(last==1){
                        alert("no deleted one row");
                    }else{
                        $(this).parent().parent().remove();
                    }
                    
            });
        });
    </script>

@endpush
