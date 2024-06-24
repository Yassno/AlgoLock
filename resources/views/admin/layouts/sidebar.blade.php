<?php
$user_type =  \Illuminate\Support\Facades\Auth::user()->user_type;
$teacher = \App\Libraries\Enumerations\UserTypes::$TEACHER;
$student = \App\Libraries\Enumerations\UserTypes::$STUDENT;
$admin = \App\Libraries\Enumerations\UserTypes::$ADMIN;

?>

<aside id="sidebar" class="sidebar">
  <ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
      <a class="nav-link" href="{{ route('dashboard') }}">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li><!-- End Dashboard Nav -->

    @if($user_type == $admin)
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#teacher-menu" data-bs-toggle="collapse" href="#">
        <i class="bi bi-hospital"></i><span>Teacher</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="teacher-menu" class="nav-content collapse" data-bs-parent="#sidebar-nav">
        <li>
          <a href="{{ route('teachers-list') }}" class="{{ Route::currentRouteName() == 'teachers-list' ? 'active' : '' }}">
            <i class="bi bi-building"></i><span>Teachers</span>
          </a>
        </li>
      </ul>
    </li><!-- End Teacher Nav -->
    @endif

    @if($user_type == $admin || $user_type == $teacher)
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#student-menu" data-bs-toggle="collapse" href="#">
        <i class="bi bi-hospital"></i><span>Student</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="student-menu" class="nav-content collapse" data-bs-parent="#sidebar-nav">
        @if($user_type == $admin)
        <li>
          <a href="{{ route('students-list') }}" class="{{ Route::currentRouteName() == 'students-list' ? 'active' : '' }}">
            <i class="bi bi-building"></i><span>Students</span>
          </a>
        </li>
        @endif
        @if($user_type == $teacher)
        <li>
          <a href="{{ route('getTeacherStudentsListPage') }}" class="{{ Route::currentRouteName() == 'getTeacherStudentsListPage' ? 'active' : '' }}">
            <i class="bi bi-building"></i><span>My Students</span>
          </a>
        </li>
        @endif
      </ul>
    </li><!-- End Student Nav -->
    @endif

    @if($user_type == $admin || $user_type == $teacher)
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#department-menu" data-bs-toggle="collapse" href="#">
        <i class="bi bi-building"></i><span>Department</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="department-menu" class="nav-content collapse" data-bs-parent="#sidebar-nav">
        <li>
          <a href="{{ route('departments-list') }}" class="{{ Route::currentRouteName() == 'departments-list' ? 'active' : '' }}">
            <i class="bi bi-list-alt"></i><span>Departments</span>
          </a>
        </li>
      </ul>
    </li><!-- End Department Nav -->
    @endif

    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#course-menu" data-bs-toggle="collapse" href="#">
        <i class="bi bi-columns"></i><span>Course</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="course-menu" class="nav-content collapse" data-bs-parent="#sidebar-nav">
        @if($user_type == $teacher || $user_type == $admin)
        <li>
          <a href="{{ route('courses-list') }}" class="{{ Route::currentRouteName() == 'courses-list' ? 'active' : '' }}">
            <i class="bi bi-list-alt"></i><span>Courses</span>
          </a>
        </li>
        @endif
        @if($user_type == $admin)
        <li>
          <a href="{{ route('courses-listing-settings') }}" class="{{ Route::currentRouteName() == 'courses-listing-settings' ? 'active' : '' }}">
            <i class="bi bi-building"></i><span>Courses List Setting</span>
          </a>
        </li>
        @endif
        @if($user_type == $teacher)
        <li>
          <a href="{{ route('my-courses-list') }}" class="{{ Route::currentRouteName() == 'my-courses-list' ? 'active' : '' }}">
            <i class="bi bi-list-alt"></i><span>My Courses</span>
          </a>
        </li>
        @endif
        @if($user_type == $student)
        <li>
          <a href="{{ route('student-courses-list') }}" class="{{ Route::currentRouteName() == 'student-courses-list' ? 'active' : '' }}">
            <i class="bi bi-list-alt"></i><span>Courses</span>
          </a>
        </li>
        <li>
          <a href="{{ route('logged-student-courses-list') }}" class="{{ Route::currentRouteName() == 'logged-student-courses-list' ? 'active' : '' }}">
            <i class="bi bi-list-alt"></i><span>My Courses</span>
          </a>
        </li>
        @endif
      </ul>
    </li><!-- End Course Nav -->

    @if($user_type == $teacher)
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#course-lessons-menu" data-bs-toggle="collapse" href="#">
        <i class="bi bi-file-text"></i><span>Course Lessons</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="course-lessons-menu" class="nav-content collapse" data-bs-parent="#sidebar-nav">
        <li>
          <a href="{{ route('course-lessons-list') }}" class="{{ Route::currentRouteName() == 'course-lessons-list' ? 'active' : '' }}">
            <i class="bi bi-list-alt"></i><span>Lessons List</span>
          </a>
        </li>
      </ul>
    </li><!-- End Course Lessons Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#questions-menu" data-bs-toggle="collapse" href="#">
        <i class="bi bi-question"></i><span>Questions</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="questions-menu" class="nav-content collapse" data-bs-parent="#sidebar-nav">
        <li>
          <a href="{{ route('question-list') }}" class="{{ Route::currentRouteName() == 'question-list' ? 'active' : '' }}">
            <i class="bi bi-question"></i><span>Questions List</span>
          </a>
        </li>
        <li>
          <a href="{{ route('question-make') }}" class="{{ Route::currentRouteName() == 'question-make' ? 'active' : '' }}">
            <i class="bi bi-plus"></i><span>Make Question File</span>
          </a>
        </li>
        <li>
          <a href="{{ route('getAllQuestionFiles') }}" class="{{ Route::currentRouteName() == 'getAllQuestionFiles' ? 'active' : '' }}">
            <i class="bi bi-list-alt"></i><span>Question File List</span>
          </a>
        </li>
      </ul>
    </li><!-- End Questions Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#exam-menu" data-bs-toggle="collapse" href="#">
        <i class="bi bi-sticky-note"></i><span>Exam</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="exam-menu" class="nav-content collapse" data-bs-parent="#sidebar-nav">
        <li>
          <a href="{{ route('getExamListPage') }}" class="{{ Route::currentRouteName() == 'getExamListPage' ? 'active' : '' }}">
            <i class="bi bi-building"></i><span>Exam List</span>
          </a>
        </li>
        <li>
          <a href="{{ route('getExamCreatePage') }}" class="{{ Route::currentRouteName() == 'getExamCreatePage' ? 'active' : '' }}">
            <i class="bi bi-building"></i><span>Exam Create</span>
          </a>
        </li>
        <li>
          <a href="{{ route('getStudentExamSubmissionsByCourse') }}" class="{{ Route::currentRouteName() == 'getStudentExamSubmissionsByCourse' ? 'active' : '' }}">
            <i class="bi bi-building"></i><span>Student Exams</span>
          </a>
        </li>
      </ul>   
    </li><!-- End Exam Nav -->
    @endif
 <li class="nav-item">
      <a class="nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#profile-menu">
        <i class="bi bi-person"></i>
        <span>{{ Auth::user()->name }}</span>
        <i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul class="nav-content collapse" id="profile-menu" data-bs-parent="#sidebar-nav">
        <li>
          <a href="{{ route('account-settings') }}">
            <i class="bi bi-gear"></i><span>Profile</span>
          </a>
        </li>
        <li>
          <a href="{{ route('logout') }}">
            <i class="bi bi-box-arrow-right"></i><span>Log Out</span>
          </a>
        </li>
      </ul>
    </li><!-- End User Profile Nav -->
  </ul>
</aside><!-- End Sidebar -->

