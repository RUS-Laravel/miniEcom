@extends('admin.layouts.app')
@section('title', __('Categories Multi'))
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <button type="button" data-toggle="modal" data-target="#con-close-modal" class="btn btn-outline-success waves-effect waves-light">+ New Category</button>
                <p class="sub-header font-13">
                    @include('admin.categories.error')
                </p>

                <div data-control="category-data-table">
                    {{-- @include('admin.categories.multi_data_cat') --}}
                </div><!-- end col -->

            </div>
        </div>
    </div>
    @include('admin.categories.create')
    @include('admin.categories.edit')
@endsection
@push('css-lib')
    <link href="{{ url('assets/libs/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/libs/nestable2/jquery.nestable.min.css') }}" rel="stylesheet" />
@endpush
@push('css')
    <!-- Sweet Alert-->
    <link href="{{ url('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
@endpush
@push('js')
    <script src="{{ url('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ url('assets/libs/nestable2/jquery.nestable.min.js') }}"></script>
    <script src="{{ url('assets/js/pages/nestable.init.js') }}"></script>
    <script src="{{ url('assets/libs/selectize/js/standalone/selectize.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            fetchData();
            $('[data-action="expand-all"]').click(function() {
                $('[data-parent="child"]').slideDown("slow");
                //$(".dd-collapsed .dd-expand").css("display", "block");  
            });
            $('[data-action="collapse-all"]').click(function() {
                $('[data-parent="child"]').slideUp("slow");
                //$(".dd-collapsed .dd-expand").css("display", "none");
                //$('[data-id="2"]').addClass('dd-colapsed');
            });
            /*$('[data-action="collapse"]').click(function(){
                console.log('hi')
                $('.dd-collapse').css('display','none');
                $('.dd-expand').css('display','block');
                $('.dd-collapsed').css('display','block');
                $(this).data('parent').slideUp();
            });
            $('[data-action="expand"]').click(function(){
                console.log('hi')
                $('.dd-expand').css('display','none');
                $('.dd-collapse').css('display','block');    
                $(this).data('parent').slideDown();
            });*/

        });

        function fetchData() {
            $.ajax({
                url: '{{ route('admin.categories.multi.data') }}',
                success: function(response) {
                    if (response.multicat !== undefined) {
                        $('[data-control="category-data-table"]').html(response.multicat)
                    }
                }
            });
        }

        $("#selectize-select").selectize();
        let $edit_modal = $('#editModal');

        $(document.body).on('click', '[data-control="edit-button"]', function() {
            $.ajax({
                url: $(this).data('url'),
                success: function(response) {
                    $edit_modal.find('[name="id"]').val(response.id)
                    $edit_modal.find('[name="name"]').val(response.name)
                    $edit_modal.find('[name="description"]').val(response.description)
                    // if null olanda parent category yazili olan option select olsun
                    if (response.parent_id == null)
                        $edit_modal.find('[name="parent_id"]').val('Parent Category').attr('selected', true)
                    else
                        // elesede ise alt category-nin parentin name secili olsun
                        $edit_modal.find('[name="parent_id"]').val(response.name).attr('selected', true)
                    if (response.status == 1)
                        $edit_modal.find('#customRadioEdit1').attr('checked', true)
                    else
                        $edit_modal.find('#customRadioEdit2').attr('checked', true)


                    $edit_modal.modal('show')

                    var $select = $("#selectize-select-edit").selectize();
                        var selectize = $select[0].selectize;
                        var defaultValueIds = [response.parent_id];
                        selectize.setValue(defaultValueIds);
                }
            });
        })

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
                        method: 'DELETE',
                        success: function(response) {
                            table()
                            Swal.fire(response.message, '', 'success')
                        }
                    });

                }
            })



        })

        $(document.body).on('click', '[data-control="update-button"]', function() {
            $.ajax({
                method: 'POST',
                url: '{{ route('admin.categories.update') }}',
                data: {
                    id: $edit_modal.find('[name="id"]').val(),
                    name: $edit_modal.find('[name="name"]').val(),
                    description: $edit_modal.find('[name="description"]').val(),
                    status: $edit_modal.find('[name="status"]:checked').val(),
                    parent_id: $edit_modal.find('[name="parent_id"]').val(),
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
                                $edit_modal.modal('hide')
                                table();
                            }
                        })
                    } else {
                        console.log(response);
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
