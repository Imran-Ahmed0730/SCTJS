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
                            <th>Title</th>
                            <th>Description</th>
                            <th>Images</th>
                            <th>Action</th>
                        </tr>
                        @php $i=1; @endphp
                        @foreach($items as $item)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$item->title}}</td>
                                <td>{{$item->description}}</td>
                                <td>
                                    @foreach($item->galleryImage as $image)
                                        <img src="{{asset($image->image_path)}}" alt="" class="mx-2" height="100px" width="100px">
                                    @endforeach
                                </td>
                                <td class="btn-group">
                                    <a href="{{route('admin.gallery.edit', ['id'=>$item->id])}}" title="Edit" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                                    <form action="{{route('admin.gallery.remove')}}" onclick="return confirm('Please Confirm Before Deleting it!!')" method="post">
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
