@extends('admin.layouts.app')
@section('title', __('Sizes'))
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <a href="{{ route('admin.sizes.create') }}" class="btn btn-outline-success waves-effect waves-light">+ New Size</a>
                <p class="sub-header font-13">
                    @include('admin.sizes.error')
                </p>
                <div class="table-responsive mt-1" data-control="data-table"></div>
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
        $(document).ready(function() {
            table();
        });
        function table() {
            $.ajax({
                url: "{{ route('admin.sizes.data') }}",
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
