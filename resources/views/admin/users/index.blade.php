@extends('admin.layouts.app')
@section('title', __('Users'))
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <button type="button" data-toggle="modal" data-target="#con-close-modal" class="btn btn-outline-success waves-effect waves-light">+ New User</button>
                <p class="sub-header font-13">
                    @include('admin.users.error')
                </p>

                <div class="table-responsive">
                    @include('admin.users.table')
                </div>
            </div>
        </div>
    </div>
    @include('admin.users.create')
    @include('admin.users.edit')

@endsection
@push('css')
    <!-- Sweet Alert-->
    <link href="{{ url('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
@endpush
@push('js')
    <script src="{{ url('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script>
        let $user_edit_modal = $('#userEditModal');

        $(document.body).on('click', '[data-control="user-edit-button"]', function() {
            $.ajax({
                url: $(this).data('url'),
                success: function(response) {
                    $user_edit_modal.find('[name="id"]').val(response.id)
                    $user_edit_modal.find('[name="name"]').val(response.name)
                    $user_edit_modal.find('[name="surname"]').val(response.surname)
                    $user_edit_modal.find('[name="email"]').val(response.email)
                    // $user_edit_modal.find('[name="is_user"]').val(response.name)
                    $user_edit_modal.modal('show')
                }
            });
        })

        $(document.body).on('click', '[data-control="user-update-button"]', function() {
            $.ajax({
                method: 'POST',
                url: '{{ route('admin.users.update') }}',
                data: {
                    id: $user_edit_modal.find('[name="id"]').val(),
                    name: $user_edit_modal.find('[name="name"]').val(),
                    surname: $user_edit_modal.find('[name="surname"]').val(),
                    email: $user_edit_modal.find('[name="email"]').val(),
                    password: $user_edit_modal.find('[name="password"]').val(),
                    is_user: $user_edit_modal.find('[name="is_user"]:checked').val(),
                },
                success: function(response) {
                    console.log(response);
                    if (response.status) {
                        Swal.fire(
                            'Notification',
                            response.message,
                            'success'
                        ).then((result) => {
                            if (result.value) {
                                $user_edit_modal.modal('hide')
                            }
                        })
                    } else {
                        Swal.fire(
                            response.message,
                            response.data,
                            'error'
                        )
                    }
                }
            });
        })
    </script>
@endpush
