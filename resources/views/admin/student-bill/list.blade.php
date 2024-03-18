@extends('admin.master')
@section('title')
    Student Bills
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-center text-success">{{session('message')}}</h4>
                    <h3 class="text-center"><strong>View Student Bills</strong>
                        <a href="{{route('student.bill.add')}}" class="float-right btn btn-primary">Add bill</a></h3>
                    <hr>
                    <form action="" id="filterForm">
                        <div class="row">
                            <div class="form-group col-md-4"><label for="" class="form-control-label">Student Roll No</label>
                                <input type="number" placeholder="Enter Roll" name="student_roll" onchange="filter()" class="form-control" value="@isset($_GET['student_roll']){{$_GET['student_roll']}}@endisset">
                            </div>
                            <div class="form-group col-md-4"><label for="" class="form-control-label">Join Year</label>
                                <select name="year" id="year" onchange="filter()" class="form-control">
                                    <option value="">All</option>
                                    @for($i=2018; $i<=date('Y'); $i++))
                                        <option value="{{$i}}" @isset($_GET['year']){{$_GET['year'] == $i ? 'selected':''}}@endisset>{{$i}}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="form-group col-md-4"><label for="" class="form-control-label">Join Month</label>
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
                            <th>Roll No</th>
                            <th>Bill Amount</th>
                            <th>Paid</th>
                            <th>Due</th>
                        </tr>
                        @php $i=1; @endphp
                        @foreach($items as $item)
                            @php $student = getStudentById($item->student_id);
                            $branchStudent = getBranchStudentByStudentId($item->student_id);
                            @endphp
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$student != null ? $student->student_name:''}}</td>
                                <td>{{$branchStudent != null ? $branchStudent->student_roll: ''}}</td>
                                <td>{{$item->total_fee}}</td>
                                <td>{{$item->total_paid}}</td>
                                <td>{{$item->due}}</td>

                            </tr>
                        @endforeach

                    </table>
                    {{$items->links('pagination::bootstrap-5')}}
                </div>
            </div>
        </div>
    </div>
@endsection
