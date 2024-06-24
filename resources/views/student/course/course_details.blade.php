@extends('admin.layouts.master')
@section('title', 'E-Learning | Course Details')
@section('page_css')
    <link href="{{ url('admin/vendors/star-rating/css/star-rating.min.css') }}" rel="stylesheet">
    <!-- PNotify -->
    <link href="{{ url('admin/vendors/pnotify/dist/pnotify.css') }}" rel="stylesheet">
    <link href="{{ url('admin/vendors/pnotify/dist/pnotify.buttons.css') }}" rel="stylesheet">
    <style>
        /* Custom Styles */
        .course-details-container {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }
        .course-image {
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    display: inline-block; /* Corrected to inline-block */
    width: fit-content; /* Ensures the container fits the image size */
}

.course-image img {
    width: 100%; /* Makes the image take the full width of the container */
    height: auto; /* Maintains the image aspect ratio */
    display: block; /* Removes the bottom margin space for images in containers */
}


        .course-title {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            margin-top: 20px;
            margin-bottom: 10px;
        }

        .course-description {
            color: #666;
            font-size: 16px;
            line-height: 1.6;
        }

        .lessons-list {
            margin-top: 20px;
        }

        .lessons-list .lesson-item {
            margin-bottom: 10px;
        }

        .lessons-list .lesson-item button {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 8px 15px;
            font-size: 14px;
            cursor: pointer;
        }

        .teacher-info {
            margin-top: 30px;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .teacher-name {
            font-size: 20px;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }

        .teacher-rating {
            margin-top: 10px;
        }

        .enroll-button {
            margin-top: 20px;
        }

        .enroll-button a {
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 15px 30px;
            font-size: 18px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .enroll-button a:hover {
            background-color: #218838;
        }
    </style>
@stop
@section('content')
<main id="main" class="main">
<!-- page content -->
<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left">
            <h3>E-Learning :: Course Details</h3>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            {!! Breadcrumbs::render('student-course-details',$teacherCourseId) !!}

            <div class="course-details-container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="course-image">
                            <img src="{{ url($teacherCourse->course->featured_image) }}" alt="Course Image" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h3 class="course-title">{{ $teacherCourse->course->title }}</h3>
                        <p class="course-description">{{ $teacherCourse->course->featured_text }}</p>
                        <div class="lessons-list">
                            <h4>Available Lessons</h4>
                            <ul class="list-unstyled">
                                @foreach($teacherCourseLessons as $lesson)
                                    <li class="lesson-item">
                                        <button>{{ $lesson->title }}</button>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="teacher-info">
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="teacher-name">Teacher/Author: {{ $teacherCourse->teacher->user->name }}</h3>
                        <p>User since {!! \App\Libraries\TimeStampToAgoHelper::time_elapsed_string($teacherCourse->teacher->user->created_at) !!}</p>
                        <input type="hidden" id="teacher_id"  value="{{ $teacherCourse->teacher->user->id }}">
                        <input id="input-id" type="text" class="rating" data-size="lg">
                    </div>
                </div>
            </div>

            <div class="enroll-button">
                @if($courseTaken)                    @if($studentCourseTaken->status == \App\Libraries\Enumerations\CourseStudentStatus::$INCOMPLETE)
                        <a href="{{ route('getCourseLessonsForStudent',['teacher_course_id'=>$teacherCourse->id]) }}" class="btn btn-success">Continue Study</a>
                        <a href="{{ route('getCourseExamsForStudent',['teacher_course_id'=>$teacherCourse->id]) }}" class="btn btn-primary">Exams</a>
                    @elseif($studentCourseTaken->status == \App\Libraries\Enumerations\CourseStudentStatus::$COMPLETED)
                        @if($certificate)
                            <a target="_blank" class="btn btn-primary btn-flat btn-sm" href="{{ asset($certificate->file_path) }}">Download Certificate</a>
                        @else
                            <p>Sorry, Certificate File Not Found. Please Contact Course Author.</p>
                        @endif
                    @endif
                @else
                    <a href="{{ route('student-course-enroll',['teacher_course_id'=>$teacherCourse->id]) }}" class="btn btn-primary">Enroll Now</a>
                @endif
            </div>
        </div>
    </div>
</div>
<!-- /page content -->

@stop
@section('page_js')
    <script src="{{ url('admin/vendors/star-rating/js/star-rating.min.js') }}"></script>
    <script src="{{ url('admin/vendors/pnotify/dist/pnotify.js') }}"></script>
    <script src="{{ url('admin/vendors/pnotify/dist/pnotify.buttons.js') }}"></script>
    <script>
        // initialize with defaults
        $("#input-id").rating({ min: 1, max: 100, step: 1, size: 'lg' });
        $('.filled-stars').css("width", "{{ (int) $avgPoint }}%");
        $('#input-id').on('change', function () {
            @if(\Illuminate\Support\Facades\Auth::user()->user_type != \App\Libraries\Enumerations\UserTypes::$STUDENT)
                alert('Sorry! Rating can only be updated by a student.');
                return false;
            @endif
            var point = parseInt($('.filled-stars')[0].style.width, 10);
            point += 1;
            if (point > 100) {
                point = 100;
            }
            var ratingUpdateUrl = '{{ route('updateTeacherRating') }}';
            var teacherId = $('#teacher_id').val();
            var token = '{{ csrf_token() }}';
            $.ajax({
                url: ratingUpdateUrl,
                type: 'POST',
                data: { _token: token, teacherId: teacherId, point: point },
                success: function (result) {
                    if (result == 'success') {
                        new PNotify({
                            title: 'Rating Updated Successfully',
                            text: 'This rating is calculated from average rating submissions from students!',
                            type: 'success',
                            styling: 'bootstrap3'
                        });
                    } else {
                        new PNotify({
                            title: 'Sorry! Something went wrong.',
                            text: 'Please try again later.',
                            type: 'error',
                            styling: 'bootstrap3'
                        });
                    }
                }
            });
        });
    </script>
    </main>
@stop

