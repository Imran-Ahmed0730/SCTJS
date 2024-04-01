@extends('admin.master')
@section('title')
    Student List
@endsection
@section('content')
    @php
    $column='col-sm-2';
    @endphp
    <div class="row mt-5 ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-center text-success">{{session('message')}}</h4>
                    <h3 class="text-center"><strong>View Students</strong>
                        @if(Auth::user()->role == 2)
                        <a href="{{route('student.add')}}" class="float-right btn btn-primary">Add Student</a>
                        @endif
                    </h3>
                    <hr>
                    <form id="filterForm">
                        <div class="row">
                            <div class="form-group col-sm-2">
                                <label for="" class="form-control-label">Student Roll</label>
                                <input name="student_roll" id="student_roll" placeholder="Enter Student Roll" onkeyup="filter()" type="text" class="form-control" value="@isset($_GET['student_roll']){{$_GET['student_roll']}}@endisset">
                            </div>
                            @if(Auth::user()->role == 1)
                                <div class="form-group {{$column}}">
                                    <label for="" class="form-control-label">Branch</label>
                                    <select name="branch_id" id="branch_id" onchange="filter()" class="form-control">
                                        <option value="">All</option>
                                        @foreach($branches as $branch)
                                            <option value="{{$branch->id}}" @isset($_GET['branch_id']) @if($branch->id == $_GET['branch_id']) selected @endif @endisset>{{$branch->branch_code}} ({{$branch->branch_name}})</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif
                            <div class="form-group col-sm-3">
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
                            <div class="form-group col-sm-3">
                                <label for="" class="form-control-label">Course</label>
                                <select name="course_id" id="course_id" onchange="filter()" class="form-control">
                                    <option value="">All</option>
                                    @foreach($courses as $course)
                                        <option value="{{$course->id}}" @isset($_GET['course_id']) @if($course->id == $_GET['course_id']) selected @endif @endisset>{{$course->course_name}}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>

                    </form>
                </div>
                <div class="card-body">
                    <div class="">
                        <table id="filter_table" class="table table-striped">
                            <thead>
                                <tr>
                                <th>#</th>
                                <th>Name<br><span class="second-line">Date of Birth</span></th>
                                <th>Father's Name<br><span class="second-line">Mother's Name</span></th>
                                <th>Roll No<br><span class="second-line">Registration No</span></th>
                                <th>Phone</th>
                                <th>Course Name</th>
                                @if(Auth::user()->role == 1)
                                    <th>Branch Name</th>
                                @endif
                                <th>Image</th>
                                <th>Join Date</th>
                                @if(Auth::user()->role == 2)
                                    <th>Action</th>
                                @endif
{{--                                <th>Download</th>--}}
                            </tr>
                            </thead>
                            @php $i=1; @endphp
                            <tbody>
                                @foreach($items as $item)
                                <tr>
                                    <td>{{$i++}}</td>
                                    @php
                                        $course = getCourseById($item->course_id);
                                        $branch = getBranchById($item->branch_id);
                                        $student = getStudentById($item->student_id)
                                    @endphp
                                    @if($student)
                                        <td>{{$item->student->student_name}}<br><span>{{$item->student->student_dob}}</span></td>
                                        <td>{{$item->student->father_name}}<br><span>{{$item->student->mother_name}}</span></td>
                                        <td>{{$item->student_roll}} <br><span>{{$item->student_registration}}</span></td>
                                        <td>{{$item->student->student_phone}}</td>

                                        <td>
                                            @if($course)
                                                {{$course->course_name}}
                                            @endif
                                        </td>
                                        @if(Auth::user()->role == 1)
                                            <td>
                                                @if($branch)
                                                    {{$branch->branch_name}}
                                                @endif
                                            </td>
                                        @endif
                                        <td><img src="{{asset($item->student->student_image)}}" alt=""></td>
                                        <td>{{$item->join_date}}</td>
                                    @else
                                        <td></td>
                                        <td></td>
                                        <td>{{$item->student_roll}} <br><span>{{$item->student_registration}}</span></td>
                                        <td></td>
                                        <td>
                                            @if($course)
                                                {{$course->course_name}}
                                            @endif
                                        </td>
                                        @if(Auth::user()->role == 1)
                                            <td>
                                                @if($branch)
                                                    {{$branch->branch_name}}
                                                @endif
                                            </td>
                                        @endif
                                        <td></td>
                                        <td>{{$item->join_date}}</td>
                                    @endif
                                    @if(Auth::user()->role ==2)
                                        <td class="">
                                            <a href="{{route('student.edit', ['id'=>$item->id])}}" title="Edit" class="btn btn-primary"><i class="fa fa-pencil"></i></a>

                                        </td>
                                    @endif

                                    <td class="btn-group">
{{--                                        @if(Auth::user()->role ==2 )<a href="{{route('student.registration.print', ['id'=>$item->id])}}" class="btn btn-info" style="border-radius: 4px;" title="Download Registration Card"><i class="fa fa-id-card" aria-hidden="true"></i></a>@endif--}}
{{--                                       // @if(Auth::user()->role ==2 )<a href="{{route('student.id.print', ['id'=>$item->id])}}" class="btn btn-primary mx-2" style="border-radius: 4px;" title="Download ID Card"><i class="fa fa-id-badge" aria-hidden="true"></i></a>@endif--}}
{{--                                        //@if(Auth::user()->role ==2  && getSettings('admit_card_printing_status') == 1)<a href="{{route('student.admit.print', ['id'=>$item->id])}}" class="btn btn-warning" style="border-radius: 4px;" title="Download Admit Card"><i class="fa fa-ticket" aria-hidden="true"></i></a>@endif--}}
                                        @if(Auth::user()->role ==1 )
                                                <form action="{{route('student.remove')}}" onclick="return confirm('Please Confirm Before Deleting it!!')" method="post">
                                                    @csrf
                                                    <input type="hidden" name="id" id="'student_id'.{{$i}}" value="{{$item->id}}">
                                                    <button type="submit" class="btn btn-danger" title="Remove" style="margin-top: 5px"><i class="fa fa-trash"></i></button>
                                                </form>
{{--                                            <a href="" onclick="test({{$item->id}})" class="btn btn-success mx-2" style="border-radius: 4px; margin-top: 5px" title="Download Certificate"><i class="fa fa-file"></i></a>--}}
                                        @endif
                                    </td>


                                </tr>

                            @endforeach
                            </tbody>
                        </table>
                        {{$items->links('pagination::bootstrap-5')}}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        function filter(){
            jQuery('#filterForm').submit()
        }
        function test(id){
            url = '{{route('admin.student.certificate.print',":id")}}'
            url = url.replace(':id', id);
            var test_window = window.open(url);
            test_window.onload = function() {
                // Trigger the print functionality for the new window
                test_window.print();
            }
            // Open a new window or tab with the URL of the page you want to print
        }
    </script>
@endpush
