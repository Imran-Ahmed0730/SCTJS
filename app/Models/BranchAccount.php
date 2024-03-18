<?php

namespace App\Models;

use http\Env\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchAccount extends Model
{
    use HasFactory;
    private static $branchAccount, $course, $billType;
    public static function addBill($branchStudent)
    {
        self::$billType = BillType::all();
        foreach (self::$billType as $bill){
            if($bill->id == 1 || $bill->id == 127){
                self::$branchAccount = new BranchAccount();
                self::$branchAccount->bill_date     = date('Y-m-d');
                self::$branchAccount->bill_month    = date('m');
                self::$branchAccount->bill_year     = date('Y');


                self::$course = Course::find($branchStudent->course_id);
                if($bill->bill_type_name == 'course_fee'){
                    $bill->bill_amount = self::$course->course_fee;
                }
                self::$branchAccount->branch_id         = $branchStudent->branch_id;
                self::$branchAccount->course_id         = $branchStudent->course_id;
                self::$branchAccount->discount          = self::$course->discount;
                self::$branchAccount->branch_student_id = $branchStudent->id;
                self::$branchAccount->student_id        = $branchStudent->student_id;
                self::$branchAccount->session_id        = $branchStudent->session_id;
                self::$branchAccount->bill_type_id      = $bill->id;
                self::$branchAccount->amount            = $bill->bill_amount;

                self::$branchAccount->save();
            }
        }

    }

    public static function updateBill($request, $branchStudent)
    {
        $bill = BillType::find($request->bill_type_id);
        self::$branchAccount = new BranchAccount();
        self::$branchAccount->bill_date     = $request->bill_date;
        self::$branchAccount->bill_month    = $request->bill_month;
        self::$branchAccount->bill_year     = $request->bill_year;


        self::$course = Course::find($branchStudent->course_id);
//        dd(self::$course);
        self::$branchAccount->branch_id         = $branchStudent->branch_id;
        self::$branchAccount->course_id         = $branchStudent->course_id;
        self::$branchAccount->discount          = self::$course->discount;
        self::$branchAccount->branch_student_id = $branchStudent->id;
        self::$branchAccount->student_id        = $branchStudent->student_id;
        self::$branchAccount->session_id        = $branchStudent->session_id;
        self::$branchAccount->bill_type_id      = $request->bill_type_id;
        self::$branchAccount->amount            += $bill->bill_amount;
        self::$branchAccount->comments          = $request->comments;

        self::$branchAccount->save();
    }


    public static function remove($id)
    {
        self::$branchAccount = BranchAccount::find($id);
        self::$branchAccount->delete();
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }
    public function branchStudent()
    {
        return $this->belongsTo(BranchStudent::class, 'branch_student_id');
    }
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
    public function session()
    {
        return $this->belongsTo(Session::class, 'session_id', 'id');
    }
}
