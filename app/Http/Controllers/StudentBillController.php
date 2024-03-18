<?php

namespace App\Http\Controllers;

use App\Models\BillType;
use App\Models\Branch;
use App\Models\BranchAccount;
use App\Models\BranchStudent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentBillController extends Controller
{
    private $branchStudent;
    public function add()
    {
        $data['bill_types'] = BillType::all();
        $data['months'] = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        return view('admin.student-bill.form', $data);
    }

    public function submit(Request $request)
    {
        $this->validation($request);
        $this->branchStudent = BranchStudent::where('student_roll', $request->student_roll)
            ->where('branch_code', Auth::user()->branch_code)->first();
        if($this->branchStudent){
            BranchAccount::updateBill($request, $this->branchStudent);
            BranchStudent::updateBill($request, $this->branchStudent);
            return redirect()->route('student.bill.list')->with('message', 'Student Bill Has Been Added Successfully!!');
        }
        return back()->with('message', 'No Student Information Found!!');
    }

    public function list()
    {
        $branch = Branch::where('branch_code', Auth::user()->branch_code)->first();
        $data['months'] = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        $this->branchStudent = BranchStudent::where('branch_id', $branch->id)->latest();

        if(isset($_GET['student_roll']) && $_GET['student_roll'] > 0){
            $branchStudent = $this->branchStudent->where('student_roll', $_GET['student_roll']);
        }
        if(isset($_GET['year']) && $_GET['year'] > 0){
            $branchStudent = $this->branchStudent->where('join_year', $_GET['year']);
        }
        if(isset($_GET['month']) && $_GET['month'] > 0){
            $branchStudent = $this->branchStudent->where('join_month', $_GET['month']);
        }
        $data['items'] = $this->branchStudent->paginate(50);
        return view('admin.student-bill.list', $data);
    }

    public function validation($request)
    {
        $request->validate([
            'student_roll'=>['required'],
            'bill_date' =>['required'],
            'bill_month'=>['required'],
            'bill_year' =>['required'],
            'bill_type_id' =>['required'],
        ]);
    }
}
