@extends('client.layouts.app')
@section('title', __('Orders'))
@section('content')
    <div class="row mb-2">
        <div class="col-lg-8">
            <form class="form-inline">
                <div class="form-group mb-2">
                    <label for="inputPassword2" class="sr-only">Search</label>
                    <input type="search" class="form-control" id="inputPassword2" placeholder="Search...">
                </div>
                <div class="form-group mx-sm-3 mb-2">
                    <label for="status-select" class="mr-2">Status</label>
                    <select class="custom-select" id="status-select">
                        <option selected>Choose...</option>
                        <option value="1">Paid</option>
                        <option value="2">Awaiting Authorization</option>
                        <option value="3">Payment failed</option>
                        <option value="4">Cash On Delivery</option>
                        <option value="5">Fulfilled</option>
                        <option value="6">Unfulfilled</option>
                    </select>
                </div>
            </form>
        </div>
        <div class="col-lg-4">
            <div class="text-lg-right">
            </div>
        </div><!-- end col-->
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <div class="table-responsive" data-control="data-table"></div>
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
                url: "{{ route('client.orders.data') }}",
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
