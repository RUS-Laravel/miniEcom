<div id="userInformationModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <form action="{{route("client.profiles.store")}}" method="POST">
            @csrf
            <input type="hidden" name="user_id" value="{{auth("client")->user()->id}}">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">@lang('Create New User Information')</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="field-1" class="control-label">Phone</label>
                                <input type="telephone" class="form-control" name="phone" placeholder="Phone">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="field-2" class="control-label">Address</label>
                                <textarea class="form-control" name="address" rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                   
                </div>
                <div class="modal-footer border-top">
                    <button type="button" data-information="user-information-button" class="btn btn-info waves-effect waves-light">Create</button>
                </div>
            </div>
        </form>
    </div>
</div><!-- /.modal -->
