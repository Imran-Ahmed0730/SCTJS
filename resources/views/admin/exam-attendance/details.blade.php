@extends('admin.master')
@section('title')
    Attendance Details
@endsection
@section('content')
{{--    @php dd($items[0]->exam_id) @endphp--}}
    <div class="row mt-5">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center"><strong>Attendance Details</strong>
                    </h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <th>#</th>
                        <th width="20px" class="{{Auth::user()->role == 1 ? 'd-none':''}}">Attendance</th>
                        <th>Student Name</th>
                        <th>Student Roll</th>
                        <th>Status</th>
                        </thead>
                        <tbody>
                        @if($items)
                            <form action="{{route('exam.attendance.update')}}" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{$items[0]->exam_id}}">
                                <input type="hidden" name="total_student" value="{{count($items)}}">
                                @php $i=1; @endphp
                                @foreach($items as $item)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td width="20px" class="{{Auth::user()->role == 1 ? 'd-none':''}}">
                                            <div class="form-check" style="align-items: center">
                                                <input class="form-check-input" type="checkbox" name="student_id[]" value="{{$item->student_id}}"
                                                       id="flexCheckDefault" style="height: 15px; width: 15px; margin: 0 20%" {{$item->status == 1 ? 'checked': ''}}>
                                            </div>
                                        </td>
                                        <td>{{$item->student->student_name ?? ''}}</td>
                                        <td>{{$item->branchStudent->student_roll ?? ''}}</td>
                                        <td class="{{$item->status == 1 ? 'text-success': 'text-danger'}}">{{$item->status == 1 ? 'Present': 'Absent'}}</td>
                                    </tr>
                                @endforeach
                                <tr class="{{Auth::user()->role == 1 ? 'd-none':''}}">
                                    <td colspan="5">
                                        <div style="display: flex; flex-wrap: wrap; justify-content: space-around">
                                            <button type="submit" id="submitBtn" onclick="" class="btn btn-primary">Update Attendance</button>
                                        </div>
                                    </td>
                                </tr>
                            </form>
                        @else
                            <tr>
                                <td colspan="4">No Student</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>

                </div>
            </div>

        </div>
    </div>
@endsection
