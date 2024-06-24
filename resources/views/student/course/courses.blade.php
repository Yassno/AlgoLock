@extends('admin.layouts.master')
@section('title', 'E-Learning | Courses')
@section('content')

    <div class="right_col" role="main">
        <div class="">
            <main id="main" class="main">
                <div class="clearfix"></div>

                @if(count($studentCourses) > 0)
                    <div class="row">
                        <div class="col-md-12">
                            {!! Breadcrumbs::render('coursesForStudents') !!}
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Currently In Progress <small> Here's what you're currently working through. Get back to work! </small></h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                                        <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <div class="row">
                                        @foreach($studentCourses as $sCourse)
                                            <div class="col-md-4">
                                                <div class="course-card">
                                                    <img src="{{ url($sCourse->teacher_course->course->featured_image) }}" alt="Course Image" class="course-thumbnail">
                                                    <div class="course-details">
                                                        <h3 class="course-title">{{ $sCourse->teacher_course->course->title }}</h3>
                                                        <a href="{{ route('student-course-details',['teacher_course_id' => $sCourse->teacher_course->id]) }}" class="btn btn-primary btn-sm">View Course</a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    {!! $studentCourses->render() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if(count($trendingCourses) > 0)
                    <div class="row">
                        <div class="col-md-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Trending Courses <small> Here's what your peers are binging. </small></h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                                        <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <div class="row">
                                        @foreach($trendingCourses as $tCourse)
                                            <div class="col-md-4">
                                                <div class="course-card">
                                                    <img src="{{ url($tCourse->teacher_course->course->featured_image) }}" alt="Course Image" class="course-thumbnail">
                                                    <div class="course-details">
                                                        <h3 class="course-title">{{ $tCourse->teacher_course->course->title }}</h3>
                                                        <a href="{{ route('student-course-details',['teacher_course_id' => $tCourse->teacher_course->id]) }}" class="btn btn-primary btn-sm">View Course</a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    {!! $trendingCourses->render() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if(count($AllCourses) > 0)
                    <div class="row">
                        <div class="col-md-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>All Courses <small> Here all the courses from our teachers. </small></h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                                        <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <div class="row">
                                        @foreach($AllCourses as $aCourse)
                                            <div class="col-md-4">
                                                <div class="course-card">
                                                    <img src="{{ url($aCourse->course->featured_image) }}" alt="Course Image" class="course-thumbnail">
                                                    <div class="course-details">
                                                        <h3 class="course-title">{{ $aCourse->course->title }}</h3>
                                                        <a href="{{ route('student-course-details',['teacher_course_id' => $aCourse->id]) }}" class="btn btn-primary btn-sm">View Course</a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    {!! $AllCourses->render() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </main>
        </div>
    </div>
    
@stop
