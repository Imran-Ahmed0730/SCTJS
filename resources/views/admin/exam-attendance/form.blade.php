@extends('admin.master')
@section('title')
    @isset($item)Edit @else Add @endisset Exam Attendance
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3><strong>@isset($item)Edit @else Add @endisset Exam Attendance</strong></h3>
                </div>
                <div class="card-body">
                    <form action="" id="filterForm">
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label for="" class="form-control-label">Date</label>
                                <input type="date" name="date" id="exam_date" oninput="changeDate()" class="form-control" value="{{date('Y-m-d')}}">
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="" class="form-control-label">Course</label>
                                <select name="course_id" id="course" class="form-control" onchange="filter()">
                                    <option value="">Select Course</option>
                                    @foreach($courses as $course)
                                        <option value="{{$course->id}}" @isset($_GET['course_id']) {{$course->id == $_GET['course_id'] ? 'selected':''}} @endisset>{{$course->course_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="" class="form-control-label">Session</label>
                                <select name="session_id" id="session" class="form-control" onchange="filter()">
                                    <option value="">Select Session</option>
                                    @foreach($sessions as $session)
                                        <option value="{{$session->id}}" @isset($_GET['session_id']) {{$session->id == $_GET['session_id'] ? 'selected':''}} @endisset>{{$session->session_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    @if(isset($_GET['session_id']) || isset($_GET['course_id']))
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <th>#</th>
                        <th width="20px">Attendance</th>
                        <th>Student Name</th>
                        <th>Student Roll</th>
                        </thead>
                        <tbody>
                        @if(isset($items) && count($items) != 0 )
                            <form action="{{route('exam.attendance.submit')}}" onsubmit="return checkFillable()" method="post">
                                @csrf
                                @php $i=1; @endphp
                                @foreach($items as $item)
{{--                                    @if($item->student && $item->student->student_status_id ==1)--}}
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td width="20px">
                                                <div class="form-check" style="align-items: center">
                                                    <input class="form-check-input" type="checkbox" name="student_id[]" value="{{$item->student_id}}"
                                                           id="flexCheckDefault" style="height: 15px; width: 15px; margin: 0 20%" checked>
                                                </div>
                                            </td>
                                            <td>{{$item->student->student_name ?? ''}}</td>
                                            <td>{{$item->student_roll}}</td>
                                        </tr>
{{--                                    @endif--}}
                                @endforeach
                                <input type="hidden" name="course_id" value="{{$_GET['course_id']}}">
                                <input type="hidden" name="session_id" value="{{$_GET['session_id']}}">
                                <input type="hidden" id="date" name="date" value="{{date('Y-m-d')}}">
                                <input type="hidden" id="total_student" name="total_student" value="{{count($items)}}">
                                <tr>

                                    <td colspan="4" style="" class="text-center">
                                        @if($i > 1)
                                            <div style="display: flex; flex-wrap: wrap; justify-content: space-around">

                                                <button type="submit" id="submitBtn" onclick="" class="btn btn-primary">Save Attendance</button>
                                            </div>
                                        @else
                                            <span >No Student Found</span>
                                        @endif

                                    </td>

                                </tr>
                            </form>
                        @else
                            <td colspan="4" class="text-center">No Student Found</td>
                        @endif
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    @endif

@endsection
@push('script')
    <script>
        function changeDate(){
            var date = jQuery('#exam_date').val();
            jQuery('#date').val(date);
            console.log(jQuery('#date').val());
        }
        function checkFillable() {
            alert();
            var session_id = jQuery('#session').val();
            var course_id = jQuery('#course').val();
            console.log(session_id);
            if(!course_id  || !session_id){
                alert('Please Select Course and Session!!');
                return false;
            }
        }
    </script>
@endpush
