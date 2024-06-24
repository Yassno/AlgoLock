@extends('admin.layouts.master')
@section('title', 'E-Learning | My Courses')

@section('content')
    <!-- Page content -->
    <main id="main" class="main">
    <div class="right_col" role="main">
        <div class="page-title">
            <div class="title_left">
                <h3>My Courses</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <!-- In Progress Courses Section -->
        <div class="row">
            <div class="col-md-12">
                {!! Breadcrumbs::render('student_own_courses') !!}
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Currently In Progress</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            @foreach($incompleteCourses as $iCourse)
                                <div class="col-md-4">
                                    <div class="course-card">
                                        <div class="course-thumbnail">
                                            <img src="{{ url($iCourse->teacher_course->course->featured_image) }}" alt="{{ $iCourse->teacher_course->course->title }}">
                                            <div class="course-status">
                                                In Progress
                                            </div>
                                        </div>
                                        <div class="course-details">
                                            <h3 class="course-title">{{ $iCourse->teacher_course->course->title }}</h3>
                                            <a href="{{ route('student-course-details',['teacher_course_id' => $iCourse->teacher_course->id]) }}" class="btn btn-primary btn-sm">View Course</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End In Progress Courses Section -->

        <!-- Completed Courses Section -->
        <div class="row">
            <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Completed Courses</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            @foreach($completedCourses as $cCourse)
                                <div class="col-md-4">
                                    <div class="course-card">
                                        <div class="course-thumbnail">
                                            <img src="{{ url($cCourse->teacher_course->course->featured_image) }}" alt="{{ $cCourse->teacher_course->course->title }}">
                                            <div class="course-status course-completed">
                                                Completed
                                            </div>
                                        </div>
                                        <div class="course-details">
                                            <h3 class="course-title">{{ $cCourse->teacher_course->course->title }}</h3>
                                            <a href="{{ route('student-course-details',['teacher_course_id' => $cCourse->teacher_course->id]) }}" class="btn btn-primary btn-sm">View Course</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Completed Courses Section -->

    </div>
    <!-- End Page content -->
    </main>
@stop
