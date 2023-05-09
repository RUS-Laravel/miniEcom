@extends('admin.layouts.app')
@section('title', __('Product Sizes'))
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <a href="{{ route('admin.products.sizes.create') }}" class="btn btn-outline-success waves-effect waves-light">+ New Select Size</a>
                <p class="sub-header font-13">
                    @include('admin.products.sizes.error')
                </p>
                <div class="table-responsive mt-1" data-control="data-table"></div>
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
        function table() {
            $.ajax({
                url: "{{ route('admin.products.sizes.data') }}",
                success: function(response) {
                    if (response.table !== undefined) {
                        $('[data-control="data-table"]').html(response.table)
                    }
                }
            });
        }

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
