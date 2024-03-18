@extends('admin.master')
@section('title')
    Gallery Images
@endsection
@section('content')
    <div class="row mt-1">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center">
                    <h3 class="text-success">{{session('message')}}</h3>
                    <h2>Gallery Images</h2>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Profession</th>
                            <th>Images</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        @php $i=1; @endphp
                        @foreach($items as $item)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$item->name}}</td>
                                <td>
                                    {{$item->profession}}
                                </td>
                                <td>
                                    @if($item->image != null)
                                        <img src="{{asset($item->image)}}" class="rounded-circle" height="50px" width="50px" alt="">
                                    @else
                                        <img src="{{asset('admin-assets')}}/images/default.jpg" class="rounded-circle" height="50px" width="50px" alt="">
                                    @endif

                                </td>
                                <td>{{$item->description}}</td>
                                <td>
                                    <div class="mt-2">
                                        <span class="{{$item->status == 1 ? 'bg-success':'bg-danger'}} p-2 text-white" style="border-radius:5px">
                                    {{$item->status == 1 ? 'Active':'Inactive'}}</span>
                                    </div>
                                </td>
                                <td class="btn-group">
                                    <a href="{{route('admin.testimonial.edit', ['id'=>$item->id])}}" title="Edit" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                                    <form action="{{route('admin.testimonial.remove')}}" onclick="return confirm('Please Confirm Before Deleting it!!')" method="post">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$item->id}}">
                                        <button type="submit" title="Remove" class="btn btn-danger" style="margin-left: 5px"><i class="fa fa-trash"></i></button>
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
