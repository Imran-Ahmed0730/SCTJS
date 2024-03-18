@extends('admin.master')
@section('title')
    Notice List
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-center text-success">{{session('message')}}</h4>
                    <h3 class="text-center"><strong>View Notices</strong></h3>
                    @if(Auth::user()->role == 1)
                        <a href="{{route('admin.notice.add')}}" class="float-right btn btn-primary">Add Notice</a>
                    @endif
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Details</th>
                            <th>Date</th>
                            @if(Auth::user()->role == 1)
                                <th>Status</th>
                                <th>Action</th>
                            @endif
                        </tr>
                        @php $i=1; @endphp
                        @foreach($items as $item)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$item->notice_title}}</td>
                                <td>{{$item->notice_description}}</td>
                                <td width="150px">{{$item->notice_date}}<br><span>{{$item->notice_time}}</span></td>
                                @if(Auth::user()->role == 1)
{{--                                    <td><span class="{{$item->notice_status_id == 1 ? 'text-success' : 'text-danger'}}"></span>{{$item->notice_status_id == 1 ? 'Active':'Inactive'}}</td>--}}
                                    <td class="text-center">
                                        <div class="">
                                        <span class="{{$item->notice_status_id == 1 ? 'bg-success':'bg-danger'}} p-2 text-white" style="border-radius:5px">
                                    {{$item->notice_status_id == 1 ? 'Circulated':'Not Circulated'}}</span>
                                        </div>
                                    </td>
                                    <td class="btn-group">
                                        <a href="{{route('admin.notice.edit', ['id'=>$item->id])}}" title="Edit" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                                        <form action="{{route('admin.notice.remove')}}" onclick="return confirm('Please Confirm Before Deleting it!!')" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$item->id}}">
                                            <button type="submit" title="Remove" class="btn btn-danger" style="margin-left: 5px"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                        @endforeach

                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
