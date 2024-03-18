@extends('admin.master')
@section('title')
    Session List
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-center text-success">{{session('message')}}</h4>
                    <h3 class="text-center"><strong>View Session List</strong>
                        <a href="{{route('admin.session.add')}}" class="float-right btn btn-primary">Add Session</a>
                    </h3>
                    <hr>
                    <form action="" id="filterForm">
                        <div class="row">
                            <div class="form-group col-md-4"><label for="" class="form-control-label">Status</label>
                                <select name="session_status_id" onchange="filter()" id="" class="form-control">
                                    <option value="">All</option>
                                    <option value="1" @isset($_GET['session_status_id']){{$_GET['session_status_id'] == 1 ? 'selected':''}}@endisset>Active</option>
                                    <option value="0" @isset($_GET['session_status_id']){{$_GET['session_status_id'] == 0 ? 'selected':''}}@endisset>Inactive</option>
                                </select>
                            </div>

                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th>#</th>
                            <th>Session Title</th>
                            <th>Starting Date</th>
                            <th>Ending Date</th>
                            <th>Total Courses</th>
                            <th>Total Students</th>
                            <th>Admission Fee</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        @php $i=1; @endphp
                        @foreach($items as $item)

                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$item->session_name}}</td>
                                <td>{{$item->session_start_day}} {{$months[$item->session_start_month-1]}}, {{$item->session_start_year}}</td>
                                <td>{{$item->session_end_day}} {{$months[$item->session_end_month-1]}}, {{$item->session_end_year}}</td>
                                <td>{{count(getCoursesBySessionId($item->id))}}</td>
                                <td>{{count(getStudentsBySessionId($item->id))}}</td>
                                <td>{{$item->admission_fee}}</td>
                                <td class="text-center">
                                    <div class="">
                                        <span class="{{$item->session_status_id == 1 ? 'bg-success':'bg-danger'}} p-2 text-white" style="border-radius:5px">
                                    {{$item->session_status_id == 1 ? 'Active':'Inactive'}}</span>
                                    </div>
                                </td>
{{--                                <td class="{{$item->session_status_id == 1 ? 'text-success': 'text-danger'}}">{{$item->session_status_id == 1 ? 'Active': 'Inactive'}}</td>--}}
                                <td class="btn-group">
                                    <a href="{{route('admin.session.edit', ['id'=>$item->id])}}" title="Edit" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                                    <form action="{{route('admin.session.remove')}}" onclick="return confirm('Please Confirm Before Deleting it!!')" method="post">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$item->id}}">
                                        <button type="submit" title="Remove" class="btn btn-danger" style="margin-left: 5px"><i class="fa fa-trash"></i></button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach

                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
