<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\BranchStudent;
use App\Models\ExamAttendance;
use App\Models\StudentAttendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class ExamAttendanceController extends Controller
{
    private $exam;
    public function add()
    {
        $students = BranchStudent::where('branch_code', Auth::user()->branch_code)->where('status_id', 1);
        if(isset($_GET['course_id']) && $_GET['course_id'] >0){
            $students = $students->where('course_id', $_GET['course_id']);
        }
        if(isset($_GET['session_id']) && $_GET['session_id'] >0){
            $students = $students->where('session_id', $_GET['session_id']);

        }
        if (isset($_GET['session_id']) && $_GET['session_id'] >0 && isset($_GET['course_id']) && $_GET['course_id'] >0 && isset($_GET['date']) && $_GET['date'] >0){
            if(ExamAttendance::where('date', $_GET['date'])
                ->where('course_id', $_GET['course_id'])
                ->where('session_id', $_GET['session_id'])
                ->where('branch_code', Auth::user()->branch_code)->first()){
                return back();
            }
        }
        $data['items'] = $students->orderBy('student_roll', 'asc')->get();

        return view('admin.exam-attendance.form', $data);
    }
    public function submit(Request $request)
    {
//        return $request;
        $this->exam = ExamAttendance::add($request);
        StudentAttendance::add($this->exam, $request);

        return redirect()->route('exam.attendance.list')->with('message', 'Attendance Has Been Submitted');
    }

    public function list()
    {
        if (Auth::user()->role == 1){
            $data['items'] = ExamAttendance::latest()->orderBy('date', 'desc')->get();
        }
        else{
            $data['items'] = ExamAttendance::where('branch_code', Auth::user()->branch_code)->latest()->orderBy('date', 'desc')->get();
        }

        return view('admin.exam-attendance.list', $data);
    }
    public function details($id)
    {
        $data['items'] = StudentAttendance::where('exam_id', $id)->get();
        return view('admin.exam-attendance.details', $data);
    }
    public function update(Request $request)
    {
//        return $request;
        $this->exam= ExamAttendance::updateExamAttendance($request);
        StudentAttendance::updateAttendance($this->exam, $request);

        return redirect()->route('exam.attendance.list')->with('message', 'Exam Attendance Has Been Updated!!');
    }
    public function print($id)
    {
        $this->exam = ExamAttendance::find($id);
        $data['items'] = StudentAttendance::where('exam_id', $id)->get();
        $data['exam'] = $this->exam;
        $pdf = PDF::loadView('admin.exam-attendance.attendance-print', $data);
        return $pdf->stream('Attendance-Sheet-'.$this->exam->branch->branch_name.'-'.$this->exam->course->course_name.'-'.$this->exam->session->session_name.'.pdf');
    }
}
