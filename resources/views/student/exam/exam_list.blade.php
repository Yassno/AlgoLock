@extends('admin.layouts.master')

@section('title', 'Student Course Exam List')

@section('content')
<main id="main" class="main">
<div class="right_col" role="main">

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            {!! Breadcrumbs::render('getCourseExamsForStudent',$teacher_course_id) !!}

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

            <div class="x_panel">
                <div class="x_title">
                    <h2>Exam List</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    @if(count($exams)<1)
                        <div class="alert alert-dismissible fade in alert-info" role="alert">
                            <strong>Sorry !</strong> No Exam Data Found.
                        </div>
                    @else
                        <table class="table table-striped table-bordered dataTable no-footer" id="data">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Title</th>
                                    <th>Course</th>
                                    <th>Question File</th>
                                    <th>Pass Score</th>
                                    <th>Duration</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($exams as $exam)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $exam->exam_title }}</td>
                                        <td>{{ $exam->course->title }}</td>
                                        <td>{{ $exam->question_file->question_title }}</td>
                                        <td>{{ $exam->passing_score }} %</td>
                                        <td>{{ $exam->duration }}</td>
                                        <td>
                                            @if($exam->status == \App\Libraries\Enumerations\ExamStatus::$RUNNING)
                                                Running
                                            @elseif($exam->status == \App\Libraries\Enumerations\ExamStatus::$PENDING)
                                                Pending
                                            @else
                                                Done
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if(count($exam->submissions)<1)
                                                <a class="btn btn-info btn-sm" href="{{route('student-exam-start', ['exam_id'=>$exam->id])}}" title="Start Exam">Start</a>
                                            @else
                                                <button  title="Show Result" type="button"
                                                        data-total_mark="{{ $exam->submissions[0]->total_mark }}"
                                                        data-achieve_mark="{{ $exam->submissions[0]->achieve_mark }}"
                                                        data-passing_score="{{ $exam->passing_score }}"
                                                        data-passed_score="{{ $exam->submissions[0]->passed_score }}"
                                                        data-result_status="{{ $exam->submissions[0]->result_status }}"
                                                        data-toggle="modal" data-target="#resultModal"
                                                        class="btn btn-info btn-sm">
                                                    Show Result
                                                </button>
                                            @endif
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

<!--Result Modal -->
<div class="modal fade" id="resultModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Result Info</h4>
            </div>
            <div class="modal-body">
                <form action="">
                    <div class="form-group">
                        <label>Total Mark</label>
                        <input type="text" class="form-control" id="total_mark" readonly>
                    </div>
                    <div class="form-group">
                        <label>Achive Mark</label>
                        <input type="text" class="form-control" id="achieve_mark" readonly>
                    </div>
                    <div class="form-group">
                        <label>Passing Score</label>
                        <input type="text" class="form-control" id="passing_score" readonly>
                    </div>
                    <div class="form-group">
                        <label>Passed Score</label>
                        <input type="text" class="form-control" id="passed_score" readonly>
                    </div>
                    <div class="form-group">
                        <label>Result Status</label>
                        <div id="result_status"></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@stop

@section('page_js')
    <script>
        $('#resultModal').on('show.bs.modal', function (e) {
            $('#total_mark').val($(e.relatedTarget).data('total_mark'));
            $('#achieve_mark').val($(e.relatedTarget).data('achieve_mark'));
            $('#passing_score').val($(e.relatedTarget).data('passing_score'));
            $('#passed_score').val($(e.relatedTarget).data('passed_score'));
            var resultStatusId = $(e.relatedTarget).data('result_status');
            $('#result_status').empty();
            var resultElement;
            if (resultStatusId == {{ \App\Libraries\Enumerations\ResultStatus::$JUDGING }}){
                resultElement = '<h4><span class="label label-info">Judging</span></h4>';
            }else if (resultStatusId == {{ \App\Libraries\Enumerations\ResultStatus::$FAILED }})
            {
                resultElement = '<h4><span class="label label-danger">Failed</span></h4>';
            }else if(resultStatusId == {{ \App\Libraries\Enumerations\ResultStatus::$PASSED }}){
                resultElement = '<h4><span class="label label-success">Passed</span></h4>';
            }
            $('#result_status').append(resultElement);
        });
    </script>
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
    </main>
@stop
