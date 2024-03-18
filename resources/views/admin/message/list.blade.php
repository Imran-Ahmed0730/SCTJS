@extends('admin.master')
@section('title')
    Message List
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-center text-success">{{session('message')}}</h4>
                    <h3 class="text-center"><strong>View Messages</strong></h3>
                    @if(Auth::user()->role == 1)
                        <a href="{{route('admin.message.add')}}" class="float-right btn btn-primary">Send Message</a>
                    @endif
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th>#</th>
                            <th>Branch Name</th>
                            <th>Message</th>
                            <th>Date</th>
                            <th>Action</th>

                        </tr>
                        @php $i=1; @endphp
                        @foreach($items as $item)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>@if($item->branch){{$item->branch->branch_name}} @endif</td>
                                <td>{{$item->message}}</td>
                                <td width="150px">{{$item->created_at}}</td>
                                <td class="btn-group">
                                    <a href="{{route('admin.message.edit', ['id'=>$item->id])}}" title="Edit" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                                </td>

                            </tr>
                        @endforeach

                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
