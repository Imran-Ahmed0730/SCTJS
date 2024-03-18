@extends('admin.master')
@section('title')
    @isset($modules)Add @else Edit @endisset Module Result
@endsection
@section('content')
    <div class="row mt-5">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h3><strong>Student Information</strong></h3></div>
                <div class="card-body">
                    @isset($item)
                        <form action="@isset($item){{route('student.result.module.update')}} @else {{route('student.result.module.submit')}} @endisset" method="post">
                            @csrf
                            <input type="hidden" name="student_id" value="{{$item->student_id}}">
                            <input type="hidden" name="course_id" value="{{$item->course_id}}">
                            <table class="table">
                                <tr>
                                    <th>Student Name</th>
                                    <td>{{$item->student->student_name}}</td>
                                </tr>
                                <tr>
                                    <th>Roll No</th>
                                    <td>{{$item->student_roll}}</td>
                                </tr>
                                <tr>
                                    <th>Registration No</th>
                                    <td>{{$item->student_registration}}</td>
                                </tr>
                                <tr>
                                    <th>Course Name</th>
                                    <td>{{$item->course->course_name}}</td>
                                </tr>
                                <tr>
                                    <th>Course Modules</th>
                                    <td>
                                        @isset($moduleResults)
                                            @foreach($moduleResults as $module)

                                                <label for="">{{$module->courseModule->module_name}}</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon3">Marks</span>
                                                    </div>
                                                    <input type="number" class="form-control" name="marks[]" id="basic-url" aria-describedby="basic-addon3"
                                                    value="{{$module->marks}}">
                                                    <div class="input-group-prepend" style="margin-left: 10px">
                                                        <span class="input-group-text" id="basic-addon3">Grade</span>
                                                    </div>
                                                    <select name="grade[]" id="" class="form-control">
                                                        <option value="">Select Grade</option>
                                                        @foreach($grades as $grade)
                                                            <option value="{{$grade->result_grade_id}}" {{$module->result_grade_id == $grade->result_grade_id ? 'selected':''}}>{{$grade->result_grade_title}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            @endforeach
                                        @endisset
                                        @isset($modules)
                                            @foreach($modules as $module)
                                            <input type="hidden" name="id[]" value="{{$module->id}}">

                                                <label for="">{{$module->module_name}}</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon3">Marks</span>
                                                    </div>
                                                    <input type="number" class="form-control" name="marks[]" id="basic-url" aria-describedby="basic-addon3"
                                                    value="{{$module->marks}}">
                                                    <div class="input-group-prepend" style="margin-left: 10px">
                                                        <span class="input-group-text" id="basic-addon3">Grade</span>
                                                    </div>
                                                    <select name="grade[]" id="" class="form-control">
                                                        <option value="">Select Grade</option>
                                                        @foreach($grades as $grade)
                                                            <option value="{{$grade->result_grade_id}}" @isset($moduleResults) @endisset>{{$grade->result_grade_title}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            @endforeach
                                        @endisset
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="text-center"><button type="submit" class="btn btn-primary">Update Module Marks</button></td>
                                </tr>
                            </table>
                        </form>
                    @endisset
                </div>
            </div>
        </div>
    </div>
@endsection
