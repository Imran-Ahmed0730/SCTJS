@extends('admin.master')
@section('title')
    @isset($item) Edit @else Add @endisset Testimonial
@endsection
@section('content')
    <div class="row mt-1">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center">
                    <h2>@isset($item) Edit @else Add @endisset Testimonial</h2>
                </div>
                <div class="card-body">
                    <form action="@isset($item){{route('admin.testimonial.update')}} @else {{route('admin.testimonial.submit')}} @endisset" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="@isset($item){{$item->id}} @endisset">
                        <div class="row mb-3">
                            <div class="col-md-6 form-group"><label for="" class="form-control-label">Name
                                    <span class="text-danger">*</span></label>
                                <input type="text" name="name" value="@isset($item){{$item->name}} @else {{old('name')}} @endisset"
                                       class="form-control @error('name') is-invalid @enderror">
                                @error('name')
                                    <div class="invalid-feedback" role="alert">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group"><label for="" class="form-control-label">Select Profession</label><select
                                    name="profession" id="" class="form-control">
                                    <option value="Student" selected>Student</option>
                                    <option value="Teacher" @isset($item){{$item->profession == 'Teacher'? 'selected':''}}@endisset>Teacher</option>
                                    <option value="Branch Admin" @isset($item){{$item->profession == "Branch Admin"? 'selected':''}}@endisset>Branch Admin</option>
                                    <option value="User" @isset($item){{$item->profession == "User" ? 'selected':''}}@endisset>User</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6 form-group"><label for="" class="form-control-label">Image</label>
                                <input type="file" name="image" class="form-control" accept="image/*">
{{--                                @error('image')--}}
{{--                                    <div class="invalid-feedback" role="alert">{{$message}}</div>--}}
{{--                                @enderror--}}
                                @isset($item)
                                    <div class="mt-2">
                                        @if($item->image != null)
                                            <img src="{{asset($item->image)}}" height="150px" width="150px" class="mx-2" alt="">
                                        @else
                                            <img src="{{asset('admin-assets')}}/images/default.jpg" class="rounded-circle" height="150px" width="150px" alt="">
                                        @endif
                                    </div>
                                @endisset
                            </div>

                            <div class="form-group col-md-4">
                                <label for="" class="form-control-label">Status</label>
                                <div class="form-check">
                                    <input class="form-check-input" value="1" type="radio" name="status" id="flexRadioDefault1" checked>
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Active
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" value="0" type="radio" name="status" id="flexRadioDefault2" @isset($item){{$item->status == 0 ? 'checked':''}}@endisset>
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Inactive
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12 form-group"><label for="" class="form-control-label">Description <span class="text-danger">*</span></label>
                                <textarea rows="3" name="description" cols="10" class="form-control @error('description') in-invalid @enderror" required>
                                    @if(isset($item)){{$item->description}} @else {{old('description')}} @endif
                                </textarea>
                                @error('description')
                                <div class="invalid-feedback" role="alert">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12 form-group">
                                <button class="form-control btn btn-primary" type="submit">@isset($item) Update @else Add @endisset Testimonial</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
