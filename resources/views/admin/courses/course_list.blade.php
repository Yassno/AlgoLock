@extends('admin.layouts.master')

@section('title', 'Courses List')

<!-- page content -->
@section('content')

    @php
        use Illuminate\Support\Facades\Auth;
        use App\Libraries\Enumerations\UserTypes;
        use App\Libraries\Enumerations\CourseStatus;
    @endphp
    <main id="main" class="main">
    <div class="main-content">

        <div class="row">

            <div class="col-12">
                @if(isset($errors))
                @if ( count($errors) > 0)
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
                {!! Breadcrumbs::render('courses') !!}

                <div class="card shadow-sm">

                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h2 class="card-title" style="font-size: 1.5rem;">Courses List</h2>
                        @if(Auth::user()->user_type == UserTypes::$ADMIN)
                            <a href="{{ route('courses-listing-settings') }}" class="btn btn-outline-primary btn-lg">
                                <i class="fa fa-plus"></i> Add Course
                            </a>
                        @else
                            <button type="button" class="btn btn-outline-primary btn-lg" data-bs-toggle="modal" data-bs-target="#addModal">
                                <i class="fa fa-plus"></i> Request new course
                            </button>
                        @endif
                    </div>
                    <div class="card-body">
                        @if(count($courses)<1)
                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                                <strong>Sorry!</strong> No Data Found.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @else
                        <?php $index = 0; ?>
                        <table class="table table-hover table-striped" id="data">
                            <thead>
                            <tr>
                                <th style="font-size: 1.2rem;">SL</th>
                                <th style="font-size: 1.2rem;">Department</th>
                                <th style="font-size: 1.2rem;">Title</th>
                                <th style="font-size: 1.2rem;">Short Code</th>
                                <th style="font-size: 1.2rem;">Status</th>
                                @if(Auth::user()->user_type == UserTypes::$ADMIN)
                                <th style="font-size: 1.2rem;">Action</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($courses as $course)
                                <tr>
                                    <td style="font-size: 1.2rem;"><strong>{{ ++$index }}</strong></td>
                                    <td style="font-size: 1.2rem;">{{ $course->department_title }}</td>
                                    <td style="font-size: 1.2rem;">{{ $course->title }}</td>
                                    <td style="font-size: 1.2rem;">{{ $course->short_code }}</td>
                                    <td style="font-size: 1.2rem;">
                                        @if($course->status == CourseStatus::$PENDING)
                                            <span class="badge bg-secondary">Pending</span>
                                        @elseif($course->status == CourseStatus::$APPROVED)
                                            <span class="badge bg-success">Approved</span>
                                        @elseif($course->status == CourseStatus::$BANNED)
                                            <span class="badge bg-warning">Banned</span>
                                        @endif
                                    </td>
                                    @if(Auth::user()->user_type == UserTypes::$ADMIN)
                                    <td class="text-center">
                                        <button type="button"
                                                data-id="{{ $course->id }}"
                                                data-department_id="{{ $course->department_id }}"
                                                data-title="{{ $course->title }}"
                                                data-short_code="{{ $course->short_code }}"
                                                data-featured_text="{{ $course->featured_text }}"
                                                data-status="{{ $course->status }}"
                                                data-featured_image="{{ $course->featured_image }}"
                                                class="btn btn-outline-info btn-lg" data-bs-toggle="modal" data-bs-target="#updateModal">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                        </button>

                                        <a href="{{route('courses-delete', ['id'=>$course->id])}}" class="delete" title="Delete">
                                            <button type="button" class="btn btn-outline-danger btn-lg">
                                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                                            </button>
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
    <!--Update Modal -->
    <div class="modal fade" id="updateModal" role="dialog" tabindex="-1">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" style="font-size: 1.5rem;">Update Info</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('courses-update') }}" method="post" enctype='multipart/form-data'>
                    <div class="modal-body">
                        <input type="hidden" name="_token" value="{{ Session::token() }}">
                        <input type="hidden" name="modal_id" id="modal_id">
                        <div class="mb-3">
                            <label for="modal_department_id" class="form-label" style="font-size: 1.2rem;">Department</label>
                            <select name="department" id="modal_department_id" required class="form-select form-select-lg">
                                @foreach($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="modal_title" class="form-label" style="font-size: 1.2rem;">Title</label>
                            <input type="text" name="title" class="form-control form-control-lg" id="modal_title">
                        </div>
                        <div class="mb-3">
                            <label for="modal_short_code" class="form-label" style="font-size: 1.2rem;">Short Code</label>
                            <input type="text" name="short_code" class="form-control form-control-lg" id="modal_short_code">
                        </div>
                        <div class="mb-3">
                            <label for="modal_featured_image" class="form-label" style="font-size: 1.2rem;">Featured Image</label>
                            <img src="" id="modal_featured_image" alt="..." class="img-thumbnail" style="max-width: 150px; max-height: 150px">
                            <input type="file" name="new_featured_image" class="form-control form-control-lg">
                        </div>
                        <div class="mb-3">
                            <label for="modal_featured_text" class="form-label" style="font-size: 1.2rem;">Featured Text</label>
                            <textarea name="featured_text" class="form-control form-control-lg" id="modal_featured_text"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="modal_status" class="form-label" style="font-size: 1.2rem;">Status</label>
                            <select class="form-select form-select-lg" name="status" id="modal_status">
                                <option value="{{ CourseStatus::$APPROVED }}">Approve</option>
                                <option value="{{ CourseStatus::$PENDING }}">Pending</option>
                                <option value="{{ CourseStatus::$BANNED }}">Banned</option>
                            </select>
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
    {{--Update Modal End--}}

    <!--Add Modal -->
    <div class="modal fade" id="addModal" role="dialog" tabindex="-1">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" style="font-size: 1.5rem;">Add Info</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('courses-add') }}" method="post" enctype='multipart/form-data'>
                    <div class="modal-body">
                        <input type="hidden" name="_token" value="{{ Session::token() }}">
                        <div class="mb-3">
                            <label for="department" class="form-label" style="font-size: 1.2rem;">Department</label>
                            <select name="department" id="department" required class="form-select form-select-lg">
                                @foreach($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="title" class="form-label" style="font-size: 1.2rem;">Title</label>
                            <input type="text" name="title" class="form-control form-control-lg" id="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="short_code" class="form-label" style="font-size: 1.2rem;">Short Code</label>
                            <input type="text" name="short_code" class="form-control form-control-lg" id="short_code">
                        </div>
                        <div class="mb-3">
                            <label for="featured_image" class="form-label" style="font-size: 1.2rem;">Featured Image</label>
                            <input type="file" name="featured_image" class="form-control form-control-lg">
                        </div>
                        <div class="mb-3">
                            <label for="featured_text" class="form-label" style="font-size: 1.2rem;">Featured Text</label>
                            <textarea name="featured_text" class="form-control form-control-lg"></textarea>
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
    {{--Add Modal End--}}
@stop
<!-- /page content -->

@section('page_js')
    <script>
        $('#updateModal').on('show.bs.modal', function (e) {
            $('#modal_id').val($(e.relatedTarget).data('id'));
            $('#modal_department_id').val($(e.relatedTarget).data('department_id'));
            $('#modal_title').val($(e.relatedTarget).data('title'));
            $('#modal_short_code').val($(e.relatedTarget).data('short_code'));
            $('#modal_status').val($(e.relatedTarget).data('status'));
            $('#modal_featured_image').attr('src', $(e.relatedTarget).data('featured_image'));
            $('#modal_featured_text').text($(e.relatedTarget).data('featured_text'));
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#data').DataTable({
                dom: "Bfrtip",
                buttons: [
                    {
                        extend: "copy",
                        className: "btn btn-outline-secondary btn-lg"
                    },
                    {
                        extend: "csv",
                        className: "btn btn-outline-secondary btn-lg"
                    },
                    {
                        extend: "excel",
                        className: "btn btn-outline-secondary btn-lg"
                    },
                    {
                        extend: "pdfHtml5",
                        className: "btn btn-outline-secondary btn-lg"
                    },
                    {
                        extend: "print",
                        className: "btn btn-outline-secondary btn-lg"
                    },
                ],
                responsive: true
            });
        });
    </script>
    </main>
@stop
