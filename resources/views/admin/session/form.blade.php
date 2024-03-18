@extends('admin.master')
@section('title')
    @isset($item)Edit @else Add @endisset Session
@endsection
@section('content')
    <div class="card">
        <div class="card-header text-center">
            <h2><strong> @isset($item)Edit @else Add @endisset Session Form</strong></h2>
        </div>
        <div class="card-body card-block">
            <form action="@isset($item){{route('admin.session.update')}}@else{{route('admin.session.submit')}}@endisset" method="post">
                @csrf
                <input type="hidden" name="id" value="@isset($item){{$item->id}}@endisset">
                <div class="row mb-3">
                    <div class="form-group col-md-12"><label for="company" class=" form-control-label">Session Title
                            <span class="text-danger">*</span></label>
                        <input type="text" id="company" name="session_name"
                               class="form-control @error('session_name') is-invalid @enderror"
                               value="@isset($item){{$item->session_name}}@else{{old('session_name')}}@endisset" required>
                        @error('session_name')
                        <div class="invalid-feedback" role="alert">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="form-group col-md-4"><label for="" class="form-control-label">Session Start Day</label>
                        <select name="session_start_day" id="" class="form-control">
                            <option value="" selected>Select Day</option>
                            @for($i=1; $i<=31; $i++)
                                <option value="{{$i}}" @isset($item){{$item->session_start_day == $i ? 'selected': ''}}@endisset>{{$i}}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="form-group col-md-4"><label for="" class="form-control-label">Session Start Month
                            <span class="text-danger">*</span></label>
                        <select name="session_start_month" id="" class="form-control @error('session_start_month') is-invalid @enderror" required>
                            <option value="" selected>Select Month</option>
                            @for($i=1; $i<=12; $i++)
                                <option value="{{$i}}" @isset($item){{$item->session_start_month == $i ? 'selected': ''}}@endisset>{{$months[$i-1]}}</option>
                            @endfor
                        </select>
                        @error('session_start_month')
                        <div class="invalid-feedback" role="alert">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-4"><label for="" class="form-control-label">Session Start Year
                            <span class="text-danger">*</span></label>
                        <select name="session_start_year" id="" class="form-control @error('session_start_year') is-invalid @enderror">
                            <option value="" selected>Select Year</option>
                            @for($i=2020; $i<=2050; $i++)
                                <option value="{{$i}}" @isset($item){{$item->session_start_year == $i ? 'selected': ''}}@endisset>{{$i}}</option>
                            @endfor
                        </select>
                        @error('session_start_year')
                        <div class="invalid-feedback" role="alert">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="form-group col-md-4"><label for="" class="form-control-label">Session End Day</label>
                        <select name="session_end_day" id="" class="form-control">
                            <option value="" selected>Select Day</option>
                            @for($i=1; $i<=31; $i++)
                                <option value="{{$i}}" @isset($item){{$item->session_end_day == $i ? 'selected': ''}}@endisset>{{$i}}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="form-group col-md-4"><label for="" class="form-control-label">Session End Month
                            <span class="text-danger">*</span></label>
                        <select name="session_end_month" id="" class="form-control @error('session_end_month') is-invalid @enderror" required>
                            <option value="" selected>Select Month</option>
                            @for($i=1; $i<=12; $i++)
                                <option value="{{$i}}" @isset($item){{$item->session_end_month == $i ? 'selected': ''}}@endisset>{{$months[$i-1]}}</option>
                            @endfor
                        </select>
                        @error('session_end_month')
                        <div class="invalid-feedback" role="alert">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-4"><label for="" class="form-control-label">Session End Year
                            <span class="text-danger">*</span></label>
                        <select name="session_end_year" id="" class="form-control @error('session_end_year') is-invalid @enderror">
                            <option value="" selected>Select Year</option>
                            @for($i=2020; $i<=2050; $i++)
                                <option value="{{$i}}" @isset($item){{$item->session_end_year == $i ? 'selected': ''}}@endisset>{{$i}}</option>
                            @endfor
                        </select>
                        @error('session_end_year')
                        <div class="invalid-feedback" role="alert">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="form-group col-md-6"><label for="" class="form-control-label">Admission Fee
                        <span class="text-danger">*</span></label>
                        <input type="number" name="admission_fee" value="@isset($item){{$item->admission_fee}}@else{{old('admission_fee')}}@endisset"
                               class="form-control @error('admission_fee') is-invalid @enderror" required>
                        @error('admission_fee')
                            <div class="invalid-feedback" role="alert">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="" class="form-control-label">Session Status</label>
                        <div class="form-check">
                            <input class="form-check-input" value="1" type="radio" name="session_status_id" id="flexRadioDefault1" checked>
                            <label class="form-check-label" for="flexRadioDefault1">
                                Active
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" value="0" type="radio" name="session_status_id" id="flexRadioDefault2">
                            <label class="form-check-label" for="flexRadioDefault2">
                                Inactive
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="form-group col-md-12">
                        <label for="" class="form-control-label"></label>
                        <button type="submit" class="btn btn-primary form-control">@isset($item)Update @else Add @endisset Session Information</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
