@extends('admin.layouts.master_layout')

@push('styles')
<link href="{{ assetUrl() }}assets/backend/plugins/select2/css/select2.min.css" rel="stylesheet" />
<!-- DataTables -->
<link rel="stylesheet" href="{{ assetUrl() }}assets/backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet"
    href="{{ assetUrl() }}assets/backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="{{ assetUrl() }}assets/backend/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<link rel="stylesheet" href="{{ assetUrl() }}assets/backend/dist/css/toggle.css">
<link rel="stylesheet" href="{{ assetUrl() }}assets/backend/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
<link rel="stylesheet" href="{{ assetUrl() }}assets/backend/plugins/toastr/toastr.min.css">
@endpush

@section('content')
@section('breadcrumb', trans('cruds.user.title'))
<div class="card">
    <div class="card-header">
        <h4 class="mb-0 text-primary"><i class="bx bxs-user me-1 font-22 text-primary"></i>{{ trans('global.list') }}
            {{ trans('cruds.user.title') }}
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
                        <th>{{ trans('cruds.user.fields.id') }}</th>
                        <th>{{ trans('cruds.user.fields.roles') }}</th>
                        <th>{{ trans('cruds.user.fields.name') }}</th>
                        <th>{{ trans('cruds.user.fields.username') }}</th>
                        <th>{{ trans('cruds.user.fields.email') }}</th>
                        <th>{{ trans('cruds.user.fields.phone_no') }}</th>
                        <th>{{ trans('cruds.user.fields.created_at') }}</th>
                        <th>{{ trans('global.status') }}</th>
                        <th>{{ trans('global.action') }}</th>
                    </tr>
                </thead>
                <tbody id="objectList">
                    @foreach ($users as $row)
                    <tr id="tr_object_id_{{ $row->id }}">
                        <td>{{ $row->id }}</td>
                        <td>
                            @foreach ($row->roles as $role)
                            <span class="badge bg-dark">{{ $role->title }}</span>
                            @endforeach
                        </td>
                        <td>{{ $row->name }}</td>
                        <td>{{ $row->username }}</td>
                        <td>{{ $row->email }}</td>
                        <td>{{ $row->phone_no }}</td>
                        <td>{{ date('d-M-Y', strtotime($row->created_at)) }}</td>
                        <td>
                            <input id="status" name="status" data-id="{{ $row->id }}"
                                {{ $row->status ? 'checked' : '' }} title="Status" type="checkbox"
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
                        <th>{{ trans('cruds.user.fields.id') }}</th>
                        <th>{{ trans('cruds.user.fields.roles') }}</th>
                        <th>{{ trans('cruds.user.fields.name') }}</th>
                        <th>{{ trans('cruds.user.fields.username') }}</th>
                        <th>{{ trans('cruds.user.fields.email') }}</th>
                        <th>{{ trans('cruds.user.fields.phone_no') }}</th>
                        <th>{{ trans('cruds.user.fields.created_at') }}</th>
                        <th>{{ trans('global.status') }}</th>
                        <th>{{ trans('global.action') }}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@include('admin.user.templates.crudModal')
@endsection

@push('scripts')
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
<script src="{{ assetUrl() }}assets/backend/plugins/select2/js/select2.full.min.js"></script>
<script src="{{ assetUrl() }}assets/backend/plugins/sweetalert2/sweetalert2.min.js"></script>
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
        table.buttons().container().appendTo('#datatable_wrapper .col-md-6:eq(0)');
    });
});
$(function() {
    "use strict";
    $('[data-toggle="tooltip"]').tooltip();
    $('.select2').select2({
        dropdownParent: $('#crudObjectModal'),
        placeholder: '{{ trans('
        global.select ') }} {{ trans('
        cruds.user.fields.roles ') }}',
        allowClear: Boolean($(this).data('allow-clear')),
    });
});
</script>
<script type="text/javaScript">
    function showPreview(event){
                                                                                        if(event.target.files.length > 0){
                                                                                          var src = URL.createObjectURL(event.target.files[0]);
                                                                                          var preview = document.getElementById("showPhoto");
                                                                                          preview.src = src;
                                                                                        }
                                                                                      }
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
            '{{ trans('
            global.add ') }} {{ trans('
            cruds.user.title_singular ') }}');
        $('#frmCrudObject').find('#object_id').val('');
        $('#frmCrudObject').find('#btnObjectSave').html(
            '<i class="fadeIn animated bx bx-plus-circle"></i>&nbsp;{{ trans('
            global.save ') }}');
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
                    $('#btnObjectSave').html('{{ trans('
                        global.save ') }}');
                    $('#btnObjectUpdate').html('{{ trans('
                        global.update ') }}');
                    toastr.success(res.success);
                }
            },
            error: function(error) {
                console.log('Error:', error);
                $('#btnObjectSave').html('{{ trans('
                    global.save ') }}');
                $('#btnObjectUpdate').html('{{ trans('
                    global.update ') }}');
            }
        });
    });

    $('body').on('click', 'a#objectEdit', function(e) {
        e.preventDefault();
        $('#frmCrudObject').find('#btnObjectSave').addClass('d-none');
        $('#frmCrudObject').find('#btnObjectUpdate').removeClass('d-none');
        $('#frmCrudObject').find('#btnObjectUpdate').html(
            '<i class="fadeIn animated bx bx-edit"></i>&nbsp;{{ trans('
            global.update ') }}');
        $('#frmCrudObject').trigger('reset');
        var object_id = $(this).data('id');
        var form = $('#frmCrudObject');
        var modal = $('#crudObjectModal');
        var actionUrl = $('#crudRoutePath').val();
        modal.find('.modal-title').html('{{ trans('
            global.edit ') }} {{ trans('
            cruds.user.title_singular ') }}');
        $.get(actionUrl + '/' + object_id + '/edit', function(res) {
            form.find('#object_id').val(res.data.id);
            var selectRoles = [];
            $.each(res.data.roles, function(i, e) {
                selectRoles.push(e.id)
            });
            $('.select2').val(selectRoles).trigger('change');
            form.find('#name').val(res.data.name);
            form.find('#username').val(res.data.username);
            form.find('#email').val(res.data.email);
            form.find('#phone_no').val(res.data.phone_no);
            form.find('#old_image').val(res.data.profile_image);
            if (res.data.status == 1) {
                form.find('#user_status').prop('checked', true);
            } else {
                form.find('#user_status').prop('checked', false);
            }
            form.find('#showPhoto').attr('src', "{{ uploadUrl() }}" + '/user/' + res.data
                .profile_image);
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
        $('#frmCrudObject').find('#showPhoto').attr('src', "{{ asset('public/images/avatar3.png') }}");
        $('#frmCrudObject').find('#btnObjectSave').removeClass('d-none');
        $('#frmCrudObject').find('#btnObjectUpdate').addClass('d-none');
        $('#crudObjectModal').find('.modal-title').html(
            '{{ trans('
            global.add ') }} {{ trans('
            cruds.user.title_singular ') }}');
        $('#frmCrudObject').trigger('reset');
    });

    $('body').on('change', '.ace-switch', function(e) {
        var object_id = $(this).data('id');
        var status = $(this).prop('checked') == true ? 1 : 0;
        $.ajax({
            type: 'GET',
            dataType: 'JSON',
            url: '{{ route('
            admin.users.changeStatus ') }}',
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