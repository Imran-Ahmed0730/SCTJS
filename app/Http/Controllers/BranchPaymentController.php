<?php

namespace App\Http\Controllers;

use App\Models\BranchAccount;
use App\Models\BranchPayment;
use App\Models\BranchStudent;
use Illuminate\Http\Request;
use App\Models\Branch;
use Illuminate\Support\Facades\Auth;
use DB;

class BranchPaymentController extends Controller
{
    public function add()
    {
        return view('admin.payment.form');
    }


    public function submit(Request $request)
    {
//        return $request;
        $this->validation($request);
        BranchPayment::addOrUpdatePayment($request);
        return redirect()->route('admin.branch.payment.list')->with('message', 'Payment Has Been Added Successfully!!');
    }

    public function list()
    {

        $branchAccount = BranchPayment::latest();

        if(isset($_GET['branch_id']) && $_GET['branch_id']>0){
            $branchAccount = $branchAccount->where('branch_id', $_GET['branch_id']);
        }
        if(isset($_GET['month']) && $_GET['month']>0){
            $branchAccount = $branchAccount->whereMonth('created_at', $_GET['month']);
        }
        if(isset($_GET['year']) && $_GET['year']>0){
            $branchAccount = $branchAccount->whereYear('created_at', $_GET['year']);
        }

        $data['items'] = $branchAccount->get();
        $data['months'] = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        return view('admin.payment.list', $data);
    }

    public function billing(){
        $data['items'] = Branch::paginate(50);
        return view('admin.payment.billing', $data);
    }

    public function payment()
    {
        if(Auth::user()->role == 1){
            $branchAccount = BranchAccount::where('amount', '!=', '0')->latest();
        }
        else{
            $branch = Branch::where('branch_code', Auth::user()->branch_code)->first();
            $branchAccount = BranchAccount::where('branch_id', $branch->id)->latest();

        }

        if(isset($_GET['student_roll']) && $_GET['student_roll'] > 0 ){
            $branchStudent = BranchStudent::where('student_roll', $_GET['student_roll'])->first();
            $branchAccount = $branchAccount->where('student_id', $branchStudent->student_id);
//            return $branchAccount->first();
        }
        if(isset($_GET['year']) && $_GET['year']>0){
            $branchAccount = $branchAccount->where('bill_year', $_GET['year']);
        }
        if(isset($_GET['month']) && $_GET['month']>0){
            $branchAccount = $branchAccount->where('bill_month', $_GET['month']);
        }

        $data['items'] = $branchAccount->paginate(25);
        $data['months'] = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        return view('admin.account.payment', $data);
    }

    public function edit($id)
    {
//        return $id;
        $data['item'] = BranchPayment::find($id);
        return view('admin.payment.form', $data);
    }

    public function update(Request $request)
    {
//        return $request;
        $this->validation($request);
        BranchAccount::addOrUpdatePayment($request);
        return redirect()->route('admin.branch.payment.list')->with('message', 'Payment Information Has Been Update Successfully!!');
    }

    public function remove(Request $request)
    {
        BranchAccount::remove($request->id);
        return back()->with('message', 'Payment Has Been Removed Successfully!!');
    }

    public function validation($request){
        $request->validate([
            'branch_id'=>['required'] ,
            'payment'=>['required'],
        ]);
    }
}
