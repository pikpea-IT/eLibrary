@extends('admin.layouts.master_layout')

@push('select2')
  <link href="{{ assetUrl() }}assets/backend/plugins/select2/css/select2.min.css" rel="stylesheet" />
  <link href="{{ assetUrl() }}assets/backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css"
    rel="stylesheet" />
@endpush

@push('styles')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ assetUrl() }}assets/backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet"
    href="{{ assetUrl() }}assets/backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ assetUrl() }}assets/backend/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ assetUrl() }}assets/backend/dist/css/toggle.css">
  <link rel="stylesheet"
    href="{{ assetUrl() }}assets/backend/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <link rel="stylesheet" href="{{ assetUrl() }}assets/backend/plugins/toastr/toastr.min.css">
  <style>
    input.ace-switch.ace-switch-yesno:checked::before {
      content: "{{ trans('global.yes') }}";
    }

    input.ace-switch.ace-switch-yesno::before {
      content: "{{ trans('global.no') }}";
    }

    input.ace-switch.ace-switch-onoff:checked::before {
      content: "{{ trans('global.on') }}";
    }

    input.ace-switch.ace-switch-onoff::before {
      content: "{{ trans('global.off') }}";
    }
  </style>
@endpush

@section('content')
@section('breadcrumb', trans('cruds.permission.title'))
<div class="card">
  <div class="card-header">
    <h4 class="mb-0 text-primary"><i class="bx bxs-user me-1 font-22 text-primary"></i>{{ trans('global.list') }}
      {{ trans('cruds.permission.title') }}
      @can($prefix . 'create')
        <button id="addNewObject" type="button" class="btn btn-sm btn-outline-primary px-4 radius-30"
          style="float: right;" data-toggle="modal" data-target="#crudObjectModal">
          <i class='bx bxs-plus-square'></i> {{ trans('global.add') }} {{ trans('global.new') }}
        </button>
      @endcan
    </h4>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table id="datatable" class="table table-striped table-bordered">
        <thead>
          <tr>
            <th>{{ trans('cruds.permission.fields.id') }}</th>
            <th>{{ trans('cruds.permission.fields.group') }}</th>
            <th>{{ trans('cruds.permission.fields.title') }}</th>
            <th>{{ trans('cruds.permission.fields.created_at') }}</th>
            <th>{{ trans('global.status') }}</th>
            <th>{{ trans('global.action') }}</th>
          </tr>
        </thead>
        <tbody id="objectList">
          @foreach ($permissions as $row)
            <tr id="tr_object_id_{{ $row->id }}">
              <td>{{ $row->id }}</td>
              <td>{{ $row->group }}</td>
              <td>{{ $row->title }}</td>
              <td>{{ date('d-M-Y', strtotime($row->created_at)) }}</td>
              <td>
                <input id="status" name="status" data-id="{{ $row->id }}" {{ $row->status ? 'checked' : '' }}
                  title="Status" type="checkbox"
                  class="ace-switch input-lg ace-switch-yesno bgc-green-d2 text-grey-m2" />
              </td>
              <td>
                @include('admin.templates.crudAction')
              </td>
            </tr>
          @endforeach
        </tbody>
        <tfoot>
          <tr>
            <th>{{ trans('cruds.permission.fields.id') }}</th>
            <th>{{ trans('cruds.permission.fields.group') }}</th>
            <th>{{ trans('cruds.permission.fields.title') }}</th>
            <th>{{ trans('cruds.permission.fields.created_at') }}</th>
            <th>{{ trans('global.status') }}</th>
            <th>{{ trans('global.action') }}</th>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</div>
@include('admin.permission.templates.crudModal')
@endsection

@push('scripts')
<!-- DataTables  & Plugins -->
<script src="{{ assetUrl() }}assets/backend/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{ assetUrl() }}assets/backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ assetUrl() }}assets/backend/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ assetUrl() }}assets/backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{ assetUrl() }}assets/backend/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{ assetUrl() }}assets/backend/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="{{ assetUrl() }}assets/backend/plugins/jszip/jszip.min.js"></script>
<script src="{{ assetUrl() }}assets/backend/plugins/pdfmake/pdfmake.min.js"></script>
<script src="{{ assetUrl() }}assets/backend/plugins/pdfmake/vfs_fonts.js"></script>
<script src="{{ assetUrl() }}assets/backend/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="{{ assetUrl() }}assets/backend/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="{{ assetUrl() }}assets/backend/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- Select2 -->
<script src="{{ assetUrl() }}assets/backend/plugins/select2/js/select2.full.min.js"></script>
<script src="{{ assetUrl() }}assets/backend/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="{{ assetUrl() }}assets/backend/plugins/toastr/toastr.min.js"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script> --}}
<script>
  $(function() {
    "use strict";
    $(document).ready(function() {
      var table = $('#datatable').DataTable({
        lengthChange: false,
        buttons: ['copy', 'excel', 'pdf', 'print']
      });
      table.buttons().container()
        .appendTo('#datatable_wrapper .col-md-6:eq(0)');
    });
    $('[data-toggle="tooltip"]').tooltip();
  });
</script>
<script>
  $(document).ready(function() {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $('#addNewObject').on('click', function(e) {
      e.preventDefault();
      $('#crudObjectModal').find('.modal-title').html(
        '{{ trans('global.add') }} {{ trans('cruds.permission.title_singular') }}');
      $('#frmCrudObject').find('#object_id').val('');
      $('#frmCrudObject').find('#btnObjectSave').html(
        '<i class="fadeIn animated bx bx-plus-circle"></i>&nbsp;{{ trans('global.save') }}');
      $('#frmCrudObject').find('#btnObjectSave').removeClass('d-none');
      $('#frmCrudObject').find('#btnObjectUpdate').addClass('d-none');
      $('#frmCrudObject').trigger('reset');
    });

    $('#frmCrudObject').on('submit', function(e) {
      e.preventDefault();
      var actionUrl = $(this).attr('action');
      var method = $(this).attr('method')
      $('#btnObjectSave').html('Processing..');
      $('#btnObjectUpdate').html('Processing..');
      $.ajax({
        type: method,
        url: actionUrl,
        data: new FormData(this),
        dataType: 'json',
        processData: false,
        dataType: 'json',
        contentType: false,
        beforeSend: function() {
          $(document).find('span.error-text').text('');
        },
        success: function(res) {
          if (res.status == 400) {
            $.each(res.error, function(prefix, val) {
              $('span.' + prefix + '_error').text(val[0]);
            });
          } else {
            var $html = $(res.html);
            if (res.type == 'store-object') {
              $('tbody#objectList').append($html);
            } else {
              $("#tr_object_id_" + res.data.id).replaceWith($html);
            }
            $('#frmCrudObject').trigger("reset");
            $('#crudObjectModal').modal('hide');
            $('#btnObjectSave').html('{{ trans('global.save') }}');
            $('#btnObjectUpdate').html('{{ trans('global.update') }}');
            toastr.success(res.success);
          }
        },
        error: function(error) {
          console.log('Error:', error);
          $('#btnObjectSave').html('{{ trans('global.save') }}');
          $('#btnObjectUpdate').html('{{ trans('global.update') }}');
        }
      });
    });

    $('body').on('click', 'a#objectEdit', function(e) {
      e.preventDefault();
      $('#frmCrudObject').find('#btnObjectSave').addClass('d-none');
      $('#frmCrudObject').find('#btnObjectUpdate').removeClass('d-none');
      $('#frmCrudObject').find('#btnObjectUpdate').html(
        '<i class="fadeIn animated bx bx-edit"></i>&nbsp;{{ trans('global.update') }}');
      $('#frmCrudObject').trigger('reset');
      var object_id = $(this).data('id');
      var form = $('#frmCrudObject');
      var modal = $('#crudObjectModal');
      var actionUrl = $('#crudRoutePath').val();
      modal.find('.modal-title').html(
        '{{ trans('global.edit') }} {{ trans('cruds.permission.title_singular') }}');
      $.get(actionUrl + '/' + object_id + '/edit', function(res) {
        form.find('#object_id').val(res.data.id);
        form.find('#group').val(res.data.group);
        form.find('#title').val(res.data.title);
        if (res.data.status == 1) {
          form.find('#status').prop('checked', true);
        } else {
          form.find('#permission_status').prop('checked', false);
        }
        modal.modal('show');
      })
    });

    $('body').on('click', '.objectDelete', function(e) {
      e.preventDefault();
      var object_id = $(this).data("id");
      var link = $(this).attr("href");
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.value) {
          $.ajax({
            type: "DELETE",
            url: link,
            success: function(data) {
              $("#tr_object_id_" + object_id).remove();
              toastr.success(data.success);
            },
            error: function(data) {
              console.log('Error:', data);
            }
          });
        }
      })
    });

    $('#btnObjectClose').on('click', function(e) {
      e.preventDefault();
      $('#frmCrudObject').find('#btnObjectSave').removeClass('d-none');
      $('#frmCrudObject').find('#btnObjectUpdate').addClass('d-none');
      $('#crudObjectModal').find('.modal-title').html(
        '{{ trans('global.add') }} {{ trans('cruds.permission.title_singular') }}');
      $('#frmCrudObject').trigger('reset');
    });

    $('body').on('change', '.ace-switch', function(e) {
      var object_id = $(this).data('id');
      var status = $(this).prop('checked') == true ? 1 : 0;
      $.ajax({
        type: 'GET',
        dataType: 'JSON',
        url: '{{ route('admin.permissions.changeStatus') }}',
        data: {
          'status': status,
          'object_id': object_id
        },
        success: function(res) {
          toastr.success(res.success);
        },
        error: function(err) {
          console.log(err);
        }
      })
    });
  });
</script>
@endpush
