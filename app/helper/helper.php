<?php

use App\Models\BillType;
use App\Models\BranchStudent;
use App\Models\Course;
use App\Models\Branch;
use App\Models\BranchAccount;
use App\Models\Setting;
use App\Models\Session;
use App\Models\Student;
use App\Models\CourseModule;
use Illuminate\Support\Facades\Auth;
use App\Models\CourseModuleResult;

function getStudentsByBranchId($id, $year=null){
    if($year != null){
        $data = BranchStudent::where('branch_id', $id)->where('join_year', $year)->get();
    }
    else{
        $data = BranchStudent::where('branch_id', $id)->get();
    }

    return $data;
}

function getStudentsByCourseId($id){
    $data = BranchStudent::where('course_id', $id)->get();
    return $data;
}

function getCoursesBySessionId($id){
    $data = BranchStudent::select('course_id')->where('session_id', $id)->distinct()->get();
    return $data;
}
function getStudentsBySessionId($id, $year=null){
    $branch_id = getBranchIdByAdmin();
    if($branch_id){
        if($year != null){
            $data = BranchAccount::where('session_id', $id)
                ->where('branch_id', $branch_id)->
                where('bill_year', $year)->get();
        }
        else{
            $data = BranchAccount::where('session_id', $id)
                ->where('branch_id', $branch_id)->get();
        }
    }
    else{
        $data = BranchStudent::where('session_id', $id)->get();
    }

    return $data;
}

function getBillBySessionId($id, $year=null)
{
    $branch_id = getBranchIdByAdmin();
    if($branch_id){
        if($year != null){
            $bills = BranchAccount::where('session_id', $id)
                ->where('branch_id', $branch_id)->
                where('bill_year', $year)->get();
        }
        else{
            $bills = BranchAccount::where('session_id', $id)
                ->where('branch_id', $branch_id)->get();
        }
    }
    else{
        $bills = BranchAccount::where('session_id', $id)->get();
    }

    $sum = 0;
    foreach ($bills as $bill){
        $sum+= $bill->amount;
    }
    return $sum;
}

function getCourseById($id)
{
    $data = Course::find($id);
    return $data;
}
function getBranchById($id)
{
    $data = Branch::find($id);
    return $data;
}

function getBillsByBranchId($id, $year=null){
    if($year!=null){
        $students = BranchAccount::where('branch_id', $id)->where('bill_year', $year)->get();
    }
    else{
        $students = BranchAccount::where('branch_id', $id)->get();
    }

    $sum = 0;
    foreach ($students as $student){
        $sum+= $student->amount;
    }
    return $sum;
}

function getPaymentByBranchId($id, $year=null){
    if($year != null){
        $students = BranchAccount::where('branch_id', $id)->where('bill_year', $year)->get();
    }
    else{
        $students = BranchAccount::where('branch_id', $id)->get();
    }
    $sum = 0;
    foreach ($students as $student){
        $sum+= $student->payment;
    }
    return $sum;
}


function getBranchIdByAdmin()
{
    $branch = null;
    if(Auth::user()->role == 2){
        $branch = Branch::where('branch_code', Auth::user()->branch_code)->first();
        return $branch->id;
    }
    else{
        return null;
    }

}

function getStudents($year=null)
{
    $branch_id = getBranchIdByAdmin();

    if($year != null and $branch_id == null ){
        $students = BranchStudent::where('join_year', $year)->get();
    }
    elseif ($year == null and $branch_id != null ) {
        $students = BranchStudent::where('branch_id', $branch_id)->get();
    }
    elseif ($year != null and $branch_id != null ) {
        $students = BranchStudent::where('branch_id', $branch_id)
            ->where('join_year', $year)->get();
    }
    else{
        $students = BranchStudent::all();
    }

    return $students;
}

function getBills($year=null){
    $branch_id = getBranchIdByAdmin();

    if($year != null and $branch_id == null){
        $students = BranchAccount::where('bill_year', $year)->get();
    }
    elseif ($year == null and $branch_id != null ) {
        $students = BranchAccount::where('branch_id', $branch_id)->get();
    }
    elseif ($year != null and $branch_id != null ) {
        $students = BranchAccount::where('branch_id', $branch_id)
            ->where('bill_year', $year)->get();
    }
    else{
        $students = BranchAccount::all();
    }
    $sum = 0;
    foreach ($students as $student){
        $sum+= $student->amount;
    }
    return $sum;
}

function getPayments($year=null){
    $branch_id = getBranchIdByAdmin();

    if($year != null and $branch_id == null){
        $students = BranchAccount::where('bill_year', $year)->get();
    }
    elseif ($year == null and $branch_id != null ) {
        $students = BranchAccount::where('branch_id', $branch_id)->get();
    }
    elseif ($year != null and $branch_id != null ) {
        $students = BranchAccount::where('branch_id', $branch_id)
            ->where('bill_year', $year)->get();
    }
    else{
        $students = BranchAccount::all();
    }
    $sum = 0;
    foreach ($students as $student){
        $sum+= $student->payment;
    }
    return $sum;
}

function getActiveSessions()
{
    $data = Session::where('session_status_id', 1)->get();
    return $data;
}

function getSettings($key){
    $setting = Setting::where('key', $key)->first();
    if(!$setting){
        return '';
    }
    return $setting->value;
}
function getStudentById($id)
{
    $data = Student::find($id);
    return $data;
}
function getBranchStudentById($id)
{
    $data = BranchStudent::find($id);
    return $data;
}

function getBranchStudentByStudentId($id){
    $data = BranchStudent::where('student_id', $id)->first();
    return $data;
}

function feeCalculation($request)
{
    $course = Course::find($request->course_id);
    $fee = $course->course_fee;
    $billTypes = BillType::all();

    foreach ($billTypes as $bill){
        $fee+= $bill->bill_amount;
    }

    return $fee;
}

function getCourseModuleByCourseId($id)
{
    $data = CourseModule::where('course_id', $id)->get();
    return $data;
}
function getModuleResultByStudentId($id)
{
    $data= CourseModuleResult::where('student_id', $id)->get();
    return $data;
}
