<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\BranchAccount;
use App\Models\BranchStudent;
use App\Models\Student;
use App\Models\StudentPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentPaymentController extends Controller
{
    private $branchStudent;
    public function add()
    {
        $data['months'] = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        return view('admin.student-payment.form', $data);
    }


    public function submit(Request $request)
    {
        $this->branchStudent = BranchStudent::where('student_roll', $request->student_roll)
            ->where('branch_code', Auth::user()->branch_code)->first();
        if($this->branchStudent)
        {
//            return $request;
            $this->validation($request);
            StudentPayment::addOrUpdate($request, $this->branchStudent);
            BranchStudent::updatePayment($request, $this->branchStudent);
            return redirect()->route('student.payment.list')->with('message', 'Payment Has Been Added Successfully!!');
        }

        return back()->with('message', 'No Student Information found');

    }

    public function list()
    {   $branch = Branch::where('branch_code', Auth::user()->branch_code)->first();
        $billingStudent = StudentPayment::where('branch_id', $branch->id)->latest();

        if(isset($_GET['student_roll']) && $_GET['student_roll'] > 0){
            $student = BranchStudent::where('student_roll', $_GET['student_roll'])->first();
//            return $student->student_id;
            $billingStudent = $billingStudent->where('student_id', $student->student_id);
        }
        if(isset($_GET['year']) && $_GET['year'] > 0){
            $billingStudent = $billingStudent->where('payment_year', $_GET['year']);
        }
        if(isset($_GET['month']) && $_GET['month'] > 0){
            $billingStudent = $billingStudent->where('payment_month', $_GET['month']);
        }
        $data['items'] = $billingStudent->paginate(50);
        $data['months'] = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        return view('admin.student-payment.list', $data);
    }

    public function edit($id)
    {
        $data['months'] = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        $data['item'] = StudentPayment::find($id);
        return view('admin.student-payment.form', $data);
    }

    public function update(Request $request)
    {
//        return $request;
        $this->branchStudent = BranchStudent::where('student_roll', $request->student_roll)->first();

        $this->validation($request);
        StudentPayment::addOrUpdate($request, $this->branchStudent);
        BranchStudent::updatePayment($request, $this->branchStudent);
        return redirect()->route('student.payment.list')->with('message', 'Payment Information Has Been Update Successfully!!');
    }

    public function validation($request){
        $request->validate([
            'student_roll'  => ['required'] ,
            'amount'        => ['required'],
            'payment_date'  => ['required'],
            'payment_month' => ['required'],
            'payment_year'  => ['required'],
            'bill_date'     => ['required'],
            'bill_month'    => ['required'],
            'bill_year'     => ['required'],
        ]);
    }
}
