<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchStudent extends Model
{
    use HasFactory;

    private static $branchStudent, $branch, $course;

    public static function addOrUpdate($request, $studentId)
    {

        if(BranchStudent::where('student_id', $studentId)->first()){
            self::$branchStudent = BranchStudent::where('student_id', $studentId)->first();
        }

        else{
            self::$branchStudent  = new BranchStudent();
            self::$course = Course::find($request->course_id);
            self::$branch = Branch::find($request->branch_id);
            $fee = feeCalculation($request) - self::$course->discount;

            self::$branchStudent->branch_id             = $request->branch_id ;
            self::$branchStudent->branch_code           = self::$branch->branch_code ;
            self::$branchStudent->student_id            = $studentId ;
            self::$branchStudent->student_roll          = self::$branch->branch_code.$studentId;
            self::$branchStudent->student_registration  = self::$branch->branch_code.'00'.$request->course_id.date('Y').$request->session_id.$studentId;
            self::$branchStudent->course_id             = $request->course_id ;
            self::$branchStudent->session_id            = $request->session_id ;
            self::$branchStudent->join_month            = date('m');
            self::$branchStudent->join_year             = date('Y');
            self::$branchStudent->join_date             = date('Y-m-d');
            self::$branchStudent->total_fee             = $fee;
            self::$branchStudent->due                   = $fee;
            self::$branchStudent->discount              = self::$course->discount;
        }

        self::$branchStudent->medium_id                 = $request->medium_id ;
        self::$branchStudent->result_marks              = $request->result_marks;
        self::$branchStudent->result_grade_id           = $request->result_grade_id;
        self::$branchStudent->status_id                 = $request->status_id;

        self::$branchStudent->save();

        return self::$branchStudent;
    }

    public static function updateBill($request, $student)
    {
        $bill = BillType::find($request->bill_type_id);
        self::$branchStudent = BranchStudent::find($student->id);
        self::$branchStudent->total_fee += $bill->bill_amount;
        self::$branchStudent->due += $bill->bill_amount;
        self::$branchStudent->save();
    }

    public static function updatePayment($request, $student)
    {
        self::$branchStudent = BranchStudent::find($student->id);
        self::$branchStudent->total_paid += $request->amount;
        self::$branchStudent->due -= $request->amount;
        self::$branchStudent->save();
    }



    public static function resultUpdate($request)
    {
        self::$branchStudent = BranchStudent::find($request->id);
        self::$branchStudent->result_marks              = $request->result_marks;
        self::$branchStudent->result_grade_id           = $request->result_grade_id;
        self::$branchStudent->save();
    }

    public static function remove($id)
    {
        self::$branchStudent = BranchStudent::find($id);
        self::$branchStudent->delete();
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function session()
    {
        return $this->belongsTo(Session::class, 'session_id');
    }

    public function resultGrade()
    {
        return $this->belongsTo(ResultGrade::class, 'result_grade_id', 'result_grade_id');
    }

}
