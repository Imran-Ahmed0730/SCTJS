<?php

namespace App\Http\Controllers;

use App\Models\BranchApply;
use Illuminate\Http\Request;

class BranchApplyController extends Controller
{
    public function index()
    {
        return view('frontend.pages.branches.branch-apply');
    }

    public function submit(Request $request)
    {
//        return $request;
        $request->validate([
            'name_en'=>['required'],
            'name_bn'=>['required'],
            'father_name'=>['required'],
            'nid_number'=>['required', 'unique:branch_applies'],
            'institution_name_en'=>['required'],
            'institution_name_bn'=>['required'],
            'address_en'=>['required'],
            'address_bn'=>['required'],
            'phone'=>['required', 'min:11',' max:16'],
            'email'=>['required', 'unique:branch_applies'],
            'head_image'=>['required'],
            'nid_image'=>['required'],
            'trade_licence_image'=>['required'],
        ]);

        BranchApply::applyForBranch($request);
        return back()->with('message', 'Application for Branch Has Been Successfully Sent!!');
    }

    public function list()
    {
        $data['items'] = BranchApply::where('status', 0)->latest()->paginate(100);
//        $data['approved_items'] = BranchApply::where('status', 1)->latest()->paginate(100);
        return view('admin.branch-application.list', $data);
    }

    public function details($id)
    {
        $data['item'] = BranchApply::find($id);
        return view('admin.branch-application.details', $data);
    }

    public function remove(Request $request)
    {
        BranchApply::remove($request->id);
        return redirect()->route('branch.applications.list')->with('message', 'Branch Application Removed Successfully!!');
    }
}
