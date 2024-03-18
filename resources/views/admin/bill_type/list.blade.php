@extends('admin.master')
@section('title')
    Bill Type List
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-center text-success">{{session('message')}}</h4>
                    <h3 class="text-center"><strong>View Bill Types</strong></h3>
                    @if(Auth::user()->role == 1)
                        <a href="{{route('admin.bills.type.add')}}" class="float-right btn btn-primary">Add Bill Types</a>
                    @endif
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Amount</th>
                            <th>Action</th>
                        </tr>
                        @php $i=1; @endphp
                        @foreach($items as $item)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$item->bill_type_name}}</td>
                                <td>{{$item->bill_amount}}</td>
                                <td class="btn-group">
                                    <a href="{{route('admin.bills.type.edit', ['id'=>$item->id])}}" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                                    <form action="{{route('admin.bills.type.remove')}}" onclick="return confirm('Please Confirm Before Deleting it!!')" method="post">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$item->id}}">
                                        <button type="submit" class="btn btn-danger" style="margin-left: 5px"><i class="fa fa-trash"></i></button>
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
