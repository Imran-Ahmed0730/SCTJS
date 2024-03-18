<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class StudentPayment extends Model
{
    use HasFactory;
    private static $student;

    public static function addOrUpdate($request, $branchStudent)
    {
        if(StudentPayment::find($request->id)){
            self::$student = StudentPayment::find($request->id);
        }
        else{
            self::$student = new StudentPayment();
        }
        self::$student->payment_date    = $request->payment_date;
        self::$student->payment_month      = $request->payment_month;
        self::$student->payment_year       = $request->payment_year;
        self::$student->bill_date       = $request->bill_date;
        self::$student->bill_month      = $request->bill_month;
        self::$student->bill_year       = $request->bill_year;
        self::$student->amount          = $request->amount;
        self::$student->comment         = $request->comment;
        self::$student->student_id      = $branchStudent->student_id;
        self::$student->student_roll    = $request->student_roll;
        self::$student->course_id       = $branchStudent->course_id;
        self::$student->branch_id       = $branchStudent->branch_id;
        self::$student->session_id      = $branchStudent->session_id;
        self::$student->added_by        = Auth::user()->id;

        self::$student->save();
    }

    public static function remove($studentId)
    {
        $studentPayment = StudentPayment::where('student_id', $studentId)->get();

        foreach ($studentPayment as $payment){
            $payment->delete();
        }
    }

    public function branchStudent()
    {
        return $this->belongsTo(BranchStudent::class, 'student_id');
    }
}
