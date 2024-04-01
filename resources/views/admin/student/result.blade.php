@extends('admin.master')
@section('title')
    Student Result
@endsection
@section('content')
    @php
        $column='col-sm-2';

    @endphp
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <h4 class="text-center text-success">{{session('message')}}</h4>
                            <h3 class="text-center"><strong>Update Students Result</strong>
                            </h3>
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <form action="" id="filterForm">
                                <div class="row">
                                    <div class="form-group col-sm-2"><label for="" class="form-control-label">Student Roll</label>
                                        <input name="student_roll" type="number" onkeypu="filter()" class="form-control" value="@isset($_GET['student_roll']){{$_GET['student_roll']}}@endisset"></div>
                                    @if(Auth::user()->role == 1)
                                        <div class="form-group col-md-2">
                                            <label for="" class="form-control-label">Branch</label>
                                            <select name="branch_id" id="branch_id" onchange="filter()" class="form-control">
                                                <option value="">All</option>
                                                @foreach($branches as $branch)
                                                    <option value="{{$branch->id}}" @isset($_GET['branch_id']) @if($branch->id == $_GET['branch_id']) selected @endif @endisset>{{$branch->branch_code}} ({{$branch->branch_name}}) </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif
                                    <div class="form-group {{$column}}">
                                        <label for="" class="form-control-label">Session</label>
                                        <select name="session_id" id="session_id" onchange="filter()" class="form-control">
                                            <option value="">All</option>
                                            @foreach($sessions as $session)
                                                <option value="{{$session->id}}" @isset($_GET['session_id']) @if($session->id == $_GET['session_id']) selected @endif @endisset>{{$session->session_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-2">
                                        <label for="" class="form-control-label">Year</label>
                                        <select name="year" id="year" onchange="filter()" class="form-control">
                                            <option value="">All</option>
                                            @for($i=2018; $i<=date('Y'); $i++)
                                                <option value="{{$i}}" @isset($_GET['year']) @if($i == $_GET['year']) selected @endif @endisset>{{$i}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="form-group {{$column}}">
                                        <label for="" class="form-control-label">Course</label>
                                        <select name="course_id" id="course_id" onchange="filter()" class="form-control">
                                            <option value="">All</option>
                                            @foreach($courses as $course)
                                                <option value="{{$course->id}}" @isset($_GET['course_id']) @if($course->id == $_GET['course_id']) selected @endif @endisset>{{$course->course_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-sm-1 text-center">
                                        <label for="" class="form-control-label text-white">--</label>
                                        <div class="d-none">
                                            @if(Auth::user()->role == 1)
                                                <button type="submit" class="btn btn-primary">
                                                    <a href="{{route('student.result-sheet.print')}}@isset($_GET['session_id'])?session_id={{ $_GET['session_id'] }}@if(Auth::user()->role == 1)&branch_id={{ $_GET['branch_id'] }}@endif&year={{ $_GET['year'] }}&course_id={{ $_GET['course_id'] }}@endisset"
                                                        class="float-right text-white" onclick="return checkBranch()">Get Result Sheet</a>
                                                </button>
                                            @elseif(getSettings('branch_result_sheet_printing_status') != 0)
                                                <button type="submit" class="btn btn-primary">
                                                    <a href="{{route('student.result-sheet.print')}}@isset($_GET['session_id'])?session_id={{ $_GET['session_id'] }}&year={{ $_GET['year'] }}&course_id={{ $_GET['course_id'] }}@endisset"
                                                       class="float-right text-white">Get Result Sheet</a>
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>

                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th>#</th>
                            <th>Name</th>

                            <th>Roll No</th>
                            <th width="100px">Course Name</th>

                            <th class="{{Auth::user()->role == 1 ? 'd-none':''}}">Marks</th>
                            <th>Grade</th>
                            <th>Action</th>
                        </tr>
                        @php $i=1; @endphp
                        @foreach($items as $item)
                            <form action="{{route('student.result.update')}}" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{$item->id}}">
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td width="120px">{{$item->student->student_name}}</td>
                                    <td>{{$item->student_roll}} <br><span>{{$item->student_registration}}</span></td>
                                    @php
                                        $course = getCourseById($item->course_id);
                                        $branch = getBranchById($item->branch_id)
                                    @endphp
                                    <td width="120px">
                                        @if($course)
                                            {{$course->course_name}}
                                        @endif
                                    </td>
                                    <td width="90px" class="{{Auth::user()->role == 1 ? 'd-none':''}}"><input type="number" name="result_marks" id="" class="form-control" value="@isset($item){{$item->result_marks}}@endisset"></td>
                                    <td width="100px">
                                        <select name="result_grade_id" id="" class="form-control">
                                            <option value="">Select Grade</option>
                                            @foreach($grades as $grade)
                                                <option value="{{$grade->result_grade_id}}" {{$item->result_grade_id == $grade->result_grade_id ? 'selected':''}}>{{$grade->result_grade_title}}</option>
                                            @endforeach
                                        </select>
                                    </td>

                                    <td class="btn-group">
                                        <button type="submit" class="btn btn-primary" title="Update Result"><i class="fa fa-save"></i></button>
                                        @php
                                            $result=  \App\Models\CourseModuleResult::where('student_id', $item->student_id)->first()
                                        @endphp
                                        @if($course != null)
                                            @if(count(getCourseModuleByCourseId($course->id)) !=0)
                                                @if($result)
                                                    <a href="{{route('student.result.module.edit', ['id'=>$item->student_id])}}" class="btn btn-info mx-2" title="Edit Module Result"><i class="fa fa-pencil"></i></a>
                                                    <!-- Button trigger modal -->
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-primary" title="Show Course Module Result" data-toggle="modal" data-target="#exampleModal">
                                                        <i class="fa fa-list"></i>
                                                    </button>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel"><strong>Course Module Result</strong>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <i class="fa fa-close"></i>
                                                                        </button></h5>
                                                                </div>
                                                                <div class="modal-body">
                                                                    @php $results = getModuleResultByStudentId($item->student_id) @endphp
                                                                    <table class="table table-borderless">
                                                                        <tr>
                                                                            <th>Module Name</th>
                                                                            <th>Marks</th>
                                                                            <th>Grade</th>
                                                                        </tr>
                                                                        @foreach($results as $result)
                                                                            @if($result->result_grade_id and $result->marks)
                                                                            <tr>
                                                                                <td>{{$result->courseModule->module_name}}</td>
                                                                                <td>{{$result->marks}}</td>
                                                                                <td>{{$result->resultGrade->result_grade_title}}</td>
                                                                            </tr>
                                                                            @endif
                                                                        @endforeach
                                                                    </table>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <a href="{{route('student.result.module.add', ['id'=>$item->id])}}" class="btn btn-warning mx-2" title="Add Module Result"><i class="fa fa-plus-square-o"></i></a>
                                                @endif
                                            @endif
                                        @endif
{{--                                        @if(getSettings('marksheet_printing_status') == 1)--}}
{{--                                            <a href="{{route('student.result.print', ['id'=>$item->id])}}" class="btn btn-warning mx-2" title="Print Result"><i class="fa fa-clipboard"></i></a>--}}
{{--                                        @endif--}}
                                    </td>
                            </form>
                        @endforeach
                    </table>

                    {{$items->links('pagination::bootstrap-5')}}
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        function checkBranch() {
            var branch_id = jQuery('#branch_id').val();
            if(!branch_id){
                alert('Please Select Branch!!');
                return false;
            }
        }
    </script>
@endpush
