@extends('admin.master')
@section('title')
    Payment List
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center"><strong>View Branch Payments</strong></h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th>#</th>
                            <th>Payment Amount</th>
                            <th>Payment Date</th>
                        </tr>
                        @php $i=1; $totalPayment=0; @endphp
                        @foreach($items as $item)
                            @if($item->payment != 0)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$item->payment}} TK</td>
                                    <td>{{$item->bill_date}}</td>
                                    @php $totalPayment+=$item->amount; @endphp
                                </tr>
                            @endif
                        @endforeach
                        <tr>
                            <td colspan="2"><strong>Total Payment: </strong></td>
                            <td>{{$totalPayment}} TK</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center"><strong>Student Payable Amount</strong></h3>
                    <hr>
                    <form action="" id="filterForm">
                        <div class="row">
                            <div class="form-group col-md-3"><label for="" class="form-control-label">Student Roll</label>
                                <input type="number" name="student_roll" placeholder="Enter Roll" onchange="filter()" class="form-control" value="@isset($_GET['student_roll']){{$_GET['student_roll']}}@endisset">
                            </div>
                            <div class="form-group col-md-3"><label for="" class="form-control-label">Year</label>
                                <select name="year" id="" onchange="filter()" class="form-control">
                                    <option value="">All</option>
                                    @for($i=2018; $i<=date('Y'); $i++))
                                    <option value="{{$i}}" @isset($_GET['year']){{$_GET['year'] == $i ? 'selected':''}}@endisset>{{$i}}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="form-group col-md-3"><label for="" class="form-control-label">Month</label>
                                <select name="month" id="" onchange="filter()" class="form-control">
                                    <option value="">All</option>
                                    @for($i=1; $i<=12; $i++)
                                        <option value="{{$i}}" @isset($_GET['month']){{$_GET['month'] == $i ? 'selected':''}}@endisset>{{$months[$i-1]}}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th>#</th>
                            <th>Student Name</th>
                            <th>Roll Number</th>
                            <th>Payable Amount</th>
                            <th>Issuing Date</th>
                        </tr>
                        @php $i=1; $totalPayment=0; @endphp
                        @foreach($items as $item)
                            @php
                                $student = getStudentById($item->student_id);
                                $branchStudent = getBranchStudentById($item->branch_student_id)
                            @endphp
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$student != null ? $student->student_name:''}}</td>
                                <td>{{$branchStudent != null ? $branchStudent->student_roll:''}}</td>
                                <td>{{$item->amount}} TK</td>
                                <td>{{$item->bill_date}}</td>
                                @php $totalPayment+=$item->amount; @endphp
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="3"><strong>Total Payment: </strong></td>
                            <td>{{$totalPayment}} TK</td>
                            <td></td>
                        </tr>
                    </table>
                    {{$items->links('pagination::bootstrap-5')}}
                </div>
            </div>
        </div>
    </div>
@endsection
