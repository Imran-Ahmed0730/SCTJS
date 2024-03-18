<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;
use App\Models\Notice;
use Illuminate\Support\Facades\Auth;

class NoticeController extends Controller
{
    public function add()
    {
        $data['branches'] = Branch::latest()->get();
        return view('admin.notice.form', $data);
    }

    public function submit(Request $request)
    {
//        return $request;
        $this->validation($request);
        Notice::addOrUpdate($request);
        return redirect()->route('admin.notice.list')->with('message', 'Notice Has Been Added Successfully!!');
    }

    public function list()
    {
        if(Auth::user()->role == 2){
            $data['items'] = Notice::where('branch_id', Auth::user()->branch_code)->orWhere('branch_id', '0')->get();
        }
        else{
            $data['items'] = Notice::latest()->get();
        }

        return view('admin.notice.list', $data);
    }

    public function edit($id)
    {
        $data['branches'] = Branch::latest()->get();
        $data['item'] = Notice::find($id);
        return view('admin.notice.form', $data);
    }

    public function update(Request $request)
    {
        $this->validation($request);
        Notice::addOrUpdate($request);
        return redirect()->route('admin.notice.list')->with('message', 'Notice Information Has Been Update Successfully!!');
    }

    public function remove(Request $request)
    {
        Notice::remove($request->id);
        return back()->with('message', 'Notice Has Been Removed Successfully!!');
    }

    public function validation($request){
        $request->validate([
            'notice_title'=>['required'],
            'notice_description'=>['required'],
            'branch_id'=>['required'],
        ]);
    }
}
