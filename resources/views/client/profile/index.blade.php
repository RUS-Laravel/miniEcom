@extends('client.layouts.app')
@section('title' , __("Profile"))
@section('content')

<div class="row">
    <div class="col-md-12">
            <div class="card-box">
                <button type="button" data-url="{{route('client.profiles.edit', auth("client")->user()->id)}}" data-toggle="modal" data-target="#userEditModal" data-control="user-edit-button" class="btn btn-outline-primary waves-effect waves-light">@lang("User edit")</button>
                <button type="button" data-toggle="modal" data-target="#userInformationModal" class="btn btn-outline-success waves-effect waves-light">+ New User Information</button>
            </div>

            <ul class="list-group list-group-flush" id="erorrs">
            </ul>
    </div>
</div>

<div data-con="table-res">
</div>
@include('client.profile.create')
@include('client.profile.edit')
@endsection
@push('js')
   
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        let $user_edit_modal = $('#userEditModal');
        let $user_information_modal = $('#userInformationModal');

        $(document).ready(function() {
            table();
        });

        function table() {
            $.ajax({
                url: "{{ route('client.profiles.data') }}",
                success: function(response) {
                    if (response.table !== undefined) {
                        $('[data-con="table-res"]').html(response.table)
                    }
                }
            });
        }

        $(document.body).on('click','[data-information="user-information-button"]', function(){
            /*console.log($user_information_modal.find('[name="phone"]').val())
            console.log($user_information_modal.find('[name="address"]').val())
            console.log($user_information_modal.find('[name="user_id"]').val())*/
            $.ajax({
                url: '{{route("client.profiles.store")}}',
                method: 'POST',
                data: {
                    user_id: $user_information_modal.find('[name="user_id"]').val(),
                    phone: $user_information_modal.find('[name="phone"]').val(),
                    address: $user_information_modal.find('[name="address"]').val(),
                   
                },
                success: function(response){
                   
                    console.log(response)
                    if(response.status){
                        Swal.fire(
                            'Notification',
                            response.message,
                            'success'
                        ).then(($result) => {
                            $user_information_modal.modal('hide')
                            table();
                        })
                    }else{
                        Swal.fire(
                            response.message,
                            response.data,
                            'error'
                        ).then(($result) => {
                            $user_information_modal.modal('hide')
                            table();
                        })
                       
                    }
                }
            })
        })

        $(document.body).on('click', '[data-control="user-edit-button"]', function() {
            
            $.ajax({
                url: $(this).data('url'),
                success: function(response) {
                    //console.log(response);
                    $user_edit_modal.find('[name="id"]').val(response.id)
                    $user_edit_modal.find('[name="name"]').val(response.name)
                    $user_edit_modal.find('[name="surname"]').val(response.surname)
                    $user_edit_modal.find('[name="email"]').val(response.email)
                    $user_edit_modal.find('[name="password"]').val(response.password)
                   
                        $user_edit_modal.modal('show')
                }
            })
        });

        $(document.body).on('click', '[data-control="user-update-button"]', function() {
            $.ajax({
                method: 'POST',
                url: '{{ route("client.profiles.update") }}',
                data: {
                    id: $user_edit_modal.find('[name="id"]').val(),
                    name: $user_edit_modal.find('[name="name"]').val(),
                    surname: $user_edit_modal.find('[name="surname"]').val(),
                    email: $user_edit_modal.find('[name="email"]').val(),
                    password: $user_edit_modal.find('[name="password"]').val(),
                
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
                                table();
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