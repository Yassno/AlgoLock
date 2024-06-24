@extends('admin.layouts.master')

@section('title', 'Departments List')

<!-- page content -->
@section('content')
<main id="main" class="main">
<div class="main-content">

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            {!! Breadcrumbs::render('departments') !!}
            @if(isset($errors) && count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            @if(\Session::has('msg'))

            @endif

            <div class="card shadow-sm">

                <div class="card-header d-flex justify-content-between align-items-center">
                    <h2 class="h5 mb-0">Departments List</h2>
                    <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addModal">
                        <i class="fa fa-plus"></i>
                        @if(\Illuminate\Support\Facades\Auth::user()->user_type == \App\Libraries\Enumerations\UserTypes::$ADMIN)
                        Add Departments
                        @else
                        Request new department
                        @endif
                    </button>
                </div>

                <div class="card-body">
                    @if(count($departments) < 1)
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <strong>Sorry !</strong> No Data Found.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @else
                    <?php $index = 0; ?>
                    <table class="table table-striped table-bordered dataTable no-footer" id="data">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Title</th>
                                <th>Short Code</th>
                                <th>Status</th>
                                @if(\Illuminate\Support\Facades\Auth::user()->user_type == \App\Libraries\Enumerations\UserTypes::$ADMIN)
                                <th>Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($departments as $department)
                            <tr>
                                <td><strong>{{ ++$index }}</strong></td>
                                <td>{{ $department->title }}</td>
                                <td>{{ $department->short_code }}</td>
                                <td>
                                    @if($department->status == \App\Libraries\Enumerations\DepartmentStatus::$PENDING)
                                    <span class="badge bg-secondary">Pending</span>
                                    @elseif($department->status == \App\Libraries\Enumerations\DepartmentStatus::$APPROVED)
                                    <span class="badge bg-success">Approved</span>
                                    @elseif($department->status == \App\Libraries\Enumerations\DepartmentStatus::$BANNED)
                                    <span class="badge bg-warning text-dark">Banned</span>
                                    @else
                                    <span class="badge bg-dark">Unknown</span>
                                    @endif
                                </td>
                                @if(\Illuminate\Support\Facades\Auth::user()->user_type == \App\Libraries\Enumerations\UserTypes::$ADMIN)
                                <td class="text-center">
                                    <button type="button" data-id="{{ $department->id }}" data-title="{{ $department->title }}" data-short_code="{{ $department->short_code }}" data-status="{{ $department->status }}" class="btn btn-outline-info btn-sm" data-bs-toggle="modal" data-bs-target="#updateModal">
                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                    </button>
                                    <a href="{{ route('departments-delete', ['id'=>$department->id]) }}" class="delete" title="Delete">
                                        <button type="button" class="btn btn-outline-danger btn-sm"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                    </a>
                                </td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>

            </div>

        </div>
    </div>

</div>

<!-- Update Modal -->
<div class="modal fade" id="updateModal" role="dialog" tabindex="-1">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Update Info</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('departments-update') }}" method="post">
                <div class="modal-body">
                    <div class="col-md-8">
                        <input type="hidden" name="_token" value="{{ Session::token() }}">
                        <table class="table">
                            <input type="hidden" name="modal_id" id="modal_id">
                            <tr>
                                <td colspan="2"><label>Title</label></td>
                                <td colspan="2"><input type="text" name="title" class="form-control" id="modal_title">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2"><label>Short Code</label></td>
                                <td colspan="2">
                                    <input type="text" name="short_code" class="form-control" id="modal_short_code">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2"><label>Status</label></td>
                                <td colspan="2">
                                    <select class="form-control" name="status" id="modal_status">
                                        <option value="{{ \App\Libraries\Enumerations\DepartmentStatus::$APPROVED }}">Approve</option>
                                        <option value="{{ \App\Libraries\Enumerations\DepartmentStatus::$PENDING }}">Pending</option>
                                        <option value="{{ \App\Libraries\Enumerations\DepartmentStatus::$BANNED }}">Banned</option>
                                    </select>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <button type="submit" class="btn btn-outline-primary pull-right">Update</button>
                </div>
            </form>

            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
<!-- Update Modal End -->

<!-- Add Modal -->
<div class="modal fade" id="addModal" role="dialog" tabindex="-1">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Add Info</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('departments-add') }}" method="post">
                <div class="modal-body">
                    <div class="col-md-8">
                        <input type="hidden" name="_token" value="{{ Session::token() }}">
                        <table class="table">
                            <tr>
                                <td colspan="2"><label>Title</label></td>
                                <td colspan="2">
                                    <input type="text" name="title" class="form-control" id="name">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2"><label>Short Code</label></td>
                                <td colspan="2">
                                    <input type="text" name="short_code" class="form-control" id="short_code">
                                </td>
                            </tr>
                        </table>
                    </div>

                    <button type="submit" class="btn btn-outline-primary pull-right">Submit</button>
                </div>
            </form>

            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
<!-- Add Modal End -->

@stop

<!-- /page content -->

@section('page_js')
<script>
    $('#updateModal').on('show.bs.modal', function (e) {
        $('#modal_id').val($(e.relatedTarget).data('id'));
        $('#modal_title').val($(e.relatedTarget).data('title'));
        $('#modal_short_code').val($(e.relatedTarget).data('short_code'));
        $('#modal_status').val($(e.relatedTarget).data('status'));
    });
</script>
<script>
    $(document).ready(function () {
        $('#data').DataTable({
            dom: "Bfrtip",
            buttons: [{
                    extend: "copy",
                    className: "btn-sm"
                },
                {
                    extend: "csv",
                    className: "btn-sm"
                },
                {
                    extend: "excel",
                    className: "btn-sm"
                },
                {
                    extend: "pdfHtml5",
                    className: "btn-sm"
                },
                {
                    extend: "print",
                    className: "btn-sm"
                },
            ],
            responsive: true
        });
    });
</script>
</main>
@stop
