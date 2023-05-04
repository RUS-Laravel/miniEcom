@extends('admin.layouts.app')
@section('title', __('Products'))
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">

                <div class="row">
                    <div class="col-lg-6">
                        <form class="form-inline"> 
                            @csrf
                            <div class="form-group">
                                <label for="search" class="sr-only">Search</label>
                                <input type="search" class="form-control" id="search" name="search" placeholder="Product search...">
                            </div>
                    
                            <div class="form-group mx-sm-3">
                                <label for="status-select" class="mr-2">Sort By</label>
                                <select class="custom-select" id="status-select" name="status-select">
                                    <option selected>All</option>
                                    <option value="1">Popular</option>{{-- en cox beyenilen--}}
                                    <option value="2">Price Low</option>
                                    <option value="3">Price High</option>
                                    <option value="4">Sold Out</option>{{-- en cox satilan--}}
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-6">
                        <div class="text-lg-right mt-3 mt-lg-0">
                            <a href="{{ route('admin.colors.index') }}" class="btn btn-outline-success waves-effect waves-light">Product colors</a>
                            <a href="{{ route('admin.sizes.index') }}" class="btn btn-outline-success waves-effect waves-light">Product sizes</a>
                            <a href="{{ route('admin.products.create') }}" class="btn btn-danger waves-effect waves-light"><i class="mdi mdi-plus-circle mr-1"></i> Add New</a>
                        </div>
                    </div><!-- end col-->
                </div> <!-- end row -->
                
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card-box product-box">
                <p class="sub-header font-13">
                    @include('admin.products.error')
                </p>
                <div class="table-responsive mt-1 mb-1" data-control="data-table">
                  
                </div>
                @isset($products)
                {!! $products->withQueryString()->links('vendor.pagination.bootstrap-5') !!}
    
                @endisset
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
        $(document).ready(function() {
            table();
        });
        function table(search='', sort='') {
            $.ajax({
                url: "{{ route('admin.products.data') }}",
                data:{search:search, sort:sort},
                dataType: 'json',
                success: function(response) {
                    if (response.blade !== undefined) {
                        $('[data-control="data-table"]').html(response.blade)
                    }
                }
            });
        }

         
        //SEARCH

        $(document).on('keyup','#search', function(){
            var query = $(this).val();
            table(query);
        });

        //SORT

        $(document).on('change','#status-select', function(){
            var select = $(this).val();
            //console.log(select);
            table(select);
        });


        $(document.body).on('click', '[data-control="delete-button"]', function() {
            Swal.fire({
                title: 'Do you want to save the changes?',
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonText: 'Delete',
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: $(this).data('url'),
                        method: 'POST',
                        success: function(response) {
                            table()
                            Swal.fire(response.message, '', 'success')
                        }
                    });

                }
            })



        })
    </script>
@endpush
