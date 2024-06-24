@extends('admin.layouts.master')

@section('title', 'Teacher Courses List')

<!-- page content -->
@section('content')
    <div class="right_col" role="main">
        <div class="row">
            <div class="col-md-12">
                {!! Breadcrumbs::render('teacher_courses', $teacher_id) !!}

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if(session('msg'))
                    <div class="alert alert-success">
                        {{ session('msg') }}
                    </div>
                @endif

                <div class="x_panel">
                    <div class="x_title">
                        <h2>Teacher Courses List</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        @if($teacher_courses->isEmpty())
                            <div class="alert alert-info alert-dismissible fade in" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <strong>Sorry!</strong> No Data Found.
                            </div>
                        @else
                            <table class="table table-striped table-bordered" id="data">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Course Title</th>
                                        <th>Short Code</th>
                                        <th>Attached Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($teacher_courses as $index => $t_course)
                                        <tr>
                                            <td><strong>{{ $loop->iteration }}</strong></td>
                                            <td>{{ $t_course->course_title }}</td>
                                            <td>{{ $t_course->course_short_code }}</td>
                                            <td>{{ $t_course->created_at->format('d-m-Y') }}</td>
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
@stop
<!-- /page content -->

@section('page_js')
    <script>
        $(document).ready(function(){
            $('#data').DataTable({
                dom: "Bfrtip",
                buttons: [
                    { extend: "copy", className: "btn-sm" },
                    { extend: "csv", className: "btn-sm" },
                    { extend: "excel", className: "btn-sm" },
                    { extend: "pdfHtml5", className: "btn-sm" },
                    { extend: "print", className: "btn-sm" }
                ],
                responsive: true
            });
        });
    </script>
@stop
