<?php

namespace App\Http\Controllers;

use App\Models\BranchStudent;
use App\Models\CourseModule;
use App\Models\CourseModuleResult;
use App\Models\ResultGrade;
use Illuminate\Http\Request;

class CourseModuleResultController extends Controller
{
    private $branchStudent;
    public function add($id)
    {
        $this->branchStudent =  BranchStudent::find($id);
//        return $this->branchStudent;
        $data['item'] = $this->branchStudent;
        $data['modules'] = CourseModule::where('course_id', $this->branchStudent->course_id)->get();
        $data['grades'] = ResultGrade::all();
        return view('admin.result-module.form', $data);
    }

    public function submit(Request $request)
    {
        CourseModuleResult::add($request);
        return redirect()->route('student.result')->with('message', 'Module Result Has Been Added Successfully!!');
    }
    public function edit($id)
    {
        $this->branchStudent =  BranchStudent::where('student_id', $id)->first();
        $data['item'] = $this->branchStudent;
        $data['moduleResults'] = CourseModuleResult::where('student_id', $this->branchStudent->student_id)->get();
        $data['grades'] = ResultGrade::all();

        return view('admin.result-module.form', $data);
    }

    public function update(Request $request)
    {
//        return $request;
        CourseModuleResult::updateResult($request);
        return redirect()->route('student.result')->with('message', 'Course Module Result Has Been Updated Successfully!!');
    }
}
