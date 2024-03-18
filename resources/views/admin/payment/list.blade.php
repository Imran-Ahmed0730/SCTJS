@extends('admin.master')
@section('title')
    Payment List
@endsection
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-center text-success">{{session('message')}}</h4>
                    <h3 class="text-center"><strong>View Payments</strong>
                        <a href="{{route('admin.branch.payment.add')}}" class="float-right btn btn-primary">Add Payment</a>
                    </h3>
                    <hr>
                    <form id="filterForm">
                        <div class="row">
                            <div class="form-group col-sm-3">
                                <label for="" class="form-control-label">Branch</label>
                                <select name="branch_id" onchange="filter()" id="branch_id" class="form-control">
                                    <option value="">All</option>
                                    @foreach($branches as $branch)
                                        <option value="{{$branch->id}}" @isset($_GET['branch_id']) @if($branch->id == $_GET['branch_id']) selected @endif @endisset>{{$branch->branch_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="" class="form-control-label">Month</label>
                                <select name="month" onchange="filter()" id="" class="form-control">
                                    <option value="">All</option>
                                    @for($i=1; $i<=12; $i++)
                                    <option value="{{$i}}" @isset($_GET['month']) @if($i == $_GET['month']) selected @endif @endisset>{{$months[$i-1]}}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="form-group col-sm-2">
                                <label for="" class="form-control-label">Year</label>
                                <select name="year" onchange="filter()" id="year" class="form-control">
                                    <option value="">All</option>
                                    @for($i=2018; $i<=date('Y'); $i++)
                                        <option value="{{$i}}" @isset($_GET['year']) @if($i == $_GET['year']) selected @endif @endisset>{{$i}}</option>
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
                            <th>Branch Name</th>
                            <th>Branch Code</th>
                            <th>Payment Amount</th>
                            <th>Payment Date</th>
                            <th>Action</th>
                        </tr>
                        @php $i=1; @endphp
                        @foreach($items as $item)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$item->branch->branch_name ?? ''}}</td>
                                <td>{{$item->branch->branch_code ?? ''}}</td>
                                <td>{{$item->payment}}</td>
                                <td>{{$item->bill_date}}</td>

                                <td class="btn-group">
                                    <a href="{{route('admin.branch.payment.edit', ['id'=>$item->id])}}" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                                </td>
                            </tr>
                        @endforeach

                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
