@extends('admin.layouts.master')

@section('title', 'Teacher List')

<!-- page content -->
@section('content')

<main id="main" class="main">
    <div class="right_col" role="main">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">

                {!! Breadcrumbs::render('teachers') !!}

                @if(isset($errors))
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                @endif
                @if(\Session::has('msg'))

                @endif

                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h2 class="h5 mb-0">Teacher List</h2>
                        <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#addModal">
                            <i class="fa fa-plus"></i> Add Teacher
                        </button>
                    </div>
                    <div class="card-body">
                        @if(count($teachers)<1)
                            <div class="alert alert-info" role="alert">
                                <strong>Sorry !</strong> No Data Found.
                            </div>
                        @else
                            <?php $index = 0; ?>
                            <table class="table table-striped table-bordered" id="data">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Picture</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($teachers as $teacher)
                                    <tr>
                                        <td><strong>{{ ++$index }}</strong></td>
                                        <td><img src="{{ $teacher->picture }}" class="img-circle" alt="user image" height="40" width="40"></td>
                                        <td>{{ $teacher->name }}</td>
                                        <td>{{ $teacher->email }}</td>
                                        <td>{{ $teacher->iso.$teacher->phone }}</td>
                                        <td class="text-center">
                                            <button type="button"
                                                    data-id="{{ $teacher->user_id }}"
                                                    data-name="{{ $teacher->name }}"
                                                    data-email="{{ $teacher->email }}"
                                                    class="btn btn-success btn-lg" data-bs-toggle="modal" data-bs-target="#updateModal">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </button>
                                            <a href="{{route('teachers-delete', ['id'=>$teacher->user_id])}}" class="delete" title="Delete">
                                                <button type="button" class="btn btn-danger btn-lg">
                                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                </button>
                                            </a>
                                            <a href="{{route('teachers-courses', ['id'=>$teacher->user_id])}}">
                                                <button type="button" class="btn btn-secondary btn-lg">
                                                    <i class="fa fa-list" aria-hidden="true"></i> Show Courses
                                                </button>
                                            </a>
                                        </td>
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
    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Update Info</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('teachers-update') }}" method="post">
                    <div class="modal-body">
                        <div class="col-md-8">
                            <input type="hidden" name="_token" value="{{ Session::token() }}">
                            <table class="table">
                                <input type="hidden" name="modal_id" id="modal_id">
                                <tr>
                                    <td colspan="2"><label>Name</label></td>
                                    <td colspan="2">
                                        <input type="text" name="name" class="form-control" id="modal_name">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2"><label>Email</label></td>
                                    <td colspan="2">
                                        <input type="text" name="email" class="form-control" id="modal_email">
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg">Update</button>
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-lg" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Update Modal End -->

    <!-- Add Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Add Info</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('teachers-add') }}" method="post">
                    <div class="modal-body">
                        <div class="col-md-8">
                            <input type="hidden" name="_token" value="{{ Session::token() }}">
                            <table class="table">
                                <tr>
                                    <td colspan="2"><label>Name</label></td>
                                    <td colspan="2">
                                        <input type="text" name="name" class="form-control" id="name">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2"><label>Email</label></td>
                                    <td colspan="2">
                                        <input type="text" name="email" class="form-control" id="email">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2"><label>Password</label></td>
                                    <td colspan="2">
                                        <input type="password" name="password" class="form-control" id="password">
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-lg" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- AddModal End -->

<!-- /page content -->
@section('page_js')
<script>
$('#updateModal').on('show.bs.modal', function (e) {
    $('#modal_id').val($(e.relatedTarget).data('id'));
    $('#modal_name').val($(e.relatedTarget).data('name'));
    $('#modal_email').val($(e.relatedTarget).data('email'));
});
</script>
<script>
$(document).ready(function(){
    $('#data').DataTable({
        dom: "Bfrtip",
        buttons: [
            {
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
@stop
