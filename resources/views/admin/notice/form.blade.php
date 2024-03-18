@extends('admin.master')
@section('title')
    @isset($item)Edit @else Add @endisset Notice
@endsection
@section('content')
    <div class="card">
        <div class="card-header text-center">
            <h2><strong> @isset($item)Edit @else Add @endisset Notice Form</strong></h2>
        </div>
        <div class="card-body card-block">
            <form action="@isset($item){{route('admin.notice.update')}}@else{{route('admin.notice.submit')}}@endisset" method="post">
                @csrf
                <input type="hidden" name="id" value="@isset($item){{$item->id}}@endisset">
                <div class="row mb-3">
                    <div class="form-group col-md-6"><label for="company" class=" form-control-label">Notice Date</label>
                        <input type="text" name="notice_date" id="company" class="form-control"
                               value="@isset($item){{$item->notice_date}}@else{{date('d M, Y')}}@endisset" readonly>
                        @error('course_name')
                        <div class="invalid-feedback" role="alert">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-6"><label for="company" class=" form-control-label">Notice Time</label>
                        <input type="text" id="company" name="notice_time"
                               class="form-control" value="@isset($item){{$item->notice_time}}@else{{date('h:i A')}}@endisset" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="form-group col-md-12"><label for="company" class=" form-control-label">Notice Title
                            <span class="text-danger">*</span></label>
                        <input type="text" name="notice_title" id="company" class="form-control @error('notice_title') is-invalid @enderror"
                               value="@isset($item){{$item->notice_title}}@else{{old('notice_title')}}@endisset" required>
                        @error('notice_title')
                        <div class="invalid-feedback" role="alert">{{$message}}</div>
                        @enderror
                    </div>

                </div>
                <div class="row mb-3">
                    <div class="form-group col-md-12"><label for="" class="form-control-label">Notice Description
                        <span class="text-danger">*</span></label>
                        <textarea name="notice_description" id="" cols="30" rows="10" class="form-control @error('notice_description') is-invalid @enderror" required>
                        @isset($item){{$item->notice_description}}@else{{old('notice_description')}}@endisset
                    </textarea>
                        @error('notice_description')
                            <div class="invalid-feedback" role="alert">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="form-group col-md-6"><label for="company" class=" form-control-label">Branch
                            <span class="text-danger">*</span></label>
                        <select name="branch_id" id="" class="form-control @error('branch_id') is-invalid @enderror" required>
                            <option value="">Select Branch</option>
                            <option value="0" @isset($item){{$item->branch_id == 0 ? 'selected': ''}}@endisset>All Branches</option>
                            @foreach($branches as $branch)
                                <option value="{{$branch->id}}" @isset($item){{$item->branch_id == $branch->id ? 'selected': ''}}@endisset>{{$branch->branch_code}} ({{$branch->branch_name}})</option>
                            @endforeach
                        </select>
                        @error('branch_id')
                        <div class="invalid-feedback" role="alert">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="" class="form-control-label">Notice Status</label>
                        <div class="form-check">
                            <input class="form-check-input" value="1" type="radio" name="notice_status_id" id="flexRadioDefault1" checked>
                            <label class="form-check-label" for="flexRadioDefault1">
                                Active
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" value="0" type="radio" name="notice_status_id" id="flexRadioDefault2">
                            <label class="form-check-label" for="flexRadioDefault2">
                                Inactive
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="form-group col-md-12">
                        <label for="" class="form-control-label"></label>
                        <button type="submit" class="btn btn-primary form-control">@isset($item)Update @else Add @endisset Notice Information</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

