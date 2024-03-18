@extends('admin.master')
@section('title')
    @isset($item) Edit @else Add @endisset Slider Images
@endsection
@section('content')
    <div class="card">
        <div class="card-header text-center">
            <h2>@isset($item) Edit @else Add @endisset Slider Images</h2>
        </div>
        <div class="card-body">
            <form action="@isset($item){{route('admin.slider.update')}} @else {{route('admin.slider.submit')}} @endisset" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="@isset($item){{$item->id}} @endisset">
                <div class="row mb-3">
                    <div class="col-md-12 form-group"><label for="" class="form-control-label">Title
                            <span class="text-danger">*</span></label>
                        <input type="text" name="title" value="@isset($item){{$item->title}} @else {{old('title')}} @endisset"
                               class="form-control @error('title') is-invalid @enderror" required>
                        @error('title')
                        <div class="invalid-feedback" role="alert">{{$message}}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-8 form-group"><label for="" class="form-control-label">Images
                            <span class="text-danger">*</span></label>
                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*" @isset($item) @else required @endisset>
                        @error('image')
                        <div class="invalid-feedback" role="alert">{{$message}}</div>
                        @enderror
                        @isset($item)
                            <div class="mt-2">
                                <img src="{{asset($item->image)}}" height="250px" width="250px" class="mx-2" alt="">
                            </div>
                        @endisset
                    </div>
                    <div class="form-group col-md-4">
                        <label for="" class="form-control-label">Slider Status</label>
                        <div class="form-check">
                            <input class="form-check-input" value="1" type="radio" name="status" id="flexRadioDefault1" @isset($item){{$item->status == 1 ? 'checked':''}}@endisset>
                            <label class="form-check-label" for="flexRadioDefault1">
                                Active
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" value="0" type="radio" name="status" id="flexRadioDefault2" checked>
                            <label class="form-check-label" for="flexRadioDefault2">
                                Inactive
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12 form-group">
                        <button class="form-control btn btn-primary" type="submit">@isset($item) Update @else Add @endisset Slider Images</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
