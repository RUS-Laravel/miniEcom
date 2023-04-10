<div id="editModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <form action="{{ route('admin.categories.update') }}" method="POST">
            @csrf
            <input type="hidden" name="id">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">@lang('Create New Categories')</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Select</label> <br />
                                <select id="selectize-select-edit" name="parent_id">
                                    <!--<option data-display="Select" value="">Parent</option>-->
                                    @foreach ($parents as $data)
                                    <option value="{{ $data->id }}">{{ $data->name }}</option>
                                        @foreach ($data->categories as $cat)
                                        <option value="{{ $cat->id }}">---{{ $cat->name}}</option>
                                        @endforeach
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="field-3" class="control-label">Name</label>
                                <input type="text" class="form-control" name="name" placeholder="">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="field-3" class="control-label">Description</label>
                                <input type="text" class="form-control" name="description" placeholder="">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadioEdit1" name="status" value="1" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadioEdit1">Active</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadioEdit2" name="status" value="2" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadioEdit2">Passive</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top">
                    <button type="button" data-control="update-button" class="btn btn-info waves-effect waves-light">@lang('Edit')</button>
                </div>
            </div>
        </form>
    </div>
</div><!-- /.modal -->
