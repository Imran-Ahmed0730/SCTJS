<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Course;
use App\Models\CourseBatch;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    public $user, $teacher;
    public function add()
    {
        $data['courses'] = Course::where('course_status_id', 1)->orderBy('course_name', 'asc')->latest()->get();
        return view('admin.teacher.form', $data);
    }
    public function submit(Request $request)
    {
//        return $request;
        if(count(Teacher::where('status', 1)->get()) >= 4){
            return back()->with('message', 'Cannot Add More Than $4 Teachers');
        }
        else{
            $request->validate([
                'name'          => ['required'],
                'phone'         => ['required', 'unique:teachers'],
                'designation'   => ['required'],
                'join_date'     => ['required']
            ]);
//        $this->user = $this->addOrUpdateUser($request);
            Teacher::addOrUpdate($request);
            return redirect()->route('admin.teacher.list')->with('message', 'Teacher Has Been Added SuccessFully!!');
        }
    }

    public function list()
    {
        $data['items'] = Teacher::latest()->paginate(25);
        return view('admin.teacher.list', $data);
    }

    public function edit($id)
    {
        $data['item'] = Teacher::find($id);
//        $data['courses'] = Course::where('course_status_id', 1)->orderBy('course_name', 'asc')->latest()->get();
//        $data['batches'] = CourseBatch::where('status', 1)->where('course_id', $data['item']->course_id)->latest()->get();
        return view('admin.teacher.form', $data);
    }
    public function update(Request $request)
    {
        $request->validate([
            'name'          => ['required'],
            'phone'         => ['required', 'min:11', 'max:15'],
            'designation'   => ['required'],
//            'password'   => ['required', 'min:8'],
            'join_date'     => ['required']
        ]);
//        $this->teacher = Teacher::find($request->id);
        Teacher::addOrUpdate($request);
        return redirect()->route('admin.teacher.list')->with('message', 'Teacher Information Has Been Updated Successfully!!');
    }
    public function remove(Request $request)
    {
        $this->removeUser($request->id);
        Teacher::remove($request->id);
        return back()->with('message', 'Teacher Has Been Removed Successfully!!');
    }

    private function addOrUpdateUser($request)
    {
        $branch = Branch::where('branch_code', Auth::user()->branch_code)->first();
        if($request->id){
            $this->teacher = Teacher::find($request->id);
            $this->user = find($this->teacher->user_id);
        }
        else{
            $this->user = new User();
            $this->user->name = $request->name;
            $this->user->branch_code = $branch->branch_code;
            $this->user->role = 3;
            $this->user->password = bcrypt($request->password);
        }

        $this->user->email = $request->email;
        $this->user->save();
        return $this->user;
    }

    public function removeUser($id)
    {
        $this->teacher = Teacher::find($id);
        $this->user = User::find($this->teacher->user_id);
        $this->user->delete();
    }

    public function getBatchByCourseId($id)
    {
        return response()->json(CourseBatch::where('course_id', $id)->where('status', 1)->get());
    }

}
