<div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf
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
                                <select id="selectize-select" name="parent_id">
                                    <option data-display="Select" value="">Parent</option>
                                    @foreach ($parents as $parent)
                                    <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                                    @foreach ($parent->categories as $cat)
                                    <option value="{{ $cat->id }}">---{{ $cat->name }}</option>
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
                                <label for="field-4" class="control-label">Tags</label>
                                <input type="text" class="form-control" name="tags" placeholder="Tags">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="field-5" class="control-label">Description</label>
                                <input type="text" class="form-control" name="description" placeholder="">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio1" name="status" value="1" checked class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio1">Active</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio2" name="status" value="2" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio2">Passive</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top">
                    <button type="submit" class="btn btn-info waves-effect waves-light">Create</button>
                </div>
            </div>
        </form>
    </div>
</div><!-- /.modal -->
