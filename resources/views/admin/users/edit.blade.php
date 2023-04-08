<div id="userEditModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="userEditModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <form action="{{ route('admin.users.update') }}" method="POST">
            @csrf
            <input type="hidden" name="id">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">@lang('Edit User')</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field-1" class="control-label">Name</label>
                                <input type="text" class="form-control" name="name" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field-2" class="control-label">Surname</label>
                                <input type="text" class="form-control" name="surname" placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="field-3" class="control-label">Email</label>
                                <input type="email" class="form-control" name="email" placeholder="">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group no-margin">
                                <label for="field-7" class="control-label">Password</label>
                                <input type="text" class="form-control" name="password" placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="mt-3">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadioedit1" name="is_user" value="1" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadioedit1">Admin User</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadioEdit2" name="is_user" value="2" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadioEdit2">Client User</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top">
                    <button type="button" data-control="user-update-button" class="btn btn-info waves-effect waves-light">@lang('Edit')</button>
                </div>
            </div>
        </form>
    </div>
</div><!-- /.modal -->
