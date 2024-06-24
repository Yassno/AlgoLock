@extends('admin.layouts.master')

@section('title', 'Courses Listing Settings')

<!-- page content -->
@section('content')
<main id="main" class="main">
<div class="container my-5">

    <div class="row">
        <div class="col-12">
            {!! Breadcrumbs::render('listing_settings') !!}
            @if(isset($errors) && count($errors) > 0)
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if(\Session::has('msg'))
                <div class="alert alert-success">
                    {{ \Session::get('msg') }}
                </div>
            @endif

            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h2 class="h4 mb-0">Trending Courses List</h2>
                    <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addModal">
                        <i class="fa fa-plus"></i> Add Trending Course
                    </button>
                </div>

                <div class="card-body">
                    @if(count($trendingCourses) < 1)
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <strong>Sorry!</strong> No Data Found.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @else
                        <table class="table table-hover table-striped" id="data">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Added at</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($trendingCourses as $index => $trendingCourse)
                                    <tr>
                                        <td><strong>{{ $index + 1 }}</strong></td>
                                        <td>{{ $trendingCourse->course_title }}</td>
                                        <td>{{ $trendingCourse->created_at }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('trending-courses-delete', ['id' => $trendingCourse->id]) }}" class="btn btn-outline-danger btn-sm" title="Delete">
                                                <i class="fa fa-trash-o" aria-hidden="true"></i>
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

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Add Trending Course</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('trending-courses-add') }}" method="post" enctype='multipart/form-data'>
                <div class="modal-body">
                    @csrf
                    <div class="mb-3">
                        <label for="course" class="form-label">Course</label>
                        <select name="course" id="course" required class="form-select">
                            @foreach($teacherCourses as $teacherCourse)
                                <option value="{{ $teacherCourse->id }}">{{ $teacherCourse->course->title }} - {{ $teacherCourse->teacher->user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Add Modal End -->
@stop
<!-- /page content -->

@section('page_js')
<script>
    $(document).ready(function() {
        $('#data').DataTable({
            dom: "Bfrtip",
            buttons: [
                {
                    extend: "copy",
                    className: "btn-sm btn-outline-primary"
                },
                {
                    extend: "csv",
                    className: "btn-sm btn-outline-primary"
                },
                {
                    extend: "excel",
                    className: "btn-sm btn-outline-primary"
                },
                {
                    extend: "pdfHtml5",
                    className: "btn-sm btn-outline-primary"
                },
                {
                    extend: "print",
                    className: "btn-sm btn-outline-primary"
                },
            ],
            responsive: true
        });
    });
</script>
</main>
@stop
