@extends('admin.master')
@section('title')
    View Exams
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-center text-success">{{session('message')}}</h4>
                    <h3 class="text-center"><strong>View Attendance Summary</strong>
                        @if(Auth::user()->role == 2)
                            <a href="{{route('exam.attendance.add')}}" class="float-right btn btn-primary">Add Exam Attendance</a>
                        @endif
                    </h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th>#</th>
                            <th class="{{Auth::user()->role == 2 ? 'd-none':''}}">Branch Name</th>
                            <th>Course Name</th>
                            <th>Session Name</th>
                            <th>Exam Date</th>
                            <th>Total Student</th>
                            <th>Present</th>
                            <th>Absent</th>
                            <th>Action</th>
                        </tr>
                        @php $i=1; @endphp
                        @foreach($items as $item)
                            <tr>
                                <td>{{$i++}}</td>
                                <td class="{{Auth::user()->role == 2 ? 'd-none':''}}">{{$item->branch->branch_name}}</td>
                                <td>{{$item->course->course_name ?? ''}}</td>
                                <td>{{$item->session->session_name ?? ''}}</td>
                                <td>{{$item->date}}</td>
                                <td>{{$item->total_student}}</td>
                                <td>{{$item->present}}</td>
                                <td>{{$item->absent}}</td>
                                <td class="btn group">
                                    <a href="{{route('exam.attendance.details', ['id'=>$item->id])}}" title="View Details" class="btn btn-primary"><i class="fa fa-info"></i></a>
                                    <a href="{{route('exam.attendance.print', ['id'=>$item->id])}}" title="Get Attendance Sheet" class=" mx-2 btn btn-success"><i class="fa fa-download"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
