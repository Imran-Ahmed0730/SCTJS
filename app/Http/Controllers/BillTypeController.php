<?php

namespace App\Http\Controllers;

use App\Models\BillType;
use Illuminate\Http\Request;

class BillTypeController extends Controller
{
    public function add()
    {
        return view('admin.bill_type.form');
    }

    public function submit(Request $request)
    {
//        return $request;
        $this->validation($request);
        BillType::addOrUpate($request);
        return redirect()->route('admin.bills.type.list')->with('message', 'Bill Type Information Added Successfully!!');
    }

    public function list()
    {
        $data['items'] = BillType::all();
        return view('admin.bill_type.list', $data);
    }

    public function edit($id)
    {
        $data['item'] = BillType::find($id);
        return view('admin.bill_type.form', $data);
    }

    public function update(Request $request)
    {
        $request->validate([
            'bill_type_name'=> ['required'],
            'bill_amount'=> ['required'],
        ]);
        BillType::addOrUpate($request);
        return redirect()->route('admin.bills.type.list')->with('message', 'Bill Type Information Updated Successfully!!');
    }

    public function remove(Request $request)
    {
        BillType::remove($request->id);
        return back()->with('message', 'Bill Type Information Deleted Successfully!!');
    }

    private function validation($request)
    {
        $request->validate([
            'bill_type_name'=> ['required', 'unique:bill_types'],
            'bill_amount'=> ['required'],
        ]);
    }
}
