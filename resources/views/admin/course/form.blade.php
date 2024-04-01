@extends('admin.master')
@section('title')
    @isset($item)Edit @else Add @endisset Course
@endsection
@section('content')
    <div class="card">
        <div class="card-header text-center">
            <h2><strong> @isset($item)Edit @else Add @endisset Course Form</strong></h2>
        </div>
        <div class="card-body card-block">
            <form action="@isset($item){{route('admin.course.update')}}@else{{route('admin.course.submit')}}@endisset" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="@isset($item){{$item->id}}@endisset">
                <div class="row mb-3">
                    <div class="form-group col-md-6"><label for="company" class=" form-control-label">Course Name
                        <span class="text-danger">*</span></label>
                        <input type="text" name="course_name" id="company" class="form-control @error('course_name') is-invalid @enderror"
                               value="@isset($item){{$item->course_name}}@else{{old('course_name')}}@endisset" required>
                        @error('course_name')
                        <div class="invalid-feedback" role="alert">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-6"><label for="company" class=" form-control-label">Course Certificate Name</label>
                        <input type="text" id="company" name="crt_course_name"
                               class="form-control" value="@isset($item){{$item->crt_course_name}}@else{{old('crt_course_name')}}@endisset">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="form-group col-md-4"><label for="company" class=" form-control-label">Course Image
                            <span class="text-danger">*</span></label>
                        <input type="file" name="image" id="company" class="form-control @error('image') is-invalid @enderror"
                               @isset($item) @else required @endisset>
                        @isset($item)
                            @if($item->image != null)
                                <img src="{{asset($item->image)}}" height="100px" width="100px" alt="">
                            @endif
                        @endisset
                        @error('image')
                        <div class="invalid-feedback" role="alert">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-4"><label for="company" class=" form-control-label">Course Code
                            <span class="text-danger">*</span></label>
                        <input type="text" name="course_code" id="company" class="form-control @error('course_code') is-invalid @enderror"
                               value="@isset($item){{$item->course_code}}@else{{old('course_code')}}@endisset" required>
                        @error('course_code')
                        <div class="invalid-feedback" role="alert">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-4"><label for="" class="form-control-label">Course Duration<span
                                class="text-danger">*</span></label>
                            <select name="course_duration" id="" class="form-control" required>
                                <option value="">Select Duration</option>
                                @for($i=1; $i<12; $i++)
                                    <option value="{{$i}} {{$i == 1 ? 'Month':'Months'}}"
                                            @isset($item)
                                                @if($item->course_duration == $i.' Month' or $item->course_duration == $i.' Months') selected @endif
                                            @endisset>
                                        {{$i}} {{$i == 1 ? 'Month':'Months'}}
                                    </option>
                                @endfor
                                @for($i=1; $i<5; $i++)
                                    <option value="{{$i}} {{$i == 1 ? 'Year':'Years'}}"
                                        @isset($item)
                                            @if($item->course_duration == $i.' Year' or $item->course_duration == $i.' Years') selected @endif
                                        @endisset>
                                    {{$i}} {{$i == 1 ? 'Year':'Years'}}</option>
                                @endfor
                            </select>
                        @error('course_duration')
                            <div class="invalid-feedback" role="alert">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="form-group col-md-3"><label for="vat" class=" form-control-label">Course Fee
                            <span class="text-danger">*</span></label>
                        <input type="number" id="company" name="course_fee"
                               class="form-control @error('course_fee') is-invalid @enderror"
                               value="@isset($item){{$item->course_fee}}@else{{old('course_fee')}}@endisset" required>
                        @error('course_fee')
                        <div class="invalid-feedback" role="alert">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-3"><label for="vat" class=" form-control-label">Discount</label>
                        <input type="number" id="company" name="discount"
                               class="form-control" value="@isset($item){{$item->discount}}@else{{old('discount')}}@endisset">
                    </div>
                    <div class="form-group col-md-3"><label for="vat" class=" form-control-label">Total Lectures
                            <span class="text-danger">*</span></label>
                        <input type="number" id="company" name="total_lectures"
                               class="form-control @error('total_lectures') is-invalid @enderror"
                               value="@isset($item){{$item->total_lectures}}@else{{old('total_lectures')}}@endisset" required>
                        @error('total_lectures')
                        <div class="invalid-feedback" role="alert">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-3"><label for="vat" class=" form-control-label">Start Date
                            <span class="text-danger">*</span></label>
                        <input type="date" id="company" name="start_date"
                               class="form-control @error('start_date') is-invalid @enderror"
                               value="@isset($item){{date('Y-m-d', strtotime($item->start_date))}}@else{{old('start_date')}}@endisset" required>
                        @error('start_date')
                        <div class="invalid-feedback" role="alert">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="form-group col-md-12"><label for="" class="form-control-label">Course Description</label>
                        <textarea name="course_description" id="" cols="30" rows="10" class="form-control">
                        @isset($item){{$item->course_description}}@else{{old('course_description')}}@endisset
                    </textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="form-group col-md-3"><label for="" class="form-control-label">Course Type
                            <span class="text-danger">*</span></label>
                        <select name="course_type" id="" class="form-control" required>
                            <option value="" selected>Select Course Type</option>
                            <option value="online" @isset($item){{$item->course_type == 'online' ? 'selected': ''}}@endisset>Online</option>
                            <option value="offline" @isset($item){{$item->course_type == 'offline' ? 'selected': ''}}@endisset>Offline</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3"><label for="" class="form-control-label">Course Medium</label>
                        <select name="course_medium_id" id="course" class="form-control">
                            <option value="" >Select Course Type</option>
                            <option value="1" selected>Bangla</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3"><label for="" class="form-control-label">Add Course Module</label><i
                            class="fa fa-plus text-success mx-2" id="addSubjectBtn"></i>
                        @isset($item)
                            @foreach($modules as $module)
                                <div class="form-check"><input type="checkbox" class="form-check-input" name="modules[]" id=""
                                                               {{$module->course_id == $item->id ? 'checked':''}}
                                                               value="{{$module->module_name}}">
                                    <label for="" class="form-check-label">{{$module->module_name}}</label>
                                </div>
                            @endforeach
                        @endisset
                        <div id="subject-container"></div>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="" class="form-control-label">Course Status</label>
                        <div class="form-check">
                            <input class="form-check-input" value="1" type="radio" name="course_status_id" id="flexRadioDefault1" checked>
                            <label class="form-check-label" for="flexRadioDefault1">
                                Active
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" value="0" type="radio" name="course_status_id" id="flexRadioDefault2" @isset($item){{$item->course_status_id == 0 ? 'checked':''}}@endisset>
                            <label class="form-check-label" for="flexRadioDefault2">
                                Inactive
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="form-group col-md-12">
                        <label for="" class="form-control-label"></label>
                        <button type="submit" class="btn btn-primary form-control">@isset($item)Update @else Add @endisset Branch Information</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('script')
    <script>
        jQuery(document).ready(function(){
           var counter=0;

           jQuery('#addSubjectBtn').click(function(){
               counter ++;
               const inputField = jQuery('<input>').attr({
                   type:'text',
                   name: 'modules[]',
                   class: 'form-control mb-2',
                   placeholder: 'Enter Module Name'
               });

               jQuery('#subject-container').append(inputField);
            });
        });
    </script>
@endpush
