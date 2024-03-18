<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\BranchAccount;
use Illuminate\Http\Request;
use App\Models\Session;
use Illuminate\Support\Facades\Auth;

class BranchAccountController extends Controller
{
    private $branch;
    public function billSummary()
    {
//        if(isset($_GET['year'])){
//            return $_GET['year'];
//        }
        $branch_id = 0;
        if(Auth::user()->role == 2){
            $this->branch = Branch::where('branch_code', Auth::user()->branch_code)->first();
            $branch_id = $this->branch->id;
        }
        $accounts = BranchAccount::select('session_id')
            ->selectRaw('SUM(amount) as amount, COUNT(branch_student_id) as student')
            ->where('branch_id', $branch_id)
            ->groupBy('session_id')->orderBy('session_id', 'asc');
        if(isset($_GET['year']) && $_GET['year'] > 0){
            $accounts = $accounts->where('bill_year',  $_GET['year']);
        }
        $data['sessionsAccount'] = $accounts->get();
        return view('admin.account.bill-summary', $data);
    }
}
