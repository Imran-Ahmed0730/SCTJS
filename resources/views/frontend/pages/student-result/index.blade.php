@extends('frontend.master')
@section('title')
    Exam Results
@endsection
@section('content')
    <!-- Header Start -->
    <div class="container-fluid bg-primary py-5 mb-5 page-header">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <h1 class="display-3 text-white animated slideInDown">Exam Result</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a class="text-white" href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item text-light">/</li>
                            <li class="breadcrumb-item  text-light active" aria-current="page">Exam Result</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->
    <div class="container-xxl py-5">
        <div class="container">
        <div class="row mt-1">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3><strong>Student Exam Result</strong></h3>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="input-group">
                                <input type="number" id="" name="student_roll" placeholder="Enter Student Roll No" class="form-control">
                                <div class="input-group-btn"><button type="submit" class="btn btn-primary">Submit</button></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @isset($item)
            @php
                $student = getStudentById($item->student_id);
                $course = getCourseById($item->course_id);
            @endphp
            <div class="row mt-5">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header"><h3><strong>Student Information</strong></h3></div>
                        <div class="card-body">
                            <table class="table">
                                <tr>
                                    <th>Student Name</th>
                                    <td>
                                        @if($student){{$item->student->student_name}} @endif
                                    </td>
                                    <td rowspan="4" width="200px">
                                        <img src="{{asset($item->student->student_image ?? '')}}" alt="" align="right" height="200px" width="200px">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Roll No</th>
                                    <td colspan="">{{$item->student_roll}}</td>
                                </tr>
                                <tr>
                                    <th>Registration No</th>
                                    <td >{{$item->student_registration}}</td>
                                </tr>
                                <tr>
                                    <th>Course Code</th>
                                    <td colspan="2">
                                        @if($course){{$course->course_code}} @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Course Name</th>
                                    <td colspan="2">@if($course){{$course->course_name}} @endif</td>
                                </tr>
                                <tr>
                                    <th>Branch Name</th>
                                    <td colspan="2">{{$item->branch->branch_name}}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mt-5">
                    <div class="card">
                        <div class="card-header"><h3><strong>Result Information</strong></h3></div>
                        <div class="card-body">
                            <table class="table table-striped">
                                @if($item->result_marks != 0)
                                    <tr>
                                        <th>Result</th>
                                        <td>{{$item->result_marks}}</td>
                                    </tr>
                                    <tr>
                                        <th>Grade</th>
                                        <td>@if($item->resultGrade){{$item->resultGrade->result_grade_title}} @endif
                                        </td>
                                    </tr>
                                @else
                                    <tr><td>Not Published Yet</td></tr>
                                @endif

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </div>
    </div>
@endsection
