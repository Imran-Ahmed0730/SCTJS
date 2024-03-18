@extends('admin.master')
@section('title')
    @isset($item)Edit @else Add @endisset Student
@endsection
@section('content')
{{--    @php dd($item) @endphp--}}
    <div class="row mt-1">
        <div class="card card-body">
            <form action="@isset($item){{route('student.update')}}@else{{route('student.submit')}}@endisset" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="@isset($item){{$item->student_id}}@endisset">
                <div class="row mb-3">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header text-center">
                                @isset($item)
                                @else
                                    @if(getSettings('registration_status') != 1 || $branch->registration_status_id != 1)<h3><strong class="text-danger">You Can not Register a Student Now</strong></h3> @endif
                                @endisset
                                <h3><strong>Personal Information</strong></h3>
                            </div>
                            <div class="card-body">
                                <div class="row mb-1">
                                    <div class="form-group col-md-12">
                                        <label for="" class="form-control-label">Student Name
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="student_name" id=""
                                               class="form-control @error('student_name') is-invalid @enderror"
                                               value="@isset($item){{$item->student->student_name}}@else{{old('student_name')}}@endisset" placeholder="Enter Student Name" required>
                                        @error('student_name')
                                        <div class="invalid-feedback" role="alert">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="form-group col-md-6">
                                        <label for="" class="form-control-label">Phone Number
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="number" name="student_phone" id=""
                                               class="form-control @error('student_phone') is-invalid @enderror"
                                               value="@isset($item){{$item->student->student_phone}}@else{{old('student_phone')}}@endisset" placeholder="Enter Student Phone Number" required>
                                        @error('student_phone')
                                        <div class="invalid-feedback" role="alert">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="" class="form-control-label">Email Address</label>
                                        <input type="email" name="student_email" id=""
                                               class="form-control"
                                               value="@isset($item){{$item->student->student_email}}@else{{old('student_email')}}@endisset">
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="form-group col-md-6">
                                        <label for="" class="form-control-label">Father's Name</label>
                                        <input type="text" name="father_name" id=""
                                               class="form-control"
                                               value="@isset($item){{$item->student->father_name}}@else{{old('father_name')}}@endisset" placeholder="Enter Father's Name">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="" class="form-control-label">Mother's Name</label>
                                        <input type="text" name="mother_name" id=""
                                               class="form-control"
                                               value="@isset($item){{$item->student->mother_name}}@else{{old('mother_name')}}@endisset" placeholder="Enter Mother's Name">
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="form-group col-md-6">
                                        <label for="" class="form-control-label">Date of Birth</label>
                                        <input type="date" name="student_dob" id=""
                                               class="form-control"
                                               value="@isset($item){{date('Y-m-d', strtotime($item->student->student_dob))}}@else{{old('student_dob')}}@endisset">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="" class="form-control-label">Admission Date</label>
                                        <input type="text" name="join_date" id=""
                                               class="form-control"
                                               value="@isset($item){{$item->student->join_date}}@else{{date('d-m-Y')}}@endisset" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card-header text-center"><h3><strong>Student Image</strong></h3></div>
                        <div class="card-body">
                            @isset($item)
                                @if($item->student->student_image)
                                    <img src="{{asset($item->student->student_image)}}"alt="" height="200px" width="200px" id="img" class="mb-3 mx-4">
                                @else
                                    <img src="{{asset('admin-assets')}}/images/default.jpg"alt="" height="200px" width="200px" id="img" class="mb-3 mx-4">
                                @endif
                            @else
                                <img src="{{asset('admin-assets')}}/images/default.jpg" alt="" height="200px" width="200px" id="img" class="mb-3 mx-4">
                            @endisset
                            <input type="file" class="form-control @error('student_image') is-invalid @enderror" name="student_image" accept="image/*" style="padding: 3px" onchange="readURL(this)">
                            @error('student_image')
                                <div class="invalid-feedback" role="alert">{{$message}}</div>
                            @enderror

                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header text-center"><h3><strong>Additional Information</strong></h3></div>
                            <div class="card-body">
                                <div class="row mb-1">
                                    <div class="form-group col-md-4"><label for="" class="form-control-label">Gender</label>
                                        <select name="student_gender" id="" class="form-control">
                                            <option value="" selected>Select Gender</option>
                                            <option value="1" @isset($item){{$item->student->student_gender == 1 ? 'selected':''}}@endisset>Male</option>
                                            <option value="2" @isset($item){{$item->student->student_gender == 2 ? 'selected':''}}@endisset>Female</option>
                                            <option value="3" @isset($item){{$item->student->student_gender == 3 ? 'selected':''}}@endisset>Others</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4"><label for="" class="form-control-label">Religion</label>
                                        <select name="student_religion" id="" class="form-control">
                                            <option value="" selected>Select Religion</option>
                                            <option value="1" @isset($item){{$item->student->student_religion == 1 ? 'selected':''}}@endisset>Islam</option>
                                            <option value="2" @isset($item){{$item->student->student_religion == 2 ? 'selected':''}}@endisset>Hinduism</option>
                                            <option value="3" @isset($item){{$item->student->student_religion == 3 ? 'selected':''}}@endisset>Christianity</option>
                                            <option value="4" @isset($item){{$item->student->student_religion == 4 ? 'selected':''}}@endisset>Buddhism</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4"><label for="" class="form-control-label">Nationality
                                            <span class="text-danger">*</span></label>
                                        <select name="student_nationality" id="" class="form-control">
                                            <option value="1" selected>Bangladeshi</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header text-center"><h3><strong>Course Information</strong></h3></div>
                            <div class="card-body">
                                <div class="row mb-1">
                                    <div class="form-group col-md-3"><label for="" class="form-control-label">Branch
                                            <span class="text-danger">*</span></label>
                                        <select name="branch_id" id="" class="form-control @error('branch_id') is-invalid @enderror">
{{--                                                @isset($item) disabled @endisset>--}}
{{--                                            <option value="" selected>Select Branch</option>--}}
                                            <option value="{{$branch->id}}" selected>{{$branch->branch_name}}</option>
{{--                                            @foreach($branches as $branch)--}}
{{--                                                <option value="{{$branch->id}}" @isset($item){{$item->branch_id == $branch->id ? 'selected':''}}@endisset>{{$branch->branch_name}}</option>--}}
{{--                                            @endforeach--}}
                                        </select>
                                        @error('branch_id')
                                            <div class="invalid-feedback" role="alert">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-3"><label for="" class="form-control-label">Course
                                            <span class="text-danger">*</span></label>
                                        <select name="course_id" id="" class="form-control @error('course_id') is-invalid @enderror" required>
{{--                                                @isset($item) disabled @endisset>--}}
                                            <option value="">Select Course</option>
                                            @foreach($courses as $course)
                                                <option value="{{$course->id}}" @isset($item){{$item->course_id == $course->id ? 'selected':''}}@endisset>{{$course->course_name}}</option>
                                            @endforeach
                                        </select>
                                        @error('course_id')
                                        <div class="invalid-feedback" role="alert">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-3"><label for="" class="form-control-label">Session
                                            <span class="text-danger">*</span></label>
                                        <select name="session_id" id="" class="form-control @error('session_id') is-invalid @enderror" required>
{{--                                                @isset($item) disabled @endisset>--}}
                                            <option value="">Select Session</option>
                                            @foreach($sessions as $session)
                                                <option value="{{$session->id}}" @isset($item){{$item->session_id == $session->id ? 'selected':''}}@endisset>{{$session->session_name}}</option>
                                            @endforeach
                                        </select>
                                        @error('session_id')
                                        <div class="invalid-feedback" role="alert">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-3"><label for="" class="form-control-label">Meduim</label>
                                        <select name="medium_id" id="" class="form-control">
                                            <option value="">Select Medium</option>
                                            <option value="1" selected>Bangla</option>
                                        </select>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header text-center"><h3><strong>Academic Information</strong></h3></div>
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="form-group col-md-3">
                                        <label for="" class="form-control-label">SSC Board</label>
                                        <select name="ssc_board" id="" class="form-control">
                                            <option value="">Select Board</option>
                                            @for($i=1; $i<=count($boards); $i++)
                                                <option value="{{$i}}" @isset($item){{$item->student->ssc_board == $i ? 'selected':''}}@endisset>
                                                    {{$boards[$i-1]}}</option>
                                            @endfor

                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="" class="form-control-label">SSC Roll</label>
                                        <input type="text" name="ssc_roll" class="form-control" placeholder="Enter SSC Roll No" value="@isset($item){{$item->student->ssc_roll}}@else{{old('ssc_roll')}}@endisset">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="" class="form-control-label">SSC Result (GPA)</label>
                                        <input
                                            type="text" class="form-control" name="ssc_result" placeholder="Enter SSC Result" value="@isset($item){{$item->student->ssc_result}}@else{{old('ssc_result')}}@endisset">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="" class="form-control-label">SSC Passing Year</label>
                                        <input type="text" name="ssc_year" class="form-control" placeholder="Enter SSC Passing Year" value="@isset($item){{$item->student->ssc_year}}@else{{old('ssc_year')}}@endisset">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label for="" class="form-control-label">JSC Board</label>
                                        <select name="jsc_board" id="" class="form-control">
                                            <option value="" selected>Select Board</option>
                                            @for($i=1; $i<=count($boards); $i++)
                                                <option value="{{$i}}" @isset($item){{$item->student->jsc_board == $i ? 'selected':''}}@endisset>
                                                    {{$boards[$i-1]}}</option>
                                            @endfor

                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="" class="form-control-label">JSC Roll</label>
                                        <input type="text" name="jsc_roll" class="form-control" placeholder="Enter JSC Roll No" value="@isset($item){{$item->student->jsc_roll}}@else{{old('jsc_roll')}}@endisset">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="" class="form-control-label">JSC Result (GPA)</label>
                                        <input
                                            type="text" class="form-control" name="jsc_result" placeholder="Enter JSC Result" value="@isset($item){{$item->student->jsc_result}}@else{{old('jsc_result')}}@endisset">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="" class="form-control-label">JSC Passing Year</label>
                                        <input type="text" name="jsc_year" class="form-control" placeholder="Enter JSC Passing Year" value="@isset($item){{$item->student->jsc_year}}@else{{old('jsc_year')}}@endisset">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header text-center">
                                <h3><strong>Result Information</strong></h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-6"><label for="" class="form-control-label">Result <span class="text-danger">(Numbers Only)</span></label>
                                        <input name="result_marks" class="form-control" type="number" placeholder="Enter Result Marks" value="@isset($item){{$item->result_marks}}@else{{old('result_marks')}}@endisset">
                                    </div>
                                    <div class="form-group col-md-6"><label for="" class="form-control-label">Result Grade</label>
                                        <select name="result_grade_id" id="" class="form-control">
                                            <option value="">Select Grade</option>
                                            @foreach($grades as $grade)
                                                <option value="{{$grade->result_grade_id}}">{{$grade->result_grade_title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="form-group col-md-12">
                        @isset($item)
                            <button type="submit" class="btn btn-primary form-control">Update Student Information</button>
                        @else
                            <button type="submit" id="submitBtn" class="btn btn-primary form-control">Add  Student Information</button>
                        @endisset
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('script')
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
    </script>
    <script>
        jQuery(document).ready(function(){
            var regStatus = {{getSettings('registration_status')}};
            var branchRegStatus = {{$branch->registration_status_id}};

                if(regStatus != '1' || branchRegStatus != 1){
                    @isset($item)
                    @else
                    jQuery('#submitBtn').prop('disabled', true);
                    jQuery('form').submit(function (event) {
                        event.preventDefault();
                        alert('Registration is now Deactivated!!');
                    });
                    @endisset
            }
        });
    </script>
@endpush
