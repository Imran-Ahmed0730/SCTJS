@extends('admin.master')
@section('title')
    About Admin
@endsection
@section('content')
    <div class="card">
        <div class="card-header text-center">
            <h2><strong> Profile Information </strong></h2>
        </div>
        <div class="card-body card-block">
            <div class="row mb-3">
                <div class="col-md-8">
                    <div class="row mb-3">
                        <div class="form-group col-md-12"><label for="company" class=" form-control-label">Branch Name</label>
                            <input type="text" id="company" name="branch_name"
                                   class="form-control"
                                   value="{{$item->branch_name}}" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="form-group col-md-12"><label for="company" class=" form-control-label">Phone Number</label>
                            <input type="number" id="company" name="branch_phone"
                                   class="form-control"
                                   value="{{$item->branch_phone}}" readonly>
                        </div>

                    </div>
                    <div class="row mb-3">
                        <div class="form-group col-md-12"><label for="company" class=" form-control-label">Email Address</label>
                            <input type="email" id="company" name="branch_email"
                                   class="form-control"
                                   value="{{$item->branch_email}}" readonly>

                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card-header text-center">Branch Head Image</div>
                    <div class="card-body">
                        @isset($item)
                            @if($item->head_image)
                                <img src="{{asset($item->head_image)}}"alt="" height="200px" width="200px" id="img" class="mb-3 mx-4">
                            @else
                                <img src="{{asset('admin-assets')}}/images/default.jpg"alt="" height="200px" width="200px" id="img" class="mb-3 mx-4">
                            @endif
                        @else
                            <img src="{{asset('admin-assets')}}/images/default.jpg" alt="" height="200px" width="200px" id="img" class="mb-3 mx-4">
                        @endisset
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="form-group col-md-4"><label for="" class="form-control-label">Branch Division </label>
                    <input type="text" class="form-control" value="{{$item->division->name}}" readonly>
                </div>
                <div class="form-group col-md-4"><label for="" class="form-control-label">Branch District</label>
                    <input type="text" class="form-control" value="{{$item->district->name}}" readonly>
                </div>
                <div class="form-group col-md-4"><label for="" class="form-control-label">Branch Upazila</label>
                    <input type="text" class="form-control" value="{{$item->upazila->name}}" readonly>
                </div>
            </div>
            <div class="row mb-3">
                <div class="form-group col-md-12"><label for="" class="form-control-label">Branch Area</label>
                    <textarea name="branch_area" id="" cols="30" rows="10" class="form-control" readonly>
                    {{$item->branch_area}}
                    </textarea>
                </div>
            </div>
            <div class="row mb-3">
                <div class="form-group col-md-3"><label for="" class="form-control-label">Registration Date</label>
                    <input type="text" name="join_date" value="{{$item->join_date}}" class="form-control" readonly>
                </div>
                <div class="form-group col-md-3"><label for="" class="form-control-label">Branch Type</label>
                    <input type="text" class="form-control" value="Branch" readonly>
                </div>
                <div class="form-group col-md-3">
                    <label for="" class="form-control-label">Registration Status</label>
                    <input type="text" class="form-control" value="{{$item->registration_status_id == 1 ? 'Active':'Inactive'}}" readonly>
                </div>
                <div class="form-group col-md-3">
                    <label for="" class="form-control-label">Branch Status</label>
                    <input type="text" class="form-control" value="{{$item->branch_status_id == 1 ? 'Active':'Inactive'}}" readonly>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-12 card card-body">
                    <div class="card-header text-center"><strong>Sign in Information</strong></div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group"><label for="company" class=" form-control-label">Branch Code</label>
                                    <input type="text" name="branch_code" id="company" class="form-control" value="{{$item->branch_code}}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group"><label for="vat" class=" form-control-label">Branch Password
                                        <span class="text-danger">*</span></label>
                                    <input type="text" id="company" name="branch_password"
                                           class="form-control"
                                           value="{{$item->branch_password}}" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
