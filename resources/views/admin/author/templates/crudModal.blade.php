<div class="modal fade" id="crudObjectModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form id="frmCrudObject" action="{{ route('admin.' . $crudRoutePath . '.store') }}" method="post"
        enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="object_id" id="object_id">
          <input type="hidden" name="crudRoutePath" id="crudRoutePath" value="{{ $crudRoutePath }}">
          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
              <div class="form-group">
                <label for="group" class="form-control-label mb-1">{{ trans('cruds.permission.fields.group') }}:
                  <span class="text-danger">*</span></label>
                <input id="group" name="group" class="form-control" type="text" value="{{ old('group') }}"
                  placeholder="{{ trans('cruds.permission.fields.group') }}">
                <span class="text-danger error-text group_error"></span>
              </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
              <div class="form-group">
                <label for="title" class="form-control-label mb-1">{{ trans('cruds.permission.fields.title') }}:
                  <span class="text-danger">*</span></label>
                <input id="title" name="title" class="form-control" type="text"
                  placeholder="{{ trans('cruds.permission.fields.title') }}">
                <span class="text-danger error-text title_error"></span>
              </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12">
              <div class="form-group">
                <div class="custom-control custom-switch">
                  <input id="permission_status" name="permission_status" class="custom-control-input" type="checkbox"
                    checked>
                  <label class="custom-control-label" for="permission_status">&nbsp;&nbsp;Status</label>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          @include('admin.templates.button')
        </div>
      </form>
    </div>
  </div>
</div>
