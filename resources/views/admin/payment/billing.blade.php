@extends('admin.master')
@section('title')
    View Billings
@endsection
@section('content')
    @php
    if(isset($_GET['year']) && $_GET['year']>0){
        $sortingYear = $_GET['year'];
    }
    else{
        $sortingYear=null;
    }
    @endphp
    <div class="row mt-1">
        <div class="col-md-12 mx-2">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8">
                            <h2><strong>View Billings</strong></h2>
                        </div>
                        <div class="col-md-4">
                            <form action="" id="filterForm">
                                <div class="form-group">
                                    <label class="form-control-label">Sort By Year</label>
                                    <div class="btn-group">
                                        <select
                                            name="year" id="year" class="form-control" onchange="filter()" style="width: 100px">
                                            <option value="">All</option>
                                            @for($i=2018; $i<=date('Y'); $i++)
                                                <option value="{{$i}}" @isset($_GET['year']) {{$i== $_GET['year'] ? 'selected':''}}@endisset>{{$i}}</option>
                                            @endfor
                                        </select>
{{--                                        <button type="submit" class="btn btn-primary form-control">Filter</button>--}}
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>#</th>
                            <th>Branch Name</th>
                            <th>Total Students</th>
                            <th>Total Bill</th>
                            <th>Total Paid</th>
                            <th>Total Due</th>
                        </tr>
                        @php $i=1 @endphp
                        @foreach($items as $item)
                            @php
                                $students = count(getStudentsByBranchId($item->id, $sortingYear));
                                $bill = getBillsByBranchId($item->id, $sortingYear);
                                $payment = getPaymentByBranchId($item->id, $sortingYear);
                                $due = $bill - $payment;
                            @endphp
                            <tr>
                                <th>{{$i++}}</th>
                                <td>{{$item->branch_name}}</td>
                                <td>{{$students}}</td>
                                <td>{{$bill}} TK</td>
                                <td>{{$payment}} TK</td>
                                <td>{{$due}} TK</td>
                            </tr>
                        @endforeach
                    </table>
                    {{$items->links('pagination::bootstrap-5')}}
                </div>
            </div>
        </div>
    </div>
@endsection


