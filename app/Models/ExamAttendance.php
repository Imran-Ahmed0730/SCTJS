<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ExamAttendance extends Model
{
    use HasFactory;
    private static $exam, $student;
    public static function add($request)
    {
        self::$exam = new ExamAttendance();

        if($request->student_id == null){
            $present = 0;
        }
        else{
            $present = count($request->student_id);
        }

        self::$exam->date = $request->date;
        self::$exam->course_id = $request->course_id;
        self::$exam->session_id = $request->session_id;
        self::$exam->total_student = $request->total_student;
        self::$exam->branch_code = Auth::user()->branch_code;
        self::$exam->present = $present;
        self::$exam->absent = $request->total_student - $present;
        self::$exam->save();
        return self::$exam;

    }
    public static function updateExamAttendance($request)
    {
        self::$exam = ExamAttendance::find($request->id);
        if($request->student_id == null){
            $present = 0;
        }
        else{
            $present = count($request->student_id);
        }
        self::$exam->total_student = $request->total_student;
        self::$exam->present = $present;
        self::$exam->absent = $request->total_student - $present;
        self::$exam->save();
        return self::$exam;
    }

    public function session()
    {
        return $this->belongsTo(Session::class, 'session_id');
    }
    public function course()
    {
        return $this->belongsTo(Course::class, 'session_id');
    }
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_code', 'branch_code');
    }
}
