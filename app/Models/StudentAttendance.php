<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class StudentAttendance extends Model
{
    use HasFactory;
    private static $attendance, $attendedStudent, $status;

    public static function add($exam, $request)
    {
//        dd($request->student_id);
        $students = BranchStudent::where('branch_code', Auth::user()->branch_code)
            ->where('status_id', 1)
            ->where('course_id', $request->course_id)
            ->where('session_id', $request->session_id)->get();
        foreach ($students as $student){

            self::$attendance = new StudentAttendance();
            self::$attendance->exam_id = $exam->id;
            self::$attendance->student_id = $student->student_id;
            if($request->student_id){
                if(in_array($student->student_id, $request->student_id )){
                    self::$attendance->status = 1;
//                dd('ok');
                }
                else{
                    self::$attendance->status = 0;
                }
            }
            else{
                self::$attendance->status = 0;
            }

            self::$attendance->save();
        }
    }

    public static function updateAttendance($exam, $request)
    {
//        dd($exam, $request);
        self::$attendance = StudentAttendance::where('exam_id', $exam->id)->get();
        foreach (self::$attendance as $att){
            if ($request->student_id){
                if(in_array($att->student_id, $request->student_id )){
                    $att->status = 1;
//                dd('ok');
                }
                else{
                    $att->status = 0;
                }
            }
            else{
                $att->status = 0;
            }

            $att->save();
        }
    }

    public static function remove($exam)
    {
        self::$attendance = StudentAttendance::where('exam_id', $exam->id)->get();
        foreach (self::$attendance as $attandance){
            $attandance->delete();
        }
    }
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
    public function branchStudent()
    {
        return $this->belongsTo(BranchStudent::class, 'student_id');
    }
}
