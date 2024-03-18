@extends('admin.master')
@section('title')
    View Billing Summary
@endsection
@section('content')
    @php
        $year = date('Y');
//        $i = 1;
        $totalBill = 0;
        $student = 0;
//        if (isset($_GET['year']) && $_GET['year']>0){
//            $sortingYear = $_GET['year'];
//        }
//        else{
//            $sortingYear=null;
//        }
    @endphp
    <div class="row mt-1">
        <dv class="col-md-12">
            <div class="card card-body">
                <dib class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header"><h3><strong>Payment Summary of {{$year}}</strong></h3></div>
                            <div class="card-body">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><b>Total Students: </b>{{count(getStudents($year))}}</li>
                                    <li class="list-group-item"><b>Total Bill: </b>{{getBills($year)}} TK</li>
                                    <li class="list-group-item"><b>Total Paid: </b><span class="text-success">{{getPayments($year)}} TK</span></li>
                                    <li class="list-group-item"><b>Total Due: </b><span class="text-danger">{{getBills($year)-getPayments($year)}} TK</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header"><h3><strong>Summary At a Glance (All)</strong></h3></div>
                            <div class="card-body">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><b>Total Students: </b>{{count(getStudents())}}</li>
                                    <li class="list-group-item"><b>Total Bill: </b>{{getBills()}} TK</li>
                                    <li class="list-group-item"><b>Total Paid: </b><span class="text-success">{{getPayments()}} TK</span></li>
                                    <li class="list-group-item"><b>Total Due: </b><span class="text-danger">{{getBills()-getPayments($year)}} TK</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </dib>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h3><strong>Bill Summary By Sessions</strong></h3>
                                    </div>
                                    <div class="col-md-4">
                                        <form action="" id="filterForm">
                                            <div class="form-group">
                                                <label class="form-control-label">Sort By Year</label>
                                                <div class="btn-group">
                                                    <select
                                                        name="year" id="" onchange="filter()" class="form-control" style="width: 100px">
                                                        <option value="">All</option>
                                                        @for($i=2018; $i<=date('Y'); $i++)
                                                            <option value="{{$i}}" @isset($_GET['year']) {{$i== $_GET['year'] ? 'selected':''}}@endisset>{{$i}}</option>
                                                        @endfor
                                                    </select>
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
                                        <th>Session Name</th>
                                        <th>Admission Fee</th>
                                        <th>Number of Student</th>
                                        <th>Total Bill</th>
                                    </tr>
                                    @php $j=1; @endphp
                                    @foreach($sessionsAccount as $session)
                                        <tr>
                                            <th>{{$j++}}</th>
                                            <td>{{$session->session->session_name}}</td>
                                            <td>{{$session->session->admission_fee}} TK/s</td>
{{--                                            <td>{{count(getStudentsBySessionId($session->session_id, 2022))}}</td>--}}
{{--                                            <td>{{$fee = getBillBySessionId($session->session_id, 2022)}} TK</td>--}}
                                            <td>{{$session->student}}</td>
                                            <td>{{$fee = $session->amount}}</td>
                                        </tr>
                                        @php
                                            $totalBill += $fee;
                                            $student += $session->student;
                                        @endphp
                                    @endforeach
                                    <tr>
                                        <td colspan="5" class="text-right"><b>Total Bill: </b>{{$totalBill}} TK</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </dv>
    </div>
@endsection
