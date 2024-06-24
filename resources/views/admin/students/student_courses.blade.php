@extends('admin.layouts.master')
@section('title', 'E-Learning | Student Courses')
@section('content')
<!-- page content -->
<main id="main" class="main">
    <div class="container my-5">
        {!! Breadcrumbs::render('student_courses', $studentId) !!}
        
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h2 class="h5 mb-0">Currently In Progress</h2>
                        <div class="panel_toolbox">
                            <button class="btn btn-outline-secondary btn-sm" data-bs-toggle="collapse" data-bs-target="#inProgressCourses" aria-expanded="true">
                                <i class="fa fa-chevron-up"></i>
                            </button>
                        </div>
                    </div>
                    <div class="collapse show" id="inProgressCourses">
                        <div class="card-body">
                            <div class="row">
                                @foreach($incompleteCourses as $iCourse)
                                    <div class="col-md-4 mb-3">
                                        <div class="card h-100">
                                            <img src="{{ url($iCourse->teacher_course->course->featured_image) }}" class="card-img-top" alt="image">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $iCourse->teacher_course->course->title }}</h5>
                                                <p class="card-text">{{ $iCourse->teacher_course->course->short_code }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            {!! $incompleteCourses->render() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h2 class="h5 mb-0">Completed Courses</h2>
                        <div class="panel_toolbox">
                            <button class="btn btn-outline-secondary btn-sm" data-bs-toggle="collapse" data-bs-target="#completedCourses" aria-expanded="true">
                                <i class="fa fa-chevron-up"></i>
                            </button>
                        </div>
                    </div>
                    <div class="collapse show" id="completedCourses">
                        <div class="card-body">
                            <div class="row">
                                @foreach($completedCourses as $cCourse)
                                    <div class="col-md-4 mb-3">
                                        <div class="card h-100">
                                            <img src="{{ url($cCourse->teacher_course->course->featured_image) }}" class="card-img-top" alt="image">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $cCourse->teacher_course->course->title }}</h5>
                                                <p class="card-text">{{ $cCourse->teacher_course->course->short_code }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            {!! $completedCourses->render() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- /page content -->
@stop
