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
                                    <option selected value="">All</option>
                                    <option value="popular">Popular</option>{{-- en cox beyenilen --}}
                                    <option value="low">Price Low</option>
                                    <option value="high">Price High</option>
                                    <option value="sold">Sold Out</option>{{-- en cox satilan --}}
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-6">
                        <div class="text-lg-right mt-3 mt-lg-0">
                            <a href="{{ route('admin.products.colors.index') }}" class="btn btn-outline-success waves-effect waves-light">Product colors</a>
                            <a href="{{ route('admin.products.sizes.index') }}" class="btn btn-outline-success waves-effect waves-light">Product sizes</a>
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
                <div class="table-responsive mt-1 mb-1" data-control="data-tablee">
                    <table id="data-table" class="table">
                        <thead>
                            <tr>
                                <th class="">@lang('Index')</th>
                                <th class="">@lang('Title')</th>
                                <th class="">@lang('Price')</th>
                                <th class="">@lang('Category')</th>
                                <th class="">@lang('Stock')</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                {{-- @isset($products)
                {!! $products->withQueryString()->links('vendor.pagination.bootstrap-5') !!}
    
                @endisset --}}
            </div>
        </div>
    </div>


@endsection
@push('css-lib')
    <link href="{{ url('assets/libs/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
@endpush
@push('css')
    <!-- Sweet Alert-->
    <link href="{{ url('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
@endpush
@push('js')
    <script src="{{ url('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ url('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ url('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ url('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ url('assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ url('assets/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ url('assets/libs/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
    <script src="{{ url('assets/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ url('assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ url('assets/libs/datatables.net-select/js/dataTables.select.min.js') }}"></script>
    <script src="{{ url('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ url('assets/libs/selectize/js/standalone/selectize.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#data-table').dataTable({

                "lengthMenu": [
                    [2, 250, 500, 1000, -1],
                    [2, 250, 500, 1000, "Tümü"]
                ],
                "ajax": {
                    url: '{{ route('admin.products.data') }}',
                    error: function(xhr, error, code) {
                        if (xhr.responseJSON)
                            console.log(xhr.responseJSON.message, code)
                    },
                    dataSrc: function(json) {
                        return json.data;
                    },
                    data: function(d) {
                        // backende requestin ötürülmesi
                        d._token = '{{ csrf_token() }}';
                        d.search = $('input[type="search"]').val();
                    },
                },
                columns: [{
                        data: 'id'
                    },
                    {
                        data: 'title'
                    },
                    {
                        data: 'price',
                        class: 'text-right'
                    },
                    {
                        data: 'category.name',
                    },
                    {
                        data: 'stock',
                        class: 'text-right'
                    }
                ],
            });
        });
        $(document).ready(function() {
            // table();
        });

        function table(data = {}) {
            $.ajax({
                url: "{{ route('admin.products.data') }}",
                data: data,
                dataType: 'json',
                success: function(response) {
                    if (response.blade !== undefined) {
                        $('[data-control="data-table"]').html(response.blade)
                    }
                }
            });
        }


        //SEARCH

        $(document).on('keyup', '#search', function() {
            var query = $(this).val();
            table({
                search: query,
                sort: $('#status-select').find(':selected').val()
            });
        });

        //SORT 

        $(document).on('change', '#status-select', function() {
            var select = $(this).val();
            console.log(select);
            table({
                query: $('#search').val(),
                sort: select
            });
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
