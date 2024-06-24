@extends('admin.layouts.master')

@section('title', 'E-Learning')

@section('page_css')
    <style>
        .max-three-line-p {
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
        }
    </style>
@stop

@section('content')
<!-- page content -->
<main id="main" class="main">
    <div class="container my-5">
        <div class="row">
            <div class="col-12">
                {!! Breadcrumbs::render('lesson_details', $teacher_lesson->number) !!}
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

                <div class="card shadow-sm mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h2 class="h5 mb-0">Lesson - {{ $teacher_lesson->number }} Details</h2>
                        @if(Auth::user()->user_type == \App\Libraries\Enumerations\UserTypes::$TEACHER)
                            <a href="{{ route('getLessonDetailsForEdit', ['id' => $lesson_id]) }}" class="btn btn-outline-primary btn-sm">
                                <i class="fa fa-pencil"></i> Edit Lesson Details - {{ $teacher_lesson->number }}
                            </a>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- Video Sources -->
                            <div class="col-md-6">
                                <div class="card shadow-sm mb-4">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h2 class="h5 mb-0">Video Sources <small class="text-muted">Youtube</small></h2>
                                        <div class="panel_toolbox">
                                            <a class="btn btn-sm btn-outline-secondary" data-bs-toggle="collapse" href="#videoSources" role="button" aria-expanded="false" aria-controls="videoSources">
                                                <i class="fa fa-chevron-up"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="collapse show" id="videoSources">
                                        <div class="card-body">
                                            <ul class="list-unstyled timeline">
                                                @foreach($lesson_videos as $lesson_video)
                                                    <li class="mb-3">
                                                        <div class="block">
                                                            <div class="tags">
                                                                <a href="#" class="tag">
                                                                    <span>{{ $lesson_video->part_number }}</span>
                                                                </a>
                                                            </div>
                                                            <div class="block_content">
                                                                <h2 class="title">
                                                                    <a>{{ $lesson_video->video_title }}</a>
                                                                </h2>
                                                                <div class="byline">
                                                                    <span>{{ $lesson_video->created_at }}</span> by <a>{{ $teacher_info->name }}</a>
                                                                </div>
                                                                <p class="excerpt max-three-line-p">{{ $lesson_video->description }}</p>
                                                                <a href="#" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#videoModal" data-theVideo="{{ $lesson_video->video_embed_url }}">Watch</a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Document Sources -->
                            <div class="col-md-6">
                                <div class="card shadow-sm mb-4">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h2 class="h5 mb-0">Document Sources</h2>
                                        <div class="panel_toolbox">
                                            <a class="btn btn-sm btn-outline-secondary" data-bs-toggle="collapse" href="#documentSources" role="button" aria-expanded="false" aria-controls="documentSources">
                                                <i class="fa fa-chevron-up"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="collapse show" id="documentSources">
                                        <div class="card-body">
                                            <ul class="list-unstyled timeline">
                                                @foreach($lesson_files as $lesson_file)
                                                    <li class="mb-3">
                                                        <div class="block">
                                                            <div class="tags">
                                                                <a href="#" class="tag">
                                                                    <span>{{ $lesson_file->part_number }}</span>
                                                                </a>
                                                            </div>
                                                            <div class="block_content">
                                                                <h2 class="title">
                                                                    <a>{{ $lesson_file->file_title }}</a>
                                                                </h2>
                                                                <div class="byline">
                                                                    <span>{{ $lesson_file->created_at }}</span> by <a>{{ $teacher_info->name }}</a>
                                                                </div>
                                                                <p class="excerpt max-three-line-p">{{ $lesson_file->description }}</p>
                                                                <a href="{{ $lesson_file->file_url }}" class="btn btn-outline-primary btn-sm" target="_blank">Read</a>
                                                                <a href="{{ $lesson_file->file_url }}" class="btn btn-outline-info btn-sm" download="{{ $lesson_file->file_title }}">Download</a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Youtube Video Watch Modal -->
        <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                        <div>
                            <iframe width="100%" height="350" src=""></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- /page content -->
@stop

@section('page_js')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        autoPlayYouTubeModal();
    });

    function autoPlayYouTubeModal() {
        var trigger = document.querySelectorAll('[data-bs-toggle="modal"]');
        trigger.forEach(function(element) {
            element.addEventListener('click', function() {
                var theModal = document.querySelector(this.getAttribute("data-bs-target")),
                    videoSRC = this.getAttribute("data-theVideo"),
                    videoSRCauto = videoSRC + "?autoplay=1";
                theModal.querySelector('iframe').setAttribute('src', videoSRCauto);
                theModal.querySelector('button.btn-close').addEventListener('click', function() {
                    theModal.querySelector('iframe').setAttribute('src', '');
                });
            });
        });
    }
</script>
@stop
