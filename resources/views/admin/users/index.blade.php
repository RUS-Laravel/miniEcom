@extends('admin.layouts.app')
@section('title', __('Users'))
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <button type="button" data-toggle="modal" data-target="#userInsertModal" class="btn btn-outline-success waves-effect waves-light">+ New User</button>
                <button type="button" data-toggle="modal" data-target="#userInformationModal" class="btn btn-outline-success waves-effect waves-light">+ New User Information</button>
                <p class="sub-header font-13">
                    
                </p>
                <div class="table-responsive" data-con="table-res"></div>
                    <ul class="list-group list-group-flush" id="erorrs">
                    </ul>
           
            </div>
        </div>
    </div>
    @include('admin.users.create')
    @include('admin.users.informations.create')
    @include('admin.users.edit')

@endsection
@push('css')
    <!-- Sweet Alert-->
   
@endpush
@push('js')
   
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        let $user_insert_modal = $('#userInsertModal');
        let $user_edit_modal = $('#userEditModal');
        let $user_information_modal = $('#userInformationModal');

        $(document).ready(function() {
            table();
        });

        function table() {
            $.ajax({
                url: "{{ route('admin.users.data') }}",
                success: function(response) {
                    if (response.table !== undefined) {
                        $('[data-con="table-res"]').html(response.table)
                    }
                }
            });
        }
        /*function user_fetch(){
            // console.log('hi');
            $.ajax({
                url:'{{route("admin.users.index")}}',
                success: function(result){
                    console.log(result);
                    if(result !== undefined){
                        $('[data-con="table-res"]').html(result)
                    }
                }
            })
        }
        user_fetch()*/
        $(document.body).on('click','[data-information="user-information-button"]', function(){
            console.log($user_information_modal.find('[name="phone"]').val())
            console.log($user_information_modal.find('[name="address"]').val())
            console.log($user_information_modal.find('[name="user_id"]').val())
            $.ajax({
                url: '{{route("admin.users.informations.store")}}',
                method: 'POST',
                data: {
                    phone: $user_information_modal.find('[name="phone"]').val(),
                    address: $user_information_modal.find('[name="address"]').val(),
                    user_id : $user_information_modal.find('[name="user_id"]').val()
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

        $(document.body).on('click','[data-insert="user-insert-button"]', function(){
            $.ajax({
                url: '{{route("admin.users.store")}}',
                method: 'POST',
                data: {
                    name: $user_insert_modal.find('[name="name"]').val(),
                    surname: $user_insert_modal.find('[name="surname"]').val(),
                    email: $user_insert_modal.find('[name="email"]').val(),
                    password: $user_insert_modal.find('[name="password"]').val(),
                    is_user: $user_insert_modal.find('[name="is_user"]:checked').val(),
                },
                success: function(response){
                    var err = ''
                    console.log(response)
                    if(response.status){
                        Swal.fire(
                            'Notification',
                            response.message,
                            'success'
                        ).then(($result) => {
                            $user_insert_modal.modal('hide')
                            table();
                        })
                    }else{
                        Swal.fire(
                            response.message,
                            response.data,
                            'error'
                        ).then(($result) => {
                            $user_insert_modal.modal('hide')
                            table();
                        })
                        $.each(response.data, function(key, err_message){
                                err = err + '<li class="alert alert-warning py-1">'+err_message+'</li>'
                            });
                        
                        $("#erorrs").html(err);
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
                    if(response.is_user==1)
                        $user_edit_modal.find("#customEditRadio1").attr('checked', true)
                    else
                        $user_edit_modal.find("#customEditRadio2").attr('checked',true)
                
                        $user_edit_modal.modal('show')
                }
            })
        });

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

        $(document.body).on('click', '[data-con="user_del_button"]', function(){
           //console.log($(this).data('id'))
          
            $.ajax({
                url:$(this).data('url'),
                success: function(res){
                    console.log(res);
                    if(res.status){
                        Swal.fire(
                            'Notification',
                            res.message,
                            'success'
                        )
                        table();
                    }
                }
            })
        });
    </script>
@endpush
