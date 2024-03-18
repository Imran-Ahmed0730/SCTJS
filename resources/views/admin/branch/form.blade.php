@extends('admin.master')
@section('title')
    @isset($item)Edit @else Add @endisset Branch
@endsection
@section('content')
    <div class="card">
        <div class="card-header text-center">
            <h2><strong> @isset($item)Edit @else Add @endisset Branch Form</strong></h2>
        </div>
        <div class="card-body card-block">
            <form action="@isset($item){{route('admin.branch.update')}}@else{{route('admin.branch.submit')}}@endisset" method="post" enctype="multipart/form-data">
                @csrf
                @isset($item)
                    <input type="hidden" name="id" value="@isset($item){{$item->id}}@endisset">
                @endisset
                @isset($application)
                    <input type="hidden" name="application_id" value="{{$application->id}}">
                @endisset
                <div class="row mb-3">
                    <div class="col-md-8">
                        <div class="row mb-3">
                            <div class="form-group col-md-12"><label for="company" class=" form-control-label">Branch Name
                                    <span class="text-danger">*</span></label>
                                <input type="text" id="company" name="branch_name"
                                       class="form-control @error('branch_name') is-invalid @enderror"
                                       value="@isset($item){{$item->branch_name}}@else @if(isset($application)){{$application->institution_name_en}}@else {{old('branch_name')}} @endif @endisset" required>
                                @error('branch_name')
                                <div class="invalid-feedback" role="alert">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="form-group col-md-12"><label for="company" class=" form-control-label">Phone Number
                                    <span class="text-danger">*</span></label>
                                <input type="text" id="company" name="branch_phone"
                                       class="form-control @error('branch_phone') is-invalid @enderror"
                                       value="@isset($item){{$item->branch_phone}}@else @if(isset($application)) {{$application->phone}} @else {{old('branch_phone')}} @endif @endisset" required>
                                @error('branch_phone')
                                <div class="invalid-feedback" role="alert">{{$message}}</div>
                                @enderror
                            </div>

                        </div>
                        <div class="row mb-3">
                            <div class="form-group col-md-12"><label for="company" class=" form-control-label">Email Address
                                <span class="text-danger">*</span></label>
                                <input type="email" id="company" name="branch_email"
                                       class="form-control @error('branch_email') is-invalid @enderror"
                                       value="@isset($item){{$item->branch_email}}@else @if(isset($application)) {{$application->email}} @else {{old('branch_email')}} @endif @endisset">
                                @error('branch_email')
                                    <div class="invalid-feedback" role="alert">{{$message}}</div>
                                @enderror
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
                                @if(isset($application))
                                    <img src="{{asset($application->head_image)}}"alt="" height="200px" width="200px" id="img" class="mb-3 mx-4">
                                @else
                                    <img src="{{asset('admin-assets')}}/images/default.jpg" alt="" height="200px" width="200px" id="img" class="mb-3 mx-4">
                                @endif
                            @endisset
                            <input type="file" class="form-control" name="head_image" accept="image/*" style="padding: 3px" value="@isset($_GET['head_image']) {{URL::asset('/uploads/'.$_GET['head_image'])}}@endisset" onchange="readURL(this)">
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="form-group col-md-4"><label for="" class="form-control-label">Branch Division
                            <span class="text-danger">*</span></label>
                        <select name="branch_division" id="division_id" class="form-control @error('branch_division') is-invalid @enderror" required>
                            <option value="">Select Division</option>
                            @foreach($divisions as $division)
                                <option value="{{$division->id}}"
                                @isset($item){{$item->branch_division == $division->id ? 'selected': ''}}@endisset>
                                    {{$division->name}}</option>
                            @endforeach
                        </select>
                        @error('branch_division')
                            <div class="invalid-feedback" role="alert">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-4"><label for="" class="form-control-label">Branch District
                            <span class="text-danger">*</span></label>
                        <select name="branch_district" id="district_id" class="form-control @error('branch_district') is-invalid @enderror" required>
                            <option value="">Select Division</option>
                            @isset($item)
                                <option value="{{$item->branch_division}}" selected>{{$item->district->name}}</option>
                            @endisset
{{--                            @foreach($districts as $district)--}}
{{--                                <option value="{{$district->id}}" @isset($item){{$item->branch_district == $district->id ? 'selected': ''}}@endisset>--}}
{{--                                    {{$district->name}}</option>--}}
{{--                            @endforeach--}}
                        </select>
                        @error('branch_district')
                        <div class="invalid-feedback" role="alert">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-4"><label for="" class="form-control-label">Branch Upazila
                            <span class="text-danger">*</span></label>
                        <select name="branch_upazila" id="upazila_id" class="form-control @error('branch_upazila') is-invalid @enderror">
                            @isset($item)
                                <option value="{{$item->branch_upazila}}" selected>{{$item->upazila->name}}</option>
                            @endisset
                            <option value="">Select Division</option>
{{--                            @foreach($upazilas as $upazila)--}}
{{--                                <option value="{{$upazila->id}}" @isset($item){{$item->branch_upazila == $upazila->id ? 'selected': ''}}@endisset>--}}
{{--                                    {{$upazila->name}}</option>--}}
{{--                            @endforeach--}}
                        </select>
                        @error('branch_upazila')
                            <div class="invalid-feedback" role="alert">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="form-group col-md-12"><label for="" class="form-control-label">Branch Area</label>
                        <textarea name="branch_area" id="" cols="30" rows="10" class="form-control">
                        @isset($item){{$item->branch_area}}@else @if(isset($application)) {{$application->address_en}}@else{{old('branch_area')}}@endif @endisset
                    </textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="form-group col-md-3"><label for="" class="form-control-label">Registration Date</label>
                        <input type="text" name="join_date" value="@isset($item){{$item->join_date}}@else{{date('d-m-Y')}}@endisset" class="form-control" readonly>
                    </div>
                    <div class="form-group col-md-3"><label for="" class="form-control-label">Branch Type
                            <span class="text-danger">*</span></label>
                        <select name="branch_type_id" id="" class="form-control">
                            <option value="">Select Branch Type</option>
                            <option value="2" selected>Branch</option>
                            <option value="1" @isset($item){{$item->branch_type_id == 1 ? 'selected': ''}}@else{{old('branch_type_id')}}@endisset>Head Branch</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="" class="form-control-label">Registration Status</label>
                        <div class="form-check">
                            <input class="form-check-input" value="1" type="radio" name="registration_status_id" id="flexRadioDefault1" checked>
                            <label class="form-check-label" for="flexRadioDefault1">
                                Active
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" value="0" type="radio" name="registration_status_id" id="flexRadioDefault2"
                            @isset($item){{$item->registration_status_id != 1 ? 'checked':''}}@endisset>
                            <label class="form-check-label" for="flexRadioDefault2">
                                Inactive
                            </label>
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="" class="form-control-label">Branch Status</label>
                        <div class="form-check">
                            <input class="form-check-input" value="1" type="radio" name="branch_status_id" id="flexRadioDefault3" checked>
                            <label class="form-check-label" for="flexRadioDefault1">
                                Active
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" value="0" type="radio" name="branch_status_id" id="flexRadioDefault4"
                            @isset($item){{$item->branch_status_id != 1 ? 'checked':''}}@endisset>
                            <label class="form-check-label" for="flexRadioDefault2">
                                Inactive
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12 card card-body">
                        <div class="card-header text-center"><strong>Sign in Information</strong></div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group"><label for="vat" class=" form-control-label">Branch Password
                                            <span class="text-danger">* [minimum length 8]</span></label>
                                        <div class="input-group">
                                            <input type="password" id="password" name="branch_password"
                                                   class="form-control @error('branch_password') is-invalid @enderror"
                                                   value="@isset($item){{$item->branch_password}}@else{{old('branch_password')}}@endisset" required>
                                            <a class="btn btn-light input-group-addon" onclick="togglePassword()"><i class="fa fa-eye"></i></a>
                                        </div>
                                        @error('branch_password')
                                        <div class="invalid-feedback" role="alert">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group"><label for="vat" class=" form-control-label">Confirm Password
                                            <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="password" id="password_confirmation" name="branch_password_confirmation"
                                                   class="form-control @error('branch_password') is-invalid @enderror"
                                                   value="@isset($item){{$item->branch_password}}@else{{old('branch_password')}}@endisset" required>
                                            <a class="btn btn-light input-group-addon" onclick="toggleConfirmPassword()"><i class="fa fa-eye"></i></a>
                                        </div>
                                        @error('branch_password')
                                        <div class="invalid-feedback" role="alert">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group"><label for="company" class=" form-control-label">Branch Code</label>
                                        <input type="text" name="branch_code" id="company" class="form-control" value="@isset($item){{$item->branch_code}}@endisset" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="form-group col-md-12">
                        <label for="" class="form-control-label"></label>
                        <button type="submit" class="btn btn-primary form-control">@isset($item)Update @else Add @endisset Branch </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('script')
<script>
    jQuery( document ).ready(function() {
        // alert('okay');
        jQuery('#division_id').change(function(){
            var division_id = jQuery(this).val();
            var url = '{{ route("admin.branch.get-district-by-division", ":division_id") }}';
            url = url.replace(':division_id',division_id);

            if(division_id!='0'){
                jQuery.ajax({
                    url: url,
                    dataType: 'json',
                    beforeSend: function() {
                        //jQuery('select[name=\'division_id\']').after('<span class="wait">&nbsp;<img src="images/loading.gif" alt="" /></span>');
                    },
                    complete: function() {
                        jQuery('.wait').remove();
                    },
                    success: function(json) {
                        html = '<option value="">--Select--</option>';
                        for (i = 0; i < json.length; i++) {
                            html += '<option value="' + json[i]['id'] + '"';
                            html += '>' + json[i]['name'] + '</option>';
                        }

                        jQuery('select[name=\'branch_district\']').html(html);
                        html_upazila = '<option value="">--Select--</option>';
                        jQuery('select[name=\'branch_upazila\']').html(html_upazila);
                    }
                });
            }else if(division_id=='0'){
                html_upazila = '<option value="">--Select--</option>';
                jQuery('select[name=\'branch_district\']').html(html_upazila);
                jQuery('select[name=\'branch_upazila\']').html(html_upazila);
            }

        });

        jQuery('#district_id').change(function(){
            var district_id = jQuery(this).val();
            var url = '{{ route("admin.branch.get-upazila-by-district", ":district_id") }}';
            url = url.replace(':district_id',district_id);

            if(district_id>0){
                jQuery.ajax({
                    url: url,
                    dataType: 'json',
                    beforeSend: function() {
                        // jQuery('select[name=\'branch_district\']').after('<span class="wait">&nbsp;<img src="images/loading.gif" alt="" /></span>');
                    },
                    complete: function() {
                        jQuery('.wait').remove();
                    },
                    success: function(json) {
                        html = '<option value="">--Select--</option>';
                        for (i = 0; i < json.length; i++) {
                            html += '<option value="' + json[i]['id'] + '"';
                            html += '>' + json[i]['name'] + '</option>';
                        }
                        jQuery('select[name=\'branch_upazila\']').html(html);
                    }
                });
            }else{
                html = '<option value="">--Select--</option>';
                jQuery('select[name=\'branch_upazila\']').html(html);
            }
        });
    });
</script>

<script>
    function readURL(input) {
        if (input.files && input.files[0]) {

            var reader = new FileReader();
            reader.onload = function (e) {
                document.querySelector("#img").setAttribute("src",e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    function togglePassword(){
        var pass =document.getElementById('password');
        if(pass.type == 'password'){
            pass.type = 'text';
        }
        else {
            pass.type = 'password';
        }

    }
    function toggleConfirmPassword(){
        var pass_confirm =document.getElementById('password_confirmation');
        if(pass_confirm.type == 'password'){
            pass_confirm.type = 'text';
        }
        else {
            pass_confirm.type = 'password';
        }
    }

</script>

@endpush
