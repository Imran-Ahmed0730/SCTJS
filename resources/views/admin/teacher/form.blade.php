@extends('admin.master')
@section('title')
    @isset($item)Edit @else Add @endisset Teacher
@endsection
@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <!-- Or for RTL support -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />
@endpush
@section('content')
    <div class="card">
        <div class="card-header text-center">
            <h2><strong> @isset($item)Edit @else Add @endisset Teacher Form</strong></h2>
        </div>
        <div class="card-body card-block">
            <form action="@isset($item){{route('admin.teacher.update')}}@else{{route('admin.teacher.submit')}}@endisset" method="post" enctype="multipart/form-data">
                @csrf
                @isset($item)
                    <input type="hidden" name="id" value="@isset($item){{$item->id}}@endisset">
                @endisset
                <div class="row mb-3">
                    <div class="col-md-8">
                        <div class="row mb-3">
                            <div class="form-group col-md-12"><label for="company" class="form-control-label">Name
                                    <span class="text-danger">*</span></label>
                                <input type="text" id="company" name="name"
                                       class="form-control @error('name') is-invalid @enderror"
                                       value="@isset($item){{$item->name}}@else{{old('name')}}@endisset" required>
                                @error('name')
                                <div class="invalid-feedback" role="alert">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="form-group col-md-12"><label for="company" class=" form-control-label">Phone Number
                                    <span class="text-danger">*</span></label>
                                <input type="text" id="company" name="phone"
                                       class="form-control @error('phone') is-invalid @enderror"
                                       value="@isset($item){{$item->phone}}@else{{old('phone')}}@endisset" required>
                                @error('phone')
                                <div class="invalid-feedback" role="alert">{{$message}}</div>
                                @enderror
                            </div>

                        </div>
                        <div class="row mb-3">
                            <div class="form-group col-md-12"><label for="company" class=" form-control-label">Email Address
                                <span class="text-danger">*</span></label>
                                <input type="email" id="company" name="email"
                                       class="form-control @error('email') is-invalid @enderror"
                                       value="@isset($item){{$item->email}}@else{{old('email')}}@endisset">
                                @error('email')
                                    <div class="invalid-feedback" role="alert">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card-header text-center">Teacher Image</div>
                        <div class="card-body">
                            @isset($item)
                                @if($item->image)
                                    <img src="{{asset($item->image)}}"alt="" height="200px" width="200px" id="img" class="mb-3 mx-4">
                                @else
                                    <img src="{{asset('admin-assets')}}/images/default.jpg"alt="" height="200px" width="200px" id="img" class="mb-3 mx-4">
                                @endif
                            @else
                                <img src="{{asset('admin-assets')}}/images/default.jpg" alt="" height="200px" width="200px" id="img" class="mb-3 mx-4">
                            @endisset
                            <input type="file" class="form-control" name="image" accept="image/*" style="padding: 3px" onchange="readURL(this)">
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="form-group col-md-12"><label for="" class="form-control-label">Address</label>
                        <textarea name="address" id="" cols="30" rows="5" class="form-control" placeholder="Enter Address">@isset($item){{$item->address}}@else{{old('area')}}@endisset</textarea>
                    </div>
                </div>


                <div class="row mb-3">
                    <div class="form-group col-md-4"><label for="" class="form-control-label">Join Date</label><span class="text-danger">*</span>
                        <input type="date" name="join_date" value="@isset($item){{$item->join_date}}@else{{date('Y-m-d')}}@endisset" class="form-control @error('batch_id') is-invalid @enderror" required>
                        @error('join_date')
                            <div class="invalid-feedback" role="alert">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-4 "><label for="" class="form-control-label">Designation</label><span class="text-danger">*</span>
                        <input type="text" name="designation" class="form-control @error('designation') is-invalid @enderror" value="@isset($item){{$item->designation}}@else{{old('designation')}}@endisset">
                        @error('designation')
                        <div class="invalid-feedback" role="alert">{{$message}}</div>
                        @enderror
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
                            <input class="form-check-input" value="0" type="radio" name="status" id="flexRadioDefault2"
                            @isset($item){{$item->status != 1 ? 'checked':''}}@endisset>
                            <label class="form-check-label" for="flexRadioDefault2">
                                Inactive
                            </label>
                        </div>
                    </div>
                </div>
{{--                <div class="row mb-3 d-none">--}}
{{--                    <div class="col-md-12 card card-body">--}}
{{--                        <div class="card-header text-center"><strong>Sign in Information</strong></div>--}}
{{--                        <div class="card-body">--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <div class="form-group"><label for="vat" class=" form-control-label">Password--}}
{{--                                            <span class="text-danger">* [minimum 8 alphanumeric characters]</span></label>--}}
{{--                                        <div class="input-group">--}}
{{--                                            <input type="password" id="password" name="password"--}}
{{--                                                   class="form-control @error('password') is-invalid @enderror"--}}
{{--                                                   value="@isset($item){{$item->password}}@else{{old('password')}}@endisset" @isset($item) readonly @else required @endisset>--}}
{{--                                            <a class="btn btn-light input-group-addon" onclick="togglePassword()"><i class="fa fa-eye"></i></a>--}}
{{--                                        </div>--}}
{{--                                        @error('password')--}}
{{--                                        <div class="invalid-feedback" role="alert">{{$message}}</div>--}}
{{--                                        @enderror--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <div class="form-group"><label for="vat" class=" form-control-label">Confirm Password--}}
{{--                                            <span class="text-danger">*</span></label>--}}
{{--                                        <div class="input-group">--}}
{{--                                            <input type="password" id="password_confirmation" name="password_confirmation"--}}
{{--                                                   class="form-control @error('password') is-invalid @enderror"--}}
{{--                                                   value="@isset($item){{$item->password}}@else{{old('password')}}@endisset" @isset($item) readonly @else required @endisset>--}}
{{--                                            <a class="btn btn-light input-group-addon" onclick="toggleConfirmPassword()"><i class="fa fa-eye"></i></a>--}}
{{--                                        </div>--}}
{{--                                        @error('password')--}}
{{--                                        <div class="invalid-feedback" role="alert">{{$message}}</div>--}}
{{--                                        @enderror--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
                <div class="row mb-3">
                    <div class="form-group col-md-12">
                        <label for="" class="form-control-label"></label>
                        <button type="submit" class="btn btn-primary form-control">@isset($item)Update @else Add @endisset Teacher </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('script')
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
{{--<script>--}}
{{--    jQuery( document ).ready(function() {--}}
{{--        // alert('okay');--}}
{{--        jQuery('#course_id').change(function(){--}}
{{--            var course_id = jQuery(this).val();--}}
{{--            var url = '{{ route("teacher.get-batch-by-course", ":course_id") }}';--}}
{{--            url = url.replace(':course_id',course_id);--}}

{{--            if(course_id!='0'){--}}
{{--                jQuery.ajax({--}}
{{--                    url: url,--}}
{{--                    dataType: 'json',--}}
{{--                    beforeSend: function() {--}}
{{--                        //jQuery('select[name=\'division_id\']').after('<span class="wait">&nbsp;<img src="images/loading.gif" alt="" /></span>');--}}
{{--                    },--}}
{{--                    complete: function() {--}}
{{--                        jQuery('.wait').remove();--}}
{{--                    },--}}
{{--                    success: function(json) {--}}
{{--                        console.log(json);--}}
{{--                        html = '<option value="">-Select Batch-</option>';--}}
{{--                        for (i = 0; i < json.length; i++) {--}}
{{--                            html += '<option value="' + json[i]['id'] + '"';--}}
{{--                            html += '>' + json[i]['batch_name'] + '</option>';--}}
{{--                        }--}}

{{--                        jQuery('select[name=\'batch_id\']').html(html);--}}

{{--                    }--}}
{{--                });--}}
{{--            }--}}

{{--        });--}}

{{--    });--}}
{{--</script>--}}

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
    $( '#select-field' ).select2( {
        theme: 'bootstrap-5'
    } );
    $( '#multiple-select-field' ).select2( {
        theme: "bootstrap-5",
        width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
        placeholder: $( this ).data( 'placeholder' ),
        closeOnSelect: false,
    } )


</script>

@endpush
