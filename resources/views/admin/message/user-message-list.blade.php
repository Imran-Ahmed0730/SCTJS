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
                            <th>Name</th>
                            <th>Email</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th>Date</th>

                        </tr>
                        @php $i=1; @endphp
                        @foreach($items as $item)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->email}}</td>
                                <td>{{$item->subject}}</td>
                                <td>{{$item->message}}</td>
                                <td width="150px">{{$item->created_at}}</td>
                            </tr>
                        @endforeach

                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
