@extends('admin.layouts.master')

@section('title', 'Lesson Files List')

<!-- page content -->
@section('content')
<main id="main" class="main">
    <div class="container my-5">
        <div class="row">
            <div class="col-12">
                {!! Breadcrumbs::render('lesson_details_edit', $lesson_id, $teacher_lesson->number) !!}
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
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

                <div class="row">
                    <!-- Video Files Panel -->
                    <div class="col-md-6">
                        <div class="card shadow-sm mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h2 class="h5 mb-0">Lesson - {{ $lesson_id }} Video File List</h2>
                                <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addModal">
                                    <i class="fa fa-plus"></i> Add Video File
                                </button>
                            </div>
                            <div class="card-body">
                                @if(count($videos) < 1)
                                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                                        <strong>Sorry!</strong> No Data Found.
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @else
                                    <table class="table table-striped table-bordered" id="data">
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Part Number</th>
                                                <th>Video Title</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($videos as $index => $video)
                                                <tr>
                                                    <td><strong>{{ $index + 1 }}</strong></td>
                                                    <td>{{ $video->part_number }}</td>
                                                    <td>{{ $video->video_title }}</td>
                                                    <td class="text-center">
                                                        <button type="button" class="btn btn-outline-info btn-sm" data-bs-toggle="modal" data-bs-target="#updateModal"
                                                            data-video_id="{{ $video->id }}"
                                                            data-video_part_number="{{ $video->part_number }}"
                                                            data-video_title="{{ $video->video_title }}"
                                                            data-video_description="{{ $video->description }}"
                                                            data-video_embed_url="{{ $video->video_embed_url }}">
                                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                        </button>
                                                        <a href="{{ route('lesson-video-delete', ['id' => $video->id]) }}" class="btn btn-outline-danger btn-sm" title="Delete">
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

                    <!-- Document Files Panel -->
                    <div class="col-md-6">
                        <div class="card shadow-sm mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h2 class="h5 mb-0">Lesson - {{ $lesson_id }} Document File List</h2>
                                <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addFileModal">
                                    <i class="fa fa-plus"></i> Add Document File
                                </button>
                            </div>
                            <div class="card-body">
                                @if(count($files) < 1)
                                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                                        <strong>Sorry!</strong> No Data Found.
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @else
                                    <table class="table table-striped table-bordered" id="data2">
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Part Number</th>
                                                <th>File Title</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($files as $index => $file)
                                                <tr>
                                                    <td><strong>{{ $index + 1 }}</strong></td>
                                                    <td>{{ $file->part_number }}</td>
                                                    <td>{{ $file->file_title }}</td>
                                                    <td class="text-center">
                                                        <button type="button" class="btn btn-outline-info btn-sm" data-bs-toggle="modal" data-bs-target="#updateFileModal"
                                                            data-file_id="{{ $file->id }}"
                                                            data-file_part_number="{{ $file->part_number }}"
                                                            data-file_title="{{ $file->file_title }}"
                                                            data-file_description="{{ $file->description }}"
                                                            data-file_url="{{ $file->file_url }}">
                                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                        </button>
                                                        <a href="{{ route('lesson-file-delete', ['id' => $file->id]) }}" class="btn btn-outline-danger btn-sm" title="Delete">
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

                <!-- Lesson Question/Objectives Panel -->
                <div class="col-md-12">
                    <div class="card shadow-sm mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h2 class="h5 mb-0">Lesson Question/Objectives</h2>
                            <div class="panel_toolbox">
                                <a class="btn btn-outline-primary btn-sm" href="{{ route('lesson-questions', ['id' => $lesson_id]) }}">
                                    <i class="fa fa-bullhorn"></i> Questions
                                </a>
                                <a class="btn btn-outline-primary btn-sm" href="{{ route('lesson-mcqs', ['id' => $lesson_id]) }}">
                                    <i class="fa fa-users"></i> Objectives
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add Video Modal -->
        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">Add Video File</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('lesson-video-add') }}" method="post">
                        @csrf
                        <input type="hidden" value="{{ $lesson_id }}" name="lesson_id">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="part_number" class="form-label">Part Number</label>
                                <input type="text" name="part_number" class="form-control" id="part_number" required>
                            </div>
                            <div class="mb-3">
                                <label for="video_title" class="form-label">Video Title</label>
                                <input type="text" name="video_title" class="form-control" id="video_title" required>
                            </div>
                            <div class="mb-3">
                                <label for="video_embed_url" class="form-label">Video Embed Url</label>
                                <input type="text" name="video_embed_url" class="form-control" id="video_embed_url" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" class="form-control" id="description" required></textarea>
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
        <!-- Add Video Modal End -->

        <!-- Update Video Modal -->
        <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateModalLabel">Update Video File</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('lesson-video-update') }}" method="post">
                        @csrf
                        <input type="hidden" name="lesson_id" value="{{ $lesson_id }}">
                        <input type="hidden" name="modal_id" id="modal_video_id">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="modal_video_part_number" class="form-label">Part Number</label>
                                <input type="text" name="part_number" class="form-control" id="modal_video_part_number" required>
                            </div>
                            <div class="mb-3">
                                <label for="modal_video_title" class="form-label">Video Title</label>
                                <input type="text" name="video_title" class="form-control" id="modal_video_title" required>
                            </div>
                            <div class="mb-3">
                                <label for="modal_video_embed_url" class="form-label">Video Embed Url</label>
                                <input type="text" name="video_embed_url" class="form-control" id="modal_video_embed_url" required>
                            </div>
                            <div class="mb-3">
                                <label for="modal_video_description" class="form-label">Description</label>
                                <textarea name="description" class="form-control" id="modal_video_description" required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Update Video Modal End -->

        <!-- Add Document Modal -->
        <div class="modal fade" id="addFileModal" tabindex="-1" aria-labelledby="addFileModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addFileModalLabel">Add Document File</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('lesson-file-add') }}" method="post">
                        @csrf
                        <input type="hidden" value="{{ $lesson_id }}" name="lesson_id">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="file_part_number" class="form-label">Part Number</label>
                                <input type="text" name="part_number" class="form-control" id="file_part_number" required>
                            </div>
                            <div class="mb-3">
                                <label for="file_title" class="form-label">File Title</label>
                                <input type="text" name="file_title" class="form-control" id="file_title" required>
                            </div>
                            <div class="mb-3">
                                <label for="file_url" class="form-label">File Url</label>
                                <input type="text" name="file_url" class="form-control" id="file_url" required>
                            </div>
                            <div class="mb-3">
                                <label for="file_description" class="form-label">Description</label>
                                <textarea name="description" class="form-control" id="file_description" required></textarea>
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
        <!-- Add Document Modal End -->

        <!-- Update Document Modal -->
        <div class="modal fade" id="updateFileModal" tabindex="-1" aria-labelledby="updateFileModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateFileModalLabel">Update Document File</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('lesson-file-update') }}" method="post">
                        @csrf
                        <input type="hidden" name="lesson_id" value="{{ $lesson_id }}">
                        <input type="hidden" name="modal_id" id="modal_file_id">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="modal_file_part_number" class="form-label">Part Number</label>
                                <input type="text" name="part_number" class="form-control" id="modal_file_part_number" required>
                            </div>
                            <div class="mb-3">
                                <label for="modal_file_title" class="form-label">File Title</label>
                                <input type="text" name="file_title" class="form-control" id="modal_file_title" required>
                            </div>
                            <div class="mb-3">
                                <label for="modal_file_url" class="form-label">File Url</label>
                                <input type="text" name="file_url" class="form-control" id="modal_file_url" required>
                            </div>
                            <div class="mb-3">
                                <label for="modal_file_description" class="form-label">Description</label>
                                <textarea name="description" class="form-control" id="modal_file_description" required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Update Document Modal End -->
    </div>
</main>
@stop
<!-- /page content -->

@section('page_js')
<script>
    $('#updateModal').on('show.bs.modal', function (e) {
        $('#modal_video_id').val($(e.relatedTarget).data('video_id'));
        $('#modal_video_title').val($(e.relatedTarget).data('video_title'));
        $('#modal_video_part_number').val($(e.relatedTarget).data('video_part_number'));
        $('#modal_video_embed_url').val($(e.relatedTarget).data('video_embed_url'));
        $('#modal_video_description').text($(e.relatedTarget).data('video_description'));
    });

    $('#updateFileModal').on('show.bs.modal', function (e) {
        $('#modal_file_id').val($(e.relatedTarget).data('file_id'));
        $('#modal_file_title').val($(e.relatedTarget).data('file_title'));
        $('#modal_file_part_number').val($(e.relatedTarget).data('file_part_number'));
        $('#modal_file_url').val($(e.relatedTarget).data('file_url'));
        $('#modal_file_description').text($(e.relatedTarget).data('file_description'));
    });

    $(document).ready(function() {
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
        $('#data2').DataTable({
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
