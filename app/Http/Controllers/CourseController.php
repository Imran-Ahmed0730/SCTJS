<?php

namespace App\Http\Controllers;

use App\Models\CourseModule;
use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    private $course;
    public function add()
    {
        return view('admin.course.form');
    }


    public function submit(Request $request)
    {
//        return $request;
        $this->validation($request);
        $request->validate(['image' => ['required']]);
        $this->course= Course::addOrUpdate($request);
        if($request->modules != null){
            CourseModule::add($request, $this->course->id);
        }

        return redirect()->route('admin.course.list')->with('message', 'Course Has Been Added Successfully!!');
    }

    public function list()
    {
        $courses = Course::latest();
        if(isset($_GET['course_status_id']) && $_GET['course_status_id'] >=0){
            $courses = $courses->where('course_status_id', $_GET['course_status_id']);
        }
        if(isset($_GET['course_type']) && $_GET['course_type']>0){
            $courses = $courses->where('course_type', $_GET['course_type']);
        }

        $data['items'] = $courses->paginate(50);
        return view('admin.course.list', $data);
    }

    public function edit($id)
    {
        $data['item'] = Course::find($id);
        $data['modules'] = CourseModule::where('course_id', $id)->latest()->get();
        return view('admin.course.form', $data);
    }

    public function update(Request $request)
    {
//        return $request;
        $request->validate([
            'course_name'=>['required'] ,
            'course_code'=>['required'],
            'total_lectures'=>['required'],
            'course_duration'=>['required'],
            'course_type'=>['required']
        ]);
        Course::addOrUpdate($request);
//        if($request->modules != null){
            CourseModule::updateModule($request);
//        }
//        else
        return redirect()->route('admin.course.list')->with('message', 'Course Information Has Been Update Successfully!!');
    }

    public function remove(Request $request)
    {
        Course::remove($request->id);
        CourseModule::remove($request->id);
        return back()->with('message', 'Course Has Been Removed Successfully!!');
    }
    public function validation($request){
        $request->validate([
           'course_name'=>['required', 'unique:courses'] ,
            'course_code'=>['required', 'unique:courses'],
            'total_lectures'=>['required'],
            'course_duration'=>['required'],
            'course_type'=>['required']
        ]);
    }
}
