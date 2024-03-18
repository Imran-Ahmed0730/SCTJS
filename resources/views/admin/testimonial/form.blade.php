@extends('admin.master')
@section('title')
    @isset($item) Edit @else Add @endisset Gallery Images
@endsection
@section('content')
    <div class="row mt-1">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center">
                    <h2>@isset($item) Edit @else Add @endisset Gallery Images</h2>
                </div>
                <div class="card-body">
                    <form action="@isset($item){{route('admin.gallery.update')}} @else {{route('admin.gallery.submit')}} @endisset" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="@isset($item){{$item->id}} @endisset">
                        <div class="row mb-3">
                            <div class="col-md-12 form-group"><label for="" class="form-control-label">Title
                                    <span class="text-danger">*</span></label>
                                <input type="text" name="title" value="@isset($item){{$item->title}} @else {{old('title')}} @endisset"
                                       class="form-control @error('title') is-invalid @enderror">
                                @error('title')
                                    <div class="invalid-feedback" role="alert">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12 form-group"><label for="" class="form-control-label">Description</label>
                                <textarea rows="3" name="description" cols="10" class="form-control">
                                    @if(isset($item)){{$item->description}} @else {{old('description')}} @endif
                                </textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12 form-group"><label for="" class="form-control-label">Images
                                <span class="text-danger">*</span></label>
                                <input type="file" name="image[]" class="form-control @error('image') is-invalid @enderror" accept="image/*" multiple required>
                                @error('image')
                                    <div class="invalid-feedback" role="alert">{{$message}}</div>
                                @enderror
                                @isset($item)
                                    <div class="mt-2">
                                        @foreach($item->galleryImage as $image)
                                            <img src="{{asset($image->image_path)}}" height="150px" width="150px" class="mx-2" alt="">
                                        @endforeach
                                    </div>
                                @endisset
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12 form-group">
                                <button class="form-control btn btn-primary" type="submit">@isset($item) Update @else Add @endisset Images</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
