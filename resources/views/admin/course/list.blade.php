@extends('admin.master')
@section('title')
    Course List
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">

                    <div class="row">
                        <div class="col-md-10">
                            <h4 class="text-center text-success">{{session('message')}}</h4>
                            <h3 class="text-center"><strong>View Course List</strong></h3>
                        </div>
                        <div class="col-md-2">
                            <a href="{{route('admin.course.add')}}" class="float-right btn btn-primary">Add Course</a>
                        </div>
                    </div>

                    <hr>
                    <form action="" id="filterForm">
                        <div class="row mb-3">
                            <div class="form-group col-sm-5"><label for="" class="form-control-label">Status</label>
                                <select name="course_status_id" onchange="filter()" id="" class="form-control">
                                    <option value="">All</option>
                                    <option value="1" @isset($_GET['course_status_id']){{$_GET['course_status_id'] == '1' ? 'selected':''}}@endisset>Active</option>
                                    <option value="0" @isset($_GET['course_status_id']){{$_GET['course_status_id'] == '0' ? 'selected':''}}@endisset>Inactive</option>
                                </select>

                            </div>
                            <div class="form-group col-sm-5"><label for="" class="form-control-label">Course Type</label>
                                <select name="course_type" onchange="filter()" id="" class="form-control">
                                    <option value="">All</option>
                                    <option value="online"
                                    @isset($_GET['course_type']){{$_GET['course_type'] == 'online' ? 'selected':''}}@endisset>
                                        Offline</option>
                                    <option value="offline" @isset($_GET['course_type']){{$_GET['course_type'] == 'offline' ? 'selected':''}}@endisset
                                    >Online</option>
                                </select>
                            </div>

                        </div>

                    </form>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th>#</th>
                            <th>Course Name<br><span class="second-line">Course Code</span></th>
                            <th>Fee<br><span class="second-line">Discount</span></th>
                            <th>Duration<br><span class="second-line">Lectures</span></th>
                            <th>Medium<br><span class="second-line">Type</span></th>
                            <th>Status<br><span class="second-line">Total Students</span></th>
                            <th>Action</th>
                        </tr>
                        @php $i=1; @endphp
                        @foreach($items as $item)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$item->course_name}}<br><span>{{$item->course_code}}</span></td>
                                <td>{{$item->course_fee}}<br><span>{{$item->discount}}</span></td>
                                <td>{{$item->course_duration}}<br><span>{{$item->total_lectures}}</span></td>
                                <td>{{$item->course_medium_id == 1 ? 'Bangla':''}} <br><span>{{ $item->course_type}}</span></td>

                                <td class="text-center">
                                    <div class="mb-2">
                                        <span class="{{$item->course_status_id == 1 ? 'bg-success':'bg-danger'}} p-2 text-white" style="border-radius:5px">
                                    {{$item->course_status_id == 1 ? 'Active':'Inactive'}}</span>
                                    </div>
                                    <span>{{count(getStudentsByCourseId($item->id))}}</span>
                                    </td>

                                <td class="btn-group">
                                    <a href="{{route('admin.course.edit', ['id'=>$item->id])}}" title="Edit" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                                    <form action="{{route('admin.course.remove')}}" onclick="return confirm('Please Confirm Before Deleting it!!')" method="post">
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
