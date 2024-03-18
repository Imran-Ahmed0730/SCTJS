@extends('admin.master')
@section('title')
    Dashboard
@endsection
@section('content')
    @php
        $year = date('Y')
    @endphp
    <div class="row">
        <div class="col-md-12">
            <div class="card card-body">
                <h3 class="text-center"><strong>Important Notice</strong></h3>
                <div class=" mt-2">
                    <a href="{{route('notice.list')}}"><marquee class="text-danger">**{{$item->notice_title ?? ''}}**</marquee></a>
                </div>
            </div>
        </div>
    </div>
    <div class="animated fadeIn">
        <!-- Widgets  -->
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="card" style="height: 113px">
                    <div class="card-body">
                        <div class="stat-widget-five">
                            <div class="stat-icon dib flat-color-2">
                                <i class="pe-7s-users"></i>
                            </div>
                            <div class="stat-content">
                                <div class="text-left dib">
                                    <div class="stat-text"><span class="count">{{count(getStudents($year))}}</span></div>
                                    <div class="stat-heading">Students ({{$year}})</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card" style="height: 113px">
                    <div class="card-body">
                        <div class="stat-widget-five">
                            <div class="stat-icon dib flat-color-4">
                                <i class="fa fa-graduation-cap"></i>
                            </div>
                            <div class="stat-content">
                                <div class="text-left dib">
                                    <div class="stat-text"><span class="count">{{count(getStudents())}}</span></div>
                                    <div class="stat-heading">Total Students</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card" style="height: 113px">
                    <div class="card-body">
                        <div class="stat-widget-five">
                            <div class="stat-icon dib flat-color-3">
                                <i class="fa fa-hourglass-half"></i>
                            </div>
                            <div class="stat-content">
                                <div class="text-left dib">
                                    <div class="stat-text"><span class="count">{{count(getActiveSessions())}}</span></div>
                                    <div class="stat-heading">Active Sessions</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card" style="height: 113px">
                    <div class="card-body">
                        <div class="stat-widget-five">
                            <div class="stat-icon dib flat-color-1">
                                <i class="pe-7s-cash"></i>
                            </div>
                            <div class="stat-content">
                                <div class="text-left dib">
                                    <div class="stat-text"><span class="count">{{getBills($year)}}</span> TK</div>
                                    <div class="stat-heading">Bills ({{$year}})</div>
                                    <small><a href="{{route('student.bill.list')}}" class="text-info">See Details</a></small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if(Auth::user()->role == 1)
            <div class="row ">
                <div class="col-lg-4 col-md-6">
                    <div class="card" style="height: 113px">
                        <div class="card-body">
                            <div class="stat-widget-five">
                                <div class="stat-icon dib text-warning">
                                    <i class="fa fa-building"></i>
                                </div>
                                <div class="stat-content">
                                    <div class="text-left dib">
                                        <div class="stat-text"><span class="count">{{count($branches)}}</span></div>
                                        <div class="stat-heading">Total Branches</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="card" style="height: 113px">
                        <div class="card-body">
                            <div class="stat-widget-five">
                                <div class="stat-icon dib text-danger">
                                    <i class="pe-7s-cash"></i>
                                </div>
                                <div class="stat-content">
                                    <div class="text-left dib">
                                        <div class="stat-text"><span class="count">{{getBills()}}</span></div>
                                        <div class="stat-heading">Total Due (All Branches)</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card" style="height: 113px">
                        <div class="card-body">
                            <div class="stat-widget-five">
                                <div class="stat-icon dib text-info">
                                    <i class="fa fa-book"></i>
                                </div>
                                <div class="stat-content">
                                    <div class="text-left dib">
                                        <div class="stat-text"><span class="count">{{count($courses)}}</span></div>
                                        <div class="stat-heading">Total Courses</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Orders -->
        <div class="orders">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="box-title">Recently Added Course </h4>
                        </div>
                        <div class="card-body">
                            <table class="table ">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Course Name</th>
                                    <th>Course Fee</th>
                                    <th>Duration</th>
                                    <th>Total Lectures</th>
                                    <th>Status</th>
{{--                                    <th>Action</th>--}}
                                </tr>
                                </thead>
                                <tbody>
                                @php $i=1; @endphp
                                @foreach($courses as $item)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$item->course_name}}</span></td>
                                        <td>{{$item->course_fee}}</td>
                                        <td>{{$item->course_duration}}</td>
                                        <td>{{$item->total_lectures}}</td>

                                        <td class="text-center">
                                            <div class="mb-2">
                                        <span class="{{$item->course_status_id == 1 ? 'bg-success':'bg-danger'}} p-2 text-white" style="border-radius:5px">
                                    {{$item->course_status_id == 1 ? 'Active':'Inactive'}}</span>
                                            </div>
                                        </td>

{{--                                        <td class="btn-group">--}}
{{--                                            <a href="{{route('admin.course.edit', ['id'=>$item->id])}}" class="btn btn-primary"><i class="fa fa-pencil"></i></a>--}}
{{--                                            <form action="{{route('admin.course.remove')}}" onclick="return confirm('Please Confirm Before Deleting it!!')" method="post">--}}
{{--                                                @csrf--}}
{{--                                                <input type="hidden" name="id" value="{{$item->id}}">--}}
{{--                                                <button type="submit" class="btn btn-danger" style="margin-left: 5px"><i class="fa fa-trash"></i></button>--}}
{{--                                            </form>--}}

{{--                                        </td>--}}
                                    </tr>
                                    @if($i == 6)
                                        @break
                                    @endif
                                @endforeach

                                </tbody>
                            </table> <!-- /.table-stats -->
                        </div>
                    </div> <!-- /.card -->
                </div>  <!-- /.col-lg-8 -->
 <!-- /.col-md-4 -->
            </div>
        </div>
        <!-- /.orders -->

        <!-- Calender Chart Weather  -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <!-- <h4 class="box-title">Chandler</h4> -->
                        <div class="calender-cont widget-calender">
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div><!-- /.card -->
            </div>
        </div>
        <!-- /Calender Chart Weather -->
        <!-- Modal - Calendar - Add New Event -->
        <div class="modal fade none-border" id="event-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title"><strong>Add New Event</strong></h4>
                    </div>
                    <div class="modal-body"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success save-event waves-effect waves-light">Create event</button>
                        <button type="button" class="btn btn-danger delete-event waves-effect waves-light" data-dismiss="modal">Delete</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /#event-modal -->
        <!-- Modal - Calendar - Add Category -->
        <div class="modal fade none-border" id="add-category">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title"><strong>Add a category </strong></h4>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="control-label">Category Name</label>
                                    <input class="form-control form-white" placeholder="Enter name" type="text" name="category-name"/>
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label">Choose Category Color</label>
                                    <select class="form-control form-white" data-placeholder="Choose a color..." name="category-color">
                                        <option value="success">Success</option>
                                        <option value="danger">Danger</option>
                                        <option value="info">Info</option>
                                        <option value="pink">Pink</option>
                                        <option value="primary">Primary</option>
                                        <option value="warning">Warning</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger waves-effect waves-light save-category" data-dismiss="modal">Save</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /#add-category -->
    </div>
@endsection
